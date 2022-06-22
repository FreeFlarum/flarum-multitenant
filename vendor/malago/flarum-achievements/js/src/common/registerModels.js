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

import Model from "flarum/Model";
import User from "flarum/models/User";
import Achievement from "./models/Achievement";
import AchievementUser from "./models/AchievementUser";

export default function registerModels() {
  User.prototype.achievements = Model.hasMany('achievements','achievement_user');
  User.prototype.achievement_user = Model.hasMany('achievement_user');

  app.store.models.achievements = Achievement;
  app.store.models.achievement_user = AchievementUser;
}