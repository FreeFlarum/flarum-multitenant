import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import User from 'flarum/common/models/User';
import Model from 'flarum/common/Model';
import SignUpModal from 'flarum/forum/components/SignUpModal';
import EditUserModal from 'flarum/common/components/EditUserModal';
import Button from 'flarum/common/components/Button';
import SettingsPage from 'flarum/forum/components/SettingsPage';
import FieldSet from 'flarum/common/components/FieldSet';
import Switch from 'flarum/common/components/Switch';
import Stream from 'flarum/common/utils/Stream';
import UserCard from 'flarum/forum/components/UserCard';
import icon from 'flarum/common/helpers/icon';
import dayjs from 'dayjs';
import LocalizedFormat from 'dayjs/plugin/localizedFormat';

import 'dayjs/locale/vi';
import 'dayjs/locale/tr';
import 'dayjs/locale/nl';
import 'dayjs/locale/az';
import 'dayjs/locale/ml';
import 'dayjs/locale/ja';
import 'dayjs/locale/ta';
import 'dayjs/locale/de';
import 'dayjs/locale/hu';
import 'dayjs/locale/ru';
import 'dayjs/locale/it';
import 'dayjs/locale/fr';
import 'dayjs/locale/si';
import 'dayjs/locale/pt-br';
import 'dayjs/locale/pt';
import 'dayjs/locale/es';
import 'dayjs/locale/zh-hk';
import 'dayjs/locale/zh-tw';
import 'dayjs/locale/zh-cn';
import 'dayjs/locale/uz';
import 'dayjs/locale/th';
import 'dayjs/locale/hi';
import 'dayjs/locale/fi';
import 'dayjs/locale/ro';
import 'dayjs/locale/te';
import 'dayjs/locale/lt';
import 'dayjs/locale/lt';
import 'dayjs/locale/sk';
import 'dayjs/locale/sv';
import 'dayjs/locale/fa';

import ChangeBirthdayModal from './components/ChangeBirthdayModal';
import calculateAge from './helpers/calculateAge';

dayjs.extend(LocalizedFormat);

app.initializers.add('datlechin/flarum-birthdays', () => {
  User.prototype.birthday = Model.attribute('birthday');
  User.prototype.showDobDate = Model.attribute('showDobDate');
  User.prototype.showDobYear = Model.attribute('showDobYear');
  User.prototype.canEditOwnBirthday = Model.attribute('canEditOwnBirthday');

  extend(UserCard.prototype, 'infoItems', function (items) {
    const user = this.attrs.user;
    const userLocale = user.preferences()?.locale || app.translator.formatter.locale;
    const dateFormat = app.forum.attribute('datlechin-birthdays.dateFormat') || 'LL';
    const dateNoneYearFormat = app.forum.attribute('datlechin-birthdays.dateNoneYearFormat') || 'DD MMMM';
    let birthday = user.birthday();
    const age = calculateAge(birthday);

    dayjs.locale(userLocale);

    if (birthday === null) return;

    if (user.showDobDate() && user.showDobYear()) birthday = dayjs(birthday).locale(userLocale).format(dateFormat);
    else if (user.showDobDate() === true && user.showDobYear() === false) birthday = dayjs(birthday).format(dateNoneYearFormat);
    else return;

    items.add(
      'birthday',
      <>
        {icon('fas fa-birthday-cake')}
        <span className="birthday">{app.translator.trans('datlechin-birthdays.forum.user.birthday_text', { date: birthday })}</span>
        {user.showDobYear() ? <span className="age">({app.translator.trans('datlechin-birthdays.forum.user.age_text', { age: age })})</span> : null}
      </>
    );
  });

  extend(EditUserModal.prototype, 'oninit', function () {
    this.birthday = Stream(this.attrs.user.birthday());
  });

  extend(EditUserModal.prototype, 'fields', function (items) {
    items.add(
      'birthday',
      <div className="Form-group">
        <label>{app.translator.trans('datlechin-birthdays.forum.edit_user.dob_heading')}</label>
        <input className="FormControl" type="date" bidi={this.birthday} />
      </div>,
      30
    );
  });

  extend(EditUserModal.prototype, 'data', function (data) {
    if (this.birthday() !== this.attrs.user.birthday()) {
      data.birthday = this.birthday();
    }
  });

  extend(SignUpModal.prototype, 'oninit', function () {
    if (app.forum.attribute('datlechin-birthdays.setBirthdayOnRegistration')) {
      this.birthday = Stream(this.attrs.birthday || '');
    }
  });

  extend(SignUpModal.prototype, 'fields', function (items) {
    if (app.forum.attribute('datlechin-birthdays.setBirthdayOnRegistration')) {
      items.add(
        'birthday',
        <div className="Form-group">
          <input
            className="FormControl birthday"
            name="birthday"
            type="text"
            bidi={this.birthday}
            disabled={this.loading}
            placeholder="Birthday"
            onfocus={(e) => {
              e.target.type = 'date';
            }}
          />
        </div>,
        20
      );
    }
  });

  extend(SignUpModal.prototype, 'submitData', function (data) {
    if (app.forum.attribute('datlechin-birthdays.setBirthdayOnRegistration')) {
      data.birthday = this.birthday();
    }
  });

  extend(SettingsPage.prototype, 'settingsItems', function (items) {
    if (this.user.canEditOwnBirthday()) {
      items.add(
        'birthday',
        <FieldSet className="Settings-birthday" label={app.translator.trans(`datlechin-birthdays.forum.settings.dob_heading`)}>
          <Switch
            state={this.user.showDobDate()}
            onchange={(value) => {
              this.showDobDateLoading = true;

              this.user.save({ showDobDate: value, showDobYear: value }).then(() => {
                this.showDobDateLoading = false;
                m.redraw();
              });
            }}
            loading={this.showDobDateLoading}
          >
            {app.translator.trans('datlechin-birthdays.forum.settings.show_dob_date_label')}
          </Switch>
          <Switch
            state={this.user.showDobDate() && this.user.showDobYear()}
            onchange={(value) => {
              this.showDobYearLoading = true;

              this.user.save({ showDobYear: value }).then(() => {
                this.showDobYearLoading = false;
                m.redraw();
              });
            }}
            loading={this.showDobYearLoading || this.showDobDateLoading}
          >
            {app.translator.trans('datlechin-birthdays.forum.settings.show_dob_year_label')}
          </Switch>
          <span className="helpText">{app.translator.trans('datlechin-birthdays.forum.settings.show_dob_year_help')}</span>
        </FieldSet>
      );
    }
  });

  extend(SettingsPage.prototype, 'accountItems', function (items) {
    if (this.user.canEditOwnBirthday()) {
      items.add(
        'changeBirthday',
        <Button className="Button" onclick={() => app.modal.show(ChangeBirthdayModal)}>
          {app.translator.trans('datlechin-birthdays.forum.settings.change_dob_label')}
        </Button>
      );
    }
  });
});
