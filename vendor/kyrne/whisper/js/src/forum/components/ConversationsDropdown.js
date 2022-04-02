import NotificationsDropdown from 'flarum/components/NotificationsDropdown';

import ConversationsList from './ConversationsList';

export default class ConversationsDropdown extends NotificationsDropdown {
  static initAttrs(attrs) {
    attrs.label = attrs.label || app.translator.trans('kyrne-whisper.forum.dropdown.tooltip');
    attrs.icon = attrs.icon || 'fas fa-comment-alt';
    attrs.className = 'MessagesDropdown NotificationsDropdown';

    super.initAttrs(attrs);
  }

  onclick() {
    if (app.drawer.isOpen()) {
      this.goToRoute();
    }

  }

  getMenu() {
    return (
      <form className={'Dropdown-menu ' + this.attrs.menuClassName}>
        {this.showing ? <ConversationsList mobile={false}></ConversationsList> : ''}
      </form>
    );
  }

  goToRoute() {
    m.route(app.route('conversations'));
  }

  getUnreadCount() {
    return app.session.user.unreadMessages();
  }

  getNewCount() {
    return app.session.user.unreadMessages();
  }
}
