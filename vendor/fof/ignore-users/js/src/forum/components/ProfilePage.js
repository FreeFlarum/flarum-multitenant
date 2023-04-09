import app from 'flarum/forum/app';
import avatar from 'flarum/common/helpers/avatar';
import Button from 'flarum/common/components/Button';
import username from 'flarum/common/helpers/username';
import UserPage from 'flarum/forum/components/UserPage';
import Stream from 'flarum/common/utils/Stream';
import Placeholder from 'flarum/common/components/Placeholder';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';

export default class ProfilePage extends UserPage {
  oninit(vdom) {
    super.oninit(vdom);

    this.loading = true;

    this.ignoredUsers = app.session.user.ignoredUsers();

    this.loadUser(app.session.user.username());

    this.loading = false;
  }

  content() {
    if (this.loading) {
      return (
        <div className="DiscussionList">
          <LoadingIndicator />
        </div>
      );
    }

    if (this.ignoredUsers.length === 0) {
      return (
        <div className="DiscussionList">
          <Placeholder text={app.translator.trans('fof-ignore-users.forum.profile_page.no_ignored')} />
        </div>
      );
    }

    return (
      <table className="NotificationGrid">
        {this.ignoredUsers.map((user, i) => {
          var unignore = () => {
            if (confirm(app.translator.trans(`fof-ignore-users.forum.user_controls.unignore_confirmation`))) {
              user.save({ ignored: false });
              this.ignoredUsers.splice(i, 1);
              app.session.user.ignoredUsers = Stream(this.ignoredUsers);
            }
          };

          return (
            <tr>
              <td>
                <a href={app.route.user(user)} config={m.route}>
                  <h3>
                    {avatar(user, { className: 'ignorePage-avatar' })} {username(user)}
                  </h3>
                </a>
              </td>
              <td className="ignorePage-button">
                {Button.component(
                  {
                    icon: 'fas fa-comment',
                    type: 'button',
                    className: 'Button Button--warning',
                    onclick: unignore.bind(user),
                  },
                  app.translator.trans('fof-ignore-users.forum.user_controls.unignore_button')
                )}
              </td>
            </tr>
          );
        })}
      </table>
    );
  }

  show(user) {
    this.user = app.session.user;

    m.redraw();
  }
}
