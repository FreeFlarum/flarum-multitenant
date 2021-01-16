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

import { extend } from 'flarum/extend';
import SettingsPage from 'flarum/components/SettingsPage';
import FieldSet from 'flarum/components/FieldSet';
import ItemList from 'flarum/utils/ItemList';
import Switch from 'flarum/components/Switch';
import Stream from 'flarum/utils/Stream';

export default function () {
    extend(SettingsPage.prototype, 'oninit', function () {
        this.showSynopsisExcerpts = Stream(this.user.preferences().showSynopsisExcerpts);
        this.showSynopsisExcerptsOnMobile = Stream(this.user.preferences().showSynopsisExcerptsOnMobile);
    });

    extend(SettingsPage.prototype, 'settingsItems', function (items) {
        items.add(
            'synopsis',
            FieldSet.component(
                {
                    label: app.translator.trans('ianm-synopsis.forum.user.settings.summaries-heading'),
                    className: 'Settings-Synopsis',
                },
                this.summariesItems().toArray()
            )
        );
    });

    SettingsPage.prototype['summariesItems'] = function () {
        const items = new ItemList();

        items.add(
            'synopsis-excerpts',
            Switch.component(
                {
                    state: this.user.preferences().showSynopsisExcerpts,
                    onchange: (value) => {
                        this.showSynopsisExcerptsLoading = true;

                        this.user.savePreferences({ showSynopsisExcerpts: value }).then(() => {
                            this.showSynopsisExcerptsLoading = false;
                            m.redraw();
                        });
                    },
                    loading: this.showSynopsisExcerptsLoading,
                },
                app.translator.trans('ianm-synopsis.forum.user.settings.show-summaries')
            )
        );

        if (this.user.preferences().showSynopsisExcerpts) {
            items.add(
                'synopsis-excerpts-mobile',
                Switch.component(
                    {
                        state: this.user.preferences().showSynopsisExcerptsOnMobile,
                        disabled: !this.user.preferences().showSynopsisExcerpts,
                        onchange: (value) => {
                            this.showSynopsisExcerptsOnMobileLoading = true;

                            this.user.savePreferences({ showSynopsisExcerptsOnMobile: value }).then(() => {
                                this.showSynopsisExcerptsOnMobileLoading = false;
                                window.location.reload();
                            });
                        },
                        loading: this.showSynopsisExcerptsOnMobileLoading,
                    },
                    app.translator.trans('ianm-synopsis.forum.user.settings.show-summaries-mobile')
                )
            );
        }

        return items;
    };
}
