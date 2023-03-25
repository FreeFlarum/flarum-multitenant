import app from 'flarum/admin/app';

const translate = (key) => app.translator.trans(`datlechin-flarum-scroll-buttons.admin.${key}`);

app.initializers.add('datlechin/flarum-scroll-buttons', () => {
  app.extensionData
    .for('datlechin-scroll-buttons')
    .registerSetting({
      setting: 'datlechin-scroll-buttons.scroll-to-top-button',
      label: translate('scroll_to_top_label'),
      help: translate('scroll_to_top_help'),
      type: 'boolean',
    })
    .registerSetting({
      setting: 'datlechin-scroll-buttons.scroll-to-bottom-button',
      label: translate('scroll_to_bottom_label'),
      help: translate('scroll_to_bottom_help'),
      type: 'boolean',
    });
});
