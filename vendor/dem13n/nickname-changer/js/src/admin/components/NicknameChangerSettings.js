import Modal from 'flarum/components/Modal';
import Switch from 'flarum/components/Switch';
import Button from 'flarum/components/Button';
import saveSettings from 'flarum/utils/saveSettings';

export default class NicknameChangerSettings extends Modal {

  init() {
    super.init();
    this.NicknameChange = m.prop(app.data.settings.dem13n_nickname_change === '1');
    this.regex = m.prop(app.data.settings.dem13n_nickname_regex);
    this.min = m.prop(app.data.settings.dem13n_nickname_min_char);
    this.max = m.prop(app.data.settings.dem13n_nickname_max_char);
    this.unique = m.prop(app.data.settings.dem13n_nickname_unique === '1');
  }

  className() {
    return 'NicknameChangerSettingsModal Modal--small';
  }

  title() {
    return app.translator.trans('dem13n.admin.nickname.settings_modal_title');
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form">
          <div className="Form-group">
            <Switch
              state={this.NicknameChange()}
              onchange={this.NicknameChange}>
              {app.translator.trans('dem13n.admin.nickname.allow_nickname_change')}
            </Switch>
          </div>
          <div className="Form-group">
            <Switch
              state={this.unique()}
              onchange={this.unique}>
              {app.translator.trans('dem13n.admin.nickname.allow_nickname_unique')}
            </Switch>
          </div>
          <div className="Form-group">
            <label>{app.translator.trans('dem13n.admin.nickname.regex')}</label>
            <input className="FormControl" bidi={this.regex}/>
          </div>
          <div className="Form-group">
            <label>{app.translator.trans('dem13n.admin.nickname.min_char')}</label>
            <input type="number" min="1" max="99" className="FormControl" bidi={this.min}/>
          </div>
          <div className="Form-group">
            <label>{app.translator.trans('dem13n.admin.nickname.max_char')}</label>
            <input type="number" min="2" max="100" className="FormControl" bidi={this.max}/>
          </div>
          <div className="Form-group">
            <Button
              className='Button Button--primary'
              type='submit'
              loading={this.loading}>
              {app.translator.trans('dem13n.admin.nickname.submit_button')}
            </Button>
          </div>
        </div>
      </div>
    );
  }

  onsubmit(e) {
    e.preventDefault();
    if (this.loading || this.min() > this.max()) return;
    this.loading = true;
    saveSettings({
      dem13n_nickname_change: this.NicknameChange(),
      dem13n_nickname_unique: this.unique(),
      dem13n_nickname_regex: this.regex(),
      dem13n_nickname_min_char: this.min(),
      dem13n_nickname_max_char: this.max()
    }).then(() => window.location.reload());
  }
}