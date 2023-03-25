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
import mixin from 'flarum/utils/mixin';

export default class Achievement extends Model {}
 
Object.assign(Achievement.prototype, {
  id: Model.attribute("id"),
  name: Model.attribute("name"),
  description: Model.attribute('description'),
  computation: Model.attribute('computation'),
  points: Model.attribute('points'),
  rectangle: Model.attribute('rectangle'),
  image: Model.attribute('image'),
  new: Model.attribute('new'),
  active: Model.attribute('active'),
  hidden: Model.attribute('hidden'),
});