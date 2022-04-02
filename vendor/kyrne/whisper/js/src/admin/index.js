import app from 'flarum/app';

app.initializers.add('kyrne-whisper', () => {

  app.extensionData
    .for('kyrne-whisper')
    .registerSetting({
      setting: 'kyrne-whisper.return_key',
      type: 'bool',
      label: app.translator.trans('kyrne-whisper.admin.settings.return_key')
    })
    .registerPermission({
      icon: 'fas fa-user-lock',
      label: app.translator.trans('kyrne-whisper.admin.permissions.start_label'),
      permission: 'startConversation',
    }, 'start')
});
