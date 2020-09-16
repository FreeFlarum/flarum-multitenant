import SettingsModal from 'flarum/components/SettingsModal';
import Button from 'flarum/components/Button';
import saveSettings from 'flarum/utils/saveSettings';

export default class ExtAppSettingsModal extends SettingsModal {
  init() {
    super.init();

    this.reloadAfterSave = true;
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form">
          {this.form()}
          <p class="extApp-infoText">
            {app.translator.trans('the-turk-extended-appearance.admin.reloadInfo')}
          </p>
          {this.submitButton()}
        </div>
      </div>
    );
  }

  submitButton() {
    return [
      <div className="Form-group">
        {Button.component({
          type: 'button',
          children: app.translator.trans('core.admin.settings.submit_button'),
          className: 'Button Button--primary',
          loading: !this.reloadAfterSave && this.loading,
          disabled: !this.changed(),
          onclick: () => {
            this.reloadAfterSave = false;
            this.$('form').submit();
          }
        })}
        {Button.component({
          type: 'submit',
          children: app.translator.trans('the-turk-extended-appearance.admin.saveAndReload'),
          className: 'Button Button--primary willReload',
          loading: this.reloadAfterSave && this.loading,
          disabled: !this.changed()
        })}
      </div>
    ];
  }

  onsubmit(e) {
    e.preventDefault();

    this.loading = true;

    saveSettings(this.dirty()).then(this.onsaved.bind(this), this.loaded.bind(this));
  }

  onsaved() {
    if (!this.reloadAfterSave) {
      this.loading = false;
      this.reloadAfterSave = true;

      return m.redraw();
    }

    window.location.reload();
  }
}
