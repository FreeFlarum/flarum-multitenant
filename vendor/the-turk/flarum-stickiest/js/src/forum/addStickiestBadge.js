/*
 * This file is part of Stickiest.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import app from 'flarum/forum/app';
import { extend } from 'flarum/extend';
import Discussion from 'flarum/models/Discussion';
import Badge from 'flarum/components/Badge';

export default function addStickiestBadge() {
  extend(Discussion.prototype, 'badges', function (badges) {
    if (this.isStickiest()) {
      badges.add(
        this.isTagSticky() ? 'tag-stickiest' : 'stickiest',
        Badge.component({
          type: 'stickiest',
          label: this.isTagSticky()
            ? app.translator.trans('the-turk-stickiest.forum.badge.super_tag_sticky_tooltip')
            : app.translator.trans('the-turk-stickiest.forum.badge.super_sticky_tooltip'),
          icon: app.forum.attribute('stickiest.badge_icon'),
        }),
        10
      );
    }
  });
}
