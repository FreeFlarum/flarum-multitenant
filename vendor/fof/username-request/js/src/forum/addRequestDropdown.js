/*
 *
 *  This file is part of fof/username-request.
 *
 *  Copyright (c) 2019 FriendsOfFlarum.
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 *
 */

import { extend } from 'flarum/extend';
import app from 'flarum/app';
import HeaderSecondary from 'flarum/components/HeaderSecondary';
import RequestsDropdown from './components/RequestsDropdown';

export default function () {
    extend(HeaderSecondary.prototype, 'items', function (items) {
        if (
            (app.forum.data.relationships.username_requests &&
                app.forum.data.relationships.username_requests.data.length &&
                !app.cache.username_requests) ||
            (app.cache.username_requests && app.cache.username_requests.length !== 0)
        ) {
            items.add('UsernameRequests', <RequestsDropdown state={app.usernameRequests} />, 20);
        }
    });
}
