import app from 'flarum/forum/app';
import Notification from "flarum/components/Notification";

export default class TransferMoneyNotification extends Notification {
  icon() {
    return "fas fa-money-bill";
  }

  href() {
    return app.route("user.transferHistory", {
      username: app.session.user.username(),
    });
  }

  content() {
    const user = this.attrs.notification.fromUser();
    return app.translator.trans('ziven-transfer-money.forum.notifications.user-transfer-money-to-you', {
      user: user,
    });
  }

  excerpt() {
    const notification = this.attrs.notification.subject();
    const transferMoney = notification.attribute("transfer_money_value");
    const transferID = notification.attribute("id");
    const moneyName = app.forum.attribute('antoinefr-money.moneyname') || '[money]';
    const costText = moneyName.replace('[money]', transferMoney);

    return app.translator.trans('ziven-transfer-money.forum.notifications.user-transfer-money-details', {
      cost: costText,
      id:transferID
    });
  }
}
