import app from 'flarum/app';

const EMBED_TYPES = ['preview-with-link', 'preview-without-link', 'full-with-link', 'full-without-link'];

app.initializers.add('imgur-upload', () => {
    app.extensionData
        .for('matteocontrini-imgur-upload')
        .registerSetting(
            {
                setting: 'imgur-upload.client-id',
                label: 'Imgur Client ID',
                type: 'text'
            }
        )
        .registerSetting(
            {
                setting: 'imgur-upload.hide-markdown-image',
                label: app.translator.trans('imgur-upload.admin.settings.hide-markdown-image'),
                type: 'boolean'
            }
        )
        .registerSetting(
            {
                setting: 'imgur-upload.allow-paste',
                label: app.translator.trans('imgur-upload.admin.settings.allow-paste'),
                type: 'boolean'
            }
        )
        .registerSetting(
            {
                setting: 'imgur-upload.embed-type',
                label: app.translator.trans('imgur-upload.admin.settings.embed-type.title'),
                type: 'select',
                options: Object.fromEntries(
                    EMBED_TYPES.map(x => [x, app.translator.trans(`imgur-upload.admin.settings.embed-type.${x}`)])
                ),
                default: 'preview-with-link'
            }
        )
});
