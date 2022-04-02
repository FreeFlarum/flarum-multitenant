import {ClassComponent} from 'mithril';
import app from 'flarum/forum/app';

export default class DropArea implements ClassComponent {
    view() {
        return m('.catchthefish-drop-area', app.translator.trans('clarkwinkelmann-catch-the-fish.forum.drop-area.message'));
    }
}
