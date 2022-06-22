import {Vnode} from 'mithril';
import app from 'flarum/forum/app';
import Link from 'flarum/common/components/Link';
import Page from 'flarum/common/components/Page';
import Button from 'flarum/common/components/Button';
import Discussion from 'flarum/common/models/Discussion';
import Post from 'flarum/common/models/Post';
import UserModel from 'flarum/common/models/User';
import NewFishModal from '../modals/NewFishModal';
import EditFishModal from '../modals/EditFishModal';
import FishImage from '../components/FishImage';
import User from '../components/User';
import Fish from '../models/Fish';
import Round from '../models/Round';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.table-fish.';

export default class RoundSettings extends Page {
    roundId!: string
    round: Round | null = null
    fishes: Fish[] | null = null
    uploading: boolean = false

    oninit(vnode: Vnode) {
        super.oninit(vnode);

        this.roundId = m.route.param('id');
        this.round = app.store.getById('catchthefish-round', this.roundId);

        if (!this.round) {
            app.store.find('catch-the-fish/rounds', this.roundId).then(round => {
                this.round = round;
                m.redraw();
            });
        }

        this.refreshFishes();
    }

    refreshFishes() {
        this.fishes = null;

        app.request({
            method: 'GET',
            url: app.forum.attribute('apiUrl') + '/catch-the-fish/rounds/' + this.roundId + '/fishes',
        }).then(result => {
            this.fishes = app.store.pushPayload(result);
            m.redraw();
        });
    }

    // Based on Flarum's AvatarEditor component
    openPicker(callback: (files: FileList) => void, multiple = false) {
        if (this.uploading) return;

        const $input = $('<input type="file">');
        // @ts-ignore should the variable be cast to string?
        $input.attr('multiple', multiple);
        $input.appendTo('body').hide().click().on('change', event => {
            callback((event.target as HTMLInputElement).files as FileList);
        });
    }

    uploadImages(images: FileList, fish?: Fish) {
        const body = new FormData();

        if (fish) {
            body.append('image', images[0]);
        } else {
            for (let i = 0; i < images.length; i++) {
                body.append('image' + i, images[i]);
            }
        }

        this.uploading = true;
        m.redraw();

        app.request({
            method: 'POST',
            url: app.forum.attribute('apiUrl') + '/catch-the-fish/' + (fish ? 'fishes/' + fish.id() + '/image' : 'rounds/' + this.roundId + '/fishes-from-images'),
            serialize: (raw: any) => raw,
            body,
        }).then(() => {
            this.uploading = false;
            m.redraw();
            this.refreshFishes();
        }).catch(err => {
            this.uploading = false;
            m.redraw();
            throw err;
        });
    }

    view() {
        if (!this.round || this.fishes === null) {
            return m('.container', m('p', app.translator.trans(translationPrefix + 'loading')));
        }

        return m('.container', [
            m('h2', app.translator.trans(translationPrefix + 'title', {
                name: this.round.name(),
            })),
            Button.component({
                className: 'Button Button--primary',
                onclick: () => {
                    app.modal.show(NewFishModal, {
                        round: this.round,
                        oncreateordelete: () => {
                            this.refreshFishes();
                        },
                    });
                },
            }, app.translator.trans(translationPrefix + 'new')),
            ' ',
            Button.component({
                className: 'Button',
                type: 'button',
                onclick: () => {
                    this.openPicker(files => {
                        this.uploadImages(files);
                    }, true);
                },
                loading: this.uploading,
            }, app.translator.trans(translationPrefix + 'new-from-image')),
            m('table.catchthefish-table', [
                m('thead', m('tr', [
                    m('th', app.translator.trans(translationPrefix + 'image')),
                    m('th', app.translator.trans(translationPrefix + 'name')),
                    m('th', app.translator.trans(translationPrefix + 'user-name')),
                    m('th', app.translator.trans(translationPrefix + 'user-place')),
                    m('th', app.translator.trans(translationPrefix + 'placement')),
                    m('th', app.translator.trans(translationPrefix + 'actions')),
                ])),
                m('tbody', this.fishes.length === 0 ? m('tr', [
                    m('td', 'No fishes'),
                ]) : this.fishes.map(fish => {
                    const namedBy = fish.namedBy();
                    const placedBy = fish.placedBy();

                    return m('tr', [
                        m('td', m(FishImage, {
                            fish,
                        })),
                        m('td', fish.name()),
                        m('td', namedBy ? m(User, {
                            user: namedBy,
                        }) : m('em', app.translator.trans(translationPrefix + 'no-user-name'))),
                        m('td', placedBy ? m(User, {
                            user: placedBy,
                        }) : m('em', app.translator.trans(translationPrefix + 'no-user-place'))),
                        m('td', this.placement(fish)),
                        m('td', [
                            Button.component({
                                className: 'Button',
                                onclick: () => {
                                    app.modal.show(EditFishModal, {
                                        fish,
                                        oncreateordelete: () => {
                                            this.refreshFishes();
                                        },
                                    });
                                },
                            }, app.translator.trans(translationPrefix + 'edit')),
                            ' ',
                            Button.component({
                                className: 'Button',
                                type: 'button',
                                onclick: () => {
                                    this.openPicker(files => {
                                        this.uploadImages(files, fish);
                                    });
                                },
                                loading: this.uploading,
                            }, app.translator.trans(translationPrefix + 'upload')),
                        ]),
                    ]);
                })),
            ]),
        ]);
    }

    placement(fish: Fish): any {
        const placement = fish.placementModel();

        if (placement instanceof Discussion) {
            return m(Link, {
                href: app.route.discussion(placement),
            }, placement.title());
        }

        if (placement instanceof Post) {
            const discussion = placement.discussion();

            return m(Link, {
                href: app.route.post(placement),
            }, (discussion ? discussion.title() : '') + ' #' + placement.number());
        }

        if (placement instanceof UserModel) {
            return m(User, {
                user: placement,
            });
        }

        return 'N/A';
    }
}
