/*
 * This file is part of Stickiest.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import { extend } from 'flarum/extend';
import DiscussionControls from 'flarum/utils/DiscussionControls';
import DiscussionPage from 'flarum/components/DiscussionPage';
import Button from 'flarum/components/Button';

export default function addStickiestControl() {
  extend(DiscussionControls, 'moderationControls', function (items, discussion) {
    if (discussion.canStickiest() && (discussion.isSticky() || discussion.isStickiest())) {
      items.add(
        'stickiest',
        Button.component(
          {
            icon: discussion.isStickiest() ? 'fas fa-thumbtack' : app.forum.attribute('stickiest.badge_icon'),
            onclick: this.stickiestAction.bind(discussion),
          },
          app.translator.trans(
            discussion.isStickiest()
              ? 'the-turk-stickiest.forum.discussion_controls.common_sticky_button'
              : 'the-turk-stickiest.forum.discussion_controls.super_sticky_button'
          )
        ),
        -20
      );
    }

    if (discussion.isStickiest()) items.remove('sticky');
  });

  DiscussionControls.stickiestAction = function () {
    this.save({ isStickiest: !this.isStickiest() }).then(() => {
      if (app.current.matches(DiscussionPage)) {
        app.current.get('stream').update();
      }

      m.redraw();
    });
  };
}
