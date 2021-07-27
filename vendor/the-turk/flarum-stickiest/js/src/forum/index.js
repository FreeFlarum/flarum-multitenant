/*
 * This file is part of Stickiest.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import { extend } from 'flarum/common/extend';

import app from 'flarum/app';
import Model from 'flarum/Model';
import Discussion from 'flarum/models/Discussion';

import DiscussionListItem from 'flarum/common/components/DiscussionListItem';
import DiscussionSuperStickiedPost from './components/DiscussionSuperStickiedPost';
import addStickyBadge from './addStickyBadge';
import addStickiestBadge from './addStickiestBadge';
import addStickiestControl from './addStickiestControl';
import addTagStickyControl from './addTagStickyControl';

app.initializers.add(
  'the-turk-stickiest',
  () => {
    app.postComponents.discussionSuperStickied = DiscussionSuperStickiedPost;

    Discussion.prototype.isStickiest = Model.attribute('isStickiest');
    Discussion.prototype.isTagSticky = Model.attribute('isTagSticky');
    Discussion.prototype.canStickiest = Model.attribute('canStickiest');
    Discussion.prototype.canTagSticky = Model.attribute('canTagSticky');

    addStickyBadge();
    addStickiestBadge();
    addStickiestControl();
    addTagStickyControl();

    extend(DiscussionListItem.prototype, 'oncreate', (out, vnode) => {
      const $discussionItem = $(vnode.dom).find('.DiscussionListItem-content');

      // select sticky discussions
      const $sticky = $discussionItem.find('.item-sticky');
      const $tagSticky = $discussionItem.find('.item-tag-sticky');
      const $stickiest = $discussionItem.find('.item-stickiest');

      if ($sticky.length) {
        $sticky.closest('.DiscussionListItem').addClass('Stickiest-stickyItem');
      }

      if ($tagSticky.length) {
        $tagSticky.closest('.DiscussionListItem').addClass('Stickiest-tagStickyItem');
      }

      if ($stickiest.length) {
        $stickiest.closest('.DiscussionListItem').addClass('Stickiest-stickiestItem');
      }
    });
  },
  -1
);
