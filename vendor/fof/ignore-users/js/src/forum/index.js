import Model from 'flarum/common/Model';
import User from 'flarum/common/models/User';
import addIgnoreUserControlButton from './addIgnoreUserControlButton';
import addHideIgnoredPost from './addHideIgnoredPost';
import addProfilePage from './addProfilePage';
import ProfilePage from './components/ProfilePage';
import addIgnoredUserBadge from './addIgnoredUserBadge';

app.initializers.add('fof-ignore-users', function (app) {
    User.prototype.ignored = Model.attribute('ignored');
    User.prototype.ignoredUsers = Model.hasMany('ignoredUsers');
    User.prototype.canBeIgnored = Model.attribute('canBeIgnored');

    app.routes.ignoredUsers = { path: '/ignoredUsers', component: ProfilePage };

    addIgnoreUserControlButton();
    addHideIgnoredPost();
    addProfilePage();
    addIgnoredUserBadge();
});
