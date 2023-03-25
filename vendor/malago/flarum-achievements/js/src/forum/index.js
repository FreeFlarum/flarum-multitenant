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

const { default: registerModels } = require("../common/registerModels");

import { extend } from 'flarum/extend';
import CommentPost from 'flarum/components/CommentPost';
import Application from 'flarum/common/Application';
import NewAchievementModal from './modals/NewAchievementModal';
import IndexPage from 'flarum/components/IndexPage'
import Page from 'flarum/components/Page'
import AchievementsPage from './components/AchievementsPage'
import LinkButton from 'flarum/components/LinkButton';
import Tooltip from "flarum/components/Tooltip";
import UserCard from 'flarum/components/UserCard'

app.initializers.add('malago-achievements', app => {
  app.routes['achievements'] = { path: '/achievements', component: AchievementsPage };
  extend(IndexPage.prototype, 'navItems', function (items) {
    const here = app.forum.attribute('malago-achievements.link-left-column');

    if (!app.session.user || here != 1) {
      return;
    }
    items.add('achievements', <LinkButton icon="fas fa-trophy" href={app.route('achievements')}>
      {app.translator.trans("malago-achievements.forum.list_heading")}
    </LinkButton>
      , -11);
  });

  registerModels();

  extend(UserCard.prototype, 'view', function (element) {
    var points = 0;

    const here = app.forum.attribute('malago-achievements.show-user-card');

    var list = m("div.UserCard-Achievement-list");

    if (here == "1" && element.attrs.className.includes("UserCard--popover")) {
      var achievements = this.attrs.user.achievements();
      if (achievements !== undefined && achievements !== null) {
        Object.keys(achievements).forEach(obj => {
          var item = achievements[obj].data.attributes;
          var rectangle = item.rectangle.split(',');
          if (item.image.includes("http")) {
            var style = "background:url(" + item.image + ");\
              background-position:-"+ rectangle[0] + "px -" + rectangle[1] + "px;\
              height:"+ rectangle[2] + "px;\
              width:"+ rectangle[3] + "px;\
              margin: -"+ (rectangle[3] / 4 - 4) + "px;";
            list.children.push(m(Tooltip, { text: item.name },
              m("span.Badge.Achievement", { style: style }, ""))
            );
          } else {
            list.children.push(m(Tooltip, { text: item.name }, m("span.Badge.Achievement--Icon",
              m("i.icon." + item.image))
            ));
          }

          points += item.points;
        });
        if (list.children.length > 0 && points > 0) {
          list.children.push(m(Tooltip, { text: app.translator.trans("malago-achievements.forum.achievement_points") }, m("span.Achievement--Points", app.translator.trans(
            "malago-achievements.forum.achievement_points") + ": ", m("span.Achievement--Points--Number", points))));
        }
        element.children.push(list);
      }
    }
  })

  extend(CommentPost.prototype, 'view', function (comment) {
    var points = 0;
    //comment.children[0].children[2].children.splice(0,0, m("div.Achievements--User"));
    const here = app.forum.attribute('malago-achievements.show-post-footer');

    if (here == "1" && !this.attrs.post.data.attributes.isHidden) {
      this.attrs.post.data.attributes.achievements.forEach(function (item, index) {
        var rectangle = item.rectangle.split(',');
        if (item.image.includes("http")) {
          var style = "background:url(" + item.image + ");\
            background-position:-"+ rectangle[0] + "px -" + rectangle[1] + "px;\
            height:"+ rectangle[2] + "px;\
            width:"+ rectangle[3] + "px;\
            margin: -"+ (rectangle[3] / 4 - 4) + "px;";

          comment.children[0].children[2].children.push(m(Tooltip, { text: item.name },
            m("span.Badge.Achievement", { style: style }, ""))
          );
        } else {
          comment.children[0].children[2].children.push(m(Tooltip, { text: item.name }, m("span.Badge.Achievement--Icon",
            m("i.icon." + item.image))
          ));
        }

        points += item.points;
      });
      if (comment.children[0].children[2].children.length > 0 && points > 0) {
        comment.children[0].children[2].children.push(m(Tooltip, { text: app.translator.trans("malago-achievements.forum.achievement_points") }, m("span.Achievement--Points", app.translator.trans(
          "malago-achievements.forum.achievement_points") + ": ", m("span.Achievement--Points--Number", points))));
      }
    }
  });

  extend(Application.prototype, 'request', function (promise) {
    if (promise) {
      promise.then(function (data) {
        if (typeof data.new_achievements === "string")
          data.new_achievements = JSON.parse(data.new_achievements);

        if (data && data.new_achievements !== undefined && data.new_achievements !== null && data.new_achievements.length > 0) {
          app.modal.show(NewAchievementModal, { achievements: data.new_achievements });
        }
      });
    }
  });

  extend(Page.prototype, 'oncreate', function (promise) {
    if (app.session.user !== undefined && app.session.user !== null) {
      setTimeout(function () {
        var new_achievements = app.session.user.achievements();

        if (new_achievements !== undefined && new_achievements !== null && new_achievements.length > 0) {
          var only_new_achievements = [];
          for (var i = 0; i < new_achievements.length; i++) {
            if (new_achievements[i].data.attributes.new == 1) {
              only_new_achievements.push(new_achievements[i].data.attributes)
              new_achievements[i].save({ new: 0, user_id: app.session.user.data.id });
            }
          }
          if (only_new_achievements.length > 0)
            app.modal.show(NewAchievementModal, { achievements: only_new_achievements });
        }
      }, 1000);
    }
  });

});
