import app from 'flarum/admin/app';

app.initializers.add('fof-ignore-users', () => {
  app.extensionData.for('fof-ignore-users').registerPermission(
    {
      icon: 'fas fa-comment-slash',
      label: app.translator.trans('fof-ignore-users.admin.permissions.can_not_be_ignored_label'),
      permission: 'notBeIgnored',
    },
    'reply'
  );
});
