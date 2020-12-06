import SettingsModal from 'flarum/components/SettingsModal';
import Switch from "flarum/components/Switch";
import Select from 'flarum/components/Select';
import app from 'flarum/app';

export default class Login2SeePlusSettingsModal extends SettingsModal
{
    constructor()
    {
        super();
    }

    className()
    {
        return 'Login2SeePlusSettingsModal Modal--small';
    }

    title()
    {
        return app.translator.trans('jslirola-login2seeplus.admin.title');
    }

    form()
    {
        return [
            m('div', {className: 'JSLirolaLogin2SeePlus'}, [
                m('fieldset', {className: 'JSLirolaLogin2SeePlus-post'}, [
                    m('legend', {}, app.translator.trans('jslirola-login2seeplus.admin.post.title')),
                    m('input', {className: 'FormControl JSLirolaLogin2SeePlus-post', type: 'number', min: '-1', bidi: this.setting('jslirola.login2seeplus.post', '100')}),
                    m('div', {className: 'helpText'}, app.translator.trans('jslirola-login2seeplus.admin.post.help')),

                ]),
                m('fieldset', {className: 'JSLirolaLogin2SeePlus-image'}, [
                    m('legend', {}, app.translator.trans('jslirola-login2seeplus.admin.hide')),
                    Switch.component(
                        {
                            state: JSON.parse(this.setting('jslirola.login2seeplus.link', 0)()),
                            onchange: this.setting('jslirola.login2seeplus.link', 1)
                        }, app.translator.trans('jslirola-login2seeplus.admin.link')),
                    Switch.component(
                        {
                            state: JSON.parse(this.setting('jslirola.login2seeplus.image', 0)()),
                            onchange: this.setting('jslirola.login2seeplus.image', 1)
                        }, app.translator.trans('jslirola-login2seeplus.admin.image')),
                    Switch.component(
                        {
                            state: JSON.parse(this.setting('jslirola.login2seeplus.code', 0)()),
                            onchange: this.setting('jslirola.login2seeplus.code', 1)
                        }, app.translator.trans('jslirola-login2seeplus.admin.code')),
                ]),
                m('fieldset', {className: 'JSLirolaLogin2SeePlus-php'}, [
                    m('legend', {}, app.translator.trans('jslirola-login2seeplus.admin.php.title')),
                    Switch.component(
                        {
                            state: JSON.parse(this.setting('jslirola.login2seeplus.php', 0)()),
                            onchange: this.setting('jslirola.login2seeplus.php', 1)
                        }, app.translator.trans('jslirola-login2seeplus.admin.php.label')),
                    m('div', {className: 'helpText'}, app.translator.trans('jslirola-login2seeplus.admin.php.help')),
                ]),
            ]),
        ];
    }
}
