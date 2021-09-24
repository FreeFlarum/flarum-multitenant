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

import app from 'flarum/admin/app';
import FilterSettingsPage from './components/FilterSettingsPage';

app.initializers.add('fof-filter', (app) => {
    app.extensionData
        .for('fof-filter')
        .registerPage(FilterSettingsPage)
        .registerPermission(
            {
                icon: 'fas fa-user-ninja',
                label: app.translator.trans('fof-filter.admin.permission.bypass_filter_label'),
                permission: 'discussion.bypassFoFFilter',
            },
            'reply'
        );
});
