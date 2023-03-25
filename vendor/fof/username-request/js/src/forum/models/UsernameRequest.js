import Model from 'flarum/common/Model';
import computed from 'flarum/common/utils/computed';
import mixin from 'flarum/common/utils/mixin';

export default class UsernameRequest extends mixin(Model, {
  user: Model.hasOne('user'),
  status: Model.attribute('status'),
  reason: Model.attribute('reason'),
  createdAt: Model.attribute('createdAt', Model.transformDate),
  forNickname: Model.attribute('forNickname'),

  _requestedUsername: Model.attribute('requestedUsername'),
  requestedUsername: computed('_requestedUsername', 'forNickname', 'user', (newName, forNickname, user) => {
    return newName === null && forNickname ? user.username() : newName;
  }),
}) {}
