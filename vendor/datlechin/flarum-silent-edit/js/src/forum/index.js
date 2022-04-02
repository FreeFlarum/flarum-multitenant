import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import PostControls from 'flarum/forum/utils/PostControls';
import Button from 'flarum/common/components/Button';
import Post from 'flarum/common/models/Post';
import Model from 'flarum/common/Model';

app.initializers.add('datlechin/flarum-silent-edit', () => {
  Post.prototype.canClearLastEdit = Model.attribute('canClearLastEdit');

  extend(PostControls, 'moderationControls', function (items, post) {
    if (!post.canClearLastEdit() || !post.editedUser()) return;

    items.add(
      'clearLastEdit',
      <Button icon="fas fa-volume-mute" onclick={this.clearLastEdit.bind(post)}>
        {app.translator.trans('datlechin-silent-edit.forum.post_controls.clear_last_edit_button')}
      </Button>
    );
  });

  PostControls.clearLastEdit = function () {
    return this.save({ isEdited: false }).then(() => m.redraw());
  };
});
