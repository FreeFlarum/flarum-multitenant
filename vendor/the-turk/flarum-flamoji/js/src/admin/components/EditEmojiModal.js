import Alert from 'flarum/common/components/Alert';
import Button from 'flarum/components/Button';
import Modal from 'flarum/components/Modal';
import ItemList from 'flarum/utils/ItemList';
import Stream from 'flarum/utils/Stream';
import urlChecker from '../../common/utils/urlChecker';

/**
 * The `EditEmojiModal` component shows a modal dialog which allows the user
 * to add or edit a emoji.
 */
export default class EditEmojiModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);

    this.emoji = this.attrs.model || app.store.createRecord('emojis');

    this.emojiTitle = Stream(this.emoji.title() || '');
    this.textToReplace = Stream(this.emoji.textToReplace() || '');
    this.path = Stream(this.emoji.path() || '');
  }

  className() {
    return 'EditEmojiModal Modal--small';
  }

  title() {
    let url = '';

    if (this.path()) url = urlChecker(this.path()) ? this.path() : app.forum.attribute('baseUrl') + this.path();

    return this.emojiTitle()
      ? this.path()
        ? [m('img', { className: 'EditEmojiModal-titleEmoji', src: url, alt: this.emojiTitle() }), this.emojiTitle()]
        : this.emojiTitle()
      : app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.edit_emoji.modal_title');
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form">{this.fields().toArray()}</div>
      </div>
    );
  }

  fields() {
    const items = new ItemList();

    items.add(
      'title',
      <div className="Form-group">
        <label>{app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.edit_emoji.emoji_title_label')}</label>
        <input className="FormControl" bidi={this.emojiTitle} />
      </div>,
      50
    );

    items.add(
      'textToReplace',
      <div className="Form-group">
        <label>{app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.edit_emoji.text_to_replace_label')}</label>
        <input className="FormControl" bidi={this.textToReplace} />
      </div>,
      40
    );

    items.add(
      'path',
      <div className="Form-group">
        <label>{app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.edit_emoji.path_or_url_label')}</label>
        <input className="FormControl" placeholder="/assets/emojis/batman.png" bidi={this.path} />
      </div>,
      30
    );

    items.add(
      'submit',
      <div className="Form-group">
        {Button.component(
          {
            type: 'submit',
            className: 'Button Button--primary EditEmojiModal-save',
            loading: this.loading,
          },
          app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.edit_emoji.submit_button')
        )}
        {this.emoji.exists ? (
          <button type="button" className="Button EditEmojiModal-delete" onclick={this.delete.bind(this)}>
            {app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.edit_emoji.delete_emoji_button')}
          </button>
        ) : (
          ''
        )}
      </div>,
      -10
    );

    return items;
  }

  submitData() {
    return {
      title: this.emojiTitle(),
      textToReplace: this.textToReplace(),
      path: this.path(),
    };
  }

  onsubmit(e) {
    e.preventDefault();
    this.loading = true;

    const exists = this.emoji.exists;

    this.emoji.save(this.submitData()).then((emoji) => {
      this.clearCache().then(() => {
        this.hide();
        if (!exists) app.customEmojiListState.addToList(emoji);
        this.loading = false;
        this.showSuccessMessage();
      });
    });
  }

  delete() {
    if (confirm(app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.edit_emoji.delete_emoji_confirmation'))) {
      this.emoji.delete().then(() => {
        this.clearCache().then(() => {
          this.hide();
          app.customEmojiListState.removeFromList(this.emoji.id());
          this.showSuccessMessage();
        });
      });
    }
  }

  showSuccessMessage() {
    return app.alerts.show(Alert, { type: 'success' }, app.translator.trans('the-turk-flamoji.admin.custom_emojis_section.edit_emoji.saved_message'));
  }

  // Seems like we need to clear cache
  // to tell TextFormatter that some changes
  // have been made on the configurator.
  clearCache() {
    return app.request({
      method: 'DELETE',
      url: app.forum.attribute('apiUrl') + '/cache',
    });
  }
}
