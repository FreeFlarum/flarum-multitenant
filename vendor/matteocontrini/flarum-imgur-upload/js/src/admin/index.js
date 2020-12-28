import app from 'flarum/app';

app.initializers.add('imgur-upload', () => {
  app.extensionData
    .for('matteocontrini-imgur-upload')
    .registerSetting(
      {
        setting: 'imgur-upload.client-id',
        label: 'Imgur Client ID',
        type: 'text'
      }
    )
    .registerSetting(
      {
        setting: 'imgur-upload.hide-markdown-image',
        label: app.translator.trans('imgur-upload.admin.settings.hide-markdown-image'),
        type: 'boolean'
      }
    )
});
