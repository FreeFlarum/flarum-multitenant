import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import Discussion from 'flarum/common/models/Discussion';
import User from 'flarum/common/models/User';
import Badge from 'flarum/common/components/Badge';

export default function addSubscriptionBadge() {
  extend(Discussion.prototype, 'badges', function (badges) {
    let badge;

    if (this.user() && this.user().ignored()) {
      badge = Badge.component({
        label: app.translator.trans('fof-ignore-users.forum.badge.discussion_label'),
        icon: 'fas fa-user-slash',
        type: 'ignored',
      });
    }

    if (badge) {
      badges.add('user-discussion-ignored', badge);
    }
  });

  extend(User.prototype, 'badges', function (badges) {
    let badge;

    if (this.ignored()) {
      badge = Badge.component({
        label: app.translator.trans('fof-ignore-users.forum.badge.user_label'),
        icon: 'fas fa-user-slash',
        type: 'ignored',
      });
    }

    if (badge) {
      badges.add('user-ignored', badge);
    }
  });
}
