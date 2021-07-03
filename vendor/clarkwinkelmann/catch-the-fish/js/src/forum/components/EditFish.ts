import {ClassComponent, Vnode} from 'mithril';
import app from 'flarum/forum/app';
import Button from 'flarum/common/components/Button';
import extractText from 'flarum/common/utils/extractText';
import Fish from '../models/Fish';
import Round from '../models/Round';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.edit-fish.';

interface EditFishAttrs {
    fish?: Fish
    round: Round
    onsave?: () => void
    ondelete?: () => void
}

export default class EditFish implements ClassComponent<EditFishAttrs> {
    fish!: Fish
    dirty: boolean = false
    processing: boolean = false

    oninit(vnode: Vnode<EditFishAttrs, this>) {
        let {fish} = vnode.attrs;
        if (typeof fish === 'undefined') {
            fish = app.store.createRecord('catchthefish-fishes', {
                attributes: {
                    round_id: vnode.attrs.round.id(),
                    name: '',
                },
            }) as Fish;
        }

        this.fish = fish;
    }

    view(vnode: Vnode<EditFishAttrs, this>) {
        return m('form', {
            onsubmit: (event: Event) => {
                event.preventDefault();
                this.saveRecord(vnode);
            },
        }, [
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'name')),
                m('input.FormControl', {
                    value: this.fish.name(),
                    oninput: (event: Event) => {
                        this.fish.pushAttributes({
                            name: (event.target as HTMLInputElement).value,
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

    saveRecord(vnode: Vnode<EditFishAttrs, this>) {
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

    deleteRecord(vnode: Vnode<EditFishAttrs, this>) {
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
