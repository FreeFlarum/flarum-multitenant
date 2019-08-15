import app from 'flarum/app';
import SettingsModal from 'flarum/components/SettingsModal';
import Select from 'flarum/components/Select';

const settingsPrefix = 'migratetoflarum-canonical.';
const translationPrefix = 'migratetoflarum-canonical.admin.settings.';

const STEPS = [
    'admin_on_canonical',
    'enable_temporary',
    'enable_permanent',
];

export default class RedirectsSettingsModal extends SettingsModal {
    title() {
        return app.translator.trans(translationPrefix + 'title');
    }

    form() {
        let step = -1;

        const baseUrl = app.forum.attribute('baseUrl');

        if (parseInt(app.data.settings[settingsPrefix + 'status']) === 301) {
            step = 2;
        } else if (parseInt(app.data.settings[settingsPrefix + 'status']) === 302) {
            step = 1;
        } else if (window.location.href.indexOf(baseUrl) === 0) {
            step = 0;
        }

        return [
            <h4>{app.translator.trans(translationPrefix + 'step.how_to')}</h4>,
            <ul>
                <li>
                    <span className="mtf-canonical-step mtf-canonical-step--done">{step >= 0 ? '✓' : '?'}</span>
                    {' ' + app.translator.trans(translationPrefix + 'step.check_config_url', {
                        url: baseUrl,
                    }).join('')}
                </li>
                {STEPS.map((translation, index) => <li>
                    {step >= index ? <span className="mtf-canonical-step mtf-canonical-step--done">✓</span> :
                        <span className="mtf-canonical-step">×</span>}
                    {' ' + app.translator.trans(translationPrefix + 'step.' + translation)}
                </li>)}
            </ul>,
            <h4>{app.translator.trans(translationPrefix + 'step.suggestions')}</h4>,
            <ul>
                <li>{app.translator.trans(translationPrefix + 'step.use_https')}</li>
                <li>{app.translator.trans(translationPrefix + 'step.use_hsts')}</li>
            </ul>,
            <div className="Form-group">
                <label>{app.translator.trans(translationPrefix + 'field.status')}</label>
                {this.setting(settingsPrefix + 'status')() < 301 && step < 0 ? app.translator.trans(translationPrefix + 'field.wrong_url') : Select.component({
                    options: {
                        0: app.translator.trans(translationPrefix + 'option.disabled'),
                        302: app.translator.trans(translationPrefix + 'option.302'),
                        301: app.translator.trans(translationPrefix + 'option.301'),
                    },
                    value: this.setting(settingsPrefix + 'status')() || 0,
                    onchange: this.setting(settingsPrefix + 'status'),
                })}
            </div>,
        ];
    }
}
