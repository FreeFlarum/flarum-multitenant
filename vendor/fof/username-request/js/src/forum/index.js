import app from 'flarum/forum/app';
import User from 'flarum/common/models/User';
import Model from 'flarum/common/Model';
import UsernameRequest from './models/UsernameRequest';
import addRequestSetting from './addRequestSetting';
import RequestsPage from './components/RequestsPage';
import addRequestDropdown from './addRequestDropdown';
import checkForApproval from './checkForApproval';
import ProfilePage from './components/ProfilePage';
import addProfilePage from './addProfilePage';
import RequestsListState from './states/RequestsListState';

app.initializers.add('fof-username-request', () => {
  app.store.models['username-requests'] = UsernameRequest;
  User.prototype.lastNicknameRequest = Model.hasOne('lastNicknameRequest');
  User.prototype.lastUsernameRequest = Model.hasOne('lastUsernameRequest');
  User.prototype.usernameHistory = Model.attribute('usernameHistory');

  app.routes.username_requests = { path: '/username-requests', component: RequestsPage };
  app.routes.username_history = { path: '/u/:username/history', component: ProfilePage };

  app.usernameRequests = new RequestsListState(app);

  addRequestSetting();
  addRequestDropdown();
  checkForApproval();
  addProfilePage();
});
