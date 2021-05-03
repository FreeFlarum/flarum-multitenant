import app from 'flarum/app';
import User from "./User";

/* global m */

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.table-ranking.';

export default class RoundRankings {
    oninit(vnode) {
        this.rankings = null;

        app.request({
            method: 'GET',
            url: app.forum.attribute('apiUrl') + '/catch-the-fish/rounds/' + vnode.attrs.round.id() + '/rankings',
        }).then(result => {
            this.rankings = app.store.pushPayload(result);
            m.redraw();
        });
    }

    view(vnode) {
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
