import { extend, override } from 'flarum/common/extend';
import app from 'flarum/forum/app';
import Button from 'flarum/common/components/Button';
import Badge from 'flarum/common/components/Badge';
import Post from 'flarum/forum/components/Post';
import CommentPost from 'flarum/forum/components/CommentPost';
import DiscussionPage from 'flarum/forum/components/DiscussionPage';
import PostControls from 'flarum/forum/utils/PostControls';
import icon from 'flarum/common/helpers/icon';
import Discussion from 'flarum/common/models/Discussion';
import ItemList from 'flarum/common/utils/ItemList';
import Model from 'flarum/common/Model';

import DiscussionPageState from './states/DiscussionPageState';
import MovePostsModal from './components/MovePostsModal';
import PostMovedPost from './components/PostMovedPost';
import PostMovedNotification from './components/PostMovedNotification';

app.initializers.add('sycho/flarum-move-posts', () => {
  // @ts-ignore
  Discussion.prototype.isFirstMoved = Model.attribute('isFirstMoved');

  extend(Discussion.prototype, 'badges', function (badges: ItemList) {
    if (this.isFirstMoved()) {
      badges.add(
        'firstMoved',
        <Badge type="firstPostMoved" label={app.translator.trans('sycho-move-posts.forum.badge.first_moved_tooltip')} icon="fas fa-exchange-alt" />,
        -20
      );
    }
  });

  // @ts-ignore
  app.postComponents.postMoved = PostMovedPost;

  // @ts-ignore
  app.notificationComponents.postMoved = PostMovedNotification;

  if (!app.data.resources[0].attributes.canMovePosts) {
    return;
  }

  const state = new DiscussionPageState();

  extend(CommentPost.prototype, 'oninit', function () {
    this.subtree.check(() => state.selectedPostsToMove());
  });

  extend(Post.prototype, 'classes', function (classes: string[]) {
    if (this.attrs.post.contentType() === 'comment' && state.has(this.attrs.post.id())) {
      classes.push('Post--moving');
    }
  });

  extend(CommentPost.prototype, 'headerItems', function (items) {
    if (state.has(this.attrs.post.id())) {
      items.add(
        'moving',
        <span className="PostMoving">
          {icon('fas fa-exchange-alt')} {app.translator.trans('sycho-move-posts.forum.post.moving')}
        </span>
      );
    }
  });

  extend(DiscussionPage.prototype, 'oncreate', () => {
    state.selectedPostsToMove([]);
  });

  extend(DiscussionPage.prototype, 'sidebarItems', function (items) {
    if (state.selectedPostsToMove().length) {
      items.add(
        'movePosts',
        <Button
          icon="fas fa-exchange-alt"
          className="Button"
          onclick={() =>
            app.modal.show(MovePostsModal, {
              postIds: state.selectedPostsToMove(),
              discussion: this.discussion,
            })
          }
        >
          {app.translator.trans('sycho-move-posts.forum.discussion.move_posts')}
          <span className="MovePosts-Button-count">{state.selectedPostsToMove().length}</span>
        </Button>
      );
    }
  });

  extend(PostControls, 'moderationControls', function (items, post) {
    if (post.contentType() !== 'comment') return;

    const operation = state.has(post.id()) ? 'unmove' : 'move';

    items.add(
      'movePost',
      <Button
        icon="fas fa-arrow-right"
        onclick={() => {
          if (operation === 'move') {
            state.push(post.id());
          } else {
            state.remove(post.id());
          }

          m.redraw();
        }}
      >
        {app.translator.trans(`sycho-move-posts.forum.post.${operation}`)}
      </Button>
    );
  });
});
