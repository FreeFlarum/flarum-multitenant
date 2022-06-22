import Model from 'flarum/common/Model';
import mixin from 'flarum/common/utils/mixin';

export default class Emoji extends mixin(Model, {
  title: Model.attribute('title'),
  textToReplace: Model.attribute('text_to_replace'),
  path: Model.attribute('path'),
}) {
  apiEndpoint() {
    return '/the-turk/emojis' + (this.exists ? '/' + this.data.id : '');
  }
}
