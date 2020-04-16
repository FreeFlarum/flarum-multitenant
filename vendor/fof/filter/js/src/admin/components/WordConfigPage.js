/*
 *
 *  This file is part of fof/filter.
 *  
 *  Copyright (c) 2020 FriendsOfFlarum..
 *  
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 *  
 */

import Component from "flarum/Component";
import Button from "flarum/components/Button";
import saveSettings from "flarum/utils/saveSettings";
import Switch from 'flarum/components/Switch';
import Alert from "flarum/components/Alert";
import FieldSet from 'flarum/components/FieldSet';

export default class WordConfigPage extends Component {

    init() {
        const settings = app.data.settings;

        this.fields = [
            'words',
            'flaggedEmail',
            'flaggedSubject',
            'count',
            'cooldown'
        ]

        this.switches = [
            'autoMergePosts',
            'emailWhenFlagged',
        ]

        this.values = {};

        this.settingsPrefix = 'fof-filter';

        this.switches.forEach(key => (this.values[key] = m.prop(settings[this.addPrefix(key)] === '1')));

        this.fields.forEach(key => (this.values[key] = m.prop(settings[this.addPrefix(key)])));

        this.values.cooldown = m.prop(this.values.cooldown() || 20)
    }

    view() {
        return (
            <div className="WordConfigPage">
                <div className="container">
                    <form onsubmit={this.onsubmit.bind(this)}>
                        <h2>{app.translator.trans('fof-filter.admin.title')}</h2>
                        {FieldSet.component({
                            label: app.translator.trans('fof-filter.admin.filter_label'),
                            className: 'WordConfigPage-Settings',
                            children: [
                                <div className="WordConfigPage-Settings-input">
                                    <div className="helpText">
                                        {app.translator.trans('fof-filter.admin.help')}
                                    </div>
                                    <textarea className="FormControl" placeholder={app.translator.trans('fof-filter.admin.input.placeholder')} rows="6" value={this.values.words() || null} oninput={m.withAttr('value', this.values.words)}/>
                                </div>
                            ]
                        })}
                        {FieldSet.component({
                            label: app.translator.trans('fof-filter.admin.input.email_label'),
                            className: 'WordConfigPage-Settings',
                            children: [
                                <div className="WordConfigPage-Settings-input">
                                    <label>{app.translator.trans('fof-filter.admin.input.email_subject')}</label>
                                    <input className="FormControl" value={this.values.flaggedSubject() || app.translator.trans('fof-filter.admin.email.default_subject')} oninput={m.withAttr('value', this.values.flaggedSubject)}/>
                                    <label>{app.translator.trans('fof-filter.admin.input.email_body')}</label>
                                    <div className="helpText">
                                        {app.translator.trans('fof-filter.admin.email_help')}
                                    </div>
                                    <textarea className="FormControl" rows="4" value={this.values.flaggedEmail() || app.translator.trans('fof-filter.admin.email.default_text')} oninput={m.withAttr('value', this.values.flaggedEmail)}/>
                                </div>
                            ]
                        })}
                        {Switch.component({
                            state: this.values.autoMergePosts(),
                            children: app.translator.trans('fof-filter.admin.input.switch.merge'),
                            className: 'WordConfigPage-Settings-switch',
                            onchange: this.values.autoMergePosts
                        })}
                        <label>{app.translator.trans('fof-filter.admin.cooldownLabel')}</label>
                        <input className="FormControl" value={this.values.cooldown()} type="number" oninput={m.withAttr('value', this.values.cooldown)}/>
                        <div className="helpText">
                            {app.translator.trans('fof-filter.admin.help2')}
                        </div>
                        {Switch.component({
                            state: this.values.emailWhenFlagged(),
                            children: app.translator.trans('fof-filter.admin.input.switch.email'),
                            className: 'WordConfigPage-Settings-switch',
                            onchange: this.values.emailWhenFlagged
                        })}

                        {Button.component({
                            type: 'submit',
                            className: 'Button Button--primary',
                            children: app.translator.trans('core.admin.email.submit_button'),
                            loading: this.loading
                        })}
                    </form>
                </div>
            </div>
        );
    }

    onsubmit(e) {
        // prevent the usual form submit behaviour
        e.preventDefault();


        // if the page is already saving, do nothing
        if (this.loading) return;

        // prevents multiple savings
        this.loading = true;

        const settings = {};

        this.switches.forEach(key => (settings[this.addPrefix(key)] = this.values[key]()));
        this.fields.forEach(key => (settings[this.addPrefix(key)] = this.values[key]()));
        // remove previous success popup
        app.alerts.dismiss(this.successAlert);

        saveSettings(settings)
            .then(() => {
                // on success, show popup
                app.alerts.show(this.successAlert = new Alert({
                    type: 'success',
                    children: app.translator.trans('core.admin.basics.saved_message')
                }));
            })
            .catch(() => {
            })
            .then(() => {
                // return to the initial state and redraw the page
                this.loading = false;
                m.redraw();
            });
    }

    addPrefix(key) {
        return this.settingsPrefix + '.' + key;
    }
}
