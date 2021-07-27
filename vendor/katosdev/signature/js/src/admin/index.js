import app from 'flarum/app';


app.initializers.add('cxsquared-signature', () => {
    app.extensionData.for('kyrne-signature')
      .registerSetting({
        setting: 'Xengine-signature.maximum_image_width',
        type: 'text',
        label: app.translator.trans('Xengine-signature.admin.settings.maximum_image_width.description')
      })
      .registerSetting({
        setting: 'Xengine-signature.maximum_image_height',
        type: 'text',
        label: app.translator.trans('Xengine-signature.admin.settings.maximum_image_height.description')
      })
      .registerSetting({
        setting: 'Xengine-signature.maximum_image_count',
        type: 'text',
        label: app.translator.trans('Xengine-signature.admin.settings.maximum_image_count.description')
      })
      .registerSetting({
        setting: 'Xengine-signature.maximum_char_limit',
        type: 'text',
        label: app.translator.trans('Xengine-signature.admin.settings.maximum_char_limit.description')
      })
});
