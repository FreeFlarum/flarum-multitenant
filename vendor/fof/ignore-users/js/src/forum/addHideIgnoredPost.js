import { extend } from 'flarum/extend';
import UserControls from 'flarum/utils/UserControls';
import CommentPost from 'flarum/components/CommentPost';
import Button from 'flarum/components/Button';

export default function () {
    extend(CommentPost.prototype, 'elementAttrs', function (elementAttrs) {
        const user = this.attrs.post.user();
        const ignored = user && user.ignored();
        if (ignored) {
            elementAttrs.className += ' Post--hidden';
        }
        return elementAttrs;
    });

    extend(CommentPost.prototype, 'headerItems', function (items) {
        const post = this.attrs.post;

        if (post.isHidden() || !(post.user() && post.user().ignored())) {
            return;
        }

        items.add(
            'ignore-toggle',
            Button.component({
                className: 'Button Button--default Button--more',
                icon: 'fas fa-ellipsis-h',
                onclick: this.toggleContent.bind(this),
            })
        );
    });
}
