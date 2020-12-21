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
import WordConfigPage from './components/WordConfigPage';

app.initializers.add('fof-filter', (app) => {
    app.extensionData.for('fof-filter').registerPage(WordConfigPage);
});
