import app from 'flarum/admin/app';
import Switch from 'flarum/common/components/Switch';
import ExtensionPage from 'flarum/admin/components/ExtensionPage';

const settingsPrefix = 'catch-the-fish.';
const translationPrefix = 'clarkwinkelmann-catch-the-fish.admin.settings.';

export default function (this: ExtensionPage) {
    return [
        m('.Form-group', [
            m('label', app.translator.trans(translationPrefix + 'discussion-age')),
            m('input.FormControl', {
                type: 'number',
                min: 1,
                step: 1,
                bidi: this.setting(settingsPrefix + 'discussionAgeDays', '14'),
            }),
        ]),
        m('.Form-group', [
            m('label', app.translator.trans(translationPrefix + 'post-age')),
            m('input.FormControl', {
                type: 'number',
                min: 1,
                step: 1,
                bidi: this.setting(settingsPrefix + 'postAgeDays', '14'),
            }),
        ]),
        m('.Form-group', [
            m('label', app.translator.trans(translationPrefix + 'user-age')),
            m('input.FormControl', {
                type: 'number',
                min: 1,
                step: 1,
                bidi: this.setting(settingsPrefix + 'userAgeDays', '14'),
            }),
        ]),
        m('.Form-group', [
            m('label', app.translator.trans(translationPrefix + 'time-to-place')),
            m('input.FormControl', {
                type: 'number',
                min: 1,
                step: 1,
                bidi: this.setting(settingsPrefix + 'autoPlacedAfterMinutes', '5'),
            }),
        ]),
        m('.Form-group', [
            Switch.component({
                state: this.setting(settingsPrefix + 'alertRound', '1')() === '1',
                onchange: (value: string) => {
                    this.setting(settingsPrefix + 'alertRound')(value ? '1' : '0');
                },
            }, app.translator.trans(translationPrefix + 'alert-round')),
        ]),
        m('.Form-group', [
            Switch.component({
                state: this.setting(settingsPrefix + 'animateFlip', '1')() === '1',
                onchange: (value: string) => {
                    this.setting(settingsPrefix + 'animateFlip')(value ? '1' : '0');
                },
            }, app.translator.trans(translationPrefix + 'animate-flip')),
        ]),
    ];
}
