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

import app from 'flarum/app';
import { extend } from 'flarum/extend';
import AdminNav from 'flarum/components/AdminNav';
import AdminLinkButton from 'flarum/components/AdminLinkButton';

import WordConfigPage from './components/WordConfigPage';

export default function () {
    app.routes['fof-filter'] = { path: '/filter', component: WordConfigPage };

    app.extensionSettings['fof-filter'] = () => m.route.set(app.route('fof-filter'));

    extend(AdminNav.prototype, 'items', (items) => {
        items.add(
            'fof-filter',
            AdminLinkButton.component(
                {
                    href: app.route('fof-filter'),
                    icon: 'fas fa-filter',
                    description: app.translator.trans('fof-filter.admin.nav.desc'),
                },
                app.translator.trans('fof-filter.admin.nav.text')
            )
        );
    });
}
