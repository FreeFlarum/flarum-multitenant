import app from 'flarum/admin/app';

const translate = (key) => app.translator.trans(`datlechin-flarum-scroll-buttons.admin.${key}`);

app.initializers.add('datlechin/flarum-scroll-buttons', () => {
  app.extensionData
    .for('datlechin-scroll-buttons')
    .registerSetting({
      setting: 'datlechin-scroll-buttons.scroll-to-top-button',
      label: translate('scroll_to_top.label'),
      help: translate('scroll_to_top.help'),
      type: 'boolean',
    })
    .registerSetting({
      setting: 'datlechin-scroll-buttons.scroll-to-top-icon',
      label: translate('scroll_to_top.icon.label'),
      help: translate('scroll_to_top.icon.help'),
      type: 'text',
      placeholder: 'fas fa-angle-double-up',
    })
    .registerSetting({
      setting: 'datlechin-scroll-buttons.scroll-to-bottom-button',
      label: translate('scroll_to_bottom.label'),
      help: translate('scroll_to_bottom.help'),
      type: 'boolean',
    })
    .registerSetting({
      setting: 'datlechin-scroll-buttons.scroll-to-bottom-icon',
      label: translate('scroll_to_bottom.icon.label'),
      help: translate('scroll_to_bottom.icon.help'),
      type: 'text',
      placeholder: 'fas fa-angle-double-down',
    });
});
