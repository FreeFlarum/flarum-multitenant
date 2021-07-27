import { extend } from 'flarum/extend';
import app from 'flarum/app';
import HeaderSecondary from 'flarum/components/HeaderSecondary';
import ConversationsDropdown from './components/ConversationsDropdown';

export default function() {
    extend(HeaderSecondary.prototype, 'items', function(items) {
        if ((app.forum.attribute('canMessage') || (app.session.user && app.session.user.conversations().length))) {
            items.add('Messages', <ConversationsDropdown/>, 20);
        }
    });
}
