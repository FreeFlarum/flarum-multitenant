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

export default function addTagStickyControl() {
  extend(DiscussionControls, 'moderationControls', function (items, discussion) {
    if (discussion.canTagSticky() && (discussion.isSticky() || discussion.isStickiest())) {
      items.add(
        'tag-sticky',
        Button.component(
          {
            icon: 'fas fa-thumbtack',
            onclick: this.tagStickyAction.bind(discussion),
          },
          discussion.isTagSticky()
            ? app.translator.trans('the-turk-stickiest.forum.discussion_controls.all_sticky_button')
            : app.translator.trans('the-turk-stickiest.forum.discussion_controls.tag_sticky_button')
        ),
        -10
      );
    }
  });

  DiscussionControls.tagStickyAction = function () {
    this.save({ isTagSticky: !this.isTagSticky() }).then(() => {
      if (app.current.matches(DiscussionPage)) {
        app.current.get('stream').update();
      }

      m.redraw();
    });
  };
}
