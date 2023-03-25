import app from 'flarum/forum/app';
import Modal from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';

export default class TransferMoneySuccessModal extends Modal {
  static isDismissible = false;

  oninit(vnode) {
    super.oninit(vnode);
  }

  className() {
    return 'Modal--small';
  }

  title() {
    return app.translator.trans('ziven-transfer-money.forum.transfer-money-success');
  }

  content() {
    return [
      <div className="Modal-body">
        <div style="text-align:center">
            {Button.component({
                style:'width:66px',
                className: 'Button Button--primary',
                onclick: () => {
                  location.reload();
                }
              },
              app.translator.trans('ziven-transfer-money.forum.ok')
            )}
          </div>
      </div>,
    ];
  }
}