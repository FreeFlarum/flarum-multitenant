import {Vnode} from 'mithril';
import app from 'flarum/forum/app';
import Page from 'flarum/common/components/Page';
import Button from 'flarum/common/components/Button';
import LinkButton from 'flarum/common/components/LinkButton';
import NewRoundModal from '../modals/NewRoundModal';
import EditRoundModal from '../modals/EditRoundModal';
import Round from '../models/Round';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.table-round.';

export default class RoundList extends Page {
    rounds: Round[] | null = null

    oninit(vnode: Vnode) {
        super.oninit(vnode);

        this.refreshRounds();
    }

    refreshRounds() {
        this.rounds = null;

        app.request({
            method: 'GET',
            url: app.forum.attribute('apiUrl') + '/catch-the-fish/rounds',
        }).then(result => {
            this.rounds = app.store.pushPayload(result);
            m.redraw();
        });
    }

    view() {
        if (this.rounds === null) {
            return m('.container', m('p', app.translator.trans(translationPrefix + 'loading')));
        }

        return m('.container', [
            m('h2', app.translator.trans(translationPrefix + 'title')),
            Button.component({
                className: 'Button Button--primary',
                onclick: () => {
                    app.modal.show(NewRoundModal, {
                        oncreateordelete: () => {
                            this.refreshRounds();
                        },
                    });
                },
            }, app.translator.trans(translationPrefix + 'new')),
            m('table.catchthefish-table', [
                m('thead', m('tr', [
                    m('th', app.translator.trans(translationPrefix + 'name')),
                    m('th', app.translator.trans(translationPrefix + 'start')),
                    m('th', app.translator.trans(translationPrefix + 'end')),
                    m('th', app.translator.trans(translationPrefix + 'actions')),
                ])),
                m('tbody', this.rounds.map(round => m('tr', [
                    m('td', round.name()),
                    m('td', round.starts_at()),
                    m('td', round.ends_at()),
                    m('td', [
                        Button.component({
                            className: 'Button',
                            onclick: () => {
                                app.modal.show(EditRoundModal, {
                                    round,
                                    oncreateordelete: () => {
                                        this.refreshRounds();
                                    },
                                });
                            },
                        }, app.translator.trans(translationPrefix + 'edit')),
                        ' ',
                        LinkButton.component({
                            className: 'Button',
                            href: app.route('catchTheFishRound', {
                                id: round.id(),
                            }),
                        }, app.translator.trans(translationPrefix + 'fishes')),
                    ]),
                ]))),
            ]),
        ]);
    }
}
