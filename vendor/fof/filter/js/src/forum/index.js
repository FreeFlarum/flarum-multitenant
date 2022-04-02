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

import { override } from 'flarum/common/extend';
import app from 'flarum/forum/app';

import CommentPost from 'flarum/forum/components/CommentPost';

app.initializers.add(
    'fof-filter',
    () => {
        override(CommentPost.prototype, 'flagReason', function (original, flag) {
            if (flag.type() === 'autoMod') {
                const detail = flag.reasonDetail();
                return [app.translator.trans('fof-filter.forum.flagger_name'), detail ? <span className="Post-flagged-detail">{detail}</span> : ''];
            }
            return original(flag);
        });
    },
    -20
);
