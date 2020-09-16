import ExtAppSettingsModal from './ExtAppSettingsModal';
import CodeMirrorTextarea from '../CodeMirrorTextarea';

export default class EditCustomCssModal extends ExtAppSettingsModal {
  className() {
    return 'EditCustomCssModal Modal--large';
  }

  title() {
    return app.translator.trans('core.admin.edit_css.title');
  }

  form() {
    return [
      <p>
        {app.translator.trans('core.admin.edit_css.customize_text', {
          a: <a href="https://github.com/flarum/core/tree/master/less" target="_blank" />,
        })}
      </p>,
      <div className="Form-group">
        {CodeMirrorTextarea.component({
          value: this.setting('custom_less')(),
          onchange: value => {
            this.setting('custom_less')(value);
            m.redraw();
          },
          mode: 'text/x-less',
        })}
      </div>,
    ];
  }
}
