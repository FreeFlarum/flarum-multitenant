import Modal from "flarum/components/Modal";
import Button from "flarum/components/Button";
import RecipientSearch from "./RecipientSearch";
import username from 'flarum/helpers/username';
import Stream from 'flarum/utils/Stream';
import withAttr from 'flarum/utils/withAttr';

export default class StartConversationModal extends Modal {

  oninit(vnode) {
    super.oninit(vnode);

    app.cache.conversationsRecipient = null;

    this.conversations = this.attrs.conversations;

    this.already = false;

    this.messageContent = Stream('');
  }

  title() {
    return app.translator.trans('kyrne-whisper.forum.modal.title');
  }

  className() {
    return 'StartConversationModal Modal--medium';
  }

  onbeforeupdate() {
    $('.Modal-content').on('click tap', (ev) => {
      ev.stopImmediatePropagation();
    })
  }

  content() {
    return [
      <div className="Modal-body">
        {this.already ? [
          <h2>{app.translator.trans('kyrne-whisper.forum.modal.already', {username: username(this.recpient)})}</h2>,
          <h2>{app.translator.trans('kyrne-whisper.forum.modal.copied', {username: username(this.recpient)})}</h2>
          ] :
          <div>
            <div class="helpText">
              {app.cache.conversationsRecipient !== null ? app.translator.trans('kyrne-whisper.forum.modal.help_start', {username: username(app.cache.conversationsRecipient)}) : app.translator.trans('kyrne-whisper.forum.modal.help')}
            </div>
            <div className="AddRecipientModal-form">
              <RecipientSearch state={app.search} ></RecipientSearch>
              {app.cache.conversationsRecipient !== null ?
                <div className="AddRecipientModal-form-submit">
                  <textarea value={this.messageContent()} oninput={withAttr('value', this.messageContent)} placeholder={app.translator.trans('kyrne-whisper.forum.chat.text_placeholder')} rows="3"></textarea>
                  {Button.component({
                    type: 'submit',
                    className: 'Button Button--primary',
                    disabled: !this.messageContent(),
                  }, app.translator.trans('kyrne-whisper.forum.modal.submit')
                  )}
                </div>
                : ''}
            </div>
          </div>
        }
      </div>
    ];
  }

  onsubmit(e) {
    e.preventDefault();

    const recipient = app.cache.conversationsRecipient;
    this.recpient = recipient;
    app.cache.conversationsRecipient = null;

    app.store.createRecord('conversations')
      .save({
        messageContents: this.messageContent(),
        recipient: recipient.id(),
      }).then(conversation => {
      if (!conversation.notNew()) {
        this.conversations.push(conversation);
        const preconv = app.session.user.conversations();
        preconv.push(conversation);
        app.session.user.conversations = Stream(preconv);
        m.redraw();
        app.modal.close();
      } else {
        let input = document.createElement('textarea');
        document.body.appendChild(input);
        input.value = this.messageContent();
        input.focus();
        input.select();
        document.execCommand('Copy');
        input.remove();
        this.already = true;
        m.redraw();
      }
    })
  }
}
