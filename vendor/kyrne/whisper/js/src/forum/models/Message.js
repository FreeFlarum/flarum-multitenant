import Model from 'flarum/Model';
import mixin from 'flarum/utils/mixin';

export default class Message extends mixin(Model, {
    message: Model.attribute('message'),
    user: Model.hasOne('user'),
    isHidden: Model.attribute('isHidden'),
    createdAt: Model.attribute('createdAt', Model.transformDate),
    conversation: Model.hasOne('conversation'),
    number: Model.hasOne('number'),
}) {
  apiEndpoint() {
    return `/whisper/messages${this.exists ? `/${this.data.id}` : ''}`;
  }
}
