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
    extend(SettingsPage.prototype, 'accountItems', (items) => {
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
                    app.translator.trans('fof-username-request.forum.account_label')
                ),
                10
            );
        }
    });
}
