/* This is part of the ianm/synopsis project.

 * Additional modifications (c)2020 Ian Morland
 *
 * Modified code (c)2019 Jordan Schnaidt
 *
 * Original code (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import app from 'flarum/app';

import addSummaryExcerpt from './addSummaryExcerpt';
import addUserPreference from './addUserPreference';

app.initializers.add('ianm-synopsis', () => {
    addSummaryExcerpt();
    addUserPreference();
});
