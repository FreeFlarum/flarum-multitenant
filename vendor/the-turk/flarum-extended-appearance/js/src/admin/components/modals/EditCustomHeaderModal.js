import ExtAppSettingsModal from './ExtAppSettingsModal';
import CodeMirrorTextarea from '../CodeMirrorTextarea';

export default class EditCustomHeaderModal extends ExtAppSettingsModal {
  className() {
    return 'EditCustomHeaderModal Modal--large';
  }

  title() {
    return app.translator.trans('core.admin.edit_header.title');
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
          value: this.setting('custom_header')(),
          onchange: value => {
            this.setting('custom_header')(value);
            m.redraw();
          },
          mode: 'htmlmixed',
        })}
      </div>,
    ];
  }
}
