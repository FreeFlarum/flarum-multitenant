import Extend from 'flarum/common/extenders';
import User from 'flarum/common/models/User';
import ProfilePage from './components/ProfilePage';

export default [
  new Extend.Model(User).attribute<boolean>('ignored').hasMany<User>('ignoredUsers').attribute<boolean>('canBeIgnored'),

  new Extend.Routes().add('user.ignoredUsers', '/ignoredUsers', ProfilePage),
];
