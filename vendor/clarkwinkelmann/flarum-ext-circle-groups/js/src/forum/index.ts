import {Vnode} from 'mithril';
import app from 'flarum/forum/app';
import {extend} from 'flarum/common/extend';
import User from 'flarum/common/models/User';
import AvatarEditor from 'flarum/forum/components/AvatarEditor';
import PostUser from 'flarum/forum/components/PostUser';
import UserCard from 'flarum/forum/components/UserCard';
import Link from 'flarum/common/components/Link';

function matchTag(tag: any): (node: Vnode) => boolean {
    return node => !!(node && node.tag && node.tag === tag);
}

function matchClass(className: string): (node: Vnode<any>) => boolean {
    // trim() to handle classNames that end with spaces easier
    return node => node && node.attrs && node.attrs.className && node.attrs.className.trim() === className;
}

function applyColor(vdom: Vnode<any>, user: User): void {
    const groups = user.groups();

    // If a user has no groups or groups have not been loaded, false might be returned
    // We'll skip this part if this happens
    if (!Array.isArray(groups)) {
        return;
    }

    // Find the first group that has a color
    // We don't read badges because we would need to support every badge component and its attrs
    const firstColoredGroup = groups.find(group => {
        return group && group.color();
    });

    // If there are no color groups, skip
    if (!firstColoredGroup) {
        return;
    }

    vdom.attrs = vdom.attrs || {};
    vdom.attrs.style = vdom.attrs.style || {};
    vdom.attrs.style.borderColor = firstColoredGroup.color();
}

app.initializers.add('clarkwinkelmann-circle-groups', () => {
    extend(PostUser.prototype, 'view', function (vnode) {
        const user = this.attrs.post.user();

        // If the post belongs to a deleted user, skip
        if (!user) {
            return;
        }

        const avatar = vnode.children.find(matchTag('h3'))
            .children.find(matchTag(Link))
            .children.find(matchClass('Avatar PostUser-avatar'));

        applyColor(avatar, user);
    });

    extend(UserCard.prototype, 'view', function (vnode) {
        const identity = vnode.children.find(matchClass('darkenBackground'))
            .children.find(matchClass('container'))
            .children.find(matchClass('UserCard-profile'))
            .children.find(matchClass('UserCard-identity'));

        // This component will only exist if we are not in edit mode
        if (identity.children[0].tag === Link) {
            const avatar = identity.children[0]
                .children.find(matchClass('UserCard-avatar'))
                .children.find(matchClass('Avatar'));

            applyColor(avatar, this.attrs.user);
        }
    });

    // We color the avatar editor because it's what users see on their own profile, or admins everywhere
    extend(AvatarEditor.prototype, 'view', function (vnode) {
        const avatar = vnode.children.find(matchClass('Avatar'));

        applyColor(avatar, this.attrs.user);
    });
});
