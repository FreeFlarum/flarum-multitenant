import app from 'flarum/admin/app';
import icon from 'flarum/common/helpers/icon';

app.initializers.add('blomstra/fontawesome', () => {
  app.extensionData
    .for('blomstra-fontawesome')
    .registerSetting({
      type: 'select',
      setting: 'blomstra-fontawesome.type',
      label: app.translator.trans('blomstra-fontawesome.admin.settings.type'),
      options: {
        free: 'Font Awesome 6 Free',
        // pro: 'Font Awesome 6 Pro',
        kit: 'Font Awesome 6 Kit (Free/Pro)',
      },
    })
    .registerSetting({
      type: 'text',
      setting: 'blomstra-fontawesome.kitUrl',
      label: app.translator.trans('blomstra-fontawesome.admin.settings.kit_url'),
      help: app.translator.trans('blomstra-fontawesome.admin.settings.kit_url_help'),
    })
    .registerSetting(() => {
      return (
        <fieldset class="Form-group BlomstraFontAwesome-testPanel">
          <legend>{app.translator.trans('blomstra-fontawesome.admin.settings.test.heading')}</legend>
          <p>{app.translator.trans('blomstra-fontawesome.admin.settings.test.desc')}</p>

          {Object.entries({
            fa5_compat: 'fab fa-font-awesome-flag',
            fa6_free: 'fas fa-person-rays',
            fa6_pro: 'fa-duotone fa-arrow-up-from-ground-water',
          }).map(([key, i]) => (
            <div class="BlomstraFontAwesome-testPanelEntry">
              {icon(`${i} fa-2x fa-fw`)}
              <span>{app.translator.trans(`blomstra-fontawesome.admin.settings.test.${key}`)}</span>
            </div>
          ))}
        </fieldset>
      );
    });
});
