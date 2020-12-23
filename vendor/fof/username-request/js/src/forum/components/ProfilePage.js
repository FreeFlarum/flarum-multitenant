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

import UserPage from 'flarum/components/UserPage';
import humanTime from 'flarum/helpers/humanTime';

export default class ProfileConfigurePane extends UserPage {
    oninit(vnode) {
        super.oninit(vnode);
        this.loading = true;

        this.loadUser(m.route.param('username'));
    }

    content() {
        return (
            <table className="NotificationGrid">
                {this.user
                    .usernameHistory()
                    .slice(0)
                    .reverse()
                    .map((username) => {
                        var oldUsername = Object.keys(username)[0];
                        return (
                            <tr>
                                <td>{oldUsername}</td>
                                <td>{humanTime(this.calculateTime(username[oldUsername]))}</td>
                            </tr>
                        );
                    })}
            </table>
        );
    }

    show(user) {
        this.user = user;

        m.redraw();
    }

    calculateTime(time) {
        var d = new Date(0);
        return d.setUTCSeconds(time);
    }
}
