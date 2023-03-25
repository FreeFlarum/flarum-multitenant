import Component from "flarum/Component";
import Link from "flarum/components/Link";
import avatar from "flarum/helpers/avatar";
import username from "flarum/helpers/username";

export default class TransferHistoryListItem extends Component {
  view() {
    const {transferHistory} = this.attrs;
    const currentUserID = app.session.user.id();
    const fromUserID = transferHistory.attribute("from_user_id");
    const assignedAt = transferHistory.assignedAt();
    const fromUser = transferHistory.fromUser();
    const targetUser = transferHistory.targetUser();
    const transferMoney = transferHistory.transferMoney();
    const transferNotes = transferHistory.notes();
    const transferNotesText = transferNotes?transferNotes:app.translator.trans('ziven-transfer-money.forum.transfer-list-transfer-notes-none');
    const transferID = transferHistory.id();
    const transferType = app.translator.trans(currentUserID==fromUserID?"ziven-transfer-money.forum.transfer-money-out":"ziven-transfer-money.forum.transfer-money-in");
    const transferTypeStyle = currentUserID==fromUserID?"color:red":"color:green";

    const moneyName = app.forum.attribute('antoinefr-money.moneyname') || '[money]';
    const transferMoneyText = moneyName.replace('[money]', transferMoney);

    return (
      <div className="transferHistoryContainer">
        <div style="padding-top: 5px;">
          <b>{app.translator.trans('ziven-transfer-money.forum.transfer-list-type')}: </b>
          <span style={transferTypeStyle}>{transferType}</span>&nbsp;|&nbsp;

          <b>{app.translator.trans('ziven-transfer-money.forum.transfer-list-assign-at')}: </b>
          {assignedAt}
        </div>

        <div style="padding-top: 5px;">
          <b>{app.translator.trans('ziven-transfer-money.forum.transfer-list-id')}: </b>
          {transferID}&nbsp;|&nbsp;
          <b>{app.translator.trans('ziven-transfer-money.forum.transfer-list-from-user')}: </b>
          <Link href={fromUser ? app.route.user(fromUser) : "#"} className="transferHistoryUser" style="color:var(--heading-color)">
            {avatar(fromUser)} {username(fromUser)}
          </Link>&nbsp;|&nbsp;

          <b>{app.translator.trans('ziven-transfer-money.forum.transfer-list-target-user')}: </b>
          <Link href={targetUser ? app.route.user(targetUser) : "#"} className="transferHistoryUser" style="color:var(--heading-color)">
            {avatar(targetUser)} {username(targetUser)}
          </Link>&nbsp;|&nbsp;
          <b>{app.translator.trans('ziven-transfer-money.forum.transfer-list-transfer-amount')}: </b>
          {transferMoneyText}&nbsp;

          {transferNotes && 
            <span>|&nbsp;
              <b>{app.translator.trans('ziven-transfer-money.forum.transfer-list-transfer-notes')}: </b>
              {transferNotesText}
            </span>
          }
        </div>
      </div>
    );
  }
}
