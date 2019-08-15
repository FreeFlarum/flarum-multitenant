import Alert from 'flarum/components/Alert';
import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';
import LoadingIndicator from 'flarum/components/LoadingIndicator';
import icon from 'flarum/helpers/icon';

export default class OneTouchModal extends Modal {
  init() {
    this.identification = this.props.data.identification;

    this.password = this.props.data.password;

    this.remember = this.props.data.remember;

    this.pageId = this.props.data.pageId;

    this.twoFactorCode = m.prop('');

    this.verified = false;

    this.code = m.prop(false);

    this.clock = window.setInterval(() => {
      if (!this.shouldCheck) {
        this.shouldCheck = true;
        app
          .request({
            url: app.forum.attribute('apiUrl') + '/twofactor/login',
            method: 'POST',
            data: {
              identification: this.identification,
              password: this.password,
              remember: this.remember,
              pageId: this.pageId,
            },
          })
          .then(response => {
            if (response.userId === 'IncorrectOneCode') {
              this.shouldCheck = false;
            } else {
              this.verified = true;
              m.redraw();
              window.location.reload();
            }
          });
      }
    }, 3000);
  }

  className() {
    return 'OneTouchModal';
  }

  title() {
    return app.translator.trans('reflar-twofactor.forum.modal.oneTouchTitle');
  }

  content() {
    if (this.verified) {
      return (
        <div className="Modal-body TwoFactor-approved">
          <h1 className="TwoFactor-title">{app.translator.trans('reflar-twofactor.forum.modal.oneTouchHeaderVerified')}</h1>
          <div className="TwoFactor-icon">{icon('fas fa-check')}</div>
        </div>
      );
    }
    return (
      <div className="Modal-body">
        <h2 className="TwoFactor-title">
          {this.code()
            ? app.translator.trans('reflar-twofactor.forum.modal.oneTouchCodeHeader')
            : app.translator.trans('reflar-twofactor.forum.modal.oneTouchHeader')}
        </h2>
        <div id="spinner">{LoadingIndicator.component({ style: 'transform: scale(1.5);' })}</div>
        {this.code()
          ? [
              <input
                type="text"
                id="code"
                oninput={m.withAttr('value', this.twoFactorCode)}
                className="FormControl TwoFactor-oneTime"
                placeholder={app.translator.trans('reflar-twofactor.forum.modal.placeholder')}
              />,
              <Button
                className={'Button Button--primary TwoFactor-inputButton' + (this.twoFactorCode().length > 5 ? '' : ' disabled')}
                loading={this.loading}
                type="submit"
              >
                {app.translator.trans('reflar-twofactor.forum.modal.button')}
              </Button>,
            ]
          : Button.component({
              className: 'Button Button--primary TwoFactor-oneButton',
              id: 'showInput',
              onclick: () => {
                this.code(true);
                m.redraw();
                $('#spinner').hide();
                window.clearInterval(this.clock);
              },
              children: app.translator.trans('reflar-twofactor.forum.modal.useACode'),
            })}
      </div>
    );
  }

  onsubmit(e) {
    e.preventDefault();

    if (this.loading) return;

    this.twoFactorCode(this.twoFactorCode().toUpperCase());

    this.loading = true;

    app
      .request({
        url: app.forum.attribute('apiUrl') + '/twofactor/login',
        method: 'POST',
        data: {
          identification: this.identification,
          password: this.password,
          remember: this.remember,
          twofactor: this.twoFactorCode(),
          pageId: this.pageId,
        },
      })
      .then(response => {
        if (response.userId === 'IncorrectOneCode') {
          this.alert = new Alert({
            type: 'error',
            dismissible: false,
            children: app.translator.trans('reflar-twofactor.forum.incorrect_2fa'),
          });
          this.loading = false;
          m.redraw();
        } else {
          window.location.reload();
        }
      });
  }
}
