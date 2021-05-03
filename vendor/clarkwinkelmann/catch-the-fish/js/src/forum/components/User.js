import app from 'flarum/app';
import Link from 'flarum/components/Link';
import avatar from 'flarum/helpers/avatar';
import username from 'flarum/helpers/username';

/* global m */

export default class User {
    view(vnode) {
        const {user} = vnode.attrs;

        return m(Link, {
            href: app.route.user(user),
        }, [
            avatar(user),
            ' ',
            username(user),
        ]);
    }
}
