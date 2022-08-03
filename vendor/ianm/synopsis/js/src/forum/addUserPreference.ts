import type * as Mithril from 'mithril';
import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import SettingsPage from 'flarum/forum/components/SettingsPage';
import FieldSet from 'flarum/common/components/FieldSet';
import ItemList from 'flarum/common/utils/ItemList';
import Switch from 'flarum/common/components/Switch';
import Stream from 'flarum/common/utils/Stream';

export default function () {
  extend(SettingsPage.prototype, 'oninit', function () {
    this.showSynopsisExcerpts = Stream(this.user.preferences().showSynopsisExcerpts);
    this.showSynopsisExcerptsOnMobile = Stream(this.user.preferences().showSynopsisExcerptsOnMobile);
  });

  extend(SettingsPage.prototype, 'settingsItems', function (items: ItemList) {
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
