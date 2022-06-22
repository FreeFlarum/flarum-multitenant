import {ClassComponent, Vnode} from 'mithril';
import app from 'flarum/forum/app';
import Button from 'flarum/common/components/Button';
import Switch from 'flarum/common/components/Switch';
import extractText from 'flarum/common/utils/extractText';
import withAttr from 'flarum/common/utils/withAttr';
import Round from '../models/Round';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.edit-round.';

interface EditRoundAttrs {
    round?: Round
    onsave?: () => void
    ondelete?: () => void
}

export default class EditRound implements ClassComponent<EditRoundAttrs> {
    round!: Round
    dirty: boolean = false
    processing: boolean = false

    oninit(vnode: Vnode<EditRoundAttrs, this>) {
        let {round} = vnode.attrs;

        if (typeof round === 'undefined') {
            round = app.store.createRecord('catchthefish-rounds', {
                attributes: {
                    name: '',
                    starts_at: '',
                    ends_at: dayjs().add(1, 'day').toISOString(),
                    include_starting_pack: true,
                },
            }) as Round;
        }

        this.round = round;
    }

    view(vnode: Vnode<EditRoundAttrs, this>) {
        return m('form', {
            onsubmit: (event: Event) => {
                event.preventDefault();
                this.saveRecord(vnode);
            },
        }, [
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'name')),
                m('input.FormControl', {
                    value: this.round.name(),
                    oninput: withAttr('value', this.updateAttribute.bind(this, 'name')),
                }),
                m('.helpText', app.translator.trans(translationPrefix + 'name-help')),
            ]),
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'starts-at')),
                m('input.FormControl', {
                    value: this.round.starts_at(),
                    oninput: withAttr('value', this.updateAttribute.bind(this, 'starts_at')),
                }),
            ]),
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'ends-at')),
                m('input.FormControl', {
                    value: this.round.ends_at(),
                    oninput: withAttr('value', this.updateAttribute.bind(this, 'ends_at')),
                }),
            ]),
            this.round.exists ? '' : m('.Form-group', [
                m('label', [
                    Switch.component({
                        state: this.round.include_starting_pack(),
                        onchange: this.updateAttribute.bind(this, 'include_starting_pack'),
                    }, app.translator.trans(translationPrefix + 'starting-pack')),
                ]),
                m('.helpText', app.translator.trans(translationPrefix + 'starting-pack-help')),
            ]),
            m('.ButtonGroup', [
                Button.component({
                    type: 'submit',
                    className: 'Button Button--primary',
                    loading: this.processing,
                    disabled: !this.readyToSave(),
                }, app.translator.trans(translationPrefix + (this.round.exists ? 'save' : 'create'))),
                (this.round.exists ? Button.component({
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

    updateAttribute(attribute: string, value: any) {
        this.round.pushAttributes({
            [attribute]: value,
        });

        this.dirty = true;
    }

    readyToSave() {
        if (!this.round.name()) {
            return false;
        }

        return this.dirty;
    }

    saveRecord(vnode: Vnode<EditRoundAttrs, this>) {
        this.processing = true;

        this.round.save(this.round.data.attributes).then(() => {
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

    deleteRecord(vnode: Vnode<EditRoundAttrs, this>) {
        if (!confirm(extractText(app.translator.trans(translationPrefix + 'delete-confirmation', {
            name: this.round.name(),
        })))) {
            return;
        }

        this.processing = true;

        this.round.delete().then(() => {
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
