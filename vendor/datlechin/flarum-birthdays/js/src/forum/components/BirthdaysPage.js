import Page from 'flarum/common/components/Page';
import IndexPage from 'flarum/forum/components/IndexPage';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import listItems from 'flarum/common/helpers/listItems';
import avatar from 'flarum/common/helpers/avatar';
import username from 'flarum/common/helpers/username';
import Link from 'flarum/common/components/Link';

export default class BirthdaysPage extends Page {
  oninit(vnode) {
    super.oninit(vnode);

    this.loading = true;

    this.users = [];

    this.setResults(this.loadUsers());
  }

  view() {
    if (this.loading) {
      return <LoadingIndicator />;
    }

    return (
      <div className="BirthdaysPage">
        {IndexPage.prototype.hero()}
        <div className="container">
          <div className="sideNavContainer">
            <nav className="IndexPage-nav sideNav">
              <ul>{listItems(IndexPage.prototype.sidebarItems().toArray())}</ul>
            </nav>
            <div className="IndexPage-results sideNavOffset">
              <div className="UserBirthdaysList">
                <ul className="UserBirthdaysList-users">
                  {this.users.map((user) => (
                    <li>
                      <Link href={app.route.user(user)}>{avatar(user)}</Link>
                      <div className="UserBirthdaysList-main">
                        <Link href={app.route.user(user)}>{username(user)}</Link>
                        <ul className="UserStats">
                          <li>{app.translator.trans('datlechin-birthdays.forum.page.discussion_count', { count: user.discussionCount() })}</li>
                          <li>{app.translator.trans('datlechin-birthdays.forum.page.post_count', { count: user.commentCount() })}</li>
                        </ul>
                      </div>
                    </li>
                  ))}
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  loadUsers() {
    const today = dayjs().format('YYYY-MM-DD');
    return app.store.find('users', {
      filter: {
        birthday: today
      },
    });
  }

  setResults(results) {
    results.then((users) => {
      this.users = users;
      this.loading = false;
      m.redraw();
    });
  }
}
