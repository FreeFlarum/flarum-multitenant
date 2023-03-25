import { extend } from 'flarum/common/extend';
import app from 'flarum/forum/app';
import LinkButton from 'flarum/common/components/LinkButton';
import UserPage from 'flarum/forum/components/UserPage';

export default function () {
  extend(UserPage.prototype, 'navItems', function (items) {
    if (app.session.user && app.session.user === this.user)
      items.add(
        'ignored-users',
        <LinkButton href={app.route('user.ignoredUsers')} icon="fas fa-user-slash">
          {app.translator.trans('fof-ignore-users.forum.profile_link')}
        </LinkButton>
      );
  });
}
