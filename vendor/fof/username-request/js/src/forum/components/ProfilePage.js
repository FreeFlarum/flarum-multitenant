import UserPage from 'flarum/forum/components/UserPage';
import humanTime from 'flarum/common/helpers/humanTime';

export default class ProfileConfigurePane extends UserPage {
  oninit(vnode) {
    super.oninit(vnode);
    this.loading = true;

    this.loadUser(m.route.param('username'));
  }

  content() {
    return (
      <table className="NotificationGrid">
        {this.user
          .usernameHistory()
          .slice(0)
          .reverse()
          .map((username) => {
            var oldUsername = Object.keys(username)[0];
            return (
              <tr>
                <td>{oldUsername}</td>
                <td>{humanTime(this.calculateTime(username[oldUsername]))}</td>
              </tr>
            );
          })}
      </table>
    );
  }

  show(user) {
    this.user = user;

    m.redraw();
  }

  calculateTime(time) {
    var d = new Date(0);
    return d.setUTCSeconds(time);
  }
}
