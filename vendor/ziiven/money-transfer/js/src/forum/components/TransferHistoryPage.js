import UserPage from "flarum/components/UserPage";
import TransferHistoryList from "./TransferHistoryList";

export default class TransferHistoryPage extends UserPage {
  oninit(vnode) {
    super.oninit(vnode);
    this.loadUser(m.route.param("username"));
  }

  content() {
    return (
      <div className="TransferHistoryPage">
        {TransferHistoryList.component({
          params: {
            user: this.user,
          },
        })}
      </div>
    );
  }
}
