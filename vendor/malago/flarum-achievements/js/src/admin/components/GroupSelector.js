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

import Component from "flarum/Component";
import Button from "flarum/components/Button";
import Dropdown from "flarum/components/Dropdown";

export default class GroupSelector extends Component {
  view() {
    const variables=["manual","posts", "likes", "selflikes", "discussions", "edits", "avatar", "comments", "contains", "meanwords", "tagposts", "years"];
    const label = app.translator.trans("malago-achievements.admin.achievement_modal.variable."+this.attrs.id());

    return (
      <span>
          <Dropdown
            label={label}
            buttonClassName="Button Button--danger"
          >
            {variables.map((g) =>
                Button.component(
                {
                  active: this.attrs.id(),
                  onclick: () => {
                      this.attrs.id(g);
                      if(g=="avatar" || g=="manual"){
                        $(".FormInline").addClass("FormHidden");
                      }else{
                        $(".FormInline").removeClass("FormHidden");
                        $("input.FormInline").attr("data-original-title", app.translator.trans("malago-achievements.admin.achievement_modal.tooltip."+g));
                      }
                  },
                },
                app.translator.trans("malago-achievements.admin.achievement_modal.variable."+g),
                )
            )}
          </Dropdown>
      </span>
    );
  }
}