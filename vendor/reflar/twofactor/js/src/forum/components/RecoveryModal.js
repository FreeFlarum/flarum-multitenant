import app from 'flarum/app';
import { extend } from 'flarum/extend';
import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';

export default class RecoveryModal extends Modal {
  init() {
    super.init();

    this.recoveries = this.props.data.split(',');
  }

  className() {
    return 'TwoFactorModal Modal--small';
  }

  title() {
    return app.translator.trans('reflar-twofactor.forum.modal.twofactor_title');
  }

  content(user) {
    return (
      <div className="Modal-body">
        <div className="Form">
          <div className="Form-group">
            <div className="TwoFactor-codes">
              <h1>{app.translator.trans('reflar-twofactor.forum.modal.recov_header')}</h1>
              <h3>{app.translator.trans('reflar-twofactor.forum.modal.recov_help1')}</h3>
              <h4>{app.translator.trans('reflar-twofactor.forum.modal.recov_help2')}</h4>
              {this.recoveries.map(recovery => {
                return <br />, <h3>{recovery}</h3>;
              })}
            </div>
            <Button className="Button Button--primary TwoFactor-button" loading={this.loading} type="submit">
              {app.translator.trans('reflar-twofactor.forum.modal.close')}
            </Button>
          </div>
        </div>
      </div>
    );
  }

  isDismissible() {
    return false;
  }

  onsubmit(e) {
    app.modal.close();
  }
}
