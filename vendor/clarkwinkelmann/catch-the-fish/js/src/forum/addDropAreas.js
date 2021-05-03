import {extend, override} from 'flarum/common/extend';
import app from 'flarum/app';
import CommentPost from 'flarum/forum/components/CommentPost';
import UserCard from 'flarum/forum/components/UserCard';
import DiscussionHero from 'flarum/forum/components/DiscussionHero';
import DropArea from './components/DropArea';
import MovingFish from './components/MovingFish';

/* global m */

function fishIdFromEvent(event) {
    const data = event.dataTransfer.getData("text/plain");

    const match = /^fish:([0-9]+)$/.exec(data);

    return match ? match[1] : null;
}

function movingFishContent(dragover, model) {
    const content = [];

    if (dragover) {
        content.push(m(DropArea));
    }

    const fishes = model.catchTheFishFishes();

    if (fishes) {
        fishes.forEach(fish => {
            if (!fish.canSee()) {
                return;
            }

            // Remove fish from relationship
            content.push(m(MovingFish, {
                fish,
                oncatch: () => {
                    model.pushData({
                        relationships: {
                            catchTheFishFishes: {
                                data: model.data.relationships.catchTheFishFishes.data.filter(f => f.id !== fish.id()),
                            },
                        },
                    });
                },
            }));
        });
    }

    return content;
}

function addDropAttrs(attrs, modelProperty) {
    attrs.ondrop = event => {
        this.fishDragOver = false;
        const fishId = fishIdFromEvent(event);

        if (fishId) {
            event.preventDefault();

            const fish = app.store.getById('catchthefish-fishes', fishId);

            if (fish) {
                const placement = {};
                placement[modelProperty + '_id'] = this.attrs[modelProperty].id();

                app.request({
                    method: 'POST',
                    url: app.forum.attribute('apiUrl') + '/catch-the-fish/fishes/' + fish.id() + '/place',
                    body: {
                        placement,
                    },
                }).then(result => {
                    app.store.pushPayload(result);

                    // Refresh basket by reloading user
                    app.store.find('users', app.session.user.id()).then(() => {
                        m.redraw();
                    });
                });
            } else {
                alert(app.translator.trans('clarkwinkelmann-catch-the-fish.forum.drop-area.missing-from-store'));
            }
        }
    };
    attrs.ondragover = event => {
        const fishId = fishIdFromEvent(event);

        if (fishId) {
            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';
            this.fishDragOver = true;
        }
    };
    attrs.ondragenter = event => {
        event.preventDefault();
    };
    attrs.ondragleave = () => {
        this.fishDragOver = false;
    };
}

function addAreaToComponent(component, viewName, modelProperty) {
    if (viewName === 'content') {
        override(component, viewName, function (content) {
            return content().concat(movingFishContent(this.fishDragOver, this.attrs[modelProperty]));
        });
    } else {
        extend(component, viewName, function (items) {
            items.add('catchthefish-fish-and-drop', movingFishContent(this.fishDragOver, this.attrs[modelProperty]));
        });
    }

    extend(component, 'oninit', function () {
        this.fishDragOver = false;

        // Add a condition to the post tree retainer
        if (this.subtree) {
            this.subtree.check(() => this.fishDragOver);
        }
    });

    if (viewName === 'content') {
        // CommentPost has an attrs() method we can extend
        extend(component, 'elementAttrs', function (attrs) {
            addDropAttrs.bind(this)(attrs, modelProperty);
        });
    } else {
        // For other elements we manually add attrs to the vdom of the view
        extend(component, 'view', function (vdom) {
            vdom.attrs = vdom.attrs || {};
            addDropAttrs.bind(this)(vdom.attrs, modelProperty);
        });
    }
}

export default function () {
    addAreaToComponent(CommentPost.prototype, 'content', 'post');
    addAreaToComponent(UserCard.prototype, 'infoItems', 'user');
    addAreaToComponent(DiscussionHero.prototype, 'items', 'discussion');
}
