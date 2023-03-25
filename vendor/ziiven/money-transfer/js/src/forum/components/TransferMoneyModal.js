import app from 'flarum/forum/app';
import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';
import SearchState from 'flarum/forum/states/SearchState';
import ItemList from 'flarum/common/utils/ItemList';
import Stream from 'flarum/common/utils/Stream';
import Alert from 'flarum/common/components/Alert';

import TransferMoneySearchModal from './TransferMoneySearchModal';
import TransferMoneySuccessModal from './TransferMoneySuccessModal';

export default class TransferMoneyModal extends Modal {
  static isDismissible = false;

  oninit(vnode) {
    super.oninit(vnode);
    this.selected = Stream(new ItemList());
    this.selectedUsers = {};
    this.moneyName = app.forum.attribute('antoinefr-money.moneyname') || '[money]';

    const targetUser = this.attrs.user;
    if(targetUser){
      this.selected().add('users:' + targetUser.id(), targetUser);
      this.selectedUsers[targetUser.id()];
    }
    
    this.recipientSearch = new SearchState();
    this.needMoney = Stream(0);
  }

  className() {
    return 'Modal--small';
  }

  title() {
    return app.translator.trans('ziven-transfer-money.forum.transfer-money');
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form">
          <div style="padding-bottom:20px;" className="TransferMoneyModal-form">
            {TransferMoneySearchModal.component({
              state: this.recipientSearch,
              selected: this.selected,
              selectedUsers: this.selectedUsers,
              needMoney: this.needMoney,
              callback: function(){
                m.redraw();
              }
            })}
          </div>

          <div className="Form-group">
            <label>{app.translator.trans('ziven-transfer-money.forum.current-money-amount')}{this.moneyName.replace('[money]', app.session.user.attribute("money"))}</label>
            <input id="moneyTransferInput" placeholder={app.translator.trans('ziven-transfer-money.forum.transfer-money-input-placeholder')} required className="FormControl" type="number" step="any" min="0" oninput={(e) => this.moneyTransferChanged()} />
            <div style="padding-top:10px">{app.translator.trans('ziven-transfer-money.forum.need-money-amount')}<span id="needMoneyContainer">{this.moneyName.replace('[money]', this.needMoney())}</span></div>
          </div>

          <div className="Form-group">
            <label>{app.translator.trans('ziven-transfer-money.forum.transfer-money-notes')}</label>
            <textarea id="moneyTransferNotesInput" maxlength="255" className="FormControl" />
          </div>

          <div className="Form-group" style="text-align: center;">
            {Button.component(
              {
                className: 'Button Button--primary',
                type: 'submit',
                loading: this.loading,
              },
              app.translator.trans('ziven-transfer-money.forum.ok')
            )}&nbsp;
            {Button.component(
              {
                className: 'Button transferMoneyButton--gray',
                loading: this.loading,
                onclick: () => {
                  this.hide();

                  if(typeof(this.attrs.callback)==="function"){
                    this.attrs.callback();
                  }
                }
              },
              app.translator.trans('ziven-transfer-money.forum.cancel')
            )}
          </div>
        </div>
      </div>
    );
  }

  getTotalNeedMoney(){
    let moneyTransferValue = parseFloat($("#moneyTransferInput").val());

    if(isNaN(moneyTransferValue)){
      moneyTransferValue = 0;
    }

    return Object.keys(this.selectedUsers).length*moneyTransferValue;
  }

  moneyTransferChanged(){
    const totalNeedMoney = this.getTotalNeedMoney();
    const totalNeedMoneyText = this.moneyName.replace('[money]', totalNeedMoney);
    $("#needMoneyContainer").text(totalNeedMoneyText);
  }

  onsubmit(e) {
    e.preventDefault();
    const userMoney = app.session.user.attribute("money");
    const moneyTransferValue = parseFloat($("#moneyTransferInput").val());
    const moneyTransferValueTotal = this.getTotalNeedMoney();
    const moneyTransferNotesValue = $("#moneyTransferNotesInput").val();

    if(moneyTransferValueTotal>userMoney){
      app.alerts.show(Alert, {type: 'error'}, app.translator.trans('ziven-transfer-money.forum.transfer-error-insufficient-fund'));
      return;
    }

    if(Object.keys(this.selectedUsers).length===0){
      app.alerts.show(Alert, {type: 'error'}, app.translator.trans('ziven-transfer-money.forum.transfer-error-no-target-user-selected'));
      return;
    }

    if(moneyTransferValue>0){
      const moneyTransferData = {
        moneyTransfer:moneyTransferValue,
        moneyTransferNotes:moneyTransferNotesValue,
        selectedUsers:JSON.stringify(Object.keys(this.selectedUsers))
      };

      this.loading = true;

      app.store
        .createRecord("transferMoney")
        .save(moneyTransferData)
        .then(
          (payload) => {
            app.store.pushPayload(payload);
            app.modal.show(TransferMoneySuccessModal);
            this.loading = false;
            
            if(typeof(this.attrs.callback)==="function"){
              this.attrs.callback();
            }
          }
        )
        .catch((e) => {
          this.loading = false;
        });
    }
  }
}
