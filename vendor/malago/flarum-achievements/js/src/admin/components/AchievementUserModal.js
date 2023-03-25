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

import Modal from "flarum/components/Modal";
import Button from "flarum/components/Button";
import LoadingIndicator from "flarum/components/LoadingIndicator";
import ItemList from "flarum/utils/ItemList";
import Stream from "flarum/utils/Stream";


export default class AchievementUserModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);
    
    this.achievement = this.attrs.model;
    this.achievement_user = app.store.createRecord("achievement_user")

    this.name = Stream(this.achievement.name() || "");
    this.id = Stream(this.achievement.data.id || "");

    this.user_id = Stream("");

  }

  className() {
    return "EditAchievementModal Modal--small";
  }

  title() {
    return this.name()
      ? this.name()
      : app.translator.trans(
          "malago-achievements.admin.achievement_modal.add_delete_title"
        );
  }

  content() {
    if (this.loading) {
      return (
        <div className="Modal-body">
          <div className="Form">
            <div className="container">
              <LoadingIndicator />
            </div>
          </div>
        </div>
      );
    }

    return (
      <div className="Modal-body">
        <div className="Form">{this.fields().toArray()}</div>
      </div>
    );
  }

  fields() {
    const items = new ItemList();
    items.add(
      "instructions",
      <div className="Form-group">
          <p>{app.translator.trans(
                "malago-achievements.admin.achievement_modal.add_delete_instructions"
            )}</p>
      </div>,
      50
      );
    items.add(
        "user_id",
        <div className="Form-group">
            <label>
            {app.translator.trans(
                "malago-achievements.admin.achievement_modal.username"
            )}
            </label>
            <input
            className="FormControl"
            placeholder={app.translator.trans(
                "malago-achievements.admin.achievement_modal.username_placeholder"
            )}
            bidi={this.user_id}
            />
        </div>,
        50
        );

    items.add(
      "submit",
      <div className="Form-group">
        {Button.component(
          {
            type: "submit",
            className: "Button Button--primary EditAchievementModal-save",
            loading: this.loading,
            disabled: this.name().length === 0,
          },
          app.translator.trans(
            "malago-achievements.admin.achievement_modal.submit_button"
          )
        )}
        
      </div>,
      -10
    );

    return items;
  }

  submitData() {
    const data = {
      id: this.id(),
      user_id: this.user_id(),
      new:1,
    };

    return data;
  }

  onsubmit(e) {
    e.preventDefault();

    this.loading = true;

    if (this.user_id()!=""){
      this.achievement_user.save(this.submitData()).then(
        () => this.hide(),
        () => (this.loading = false)
      );
    }
  }

}