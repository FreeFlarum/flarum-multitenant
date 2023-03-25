import {extend, override} from 'flarum/common/extend';
import app from 'flarum/forum/app';
import ItemList from 'flarum/common/utils/ItemList';
import SubtreeRetainer from 'flarum/common/utils/SubtreeRetainer';
import CommentPost from 'flarum/forum/components/CommentPost';
import UserCard from 'flarum/forum/components/UserCard';
import DiscussionHero from 'flarum/forum/components/DiscussionHero';
import DropArea from './components/DropArea';
import MovingFish from './components/MovingFish';

interface DragOverComponent {
    fishDragOver: boolean
    subtree?: SubtreeRetainer
    attrs?: any
}

function fishIdFromEvent(event: DragEvent): string | null {
    if (!event.dataTransfer) {
        return null;
    }

    const data = event.dataTransfer.getData("text/plain");

    const match = /^fish:([0-9]+)$/.exec(data);

    return match ? match[1] : null;
}

function movingFishContent(dragover: boolean, model: any) {
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

function addDropAttrs(this: DragOverComponent, attrs: any, modelProperty: string) {
    attrs.ondrop = (event: DragEvent) => {
        this.fishDragOver = false;

        const fishId = app.draggedFishId || fishIdFromEvent(event);

        if (fishId) {
            event.preventDefault();

            const fish = app.store.getById('catchthefish-fishes', fishId);

            if (fish) {
                const placement: any = {};
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
    attrs.ondragover = (event: DragEvent) => {
        if (app.draggedFishId || fishIdFromEvent(event)) {
            event.preventDefault();
            event.dataTransfer!.dropEffect = 'move';

            if (this.fishDragOver) {
                event.redraw = false;
            } else {
                this.fishDragOver = true;
                m.redraw();
            }
        } else {
            // In order to still support drag and drop across windows, we will accept any text drops
            // This is necessary because browsers don't give access to the drop value until the actual drop
            // But if we don't call preventDefault() here the drop can't happen in the first place
            if (event.dataTransfer && event.dataTransfer.types.includes('text/plain')) {
                event.preventDefault();
            }

            event.redraw = false;
        }
    };
    attrs.ondragenter = (event: DragEvent) => {
        event.preventDefault();
        event.redraw = false;
    };
    attrs.ondragleave = (event: DragEvent) => {
        if (this.fishDragOver) {
            this.fishDragOver = false;
            m.redraw();
        } else {
            event.redraw = false;
        }
    };
}

function addAreaToComponent(component: DragOverComponent, viewName: string, modelProperty: string) {
    if (viewName === 'content') {
        override(component, viewName, function (original: any) {
            return original().concat(movingFishContent(this.fishDragOver, this.attrs[modelProperty]));
        });
    } else {
        extend(component, viewName, function (items: ItemList<any>) {
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
    addAreaToComponent(CommentPost.prototype as any, 'content', 'post');
    addAreaToComponent(UserCard.prototype as any, 'infoItems', 'user');
    addAreaToComponent(DiscussionHero.prototype as any, 'items', 'discussion');

    document.addEventListener('dragend', () => {
        app.draggedFishId = null;
    });
}
