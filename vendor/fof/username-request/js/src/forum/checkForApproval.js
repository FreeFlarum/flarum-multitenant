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

import app from 'flarum/app';
import ResultsModal from './components/ResultsModal';

export default function () {
    return new Promise(() => {
        setTimeout(() => {
            const approvedNickname = app.session.user.lastNicknameRequest() && app.session.user.lastNicknameRequest().status() !== 'Sent';
            const approvedUsername = app.session.user.lastUsernameRequest() && app.session.user.lastUsernameRequest().status() !== 'Sent'
            if (app.session.user && (approvedNickname || approvedUsername)
            ) {
                app.modal.show(ResultsModal, {nickname: approvedNickname});
            }
        }, 1000);
    });
}
