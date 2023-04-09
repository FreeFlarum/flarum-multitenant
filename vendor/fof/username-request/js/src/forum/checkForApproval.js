import app from 'flarum/forum/app';
import ResultsModal from './components/ResultsModal';

export default function () {
  return new Promise(() => {
    setTimeout(() => {
      if (app.session.user) {
        const approvedNickname = app.session.user.lastNicknameRequest() && app.session.user.lastNicknameRequest().status() !== 'Sent';
        const approvedUsername = app.session.user.lastUsernameRequest() && app.session.user.lastUsernameRequest().status() !== 'Sent';
        if (approvedNickname || approvedUsername) {
          app.modal.show(ResultsModal, { nickname: approvedNickname });
        }
      }
    }, 1000);
  });
}
