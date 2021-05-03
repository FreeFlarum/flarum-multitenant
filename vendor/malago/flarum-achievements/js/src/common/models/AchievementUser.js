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

import Model from 'flarum/Model';

export default class AchievementUser extends Model {}

Object.assign(AchievementUser.prototype, {
  achievement_id: Model.attribute("achievement_id"),
  user_id: Model.attribute('user_id'),
  new: Model.attribute('new')
});