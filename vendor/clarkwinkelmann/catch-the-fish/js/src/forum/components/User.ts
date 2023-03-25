import {ClassComponent, Vnode} from 'mithril';
import app from 'flarum/forum/app';
import Link from 'flarum/common/components/Link';
import avatar from 'flarum/common/helpers/avatar';
import username from 'flarum/common/helpers/username';
import UserModel from 'flarum/common/models/User';

interface UserAttrs {
    user: UserModel
}

export default class User implements ClassComponent<UserAttrs> {
    view(vnode: Vnode<UserAttrs, this>) {
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
