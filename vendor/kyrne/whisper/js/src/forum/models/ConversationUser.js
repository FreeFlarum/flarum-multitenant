import Model from 'flarum/Model';
import mixin from 'flarum/utils/mixin';

export default class ConversationUser extends mixin(Model, {
  conversation: Model.hasOne('conversation'),
  user: Model.hasOne('user'),

  userId: Model.attribute('userId'),
  conversationId: Model.attribute('conversationId'),
  lastRead: Model.attribute('lastRead')
}) {}
