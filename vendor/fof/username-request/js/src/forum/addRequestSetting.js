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
import Button from 'flarum/components/Button';
import SettingsPage from 'flarum/components/SettingsPage';
import RequestModal from './components/RequestModal';

export default function () {
    extend(SettingsPage.prototype, 'accountItems', function (items) {
        if (app.forum.attribute('canRequestUsername')) {
            items.add(
                'username-request',
                Button.component(
                    {
                        className: 'Button',
                        onclick: () => {
                            app.modal.show(RequestModal);
                        },
                    },
                    app.translator.trans('fof-username-request.forum.settings.username_request_button')
                ),
                8
            );
        }
        if (
            app.forum.attribute('displayNameDriver') === 'nickname' &&
            app.forum.attribute('canRequestNickname') &&
            !this.user.attribute('canEditOwnNickname') &&
            'flarum-nicknames' in flarum.extensions
        ) {
            items.add(
                'nickname-request',
                Button.component(
                    {
                        className: 'Button',
                        onclick: () => {
                            app.modal.show(RequestModal, { nickname: true });
                        },
                    },
                    app.translator.trans('fof-username-request.forum.settings.nickname_request_button')
                ),
                8
            );
        }
    });
}
