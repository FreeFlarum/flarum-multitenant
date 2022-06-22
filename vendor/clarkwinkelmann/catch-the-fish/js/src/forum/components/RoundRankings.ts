import {ClassComponent, Vnode} from 'mithril';
import app from 'flarum/forum/app';
import User from './User';
import Ranking from '../models/Ranking';
import Round from '../models/Round';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.table-ranking.';

interface RoundRankingsAttrs {
    round: Round
}

export default class RoundRankings implements ClassComponent<RoundRankingsAttrs> {
    rankings: Ranking[] | null = null;

    oninit(vnode: Vnode<RoundRankingsAttrs, this>) {
        app.request({
            method: 'GET',
            url: app.forum.attribute('apiUrl') + '/catch-the-fish/rounds/' + vnode.attrs.round.id() + '/rankings',
        }).then(result => {
            this.rankings = app.store.pushPayload(result);
            m.redraw();
        });
    }

    view(vnode: Vnode<RoundRankingsAttrs, this>) {
        if (this.rankings === null) {
            return m('p', app.translator.trans(translationPrefix + 'loading'));
        }

        return m('div', [
            m('h2', app.translator.trans(translationPrefix + 'title', {
                name: vnode.attrs.round.name(),
            })),
            m('table.catchthefish-table', [
                m('thead', m('tr', [
                    m('th', app.translator.trans(translationPrefix + 'rank')),
                    m('th', app.translator.trans(translationPrefix + 'count')),
                    m('th', app.translator.trans(translationPrefix + 'user')),
                ])),
                m('tbody', this.rankings.map((ranking, index) => m('tr', [
                    m('td', '#' + (index + 1)),
                    m('td', ranking.catch_count()),
                    m('td', m(User, {
                        user: ranking.user(),
                    })),
                ]))),
            ]),
        ]);
    }
}
