import { extend } from 'flarum/extend';
import app from 'flarum/app';
import Alert from 'flarum/components/Alert';
import Button from 'flarum/components/Button';
import LogInFactorModal from './components/LogInFactorModal';
import LogInModal from 'flarum/components/LogInModal';
import Model from 'flarum/Model';
import SettingsPage from 'flarum/components/SettingsPage';
import TwoFactorModal from './components/TwoFactorModal';
import User from 'flarum/models/User';
import OneTouchModal from './components/OneTouchModal';

app.initializers.add('reflar-twofactor', () => {
  User.prototype.twofa_enabled = Model.attribute('twofa-enabled');

  LogInModal.prototype.init = function() {
    this.identification = m.prop(this.props.identification || '');

    this.password = m.prop(this.props.password || '');

    this.remember = m.prop(this.props.remember && true);

    this.pageId = this.makeid();
  };

  LogInModal.prototype.makeid = function() {
    var text = '';
    var possible = '0123456789';

    for (var i = 0; i < 5; i++) text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  };

  LogInModal.prototype.onsubmit = function(e) {
    e.preventDefault();

    this.loading = true;

    const identification = this.identification();
    const password = this.password();
    const remember = this.remember();
    const pageId = this.pageId;

    app
      .request({
        url: app.forum.attribute('apiUrl') + '/twofactor/login',
        method: 'POST',
        errorHandler: this.failure.bind(this),
        data: { identification, password, remember, pageId },
      })
      .then(response => {
        let data = {
          identification: this.identification(),
          password: this.password(),
          remember: this.remember(),
          pageId: this.pageId,
        };
        if (response.userId === 'IncorrectCode') {
          app.modal.show(new LogInFactorModal({ data }));
        } else if (response.userId === 'IncorrectOneCode') {
          app.modal.show(new OneTouchModal({ data }));
        } else {
          window.location.reload();
        }
      });
  };

  LogInModal.prototype.failure = function(response) {
    if (parseInt(response.status) === 403) {
      this.alert = new Alert({
        type: 'error',
        dismissible: false,
        children: app.translator.trans('core.forum.log_in.invalid_login_message'),
      });
      this.loading = false;
      m.redraw();
    }
  };

  extend(SettingsPage.prototype, 'accountItems', items => {
    items.add(
      '2 Factor',
      Button.component(
        {
          className: 'Button',
          onclick: () => {
            app.modal.show(new TwoFactorModal());
          },
        },
        [app.translator.trans('reflar-twofactor.forum.accountlabel')]
      ),
      1
    );
  });
});
