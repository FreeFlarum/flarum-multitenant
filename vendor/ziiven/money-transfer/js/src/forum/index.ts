import { extend } from 'flarum/extend';
import UserControls from 'flarum/utils/UserControls';
import NotificationGrid from "flarum/components/NotificationGrid";
import SessionDropdown from 'flarum/forum/components/SessionDropdown';
import Button from 'flarum/components/Button';

import TransferMoney from "./model/TransferMoney";
import TransferMoneyModal from './components/TransferMoneyModal';
import TransferMoneyNotification from "./components/TransferMoneyNotification";
import addTransferMoneyPage from "./addTransferMoneyPage";
import addClient1CustomizationFeatures from "./addClient1CustomizationFeatures";


app.initializers.add('ziven-money-transfer', () => {
  app.store.models.transferMoney = TransferMoney;
  app.notificationComponents.transferMoney = TransferMoneyNotification;

  addTransferMoneyPage();
  addClient1CustomizationFeatures();

  extend(NotificationGrid.prototype, "notificationTypes", function (items) {
    items.add("transferMoney", {
      name: "transferMoney",
      icon: "fas fa-dollar-sign",
      label: app.translator.trans(
        "ziven-transfer-money.forum.receive-transfer-from-user"
      ),
    });
  });

  extend(UserControls, 'moderationControls', (items, user) => {
    const allowUseTranferMoney = app.forum.attribute('allowUseTranferMoney');

    if(app.session.user && allowUseTranferMoney){
      const currentUserID = app.session.user.id();
      const targetUserID = user.id();
      
      if(currentUserID!==targetUserID){
        items.add('transferMoney', Button.component({
            icon: 'fas fa-money-bill',
            onclick: () => app.modal.show(TransferMoneyModal, {user})
          }, app.translator.trans('ziven-transfer-money.forum.transfer-money'))
        );
      }
    }
  });

  extend(SessionDropdown.prototype, 'items', function (items) {
    if (!app.session.user) {
      return;
    }

    items.add(
      'transferMoney',
      Button.component(
        {
          icon: 'fas fa-money-bill',
          onclick: () => {
            app.modal.show(TransferMoneyModal)
          },
        },
        app.translator.trans('ziven-transfer-money.forum.transfer-money')
      ),
      -1
    );
  });
});
