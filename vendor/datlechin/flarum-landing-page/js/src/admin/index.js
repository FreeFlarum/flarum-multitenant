import app from 'flarum/admin/app';

app.initializers.add('datlechin/flarum-landing-page', () => {
  app.extensionData
    .for('datlechin-landing-page')
    .registerSetting({
      setting: 'datlechin-landing-page.header_html',
      label: app.translator.trans('datlechin-landing-page.admin.settings.header_html_label'),
      help: app.translator.trans('datlechin-landing-page.admin.settings.header_html_help'),
      type: 'textarea',
    })
    .registerSetting({
      setting: 'datlechin-landing-page.body_html',
      label: app.translator.trans('datlechin-landing-page.admin.settings.body_html_label'),
      help: app.translator.trans('datlechin-landing-page.admin.settings.body_html_help'),
      type: 'textarea',
    });
});
