import Component from 'flarum/Component';
import avatar from 'flarum/helpers/avatar';
import username from 'flarum/helpers/username';
import userOnline from 'flarum/helpers/userOnline';


export default class UserListItem extends Component {
  oninit(vnode) {
    this.conversation = vnode.attrs.conversation;
    this.index = vnode.attrs.i;
    this.active = vnode.attrs.active;
    this.loading = true;

    this.conversation.recipients().map(recipient => {
      if (parseInt(recipient.user().id()) !== parseInt(app.session.user.id())) {
        this.user = recipient.user();
        this.loading = false;
        m.redraw();
      }
    });

    const interval2 = () => {
      if (this.typingTime < new Date(Date.now() - 6000)) {
        this.typing = false;
        m.redraw();
      }
      setTimeout(() => {
        interval2();
      }, 6000);
    };

    interval2();
  }

  onremove() {
    if (app.pusher) {
      app.pusher.then(object => {
        const channels = object.channels;
        channels.user.unbind('typing');
      });
    }
  }

  onupdate() {
    $('.UserListItem').on('click tap', ((e) => {
        this.active = this.conversation.id() == app.cache.conversations[$(e.currentTarget).attr('id')].id();
        m.redraw();
    }));

  }

  oncreate() {
    if (app.pusher) {
      app.pusher.then(object => {
        const channels = object.channels;
        channels.user.bind('typing', data => {
          if (parseInt(data.conversationId) === parseInt(this.conversation.id())) {
            this.typing = true;
            this.typingTime = new Date();
            m.redraw();
          }
        })
      })
    }
  }

  view() {
    if (this.loading) return;
    return (
      <li id={this.index} className={this.active ? 'UserListItem active' : 'UserListItem'}>
        <div className="UserListItem-content">
          {avatar(this.user)}
          <div className="info">
            {username(this.user)}
            {userOnline(this.user)}
          </div>
          {this.typing ?
            <div className="tiblock">
              <div className="tidot"></div>
            </div>
            : ''}
        </div>
      </li>
    )
  }
}

