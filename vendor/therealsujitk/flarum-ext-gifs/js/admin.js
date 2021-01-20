import app from 'flarum/app';

app.initializers.add('therealsujitk-gifs', (app) => {
    app.extensionData.for('therealsujitk-gifs')
        .registerSetting({
            setting: 'therealsujitk-gifs.giphy_api_key',
            type: 'text',
            label: app.translator.trans('therealsujitk.admin.gifs.giphyAPIkey')
        })
});