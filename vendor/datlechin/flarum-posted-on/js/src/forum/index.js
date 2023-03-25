import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import Post from 'flarum/common/models/Post';
import User from 'flarum/common/models/User';
import Model from 'flarum/common/Model';
import CommentPost from 'flarum/forum/components/CommentPost';
import SettingsPage from 'flarum/forum/components/SettingsPage';
import Switch from 'flarum/common/components/Switch';
import PostedOn from './components/PostedOn';

app.initializers.add('datlechin/flarum-posted-on', () => {
  Post.prototype.postedOn = Model.attribute('posted_on');
  User.prototype.disclosePostedOn = Model.attribute('disclosePostedOn');

  extend(CommentPost.prototype, 'headerItems', function (items) {
    const post = this.attrs.post;
    const user = post.user();

    if (user && (post.postedOn() === null || user.disclosePostedOn() === false)) return;

    items.add('postedOn', PostedOn.component({ post }));
  });

  extend(SettingsPage.prototype, 'privacyItems', function (items) {
    items.add(
      'disclosePostedOn',
      <Switch
        state={this.user.disclosePostedOn()}
        onchange={(value) => {
          this.disclosePostedOnLoading = true;

          this.user.save({ disclosePostedOn: value }).then(() => {
            this.disclosePostedOnLoading = false;
            m.redraw();
          });
        }}
        loading={this.disclosePostedOnLoading}
      >
        {app.translator.trans('datlechin-posted-on.forum.settings.privacy_disclose_posted_on_label')}
      </Switch>
    );
  });
});
