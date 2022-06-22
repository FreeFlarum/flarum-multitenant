import app from 'flarum/admin/app';

app.initializers.add('ianm-level-ranks', () => {
  app.extensionData.for('ianm-level-ranks').registerSetting({
    label: app.translator.trans('ianm-level-ranks.admin.settings.levelText'),
    setting: 'ianm-level-ranks.pointsText',
    placeholder: app.translator.trans('ianm-level-ranks.lib.defaults.level'),
    type: 'text',
  });
});
