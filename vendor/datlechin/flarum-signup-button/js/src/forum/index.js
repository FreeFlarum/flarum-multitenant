import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import IndexPage from 'flarum/forum/components/IndexPage';
import Button from 'flarum/common/components/Button';
import classList from 'flarum/common/utils/classList';
import SignUpModal from 'flarum/forum/components/SignUpModal';

const packagePrefix = 'datlechin-signup-button.';
const translationPrefix = packagePrefix + 'forum.';

app.initializers.add('datlechin/flarum-signup-button', () => {
  extend(IndexPage.prototype, 'sidebarItems', function (items) {
    const classes = classList('Button', 'Button--primary', 'SignUpButton');
    const startDiscussion = document.querySelector('.fas.fa-edit');

    if (app.session.user !== null) return;

    startDiscussion ? startDiscussion.classList.remove('.IndexPage-newDiscussion>fa-edit') : null;
    startDiscussion ? startDiscussion.classList.add('fa-sign-in-alt') : null;


    items.add(
      'signupButton',
      Button.component(
        {
          className: classes,
          onclick: () => app.modal.show(SignUpModal),
        },
        app.translator.trans(translationPrefix + 'sign_up')
      ),
      100
    );

  });
});
