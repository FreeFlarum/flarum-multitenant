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

/* global m */

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

        const disabled = this.setting(settingsPrefix + 'status')() < 301 && step < 0;

        return [
            m('h4', app.translator.trans(translationPrefix + 'step.how_to')),
            m('ul', [
                m('li', [
                    m('span.mtf-canonical-step.mtf-canonical-step--done', step >= 0 ? '✓' : '?'),
                    ' ',
                    app.translator.trans(translationPrefix + 'step.check_config_url', {
                        url: baseUrl,
                    }),
                ]),
                STEPS.map((translation, index) => m('li', [
                    m('span.mtf-canonical-step', {
                        className: step >= index ? 'mtf-canonical-step--done' : '',
                    }, step >= index ? '✓' : '×'),
                    ' ',
                    app.translator.trans(translationPrefix + 'step.' + translation),
                ])),
            ]),
            m('h4', app.translator.trans(translationPrefix + 'step.suggestions')),
            m('ul', [
                m('li', app.translator.trans(translationPrefix + 'step.use_https')),
                m('li', app.translator.trans(translationPrefix + 'step.use_hsts')),
            ]),
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'field.status')),
                Select.component({
                    options: {
                        0: app.translator.trans(translationPrefix + 'option.disabled'),
                        302: app.translator.trans(translationPrefix + 'option.302'),
                        301: app.translator.trans(translationPrefix + 'option.301'),
                    },
                    value: this.setting(settingsPrefix + 'status')() || 0,
                    onchange: this.setting(settingsPrefix + 'status'),
                    disabled,
                }),
                disabled ? m('.helpText', app.translator.trans(translationPrefix + 'field.wrong_url')) : null,
            ]),
        ];
    }
}
