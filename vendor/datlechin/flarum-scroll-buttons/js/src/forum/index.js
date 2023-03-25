import app from 'flarum/forum/app';
import { extend } from 'flarum/forum/extend';
import ForumApplication from 'flarum/forum/ForumApplication';
import ScrollButtons from './components/ScrollButons';

app.initializers.add('datlechin/flarum-scroll-buttons', () => {
  extend(ForumApplication.prototype, 'mount', () => {
    const div = document.createElement('div');
    div.classList.add('ScrollButtons');
    app.initializers.has('acpl/mobile-tab') || app.initializers.has('itnt-uitab') ? div.classList.add('has-MobileTab') : null;
    m.mount(document.querySelector('.App-content').appendChild(div), ScrollButtons);
  });
});
