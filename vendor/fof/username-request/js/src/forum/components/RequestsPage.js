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

import Page from 'flarum/components/Page';

import RequestsList from './RequestsList';

export default class RequestsPage extends Page {
    oninit(vnode) {
        super.oninit(vnode);

        app.history.push('requests');

        this.bodyClass = 'App--requests';
    }

    view() {
        return (
            <div className="RequestsPage">
                <RequestsList state={app.usernameRequests}></RequestsList>
            </div>
        );
    }
}
