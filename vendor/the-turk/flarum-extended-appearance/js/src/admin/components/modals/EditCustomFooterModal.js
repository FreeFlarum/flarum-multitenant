import ExtAppSettingsModal from './ExtAppSettingsModal';
import CodeMirrorTextarea from '../CodeMirrorTextarea';

export default class EditCustomFooterModal extends ExtAppSettingsModal {
  className() {
    return 'EditCustomFooterModal Modal--large';
  }

  title() {
    return app.translator.trans('core.admin.edit_footer.title');
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
          value: this.setting('custom_footer')(),
          onchange: value => {
            this.setting('custom_footer')(value);
            m.redraw();
          },
          mode: 'htmlmixed',
        })}
      </div>,
    ];
  }
}
