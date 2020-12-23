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

import User from 'flarum/models/User';
import Model from 'flarum/Model';
import UsernameRequest from './models/UsernameRequest';
import addRequestSetting from './addRequestSetting';
import RequestsPage from './components/RequestsPage';
import addRequestDropdown from './addRequestDropdown';
import checkForApproval from './checkForApproval';
import ProfilePage from './components/ProfilePage';
import addProfilePage from './addProfilePage';
import RequestsListState from './states/RequestsListState';

app.initializers.add('fof-username-request', () => {
    app.store.models['username-requests'] = UsernameRequest;
    User.prototype.username_requests = Model.hasOne('username_requests');
    User.prototype.usernameHistory = Model.attribute('usernameHistory');

    app.routes.username_requests = { path: '/username-requests', component: RequestsPage };
    app.routes.username_history = { path: '/u/:username/history', component: ProfilePage };

    app.usernameRequests = new RequestsListState(app);

    addRequestSetting();
    addRequestDropdown();
    checkForApproval();
    addProfilePage();
});
