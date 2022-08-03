/*
 * This file is part of Stickiest.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import DiscussionControls from 'flarum/forum/utils/DiscussionControls';
import Button from 'flarum/common/components/Button';
import StickiestModal from './components/StickiestModal';

export default function addStickyControl() {
  extend(DiscussionControls, 'moderationControls', function (items, discussion) {
    if (discussion.canSticky() && (discussion.canStickiest() || discussion.canTagSticky())) {
      if (items.has('sticky')) items.remove('sticky');

      items.add(
        'sticky',
        Button.component(
          {
            icon: 'fas fa-thumbtack',
            onclick: () => app.modal.show(StickiestModal, { discussion }),
          },
          app.translator.trans('the-turk-stickiest.forum.discussion_controls.sticky_button')
        )
      );
    }
  });
}
