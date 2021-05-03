/*
 *  Achievements Extension for Flarum
 *  Author: Miguel A. Lago
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 */

import ExtensionPage from "flarum/components/ExtensionPage";
import LoadingIndicator from "flarum/components/LoadingIndicator";
import icon from "flarum/helpers/icon";
import AchievementModal from "./AchievementModal";
import AchievementUserModal from "./AchievementUserModal";

function AchievementsItem(achievement) {

  const name = achievement
    ? achievement.name()
    : app.translator.trans(
      "malago-achievements.admin.achievements_page.create_achievement_button"
    );
  const rectangle = (achievement ? achievement.rectangle() : "0,0,32,32").split(',')

  var iconName = achievement ? "" : icon("fas fa-plus");

  const addString = app.translator.trans("malago-achievements.admin.achievements_page.add_delete_users")

  var style = "background:none;\
      height:32px;\
      width:32px;";

  if (achievement)
    if (achievement.image().includes("http")) {
      style = "background:url(" + achievement.image() + ");\
      background-position:-"+ rectangle[0] + "px -" + rectangle[1] + "px;\
      height:"+ rectangle[2] + "px;\
      width:"+ rectangle[3] + "px;";
    } else {
      iconName = icon(achievement.image());
    }
  return (
    <div
      className="ExtensionListItem"
    >
      <span className="ExtensionListItem-icon ExtensionIcon Achievement" style={style} onclick={() => app.modal.show(AchievementModal, { model: achievement })}>
        {iconName}</span>
      <span className="ExtensionListItem-title">{name}</span>
      <span className="ExtensionListItem-user" data-toggle='tooltip' title={addString} onclick={() => achievement ? app.modal.show(AchievementUserModal, { model: achievement }) : null}><i class="fas fa-users-cog"></i></span>
    </div>

  );
}

export default class AchievementsPage extends ExtensionPage {
  oninit(vnode) {
    super.oninit(vnode);

    this.loading = true;

    app.store.find("achievements").then(() => {
      this.loading = false;
      m.redraw();
    });

  }
  content() {
    if (this.loading) {
      return (
        <div className="Achievements">
          <div className="container">
            <LoadingIndicator />
          </div>
        </div>
      );
    }

    return (
      <div className="Achievements">
        <div className="container">
          <div className="ExtensionsWidget-list Achievements-list">
            <p className="Achievements-list-heading">
              {app.translator.trans(
                "malago-achievements.admin.achievements_page.list_heading"
              )}
            </p>
            <div className="ExtensionList">
              {[
                ...app.store.all("achievements").map(AchievementsItem),
                AchievementsItem(),
              ]}
            </div>
          </div>
          <div className="Achievements-footer">
            <p>
              {app.translator.trans(
                "malago-achievements.admin.achievements_page.instructions_header"
              )}
            </p>
            <ul>
              {app.translator.trans(
                "malago-achievements.admin.achievements_page.instructions_text"
              )}
            </ul>
          </div>
        </div>
      </div>
    );
  }
}