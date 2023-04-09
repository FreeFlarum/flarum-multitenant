import app from 'flarum/forum/app';
import addIgnoreUserControlButton from './addIgnoreUserControlButton';
import addHideIgnoredPost from './addHideIgnoredPost';
import addProfilePage from './addProfilePage';
import addIgnoredUserBadge from './addIgnoredUserBadge';

export { default as extend } from './extend';

app.initializers.add('fof-ignore-users', function () {
  addIgnoreUserControlButton();
  addHideIgnoredPost();
  addProfilePage();
  addIgnoredUserBadge();
});
