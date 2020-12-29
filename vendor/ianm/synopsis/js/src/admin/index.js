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

function typeOptions() {
    let opts;
    opts = ['first', 'last'].reduce((o, key) => {
        o[key] = app.translator.trans(`ianm-synopsis.admin.settings.${key}-label`);

        return o;
    }, {});
    return opts;
}

app.initializers.add('ianm-synopsis', () => {
    app.extensionData
        .for('ianm-synopsis')
        .registerSetting({
            label: app.translator.trans('ianm-synopsis.admin.settings.excerpt-label'),
            setting: 'ianm-synopsis.excerpt_length',
            type: 'number',
        })
        .registerSetting({
            label: app.translator.trans('ianm-synopsis.admin.settings.rich-excerpts'),
            setting: 'ianm-synopsis.rich-excerpts',
            type: 'boolean',
        })
        .registerSetting({
            label: app.translator.trans('ianm-synopsis.admin.settings.excerpt-type'),
            setting: 'ianm-synopsis.excerpt-type',
            options: typeOptions(),
            type: 'select',
        });
});
