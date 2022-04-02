import app from 'flarum/forum/app';
import Page from 'flarum/common/components/Page';
import RoundRankings from "../components/RoundRankings";

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.page-ranking.';

export default class Rankings extends Page {
    view() {
        if (!app.forum.catchTheFishCanSeeRankingsPage()) {
            return m('.container', m('p', app.translator.trans(translationPrefix + 'permission')));
        }

        const rounds = app.forum.catchTheFishActiveRounds();

        return m('.container', [
            m('h2', app.translator.trans(translationPrefix + 'title')),
            rounds ? rounds.map(round => m(RoundRankings, {
                round,
            })) : m('p', app.translator.trans(translationPrefix + 'nothing')),
        ]);
    }
}
