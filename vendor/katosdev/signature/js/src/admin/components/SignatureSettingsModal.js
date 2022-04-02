import SettingsModal from 'flarum/components/SettingsModal';

export default class SignatureSettingsModal extends SettingsModal {
    className() {
        return 'SignatureSettingsModal Modal--medium';
    }

    title() {
        return app.translator.trans('signature.admin.settings.title');
    }

    form() {
        return [
            <div className="Form-group">
                <label>{app.translator.trans('signature.admin.settings.maximum_image_width.description')}</label>
                <input
                    className="FormControl"
                    placeholder={app.translator.trans('signature.admin.settings.maximum_image_width.placeholder')}
                    bidi={this.setting('signature.maximum_image_width')}
                />
            </div>,
            <div className="Form-group">
                <label>{app.translator.trans('signature.admin.settings.maximum_image_height.description')}</label>
                <input
                    className="FormControl"
                    placeholder={app.translator.trans('signature.admin.settings.maximum_image_height.placeholder')}
                    bidi={this.setting('signature.maximum_image_height')}
                />
            </div>,
            <div className="Form-group">
                <label>{app.translator.trans('signature.admin.settings.maximum_image_count.description')}</label>
                <input
                    className="FormControl"
                    placeholder={app.translator.trans('signature.admin.settings.maximum_image_count.placeholder')}
                    bidi={this.setting('signature.maximum_image_count')}
                />
            </div>,
            <div className="Form-group">
                <label>{app.translator.trans('signature.admin.settings.maximum_char_limit.description')}</label>
                <input
                    className="FormControl"
                    placeholder={app.translator.trans('signature.admin.settings.maximum_char_limit.placeholder')}
                    bidi={this.setting('signature.maximum_char_limit')}
                />
            </div>,
        ];
    }
}
