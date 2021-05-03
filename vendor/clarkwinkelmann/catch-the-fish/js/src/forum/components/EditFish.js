import app from 'flarum/app';
import Button from 'flarum/common/components/Button';
import extractText from 'flarum/common/utils/extractText';

/* global m */

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.edit-fish.';

export default class EditFish {
    oninit(vnode) {
        this.fish = vnode.attrs.fish;
        this.dirty = false;
        this.processing = false;

        if (typeof this.fish === 'undefined') {
            this.fish = app.store.createRecord('catchthefish-fishes', {
                attributes: {
                    round_id: vnode.attrs.round.id(),
                    name: '',
                },
            });
        }
    }

    view(vnode) {
        return m('form', {
            onsubmit: event => {
                event.preventDefault();
                this.saveRecord(vnode);
            },
        }, [
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'name')),
                m('input.FormControl', {
                    value: this.fish.name(),
                    oninput: event => {
                        this.fish.pushAttributes({
                            name: event.target.value,
                        });

                        this.dirty = true;
                    },
                }),
                m('.helpText', app.translator.trans(translationPrefix + 'name-help')),
            ]),
            m('.ButtonGroup', [
                Button.component({
                    type: 'submit',
                    className: 'Button Button--primary',
                    loading: this.processing,
                    disabled: !this.readyToSave(),
                }, app.translator.trans(translationPrefix + (this.fish.exists ? 'save' : 'create'))),
                (this.fish.exists ? Button.component({
                    type: 'button',
                    className: 'Button Button--danger',
                    loading: this.processing,
                    onclick: () => {
                        this.deleteRecord(vnode);
                    },
                }, app.translator.trans(translationPrefix + 'delete')) : ''),
            ]),
        ]);
    }

    readyToSave() {
        if (!this.fish.name()) {
            return false;
        }

        return this.dirty;
    }

    saveRecord(vnode) {
        this.processing = true;

        this.fish.save(this.fish.data.attributes).then(() => {
            if (vnode.attrs.onsave) {
                vnode.attrs.onsave();
            }

            this.processing = false;
            this.dirty = false;
            m.redraw();
        }).catch(err => {
            this.processing = false;
            m.redraw();
            throw err;
        });
    }

    deleteRecord(vnode) {
        if (!confirm(extractText(app.translator.trans(translationPrefix + 'delete-confirmation', {
            name: this.fish.name(),
        })))) {
            return;
        }

        this.processing = true;

        this.fish.delete().then(() => {
            if (vnode.attrs.ondelete) {
                vnode.attrs.ondelete();
            }

            this.processing = false;
            m.redraw();
        }).catch(err => {
            this.processing = false;
            m.redraw();
            throw err;
        });
    }
}
