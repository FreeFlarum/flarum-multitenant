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
import Checkbox from "flarum/components/Checkbox";
import Tooltip from "flarum/components/Tooltip";
import LoadingIndicator from "flarum/components/LoadingIndicator";
import ItemList from "flarum/utils/ItemList";
import Stream from "flarum/utils/Stream";
import GroupSelector from "./GroupSelector";

export default class AchievementModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);

    this.achievement =
      this.attrs.model || app.store.createRecord("achievements");

    this.id = Stream(this.achievement.data.id || "-");
    this.name = Stream(this.achievement.name() || "");
    this.description = Stream(this.achievement.description() || "");
    if (this.achievement.computation()) {
      var c = this.achievement.computation().split(':');
      this.selected_variable = Stream(c[0])
      this.computation = Stream(c[1]);

      if (this.selected_variable() == "avatar" || this.selected_variable() == "manual") {
        $(".FormInline").hide();
      }
    } else {
      this.computation = Stream("");
      this.selected_variable = Stream("manual");
    }

    this.points = Stream(this.achievement.points() || "");
    this.image = Stream(this.achievement.image() || "");
    this.active = Stream(this.achievement.active() || 1);
    this.hidden = Stream(this.achievement.hidden() || 0);

    if (this.achievement.rectangle()) {
      var rectangle = this.achievement.rectangle().split(',');

      this.row = Stream(rectangle[0] / rectangle[2] + 1);
      this.col = Stream(rectangle[1] / rectangle[3] + 1);

      this.width = Stream(rectangle[3]);
      this.height = Stream(rectangle[2]);
    } else {
      this.row = Stream("1");
      this.col = Stream("1");
      this.width = Stream("");
      this.height = Stream("");
    }

  }

  className() {
    return "EditAchievementModal Modal--large";
  }

  title() {
    return this.name()
      ? this.name() + " ID: " + this.id()
      : app.translator.trans(
        "malago-achievements.admin.achievement_modal.title"
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

    var all_fields = this.fields().toArray();
    return (
      <div className="Modal-body">
        <div className="Form">
          <div className="ModalColumn">{all_fields.slice(0, 6)}</div>
          <div className="ModalColumn">{all_fields.slice(6)}</div>
        </div>
      </div>
    );
  }

  fields() {
    const items = new ItemList();

    items.add(
      "name",
      <div className="Form-group">
        <label>
          {app.translator.trans(
            "malago-achievements.admin.achievement_modal.name_label"
          )}
        </label>
        <input
          className="FormControl"
          placeholder={app.translator.trans(
            "malago-achievements.admin.achievement_modal.name_placeholder"
          )}
          bidi={this.name}
        />
      </div>,
      50
    );

    items.add(
      "active",
      <div className="Form-group">
        <label>
          {app.translator.trans(
            "malago-achievements.admin.achievement_modal.active_label"
          )}
        </label>
        {Checkbox.component(
          {
            state: this.active(),
            onchange: () => {
              this.active((this.active() + 1) % 2);
            },
          }
        )}
      </div>,
      50
    );

    items.add(
      "hidden",
      <div className="Form-group">
        <label>
          {app.translator.trans(
            "malago-achievements.admin.achievement_modal.hidden_label"
          )}
        </label>
        {Checkbox.component(
          {
            state: this.hidden(),
            onchange: () => {
              this.hidden((this.hidden() + 1) % 2);
            },
          }
        )}
      </div>,
      50
    );

    items.add(
      "description",
      <div className="Form-group">
        <label>
          {app.translator.trans(
            "malago-achievements.admin.achievement_modal.description_label"
          )}
        </label>
        <input
          className="FormControl"
          placeholder={app.translator.trans(
            "malago-achievements.admin.achievement_modal.description_placeholder"
          )}
          bidi={this.description}
        />
      </div>,
      50
    );

    items.add(
      "computation",
      <div className="Form-group">
        <label>{app.translator.trans(
          "malago-achievements.admin.achievement_modal.variable_label"
        )}</label>
        <GroupSelector
          label={app.translator.trans(
            "malago-achievements.admin.achievement_modal.variable_label"
          )}
          id={this.selected_variable}
        ></GroupSelector>
        <Tooltip id='Tooltip-computation' text="">
          <input
            className={this.selected_variable() == "avatar" || this.selected_variable() == "manual" ? "FormControl FormHidden FormInline" : "FormControl FormInline"}
            placeholder={app.translator.trans(
              "malago-achievements.admin.achievement_modal.computation_placeholder"
            )}
            bidi={this.computation}
            />
          </Tooltip>
      </div>
      ,
      50
    );

    items.add(
      "points",
      <div className="Form-group">
        <label>
          {app.translator.trans(
            "malago-achievements.admin.achievement_modal.points_label"
          )}
        </label>
        <input
          className="FormControl"
          placeholder={app.translator.trans(
            "malago-achievements.admin.achievement_modal.points_placeholder"
          )}
          bidi={this.points}
        />
      </div>,
      50
    );
    items.add(
      "image",
      <div className="Form-group">
        <label>
          {app.translator.trans(
            "malago-achievements.admin.achievement_modal.image_label"
          )}
        </label>
        <input
          className="FormControl"
          placeholder={app.translator.trans(
            "malago-achievements.admin.achievement_modal.image_placeholder"
          )}
          bidi={this.image}
          onchange={this.showImage()}
        />
      </div>,
      50
    );

    items.add(
      "image-show",
      <div className="Form-group">
        <div class="AchievementImage-Show">
          &nbsp;
        </div>
      </div>
      ,
      50
    );

    items.add(
      "size",
      <div className="Form-group Image-data">
        <table className="AchievementModal-Table">
          <tr>
            <td>
              <label>
                {app.translator.trans(
                  "malago-achievements.admin.achievement_modal.height_label"
                )}
              </label>
            </td>
            <td>
              <label>
                {app.translator.trans(
                  "malago-achievements.admin.achievement_modal.width_label"
                )}
              </label>
            </td>
          </tr>
          <tr>
            <td>
              <input
                className="FormControl"
                bidi={this.height}
                onchange={this.showImage()}
                type="number"
              />
            </td>
            <td>
              <input
                className="FormControl"
                bidi={this.width}
                onchange={this.showImage()}
                type="number"
              />
            </td>
          </tr>
        </table>
      </div>,
      50
    );

    items.add(
      "position",
      <div className="Form-group Image-data">
        <table className="AchievementModal-Table">
          <tr>
            <td>
              <label>
                {app.translator.trans(
                  "malago-achievements.admin.achievement_modal.row_label"
                )}
              </label>
            </td>
            <td>
              <label>
                {app.translator.trans(
                  "malago-achievements.admin.achievement_modal.col_label"
                )}
              </label>
            </td>
          </tr>
          <tr>
            <td>
              <input
                className="FormControl"
                placeholder={1}
                bidi={this.col}
                onchange={this.showImage()}
                type="number"
              />
            </td>
            <td>
              <input
                className="FormControl"
                placeholder={1}
                bidi={this.row}
                onchange={this.showImage()}
                type="number"
              />
            </td>
          </tr>
        </table>
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
        {this.achievement.exists ? (
          <button
            type="button"
            className="Button EditAchievementsModal-delete"
            onclick={this.delete.bind(this)}
          >
            {app.translator.trans(
              "malago-achievements.admin.achievement_modal.delete_button"
            )}
          </button>
        ) : (
          ""
        )}
      </div>,
      -10
    );

    return items;
  }

  showImage() {

    if (this.image().includes("http")) {
      $(".AchievementImage-Show").html("");
      $(".Image-data").show();
      $(".AchievementImage-Show").css("background-position", "-" + ((this.row() - 1) * this.height()) + "px -" + ((this.col() - 1) * this.width()) + "px");
      $(".AchievementImage-Show").css("background-image", "url(" + this.image() + ")");
      $(".AchievementImage-Show").css("width", this.width() + "px");
      $(".AchievementImage-Show").css("height", this.height() + "px");
    } else {
      $(".AchievementImage-Show").html("<i class='icon " + this.image() + "'></i>");
      $(".AchievementImage-Show").css("background", "none");
      $(".AchievementImage-Show").css("height", "32px");
      $(".AchievementImage-Show").css("width", "32px");
      $(".Image-data").hide();
    }
  }

  submitData() {
    const data = {
      name: this.name(),
      description: this.description(),
      computation: this.selected_variable() + ":" + this.computation(),
      points: this.points(),
      image: this.image(),
      rectangle: [(this.row() - 1) * this.height(), (this.col() - 1) * this.width(), this.height(), this.width()].join(','),
      active: this.active(),
      hidden: this.hidden()
    };

    return data;
  }

  onsubmit(e) {
    e.preventDefault();

    this.loading = true;

    this.achievement.save(this.submitData()).then(
      () => this.hide(),
      () => (this.loading = false)
    );
  }

  delete() {
    if (
      confirm(
        app.translator.trans(
          "malago-achievements.admin.achievement_modal.delete_confirmation"
        )
      )
    ) {
      this.achievement.delete().then(() => {
        m.redraw();
      });

      this.hide();
    }
  }
}