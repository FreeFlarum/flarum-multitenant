import app from 'flarum/admin/app';

app.initializers.add('datlechin/flarum-silent-edit', () => {
  app.extensionData.for('datlechin-silent-edit').registerPermission(
    {
      icon: 'fas fa-volume-mute',
      label: app.translator.trans('datlechin-silent-edit.admin.permissions.clearLastEdit'),
      permission: 'discussion.clearLastEdit',
    },
    'moderate'
  );
});
