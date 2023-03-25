import Notification from 'flarum/forum/components/Notification';
import { truncate } from 'flarum/common/utils/string';

export default class PostMovedNotification extends Notification {
  icon() {
    return 'fas fa-exchange-alt';
  }

  href() {
    return app.route('discussion', { id: this.attrs.notification.content().targetDiscussionId });
  }

  content() {
    return app.translator.trans('sycho-move-posts.forum.notifications.post_moved_text', {
      targetDiscussionTitle: (
        <span className="MovePosts-Notification-targetDiscussion">{this.attrs.notification.content().targetDiscussionTitle}</span>
      ),
    });
  }
}
