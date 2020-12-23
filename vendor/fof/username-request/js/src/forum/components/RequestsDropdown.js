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

import NotificationsDropdown from 'flarum/components/NotificationsDropdown';

import RequestsList from './RequestsList';

export default class RequestsDropdown extends NotificationsDropdown {
    static initAttrs(attrs) {
        attrs.label = attrs.label || app.translator.trans('fof-username-request.forum.dropdown.tooltip');
        attrs.icon = attrs.icon || 'fas fa-user-edit';

        super.initAttrs(attrs);
    }

    getMenu() {
        return (
            <div className={'Dropdown-menu ' + this.attrs.menuClassName} onclick={this.menuClick.bind(this)}>
                {this.showing ? RequestsList.component({ state: app.usernameRequests }) : ''}
            </div>
        );
    }

    goToRoute() {
        m.route.set(app.route('username_requests'));
    }

    getUnreadCount() {
        if (app.cache.username_requests) {
            return app.cache.username_requests.length;
        }
        return app.forum.data.relationships.username_requests.data.length;
    }

    getNewCount() {
        if (app.cache.username_requests) {
            return app.cache.username_requests.length;
        }
        return app.forum.data.relationships.username_requests.data.length;
    }
}
