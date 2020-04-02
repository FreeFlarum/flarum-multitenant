import { extend } from "flarum/extend";
import app from "flarum/app";
import PermissionGrid from "flarum/components/PermissionGrid";

import NicknameChangerSettings from './components/NicknameChangerSettings';

app.initializers.add('dem13n-nickname-changer', app => {

  app.extensionSettings['dem13n-nickname-changer'] = () => app.modal.show(new NicknameChangerSettings());

  extend(PermissionGrid.prototype, 'moderateItems', items => {
    items.add('permanentChange', {
      icon: 'fas fa-id-badge',
      label: app.translator.trans('dem13n.admin.nickname.unlimited_nickname_change'),
      permission: 'dem13n.canPermanentNicknameChange'
    });
  });

});