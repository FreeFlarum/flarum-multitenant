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

export default function addStickyBadge() {
  extend(Discussion.prototype, 'badges', function (badges) {
    badges.has('sticky') ? badges.remove('sticky') : '';

    if ((this.isSticky() || this.isTagSticky()) && !this.isStickiest()) {
      badges.add(
        this.isTagSticky() ? 'tag-sticky' : 'sticky',
        Badge.component({
          type: 'sticky',
          label: this.isTagSticky()
            ? app.translator.trans('the-turk-stickiest.forum.badge.tag_sticky_tooltip')
            : app.translator.trans('the-turk-stickiest.forum.badge.sticky_tooltip'),
          icon: 'fas fa-thumbtack',
        }),
        10
      );
    }
  });
}
