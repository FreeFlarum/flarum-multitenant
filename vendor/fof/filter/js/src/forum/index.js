/*
 *
 *  This file is part of fof/filter.
 *
 *  Copyright (c) 2020 FriendsOfFlarum..
 *
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 *
 */

import { extend, override } from 'flarum/extend';
import app from 'flarum/app';

import PostControls from 'flarum/utils/PostControls';
import CommentPost from 'flarum/components/CommentPost';

app.initializers.add('fof-filter', () => {

  override(CommentPost.prototype, 'flagReason', function(original, flag) {
    if (flag.type() === app.translator.trans('fof-filter.forum.flagger_name')[0]) {
      return app.translator.trans('fof-filter.forum.flagger_name');
    }
    return original(flag);
  });
}, -20);