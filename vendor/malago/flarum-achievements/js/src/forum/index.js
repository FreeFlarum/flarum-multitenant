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
import Post from 'flarum/components/Post';
import PostUser from 'flarum/components/PostUser';
import ModalManager from 'flarum/components/ModalManager';
import Model from 'flarum/Model';
import User from 'flarum/models/User';
import TextEditor from 'flarum/components/TextEditor';
import PostEdited from 'flarum/components/PostEdited'
import Achievement from '../common/models/Achievement';
import Application from 'flarum/common/Application';
import NewAchievementModal from './modals/NewAchievementModal';
import icon from "flarum/helpers/icon";
import IndexPage from 'flarum/components/IndexPage'
import Page from 'flarum/components/Page'

app.initializers.add('malago-achievements', app => {
  registerModels();

  extend(CommentPost.prototype, 'oncreate', function (x) {
    var html = "";
    var points = 0;

    if (!this.attrs.post.data.attributes.isHidden) {
      this.attrs.post.data.attributes.achievements.forEach(function (item, index) {

        var rectangle = item.rectangle.split(',');
        if (item.image.includes("http")) {
          var style = "background:url(" + item.image + ");\
            background-position:-"+ rectangle[0] + "px -" + rectangle[1] + "px;\
            height:"+ rectangle[2] + "px;\
            width:"+ rectangle[3] + "px;\
            margin: -"+ (rectangle[3] / 4 - 4) + "px;";
          html += "<span class='Badge Achievement' style='" + style + "' data-toggle='tooltip' title='" + item.name + "'></span>";
        } else {
          html += "<span class='Badge Achievement--Icon' data-toggle='tooltip' title='" + item.name + "'><i class='icon " + item.image + "'></i></span>";
        }

        points += item.points;
      });
      if (html !== "") {
        if (points > 0) {
          html += "<span class='Achievement--Points' data-toggle='tooltip' title='" + app.translator.trans(
            "malago-achievements.forum.achievement_points") + "'>" + app.translator.trans(
              "malago-achievements.forum.achievement_points") + ": <span class='Achievement--Points--Number'>" + points + "</span></span>";
        }
        $(this.element).find(".Post-body").after("<div class='Achievements--User'>" + html + "</div>");
        $(".Achievement--Icon").tooltip();
        $(".Achievement").tooltip();
        $(".Achievement--Points").tooltip();
      }
    }
  });

  extend(Application.prototype, 'request', function (promise) {
    if (promise) {
      promise.then(function (data) {
        if (data && data.new_achievements !== undefined && data.new_achievements !== null && data.new_achievements.length > 0)
          app.modal.show(NewAchievementModal, { achievements: data.new_achievements });
      });
    }
  });

  extend(Page.prototype, 'oncreate', function (promise) {
    if (app.session.user !== undefined) {
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
