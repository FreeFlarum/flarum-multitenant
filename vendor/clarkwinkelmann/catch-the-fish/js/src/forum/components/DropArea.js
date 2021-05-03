import app from 'flarum/app';

/* global m */

export default class DropArea {
    view() {
        return m('.catchthefish-drop-area', app.translator.trans('clarkwinkelmann-catch-the-fish.forum.drop-area.message'));
    }
}
