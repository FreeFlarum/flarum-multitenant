import {Vnode} from 'mithril';
import app from 'flarum/admin/app';
import Button from 'flarum/common/components/Button';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import Select from 'flarum/common/components/Select';
import Switch from 'flarum/common/components/Switch';
import ExtensionPage from 'flarum/admin/components/ExtensionPage';

const settingsPrefix = 'catch-the-fish.';
const translationPrefix = 'clarkwinkelmann-catch-the-fish.admin.settings.';

// @ts-ignore missing view type-hint
export default class SettingsPage extends ExtensionPage {
    allTagsLoaded: boolean = false
    loadingAllTags: boolean = false
    selectedTag: string = '0'

    oninit(vnode: Vnode) {
        super.oninit(vnode);

        // Only attempt to load all tags if the Tags extension is actually enabled, otherwise the API endpoint would error
        if (flarum.extensions['flarum-tags']) {
            this.loadAllTags();
        }
    }

    loadAllTags() {
        this.loadingAllTags = true;

        // Only the primary tags are loaded by default, so we need to make the same request that
        // the tags page settings does to load the full list
        app.store.find('tags', {include: 'parent,lastPostedDiscussion'}).then(() => {
            this.loadingAllTags = false;
            this.allTagsLoaded = true;

            m.redraw();
        });
    }

    content(): any {
        return m('.ExtensionPage-settings', m('.container', [
            m('h3', app.translator.trans(translationPrefix + 'user')),
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
                m('label', app.translator.trans(translationPrefix + 'user-probability')),
                m('input.FormControl.CTFFormControl--range', {
                    type: 'number',
                    min: 0,
                    max: 100,
                    step: 1,
                    bidi: this.setting(settingsPrefix + 'userProbability', '33'),
                }),
                m('input', {
                    type: 'range',
                    min: 0,
                    max: 100,
                    step: 1,
                    bidi: this.setting(settingsPrefix + 'userProbability', '33'),
                }),
            ]),
            m('h3', app.translator.trans(translationPrefix + 'discussion')),
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
                m('label', app.translator.trans(translationPrefix + 'discussion-tags')),
                m('p.helpText', app.translator.trans(translationPrefix + 'discussion-tags-help')),
                this.tagSettings(),
            ]),
            m('h3', app.translator.trans(translationPrefix + 'post')),
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
                m('label', app.translator.trans(translationPrefix + 'post-probability')),
                m('input.FormControl.CTFFormControl--range', {
                    type: 'number',
                    min: 0,
                    max: 100,
                    step: 1,
                    bidi: this.setting(settingsPrefix + 'postProbability', '50'),
                }),
                m('input', {
                    type: 'range',
                    min: 0,
                    max: 100,
                    step: 1,
                    bidi: this.setting(settingsPrefix + 'postProbability', '50'),
                }),
            ]),
            m('h3', app.translator.trans(translationPrefix + 'general')),
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
            m('.Form-group', this.submitButton()),
        ]));
    }

    tagSettings(): any {
        if (!flarum.extensions['flarum-tags']) {
            return m('p', m('em', app.translator.trans(translationPrefix + 'discussion-tags-unavailable')));
        }

        if (this.loadingAllTags) {
            return LoadingIndicator.component();
        }

        let tags: {
            tagId: string
            probability: number
        }[] = [];

        try {
            tags = JSON.parse(this.setting(settingsPrefix + 'discussionTags')());
        } catch (e) {
            // do nothing, we'll reset to something usable
        }

        if (!Array.isArray(tags)) {
            tags = [];
        }

        let options: any = {
            '0': app.translator.trans(translationPrefix + 'tags-control.choose'),
        };

        flarum.core.compat['tags/utils/sortTags'](app.store.all('tags')).forEach(tag => {
            if (tags.some(t => t.tagId === tag.id())) {
                return;
            }

            options[tag.id()] = tag.name();
        });

        return m('table.CTFTagsTable', [
            m('thead', m('tr', [
                m('th', app.translator.trans(translationPrefix + 'tags-header.tag')),
                m('th', app.translator.trans(translationPrefix + 'tags-header.probability')),
                m('th'),
            ])),
            m('tbody', [
                tags.map((tag, index) => {
                    const onchange = (event: Event) => {
                        tag.probability = parseInt((event.target as HTMLInputElement).value);
                        this.setting(settingsPrefix + 'discussionTags')(JSON.stringify(tags));
                    };

                    const tagModel = app.store.getById('tags', tag.tagId);

                    const isLastLine = index === tags.length - 1;

                    return m('tr', [
                        m('td', tagModel ? tagModel.name() : m('em', tag.tagId)),
                        m('td', isLastLine ? m('em', app.translator.trans(translationPrefix + 'tags-fallback.' + (tags.length > 1 ? 'last-line' : 'single-line'))) : [
                            m('input.FormControl.CTFFormControl--range', {
                                type: 'number',
                                min: 0,
                                max: 100,
                                step: 1,
                                value: tag.probability || '',
                                onchange,
                            }),
                            m('input', {
                                type: 'range',
                                min: 0,
                                max: 100,
                                step: 1,
                                value: tag.probability || '',
                                onchange,
                            }),
                        ]),
                        m('td', [
                            ' ',
                            Button.component({
                                className: 'Button Button--icon',
                                icon: 'fas fa-chevron-down',
                                onclick: () => {
                                    tags.splice(index + 1, 0, ...tags.splice(index, 1));

                                    this.setting(settingsPrefix + 'discussionTags')(JSON.stringify(tags));
                                },
                                disabled: isLastLine,
                                title: app.translator.trans(translationPrefix + 'tags-control.down'),
                            }),
                            ' ',
                            Button.component({
                                className: 'Button Button--icon',
                                icon: 'fas fa-chevron-up',
                                onclick: () => {
                                    tags.splice(index - 1, 0, ...tags.splice(index, 1));

                                    this.setting(settingsPrefix + 'discussionTags')(JSON.stringify(tags));
                                },
                                disabled: index === 0,
                                title: app.translator.trans(translationPrefix + 'tags-control.up'),
                            }),
                            ' ',
                            Button.component({
                                className: 'Button Button--icon',
                                icon: 'fas fa-times',
                                onclick: () => {
                                    tags.splice(index, 1);

                                    this.setting(settingsPrefix + 'discussionTags')(JSON.stringify(tags));
                                },
                                title: app.translator.trans(translationPrefix + 'tags-control.delete'),
                            }),
                        ]),
                    ]);
                }),
                m('tr', [
                    m('td', {
                        colspan: 2,
                    }, Select.component({
                        options,
                        value: this.selectedTag,
                        onchange: (id: string) => {
                            this.selectedTag = id;
                        },
                    })),
                    m('td', Button.component({
                        className: 'Button Button--block',
                        onclick: () => {
                            tags.push({
                                tagId: this.selectedTag,
                                probability: 50,
                            });

                            this.setting(settingsPrefix + 'discussionTags')(JSON.stringify(tags));

                            this.selectedTag = '0';
                        },
                        disabled: this.selectedTag === '0',
                    }, app.translator.trans(translationPrefix + 'tags-control.add'))),
                ]),
            ]),
        ]);
    }
}
