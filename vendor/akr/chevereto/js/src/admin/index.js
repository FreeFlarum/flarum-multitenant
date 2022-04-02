import app from "flarum/app";

app.initializers.add('akr-chevereto', app => {
    app.extensionData.for('akr-chevereto')
        .registerSetting({
            type: 'text',
            setting: 'akr-chevereto.url',
            label: app.translator.trans('akr-chevereto.admin.setting.url'),
        })
        .registerSetting({
            type: 'text',
            setting: 'akr-chevereto.insert_type',
            label: app.translator.trans('akr-chevereto.admin.setting.insert_type'),
        })
});
