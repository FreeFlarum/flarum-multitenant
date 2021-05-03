import {override} from 'flarum/common/extend';
import app from 'flarum/app';
import IndexPage from 'flarum/forum/components/IndexPage';
import RoundAlert from './components/RoundAlert';

/* global m */

export default function () {
    override(IndexPage.prototype, 'hero', function (original) {
        const existing = original();

        const rounds = app.forum.catchTheFishActiveRounds();

        if (!rounds) {
            return existing;
        }

        // Replace missing rounds with null. Happens if you delete a round and go back to homepage
        const additional = rounds.map(round => round ? m(RoundAlert, {
            round,
        }) : null);

        if (Array.isArray(existing)) {
            return rounds.concat(existing);
        }

        return m('div', [
            additional,
            existing,
        ]);
    });
}
