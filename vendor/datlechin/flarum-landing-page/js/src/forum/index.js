import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import IndexPage from 'flarum/forum/components/IndexPage';
import DiscussionPage from 'flarum/forum/components/DiscussionPage';
import PostsUserPage from 'flarum/forum/components/PostsUserPage';
import DiscussionsUserPage from 'flarum/forum/components/DiscussionsUserPage';
import LandingPage from './components/LandingPage';

app.initializers.add('datlechin/flarum-landing-page', () => {
  const toExtend = [IndexPage, DiscussionPage, PostsUserPage, DiscussionsUserPage];

  toExtend.forEach((component) => {
    extend(component.prototype, 'view', function (view) {
      if (app.session.user) return;
      view.children = [];
      view.children.unshift(LandingPage.component());
    });
  });
});
