import Component from 'flarum/Component';
import Button from 'flarum/components/Button';
import avatar from 'flarum/helpers/avatar';
import username from 'flarum/helpers/username';
import humanTime from 'flarum/helpers/humanTime'
import LoadingIndicator from 'flarum/components/LoadingIndicator';
import MessageText from "./MessageText";
import Stream from 'flarum/utils/Stream';
import withAttr from 'flarum/utils/withAttr';
import icon from 'flarum/helpers/icon';

export default class ConversationView extends Component {
  oninit(vnode) {
    this.loading = true;
    this.vnode = vnode;
    this.mobile = vnode.attrs.mobile;
    this.idParam = m.route.param('id');
    this.firstLoad = true;

    this.typingTimeout = true;

    this.sendTimeout = true;

    const interval1 = () => {
      this.typingTimeout = true;
      setTimeout(() => {
        interval1();
      }, 5000);
    };

    const interval2 = () => {
      if (this.typingTime < new Date(Date.now() - 6000)) {
        this.typing = false;
        m.redraw();
      }
      setTimeout(() => {
        interval2();
      }, 6000);
    };

    this.interval3 = () => {
      if (this.timer === 0) {
        this.sendTimeout = true;
        m.redraw();
        return;
      }
      this.timer--;
      if (this.timer >= 0) {
        setTimeout(() => {
          this.interval3();
        }, 1000);
      }
    };

    interval1();
    interval2();

    this.typing = false;

    this.conversation = this.conversation ? this.conversation : vnode.attrs.conversation;

    this.initPost();
  }

  initPost() {
    this.newMessageCount = 0;

    this.load();

    this.messageContent = Stream('');

    return new Promise(() => {
      setTimeout(() => {
        $(".chat-history").animate({scrollTop: $('.chat-history').prop("scrollHeight")}, 1000);
      }, 500);
    });
  }

  onremove() {
    if (app.pusher) {
      app.pusher.then(object => {
        const channels = object.channels;
        channels.user.unbind('typing');
        channels.user.unbind('newMessage');
      });
    }
  }

  onupdate() {

    $('.chat-history').scroll(() => {
      if (!this.notNew) {
        let pos = $('.chat-history').scrollTop();
        if (pos === 0) {
          const firstMsg = $('.message-content:first');
          this.getMessages(app.cache.messages[this.conversation.id()].length);
          if (!this.notNew) {
            $('.chat-history').scrollTop(firstMsg.offset().top);
          }
        }
      }
    });
  }

  onbeforeupdate() {

    $('.UserListItem').on('click', ((e) => {
      this.conversation = app.cache.conversations[$(e.currentTarget).attr('id')];
      this.index = $(e.currentTarget).attr('id');
      this.notNew = false;
      this.cipher = null;
      this.oninit(this.vnode);
      m.redraw();
    }));

    $('#MessageTextArea').off().on('keydown', (e) => {
      if (e.keyCode === 13 && app.forum.attribute('whisperReturnKey')) {
        $('#MessageTextArea').prop("disabled", true);
        this.sendMessage();
      }
    });
  }

  oncreate() {

    if (app.pusher) {
      app.pusher.then(object => {
        const channels = object.channels;
        channels.user.bind('newMessage', data => {
          if (parseInt(data.conversationId) === parseInt(this.conversation.id()) && $('.MessagesDropdown').children('.Dropdown-menu').is(':visible')) {
            const message = {
              id: Stream(data.id),
              message: Stream(data.message),
              user: Stream(this.user),
              createdAt: Stream(data.createdAt)
            };
            this.decryptMessages([message]);
            this.newMessageCount++;
            this.typing = false;
            m.redraw();
            $(".chat-history").animate({scrollTop: $('.chat-history').prop("scrollHeight")}, 1000);
          }
        });

        channels.user.bind('typing', data => {
          if (parseInt(data.conversationId) === parseInt(this.conversation.id())) {
            let list = $(".chat-history");

            let scrollMore = false;

            if (list.scrollTop() + list.innerHeight() >= list[0].scrollHeight - 50) {
              scrollMore = true;
            }

            this.typing = true;
            this.typingTime = new Date();
            m.redraw();

            if (scrollMore) {
              list.animate({scrollTop: $('.chat-history').prop("scrollHeight")}, 400);
            }
          }
        })

        channels.user.bind('readMessage', data => {
          if (parseInt(data.conversationId) === parseInt(this.conversation.id())) {

            this.recipient.lastRead = m.prop(data.number);
            m.redraw();
          }
        })
      })
    }
  }

  view() {
    this.messages = app.cache.messages ? app.cache.messages[this.conversation.id()] : [];
    return (
      <div style={this.idParam && this.mobile ? 'width: 100%' : ''} className="chat">
        <div className="chat-header clearfix">
          {avatar(this.user)}

          <div className="chat-about">
            <div
              className="chat-with">{app.translator.trans('kyrne-whisper.forum.chat.chat_with', {username: username(this.user)})}</div>
            <div
              className="chat-num-messages">{app.translator.trans('kyrne-whisper.forum.chat.messages_' + (parseInt(this.conversation.totalMessages()) > 1 ? 'multiple' : 'single'), {count: this.conversation.totalMessages() + this.newMessageCount})}</div>
          </div>
        </div>

        {this.messages && this.messages.length > 0 && !this.loading ? [
          <div className="chat-history">
            <ul>
              {this.notNew ?
                <li className="startConvo">{app.translator.trans('kyrne-whisper.forum.chat.start_of_conversation')}</li>
                : ''}
              {this.messages ? this.messages.filter((message, index, self) =>
                index === self.findIndex((t) => (
                  t.message() === message.message()
                ))
              ).sort((a, b) => {
                return a.createdAt() - b.createdAt();
              }).map((message, i) => {
                const myMessage = parseInt(message.user().id()) === parseInt(app.session.user.id());
                return (
                  <li className="clearfix message-content">
                    <div className={"message-data " + (myMessage ? 'align-right' : '')}>
                      <div className={"avatar-inline " + (myMessage ? 'me' : 'other')}>
                        {avatar(myMessage ? app.session.user : message.user())}
                      </div>
                      <span
                        className="message-data-name">{username(myMessage ? app.session.user : message.user())}</span>
                      <span className="message-data-time">{humanTime(message.createdAt())}</span>

                    </div>
                    <MessageText content={message.message()}
                                 className={"message " + (myMessage ? 'my-message float-right' : 'other-message')}></MessageText>
                    {myMessage ? ((parseInt(this.recipient.lastRead()) >= parseInt(message.data.attributes.number)) ? <span className="message-read">{icon('fas fa-check')}</span> : '') : ''}
                  </li>
                )

              }) : ''}
              {this.messageContent() ?
                <li>
                  <MessageText content={this.messageContent()}
                               className={"message my-message float-right message-preview"}
                               preview={true}></MessageText>
                </li>
                : ''
              }
              {this.typing ?
                <li>
                  <div className="tiblock">
                    <div className="tidot"></div>
                    <div className="tidot"></div>
                    <div className="tidot"></div>
                  </div>
                </li>
                : ''}
            </ul>

          </div>
        ] : <LoadingIndicator display="block" size="medium" />}


        <form className="chat-message clearfix">
                <textarea id="MessageTextArea" value={this.messageContent()}
                          oninput={withAttr('value', this.typingPush.bind(this))}
                          placeholder={app.translator.trans('kyrne-whisper.forum.chat.text_placeholder')}
                          rows="3"></textarea>,

          {Button.component({
              onclick: this.sendMessage.bind(this),
              className: 'Button Button--primary',
              disabled: !this.messageContent() || !this.sendTimeout,
            }, app.translator.trans('kyrne-whisper.forum.chat.send')
          )}
        </form>
      </div>
    )
  }

  typingPush(value) {
    this.messageContent(value);
    m.redraw();
    if (this.typingTimeout) {
      app.request({
        method: 'POST',
        url: app.forum.attribute('apiUrl') + '/whisper/messages/typing',
        body: {
          conversationId: this.conversation.id(),
          userId: this.user.id()
        }
      }).then(() => {
        this.typingTimeout = false;
      });
    }
  }

  sendMessage() {
    if (this.sendTimeout) {
      if (this.messageContent() === '' || !this.messageContent().replace(/\s/g, '').length) return;
      this.sendTimeout = false;
      this.timer = 1;
      this.interval3();
      this.newMessageCount++;
      app.store.createRecord('messages')
        .save({
          messageContents: this.messageContent(),
          conversationId: this.conversation.id()
        }).then(message => {
        app.cache.messages[this.conversation.id()].push(message);
        m.redraw();
        this.messageContent('');
        $(".chat-history").animate({scrollTop: $('.chat-history').prop("scrollHeight")}, 500);
        app.request({
          method: 'POST',
          url: app.forum.attribute('apiUrl') + '/whisper/messages/read',
          body: {
            conversationId: this.conversation.id(),
            messageId: message.id()
          }
        })
      })
    }
  }

  getMessages(offset = 0) {
    if (!this.notNew) {
      app.store.find('whisper/messages', this.conversation.id(), {offset})
        .then(results => {
          delete results.payload;
          if (this.firstLoad) {
            const oldNumber = this.meRecipient.lastRead();
            app.request({
              method: 'POST',
              url: app.forum.attribute('apiUrl') + '/whisper/messages/read',
              body: {
                conversationId: this.conversation.id(),
                messageId: results[0].id()
              }
            }).then((response) => {
              const newNumber = response.data.attributes.lastRead;
              app.session.user.pushAttributes({
                unreadMessages: app.session.user.unreadMessages() - (newNumber - oldNumber),
              });
              m.redraw();
              this.firstLoad = false;
            })
          }
          app.cache.messages[this.conversation.id()].push(...results);
          if (results.length < 20) {
            this.notNew = true;
          }
        })
        .then(() => {
          this.loading = false;
          m.redraw();
        });
    }
  }

  load() {
    this.loading = true;
    m.redraw();

    if (!app.cache.messages) {
      app.cache.messages = [];
    }

    this.conversation.recipients().map(recipient => {
      if (parseInt(recipient.user().id()) !== parseInt(app.session.user.id())) {
        this.user = recipient.user();
        this.recipient = recipient;
      } else {
        this.meRecipient = recipient;
      }
    });


    if (!app.cache.messages[this.conversation.id()]) {
      app.cache.messages[this.conversation.id()] = [];
    }

    this.getMessages();
  }
}
