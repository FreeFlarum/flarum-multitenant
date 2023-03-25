import app from 'flarum/admin/app';

const prefix = 'datlechin-more-discussions';
const settingPrefix = prefix + '.';
const localePrefix = prefix + '.admin.settings.';

app.initializers.add('datlechin/flarum-more-discussions', () => {
  app.extensionData
    .for(prefix)
    .registerSetting({
      setting: settingPrefix + 'block_name',
      label: trans('block_name_label'),
      help: trans('block_name_help'),
      type: 'text',
    })
    .registerSetting({
      setting: settingPrefix + 'discussion_limit',
      label: trans('discussion_limit_label'),
      help: trans('discussion_limit_help'),
      type: 'number',
    })
    .registerSetting({
      setting: settingPrefix + 'filter_by',
      label: trans('filter_by_label'),
      help: trans('filter_by_help'),
      type: 'select',
      options: {
        '': trans('filter_dropdown.latest'),
        '-commentCount': trans('filter_dropdown.top'),
        '-createdAt': trans('filter_dropdown.newest'),
        createdAt: trans('filter_dropdown.oldest'),
        '-hotness': trans('filter_dropdown.hot'),
        '-votes': trans('filter_dropdown.votes'),
      },
      default: '',
    });
});

function trans(key: string) {
  return app.translator.trans(localePrefix + key);
}
