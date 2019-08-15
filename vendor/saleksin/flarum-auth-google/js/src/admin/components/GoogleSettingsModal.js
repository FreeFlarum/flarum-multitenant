import SettingsModal from 'flarum/components/SettingsModal';

export default class GoogleSettingsModal extends SettingsModal {
  className() {
    return 'GoogleSettingsModal Modal--small';
  }

  title() {
    return app.translator.trans('saleksin-auth-google.admin.google_settings.title');
  }

  form() {
    return [
      <div className="Form-group">
        <label>{app.translator.trans('saleksin-auth-google.admin.google_settings.client_id_label')}</label>
        <input className="FormControl" bidi={this.setting('saleksin-auth-google.client_id')}/>
      </div>,

      <div className="Form-group">
        <label>{app.translator.trans('saleksin-auth-google.admin.google_settings.client_secret_label')}</label>
        <input className="FormControl" bidi={this.setting('saleksin-auth-google.client_secret')}/>
      </div>
    ];
  }
}
