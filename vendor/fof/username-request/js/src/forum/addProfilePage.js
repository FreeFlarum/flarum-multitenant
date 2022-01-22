import { extend } from 'flarum/common/extend';
import app from 'flarum/forum/app';
import LinkButton from 'flarum/common/components/LinkButton';
import UserPage from 'flarum/forum/components/UserPage';

export default function () {
  extend(UserPage.prototype, 'navItems', function (items) {
    if (this.user.usernameHistory()) {
      items.add(
        'username-requests',
        LinkButton.component(
          {
            href: app.route('username_history', { username: this.user.username() }),
            icon: 'fas fa-user-edit',
          },
          app.translator.trans('fof-username-request.forum.user.name_history_link')
        )
      );
    }
  });
}
