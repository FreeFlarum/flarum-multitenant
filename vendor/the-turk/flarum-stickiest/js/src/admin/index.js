/*
 * This file is part of Stickiest.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import app from 'flarum/app';

app.initializers.add('the-turk-stickiest', function () {
  app.extensionData
    .for('the-turk-stickiest')
    .registerSetting({
      setting: 'the-turk-stickiest.badge_icon',
      type: 'text',
      label: app.translator.trans('the-turk-stickiest.admin.settings.badge_icon_label'),
      help: app.translator.trans('the-turk-stickiest.admin.settings.badge_icon_text'),
    })
    .registerSetting({
      setting: 'the-turk-stickiest.display_tag_sticky',
      type: 'boolean',
      label: app.translator.trans('the-turk-stickiest.admin.settings.display_tag_sticky_label'),
      help: app.translator.trans('the-turk-stickiest.admin.settings.display_tag_sticky_text'),
    })
    .registerPermission(
      {
        icon: app.data.settings['the-turk-stickiest.badge_icon'],
        label: app.translator.trans('the-turk-stickiest.admin.permissions.super_sticky_discussions_label'),
        permission: 'discussion.stickiest',
      },
      'moderate',
      97
    )
    .registerPermission(
      {
        icon: 'fas fa-thumbtack',
        label: app.translator.trans('the-turk-stickiest.admin.permissions.tag_sticky_discussions_label'),
        permission: 'discussion.stickiest.tagSticky',
      },
      'moderate',
      96
    );
});
