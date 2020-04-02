import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';

export default class ChangeNickNameModal extends Modal {

  init() {
    super.init();
    this.displayname = m.prop(app.session.user.displayName());
  }

  className() {
    return 'ChangeNickNameModal Modal--small';
  }

  title() {
    return app.translator.trans('dem13n.forum.nickname.change');
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form Form--centered">
          <div className="Form-group">
            <input
              type="text"
              autocomplete="off"
              name="nickname"
              className="FormControl"
              bidi={this.displayname}
              disabled={this.loading} />
          </div>
          <div className="Form-group">
            {Button.component({
              className: 'Button Button--primary Button--block',
              type: 'submit',
              loading: this.loading,
              children: app.translator.trans('dem13n.forum.nickname.submit_button')
            })}
          </div>
        </div>
      </div>
    );
  }

  onsubmit(e) {
    e.preventDefault();

    if (this.displayname() === app.session.user.username() || (!this.displayname() && (app.session.user.displayName() === app.session.user.username()))) {
      this.hide();
      return;
    }

    this.loading = true;

    app.session.user.save({ nickname: this.displayname() }, {
      errorHandler: this.onerror.bind(this),
    })
      .then(this.hide.bind(this))
      .catch(() => {
        this.loading = false;
        m.redraw();
      });
  }
}