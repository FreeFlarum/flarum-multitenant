import app from 'flarum/admin/app';
import ExtensionPage from 'flarum/admin/components/ExtensionPage';

export default class FilterSettingsPage extends ExtensionPage {
    oninit(vnode) {
        super.oninit(vnode);

        this.setting = this.setting.bind(this);
    }

    content() {
        return (
            <div className="FilterSettingsPage">
                <div className="container">
                    <form>
                        <h2>{app.translator.trans('fof-filter.admin.title')}</h2>
                        <div className="Form-group">
                            <label>{app.translator.trans('fof-filter.admin.filter_label')}</label>
                            <div className="helpText">{app.translator.trans('fof-filter.admin.bad_words_help')}</div>
                            <textarea
                                className="FormControl"
                                bidi={this.setting('fof-filter.words')}
                                placeholder={app.translator.trans('fof-filter.admin.input.placeholder')}
                                rows="6"
                            />
                        </div>
                        <hr />
                        <h2>{app.translator.trans('fof-filter.admin.auto_merge_title')}</h2>
                        {this.buildSettingComponent({
                            type: 'boolean',
                            setting: 'fof-filter.autoMergePosts',
                            label: app.translator.trans('fof-filter.admin.input.switch.merge'),
                        })}
                        {this.buildSettingComponent({
                            type: 'number',
                            setting: 'fof-filter.cooldown',
                            label: app.translator.trans('fof-filter.admin.cooldownLabel'),
                            help: app.translator.trans('fof-filter.admin.help2'),
                            min: 0,
                        })}
                        <hr />
                        <h2>{app.translator.trans('fof-filter.admin.input.email_label')}</h2>
                        {this.buildSettingComponent({
                            type: 'string',
                            setting: 'fof-filter.flaggedSubject',
                            label: app.translator.trans('fof-filter.admin.input.email_subject'),
                            placeholder: app.translator.trans('fof-filter.admin.email.default_subject'),
                        })}
                        <div className="Form-group">
                            <label>{app.translator.trans('fof-filter.admin.input.email_body')}</label>
                            <div className="helpText">{app.translator.trans('fof-filter.admin.email_help')}</div>
                            <textarea
                                className="FormControl"
                                bidi={this.setting('fof-filter.flaggedEmail')}
                                placeholder={app.translator.trans('fof-filter.admin.email.default_text')}
                                rows="4"
                            />
                        </div>
                        {this.buildSettingComponent({
                            type: 'boolean',
                            setting: 'fof-filter.emailWhenFlagged',
                            label: app.translator.trans('fof-filter.admin.input.switch.email'),
                        })}
                        <hr />

                        {this.submitButton()}
                    </form>
                </div>
            </div>
        );
    }
}
