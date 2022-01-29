import { extend } from 'flarum/extend';
import app from 'flarum/app';

app.initializers.add('gpx-preview', () => {
  app.extensionData
    .for('webbinaro-gpx-preview')
    .registerSetting(
      {
        setting: 'gpx-preview.gkey', // This is the key the settings will be saved under in the settings table in the database.
        label: app.translator.trans('gpx-preview.admin.settings.gkey'), // The label to be shown letting the admin know what the setting does.
        type: 'string', // What type of setting this is, valid options are: boolean, text (or any other <input> tag type), and select. 
      },
      30 // Optional: Priority
    )
});
