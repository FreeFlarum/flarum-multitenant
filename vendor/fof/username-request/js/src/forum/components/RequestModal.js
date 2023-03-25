import app from 'flarum/forum/app';
import Stream from 'flarum/common/utils/Stream';
import Modal from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';

export default class RequestModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);

    this.username = Stream(this.attrs.nickname ? app.session.user.displayName() : app.session.user.username());

    this.userRequestAttr = `last${this.attrs.nickname ? 'Nickname' : 'Username'}Request`;

    this.lastRequest = app.session.user[this.userRequestAttr]();

    if (this.lastRequest) this.username(this.lastRequest.requestedUsername());

    this.success = false;

    this.password = Stream('');

    this.translationPrefix = `fof-username-request.forum.${this.attrs.nickname ? 'nickname' : 'username'}_modals.request`;
  }

  className() {
    return 'RequestUsernameModal Modal--small';
  }

  title() {
    return app.translator.trans(`${this.translationPrefix}.title`);
  }

  content() {
    if (this.success) {
      return (
        <div className="Modal-body">
          <div className="Form Form--centered">
            <p className="helpText">{app.translator.trans(`${this.translationPrefix}.confirmation_message`)}</p>
            <div className="Form-group">
              <Button className="Button Button--primary Button--block" onclick={this.hide.bind(this)}>
                {app.translator.trans(`${this.translationPrefix}.dismiss_button`)}
              </Button>
            </div>
          </div>
        </div>
      );
    }

    return (
      <div className="Modal-body">
        <div className="Form Form--centered">
          {this.lastRequest ? (
            <p className="helpText">
              {app.translator.trans(`${this.translationPrefix}.current_request`, {
                name: this.lastRequest.requestedUsername(),
              })}
            </p>
          ) : (
            ''
          )}
          <div className="Form-group">
            <input
              type="text"
              name="text"
              className="FormControl"
              placeholder={app.session.user.username()}
              bidi={this.username}
              disabled={this.deleteLoading || this.submitLoading}
            />
          </div>
          {app.forum.attribute('passwordlessSignUp') ? null : (
            <div className="Form-group">
              <input
                type="password"
                name="password"
                className="FormControl"
                placeholder={app.translator.trans('core.forum.change_email.confirm_password_placeholder')}
                bidi={this.password}
                disabled={this.deleteLoading || this.submitLoading}
              />
            </div>
          )}
          <div className="Form-group">
            {Button.component(
              {
                className: 'Button Button--primary Button--block',
                type: 'submit',
                loading: this.submitLoading,
              },
              app.translator.trans(`${this.translationPrefix}.submit_button`)
            )}
          </div>
          {this.lastRequest ? (
            <div className="Form-group">
              {Button.component(
                {
                  className: 'Button Button--primary Button--block',
                  onclick: this.deleteRequest.bind(this),
                  loading: this.deleteLoading,
                },
                app.translator.trans(`${this.translationPrefix}.delete_button`)
              )}
            </div>
          ) : (
            ''
          )}
        </div>
      </div>
    );
  }

  deleteRequest(e) {
    e.preventDefault();

    this.deleteLoading = true;

    this.lastRequest.delete();

    this.successAlert = app.alerts.show({ type: 'success' }, app.translator.trans(`${this.translationPrefix}.deleted`));

    app.session.user[this.userRequestAttr] = Stream();

    this.hide();
  }

  onsubmit(e) {
    e.preventDefault();

    this.alert = null;

    const currentAttr = this.attrs.nickname ? app.session.user.displayName() : app.session.user.username();
    if (this.username() === currentAttr) {
      this.hide();
      return;
    }

    this.submitLoading = true;

    app.store
      .createRecord('username-requests')
      .save(
        {
          username: this.username(),
          forNickname: this.attrs.nickname,
        },
        {
          meta: { password: this.password() },
          errorHandler: this.onerror.bind(this),
        }
      )
      .then((request) => {
        app.session.user[this.userRequestAttr] = Stream(request);
        this.success = true;
        this.alertAttrs = null;
      })
      .catch(() => {})
      .then(this.loaded.bind(this));
  }

  onerror(error) {
    if (error.status === 401) {
      error.alert.content = app.translator.trans('core.forum.change_email.incorrect_password_message');
      this.submitLoading = false;
    }

    super.onerror(error);
  }
}
