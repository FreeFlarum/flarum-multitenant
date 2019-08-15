import SettingsModal from 'flarum/components/SettingsModal';
import Select from 'flarum/components/Select';

import StringItem from '@fof/components/admin/settings/items/StringItem';

export default class CookieConsentSettingsModal extends SettingsModal {
    className() {
        return 'CookieConsentSettingsModal Modal--medium';
    }

    title() {
        return app.translator.trans('reflar-cookie-consent.admin.settings.title');
    }

    form() {
        return [
            <div className="Form-group">
                <h2>{app.translator.trans('reflar-cookie-consent.admin.settings.configuration_title')}</h2>
                <div className="Form-group">
                    <label>{app.translator.trans('reflar-cookie-consent.admin.settings.consentText')}</label>
                    <textarea required className="FormControl" bidi={this.setting('reflar-cookie-consent.consentText')} />
                </div>
                <StringItem key="reflar-cookie-consent.buttonText">
                    {app.translator.trans('reflar-cookie-consent.admin.settings.buttonText')}
                </StringItem>

                <h3>{app.translator.trans('reflar-cookie-consent.admin.settings.configuration_button_title')}</h3>
                <div className="Form-section">
                    <StringItem key="reflar-cookie-consent.learnMoreLinkText" required>
                        {app.translator.trans('reflar-cookie-consent.admin.settings.learnMoreLinkText')}
                    </StringItem>
                    <StringItem key="reflar-cookie-consent.learnMoreLinkUrl">
                        {app.translator.trans('reflar-cookie-consent.admin.settings.learnMoreLinkUrl')}
                    </StringItem>
                </div>

                <h2>{app.translator.trans('reflar-cookie-consent.admin.settings.theme_title')}</h2>

                <div className="Form-group">
                    <label>{app.translator.trans('reflar-cookie-consent.admin.settings.ccTheme')}</label>
                    {Select.component({
                        options: {
                            blocky: app.translator.trans('reflar-cookie-consent.admin.settings.themes.blocky'),
                            edgeless: app.translator.trans('reflar-cookie-consent.admin.settings.themes.edgeless'),
                            classic: app.translator.trans('reflar-cookie-consent.admin.settings.themes.classic'),
                            custom: app.translator.trans('reflar-cookie-consent.admin.settings.themes.custom'),
                            no_css: app.translator.trans('reflar-cookie-consent.admin.settings.themes.no_css'),
                        },
                        value: this.setting('reflar-cookie-consent.ccTheme')(),
                        onchange: this.setting('reflar-cookie-consent.ccTheme'),
                    })}
                </div>

                <h3>{app.translator.trans('reflar-cookie-consent.admin.settings.theme_popup_title')}</h3>

                <div className="Form-section">
                    <StringItem key="reflar-cookie-consent.backgroundColor">
                        {app.translator.trans('reflar-cookie-consent.admin.settings.backgroundColor')}
                    </StringItem>
                    <StringItem key="reflar-cookie-consent.textColor">
                        {app.translator.trans('reflar-cookie-consent.admin.settings.textColor')}
                    </StringItem>
                </div>

                <h3>{app.translator.trans('reflar-cookie-consent.admin.settings.theme_dismiss_title')}</h3>
                <div className="Form-section">
                    <StringItem key="reflar-cookie-consent.buttonBackgroundColor">
                        {app.translator.trans('reflar-cookie-consent.admin.settings.buttonBackgroundColor')}
                    </StringItem>
                    <StringItem key="reflar-cookie-consent.buttonTextColor">
                        {app.translator.trans('reflar-cookie-consent.admin.settings.buttonTextColor')}
                    </StringItem>
                </div>
            </div>,
        ];
    }
}
