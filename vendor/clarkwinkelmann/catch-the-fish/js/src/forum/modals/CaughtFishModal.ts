import {Vnode} from 'mithril'
import app from 'flarum/forum/app';
import Modal, {IInternalModalAttrs} from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';
import FishImage from '../components/FishImage';
import User from '../components/User';
import Fish from '../models/Fish';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.caught-fish-modal.';

interface CaughtFishModalAttrs extends IInternalModalAttrs {
    fish: Fish
}

export default class CaughtFishModal extends Modal<CaughtFishModalAttrs> {
    newName!: string
    dirty: boolean = false
    loading: boolean = false

    oninit(vnode: Vnode) {
        super.oninit(vnode);

        this.newName = this.attrs.fish.name();
    }

    className() {
        return 'Modal--small catchthefish-catch-modal';
    }

    title() {
        return app.translator.trans(translationPrefix + 'title');
    }

    saveNameAndPlacement(randomPlacement = false) {
        const body: any = {};

        if (this.dirty) {
            body.name = this.newName;
        }

        if (randomPlacement) {
            body.placement = 'random';
        }

        if (body) {
            this.loading = true;

            app.request({
                method: 'POST',
                url: app.forum.attribute('apiUrl') + '/catch-the-fish/fishes/' + this.attrs.fish.id() + '/place',
                body,
            }).then(result => {
                app.store.pushPayload(result);
                this.hide();

                if (this.attrs.fish.canPlace() && !randomPlacement) {
                    // Refresh basket by reloading user
                    app.store.find('users', app.session.user!.id()!).then(() => {
                        m.redraw();
                    });
                }
            }).catch(err => {
                this.loading = false;
                m.redraw();
                throw err;
            });
        } else {
            this.hide();

            if (this.attrs.fish.canPlace() && !randomPlacement) {
                // Refresh basket by reloading user
                app.store.find('users', app.session.user!.id()!).then(() => {
                    m.redraw();
                });
            }
        }
    }

    content() {
        const {fish} = this.attrs;

        const namedBy = fish.namedBy();
        const placedBy = fish.placedBy();

        return m('.Modal-body', [
            m('h3', '"' + fish.name() + '"'),
            m(FishImage, {
                fish,
            }),
            namedBy ? m('p', [
                app.translator.trans(translationPrefix + 'named-by'),
                ' ',
                m(User, {
                    user: namedBy,
                }),
            ]) : null,
            placedBy ? m('p', [
                app.translator.trans(translationPrefix + 'placed-by'),
                ' ',
                m(User, {
                    user: placedBy,
                }),
            ]) : null,
            m('p', app.translator.trans(translationPrefix + 'congratulation', {
                catch_count: fish.round()!.myRanking()?.catch_count(),
            })),
            fish.canName() ? m('.Form-group', [
                m('p', app.translator.trans(translationPrefix + 'name-help')),
                m('label', app.translator.trans(translationPrefix + 'name')),
                m('input.FormControl', {
                    value: this.newName,
                    oninput: (event: Event) => {
                        this.newName = (event.target as HTMLInputElement).value;
                        this.dirty = true;
                    },
                }),
            ]) : null,
            fish.canPlace() ? m('p', app.translator.trans(translationPrefix + 'placement-help')) : null,
            m('.Form-group', Button.component({
                className: 'Button Button--primary Button--block',
                type: 'button',
                loading: this.loading,
                onclick: () => {
                    this.saveNameAndPlacement();
                },
            }, app.translator.trans(translationPrefix + (this.dirty ? (fish.canPlace() ? 'submit-name-place-later' : 'submit-name') : (fish.canPlace() ? 'submit-place-later' : 'submit-continue'))))),
            fish.canPlace() ? m('.Form-group', Button.component({
                className: 'Button Button--primary Button--block',
                type: 'button',
                loading: this.loading,
                onclick: () => {
                    this.saveNameAndPlacement(true);
                },
            }, app.translator.trans(translationPrefix + (this.dirty ? 'submit-name-place-random' : 'submit-place-random')))) : null,
        ]);
    }

    onsubmit(event: Event) {
        event.preventDefault();
        // Because the modal has its own form, pressing enter will submit here
        // In this case we apply the same feature as the first button
        this.saveNameAndPlacement();
    }
}
