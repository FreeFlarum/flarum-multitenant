import { extend } from 'flarum/common/extend';
import app from 'flarum/common/app';

app.initializers.add('jslirola-login2seeplus', () => {
    app.extensionData.for('jslirola-login2seeplus')
      .registerSetting(() => <legend class="login2seeplus-lenght">{app.translator.trans('jslirola-login2seeplus.admin.post.title')}</legend>)
      .registerSetting({
        setting: 'jslirola.login2seeplus.post',
        type: 'number',
        min: -1
      })
      .registerSetting(() => <legend class="login2seeplus-hide">{app.translator.trans('jslirola-login2seeplus.admin.hide')}</legend>)
      .registerSetting({
        setting: 'jslirola.login2seeplus.link',
        type: 'switch',
        label: app.translator.trans('jslirola-login2seeplus.admin.link')
      })
      .registerSetting({
        setting: 'jslirola.login2seeplus.image',
        type: 'switch',
        label: app.translator.trans('jslirola-login2seeplus.admin.image')
      })
      .registerSetting({
        setting: 'jslirola.login2seeplus.code',
        type: 'switch',
        label: app.translator.trans('jslirola-login2seeplus.admin.code')
      });
});
