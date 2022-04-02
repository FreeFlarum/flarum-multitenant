import app from 'flarum/common/app';

app.initializers.add('ffans/clipboardjs', (app) => {

  function getTrans(key) {
    return app.translator.trans('ffans-clipboardjs.admin.settings.' + key);
  }
  
  const themes = {
    'default': getTrans('themes.default'),
    'github': getTrans('themes.github'),
    'lingcoder': getTrans('themes.lingcoder'),
    'csdn': getTrans('themes.csdn'),
    'cnblog': getTrans('themes.cnblog'),
    'jianshu': getTrans('themes.jianshu'),
    'segmentfault': getTrans('themes.segmentfault'),
  }

  app.extensionData.for('ffans-clipboardjs')
    .registerSetting({
        setting: 'ffans-clipboardjs.theme_name',
        type: 'select',
        options: themes,
        default: 'default',
        label: getTrans('themes_label')
    })
    .registerSetting({
      setting: 'ffans-clipboardjs.is_copy_enable',
      type: 'switch',
      label: getTrans('copy_enable_label')
    })
    .registerSetting({
      setting: 'ffans-clipboardjs.is_show_codeLang',
      type: 'switch',
      label: getTrans('codeLang_label')
    })
  console.log('[ffans/clipboardjs] Hello, admin!');
});
