import {extend} from 'flarum/common/extend';
import app from 'flarum/forum/app';
import IndexPage from 'flarum/forum/components/IndexPage';
import LinkButton from 'flarum/common/components/LinkButton';
import ItemList from 'flarum/common/utils/ItemList';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.nav.';

export default function () {
    extend(IndexPage.prototype, 'navItems', function (items: ItemList) {
        if (app.forum.catchTheFishCanSeeRankingsPage()) {
            items.add('catchthefish-rankings', LinkButton.component({
                icon: 'fas fa-fish',
                href: app.route('catchTheFishRankings'),
            }, app.translator.trans(translationPrefix + 'rankings')));
        }

        if (app.forum.catchTheFishCanModerate()) {
            items.add('catchthefish-settings', LinkButton.component({
                icon: 'fas fa-fish',
                href: app.route('catchTheFishRounds'),
            }, app.translator.trans(translationPrefix + 'settings')));
        }
    });
}
