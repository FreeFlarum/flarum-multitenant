import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import PostUser from 'flarum/forum/components/PostUser';
import LevelBar from './components/LevelBar';

app.initializers.add('ianm-level-ranks', () => {
  extend(PostUser.prototype, 'view', function (view) {
    const user = this.attrs.post.user();

    if (!user) return;

    view.children.push(LevelBar.component({ user }));
  });
});
