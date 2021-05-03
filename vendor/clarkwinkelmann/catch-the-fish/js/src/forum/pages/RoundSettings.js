import app from 'flarum/app';
import Page from 'flarum/common/components/Page';
import Button from 'flarum/common/components/Button';
import NewFishModal from '../modals/NewFishModal';
import EditFishModal from '../modals/EditFishModal';
import FishImage from '../components/FishImage';
import User from "../components/User";

/* global m, $ */

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.table-fish.';

export default class RoundSettings extends Page {
    oninit(vnode) {
        super.oninit(vnode);

        this.roundId = m.route.param('id');
        this.round = app.store.getById('catchthefish-round', this.roundId);

        if (!this.round) {
            app.store.find('catch-the-fish/rounds', this.roundId).then(round => {
                this.round = round;
                m.redraw();
            });
        }

        this.uploading = false;

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
    openPicker(callback, multiple = false) {
        if (this.uploading) return;

        const $input = $('<input type="file">');
        $input.attr('multiple', multiple);
        $input.appendTo('body').hide().click().on('change', e => {
            callback($(e.target)[0].files);
        });
    }

    uploadImages(images, fish) {
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
            serialize: raw => raw,
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
                    m('th', app.translator.trans(translationPrefix + 'actions')),
                ])),
                m('tbody', this.fishes.length === 0 ? m('tr', [
                    m('td', 'No fishes'),
                ]) : this.fishes.map(fish => m('tr', [
                    m('td', m(FishImage, {
                        fish,
                    })),
                    m('td', fish.name()),
                    m('td',  fish.namedBy() ? m(User, {
                        user: fish.namedBy(),
                    }) : m('em', app.translator.trans(translationPrefix + 'no-user-name'))),
                    m('td', fish.placedBy() ? m(User, {
                        user: fish.placedBy(),
                    }) : m('em', app.translator.trans(translationPrefix + 'no-user-place'))),
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
                ]))),
            ]),
        ]);
    }
}
