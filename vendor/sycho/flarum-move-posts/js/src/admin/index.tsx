import extractText from 'flarum/common/utils/extractText';

app.initializers.add('sycho/flarum-move-posts', () => {
  let value =
    app.data.settings['sycho-move-posts.moved_first_post_content'] ||
    extractText(app.translator.trans('sycho-move-posts.lib.discussion.first_post.default_content'));

  app.extensionData
    .for('sycho-move-posts')
    .registerSetting(function () {
      return (
        <div className="Form-group">
          <label for="moved_first_post_content">{app.translator.trans('sycho-move-posts.admin.settings.moved_first_post_content')}</label>
          <div className="helpText">{app.translator.trans('sycho-move-posts.admin.settings.moved_first_post_content_help')}</div>
          <textarea
            id="moved_first_post_content"
            oninput={(e: any) => {
              value = e.target.value;
              this.setting('sycho-move-posts.moved_first_post_content')(e.target.value);
            }}
            className="FormControl"
            required
          >
            {value}
          </textarea>
        </div>
      );
    })
    .registerSetting({
      setting: 'sycho-move-posts.group_sequential_event_posts',
      label: app.translator.trans('sycho-move-posts.admin.settings.group_sequential_posts'),
      type: 'boolean',
    })
    .registerPermission(
      {
        icon: 'fas fa-exchange-alt',
        label: app.translator.trans('sycho-move-posts.admin.permissions.move_posts'),
        permission: 'sycho-move-posts:movePosts',
      },
      'moderate'
    );
});
