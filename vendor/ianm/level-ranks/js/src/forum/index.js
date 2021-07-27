import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import PostUser from 'flarum/forum/components/PostUser';
import LevelBar from './components/LevelBar';

app.initializers.add('reflar-level-ranks', (app) => {
    extend(PostUser.prototype, 'view', function (view) {
        const user = this.attrs.post.user();

        if (!user) return;

        view.children.push(LevelBar.component({ user }));
    });
});
