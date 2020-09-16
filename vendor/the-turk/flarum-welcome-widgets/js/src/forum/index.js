import { extend } from 'flarum/extend';
import app from 'flarum/app';
import IndexPage from 'flarum/components/IndexPage';
import listItems from 'flarum/helpers/listItems';
import iconHelper from 'flarum/helpers/icon';
import formatNumber from 'flarum/utils/formatNumber';
import UserDropdown from './components/UserDropdown';
import User from 'flarum/models/User';
import Model from 'flarum/Model';
import humanTime from 'flarum/utils/humanTime';
import AvatarEditor from 'flarum/components/AvatarEditor';

const localePrefix = 'the-turk-welcome-widgets.forum.';

app.initializers.add('the-turk-welcome-widgets', () => {
  User.prototype.ww_lastLoginDiscussionsCount = Model.attribute('ww_lastLoginDiscussionsCount');
  User.prototype.ww_lastLoginPostsCount = Model.attribute('ww_lastLoginPostsCount');
  User.prototype.ww_lastLoginUsersCount = Model.attribute('ww_lastLoginUsersCount');
  User.prototype.ww_previousLoginAt = Model.attribute('ww_previousLoginAt', Model.transformDate);

  var getGreetingTime = (currentTime, user) => {
    let localeKey = 'welcome';
    const username_obj = { username: <a href={app.route.user(user)}>{user.username()}</a> };

    if (!(!currentTime || !currentTime.isValid())) {
      const splitAfternoon = 12;
      const splitEvening = 17;
      const currentHour = parseFloat(currentTime.format('HH'));

      if (currentHour >= splitAfternoon && currentHour < splitEvening) {
        localeKey = 'goodAfternoon';
      } else if (currentHour >= splitEvening) {
        localeKey = 'goodEvening';
      } else {
        localeKey = 'goodMorning';
      }
    }

    return app.translator.trans(localePrefix + localeKey, username_obj);
  };

  var getChangeInfo = (currentCount, previousCount) => {
    let keyword, icon, percentage;

    if (previousCount == 0) {
      if (currentCount > 0) {
        // Going from 'not being' into 'being' is not a **change** of being,
        // it is instead **creation** of being. But I'll indicate this situation
        // as there is 100% increase to make it more 'charming'
        percentage = 100;
      } else {
        percentage = 0;
      }
    } else {
      percentage = ((currentCount - previousCount) / previousCount) * 100;
    }

    if (percentage > 0) {
      keyword = 'up';
      icon = 'fas fa-chevron-up';
    } else if (percentage < 0) {
      keyword = 'down';
      icon = 'fas fa-chevron-down';
      percentage = percentage * -1;
    } else {
      keyword = 'neutral';
      icon = 'fas fa-minus';
    }

    if (percentage > 100) {
      percentage = '> 100';
    } else if (percentage > 0 && percentage < 0.1) {
      percentage = '< 0.1';
    } else {
      percentage = percentage.toFixed(1).toString();
    }

    percentage = percentage + '%';
    icon = iconHelper(icon + ' stats-' + keyword);
    const badgeClass = 'stats-badge stats-' + keyword + ' stats-badge--' + keyword;

    return { percentage: percentage, icon: icon, badgeClass: badgeClass };
  };

  extend(IndexPage.prototype, 'view', function (vdom) {
    const user = app.session.user;

    if (!user || !user.ww_previousLoginAt()) return;

    let currentCount, changeInfo, icon;
    const currentStats = {
      discussions: app.forum.attribute('ww_discussionsCount'),
      posts: app.forum.attribute('ww_postsCount'),
      users: app.forum.attribute('ww_usersCount'),
    };
    const previousStats = {
      discussions: user.ww_lastLoginDiscussionsCount(),
      posts: user.ww_lastLoginPostsCount(),
      users: user.ww_lastLoginUsersCount(),
    };
    const container = vdom.children.find((e) => e.attrs && e.attrs.className && e.attrs.className.includes('container'));

    container.children.unshift(
      <div className="IndexPage-stats">
        {/* User's Panel */}
        <div className="IndexPage-stats-general">
          <div className="IndexPage-stats-header">
            <h4 className="stats-greeting">{getGreetingTime(moment(), user)}</h4>
            {UserDropdown.component()}
          </div>
          <div className="IndexPage-stats-body">
            <div className="Avatar-container">
              {AvatarEditor.component({ user })}
              <ul className="badges">{listItems(user.badges().toArray())}</ul>
            </div>
            <div className="IndexPage-stats-personal">
              <div>
                <h3>{formatNumber(user.commentCount())}</h3>
                <p>
                  <a href={app.route('user.posts', { username: user.username() })}>{app.translator.trans(localePrefix + 'posts')}</a>
                </p>
              </div>
              <div>
                <h3>{formatNumber(user.discussionCount())}</h3>
                <p>
                  <a href={app.route('user.discussions', { username: user.username() })}>{app.translator.trans(localePrefix + 'discussions')}</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        {/* Posts, Discussions & Users Stats */}
        {['discussions', 'posts', 'users'].map((type) => {
          switch (type) {
            case 'discussions':
              currentCount = currentStats.discussions;
              changeInfo = getChangeInfo(currentCount, previousStats.discussions);
              icon = 'fas fa-bars';
              break;
            case 'posts':
              currentCount = currentStats.posts;
              changeInfo = getChangeInfo(currentCount, previousStats.posts);
              icon = 'far fa-comment';
              break;
            case 'users':
              currentCount = currentStats.users;
              changeInfo = getChangeInfo(currentCount, previousStats.users);
              icon = 'far fa-user';
              break;
          }

          return (
            <div className={'IndexPage-stats-' + type}>
              <div className="IndexPage-stats-header">
                <div className="IndexPage-stats-icon">{iconHelper(icon)}</div>
                <h4>{app.translator.trans(localePrefix + type)}</h4>
              </div>
              <div className="IndexPage-stats-body">
                <div>
                  <h3>{[formatNumber(currentCount), changeInfo.icon]}</h3>
                  <div>
                    <span className={changeInfo.badgeClass}>{changeInfo.percentage}</span>
                    <p className="stats-since">
                      {app.translator.trans(localePrefix + 'sinceLastVisit', {
                        span: <span title={humanTime(user.ww_previousLoginAt())} className="stats-since--text" />,
                      })}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          );
        })}
      </div>
    );
  });
});
