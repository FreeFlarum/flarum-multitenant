import Button from 'flarum/components/Button';
import Component from 'flarum/Component';
import ConversationView from './ConversationView';
import UserListItem from './UserListItem';
import StartConversationModal from './StartConversationModal';

export default class ConversationsList extends Component {
  oninit(vnode) {
    this.mobile = vnode.attrs.mobile;
    this.load();
    this.loading = false;
    this.currentConversation = null;
  }

  onupdate() {
    $('.UserListItem').on('click tap', ((e) => {
      if (this.mobile) {
        m.route(app.route('messages', {id: app.cache.conversations[$(e.currentTarget).attr('id')].id()}))
      } else {
        this.currentConversation = app.cache.conversations[$(e.currentTarget).attr('id')];
        m.redraw();
      }
    }));

  }

  onbeforeupdate() {

    let list = $('.ConversationsList-list');

    list.scroll(() => {
      if (list.scrollTop() + list.innerHeight() >= list[0].scrollHeight) {
        this.loadMore()
      }
    });
  }

  view() {
    if (this.loading) return;
    const conversations = app.cache.conversations;

    if (this.currentConversation === null && app.cache.conversations && app.cache.conversations.length > 0) {
      this.currentConversation = app.cache.conversations[0];
    }

    if (this.currentConversation) {
      this.conversationComponent = ConversationView.component({conversation: this.currentConversation, mobile: this.mobile});
    }

    return (
      <div className="ConversationsList">
        <div style={app.session.user.conversations().length ? '' : 'width: unset; padding: 10px;'} className="container clearfix">
          <div style={this.mobile ? 'float: unset; margin: 0 auto; display: block;' : ''} className="people-list" id="people-list">
            {Button.component({
              onclick: this.showModal.bind(this),
              className: 'Button Button--primary',
              disabled: !app.forum.attribute('canMessage'),
            }, app.forum.attribute('canMessage') ? app.translator.trans('kyrne-whisper.forum.chat.start') : app.translator.trans('kyrne-whisper.forum.chat.cant_start')
            )}
            {app.session.user.conversations().length ?
            <ul className="ConversationsList-list">
              {conversations ? conversations.map((conversation, i) => {
                return UserListItem.component({conversation, i, active: this.mobile ? false : this.currentConversation === conversation})
              }) : ''}
            </ul>
              : ''}
          </div>

          {!this.mobile ? this.conversationComponent : ''}

        </div>
      </div>

    );
  }

  showModal() {
    app.modal.show(StartConversationModal, {
      conversations: app.cache.conversations,
      messages: app.cache.messages
    })
  }

  loadMore() {
    this.loading = true;
    m.redraw();

    app.store.find('whisper/conversations', {offset: app.cache.conversations.length})
      .then(results => {
        delete results.payload;
        results.map(result => {
          app.cache.conversations.push(result)
        });
      })
      .catch(() => {
      })
      .then(() => {
        this.loading = false;
        m.redraw();
      });
  }

  load() {
    if (app.cache.conversations && !this.mobile) {
      return;
    }

    if (this.mobile) {
      app.cache.conversations = [];
    }

    this.loading = true;
    m.redraw();

    app.store.find('whisper/conversations')
      .then(results => {
        delete results.payload;
        app.cache.conversations = results;
      })
      .catch(() => {
      })
      .then(() => {
        this.loading = false;
        m.redraw();
      });
  }
}
