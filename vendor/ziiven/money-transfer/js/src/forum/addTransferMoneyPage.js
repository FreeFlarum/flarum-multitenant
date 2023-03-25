import { extend } from "flarum/extend";
import UserPage from "flarum/components/UserPage";
import LinkButton from "flarum/components/LinkButton";
import TransferHistoryPage from "./components/TransferHistoryPage";

export default function () {
  app.routes["user.transferHistory"] = {
    path: "/u/:username/transferHistory",
    component: TransferHistoryPage,
  };

  extend(UserPage.prototype, "navItems", function (items,user) {
      if(app.session.user){
        const currentUserID = app.session.user.id();
        const targetUserID = this.user.id();

        if(currentUserID==targetUserID){
          items.add(
            "transferMoney",
            LinkButton.component({
                href: app.route("user.transferHistory", {
                  username: this.user.username(),
                }),
                icon: "fas fa-money-bill",
              },
              [
                app.translator.trans(
                  "ziven-transfer-money.forum.transfer-money-history"
                )
              ]
            ),
            10
          );
        }
      }
  });
}
