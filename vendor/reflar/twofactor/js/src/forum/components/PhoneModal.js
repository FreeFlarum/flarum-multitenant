import app from 'flarum/app';
import Alert from 'flarum/components/Alert';
import { extend } from 'flarum/extend';
import ItemList from 'flarum/utils/ItemList';
import listItems from 'flarum/helpers/listItems';
import Modal from 'flarum/components/Modal';
import Dropdown from 'flarum/components/Dropdown';
import Button from 'flarum/components/Button';
import AuthyModal from './AuthyModal';
import TwoFactorModal from './TwoFactorModal';
import RecoveryModal from './RecoveryModal';
import Countries from './Countries';

export default class PhoneModal extends Modal {
  init() {
    super.init();

    this.twoFactorCode = m.prop('');

    this.phone = m.prop('');

    this.enabled = m.prop(app.session.user.twofa_enabled());

    $.getScript('https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/master/src/jquery.mask.js', function() {
      $('#phone').mask('(000) 000-00000');
      $('#code').mask('AAA-AAA', { placeholder: '   -   ' });
    });

    this.country = {
      name: 'United States of America',
      mcode: '+1',
    };
  }

  className() {
    return 'TwoFactorModal Modal--small';
  }

  title() {
    return app.translator.trans('reflar-twofactor.forum.modal.twofactor_title');
  }

  countryItems() {
    const items = new ItemList();

    items.add(
      'sort',
      Dropdown.component({
        buttonClassName: 'Button FormControl',
        menuClassName: 'Country-Dropdown-actual',
        label: this.country.name,
        children: Countries().map(country => {
          const active = this.country === country;

          return Button.component({
            children: country.name,
            icon: active ? 'check' : true,
            onclick: () => {
              this.country = country;
            },
            active: active,
          });
        }),
      })
    );

    return items;
  }

  content(user) {
    return (
      <div className="Modal-body">
        <div className="Form">
          <div className="Form-group">
            <h2 style="text-align: center">{app.translator.trans('reflar-twofactor.forum.modal.phone_heading')}</h2>
            {this.enabled() !== 3
              ? Button.component({
                  className: 'Button Button--primary Switch-button',
                  onclick: () => {
                    app.modal.close();
                    app.modal.show(new TwoFactorModal(this.user));
                  },
                  children: app.translator.trans('reflar-twofactor.forum.modal.stTOTP'),
                })
              : ''}
            {app.forum.data.attributes.authy_enabled === '1'
              ? Button.component({
                  className: 'Button Button--primary Switch-button',
                  onclick: () => {
                    app.modal.close();
                    app.modal.show(new AuthyModal());
                  },
                  children: app.translator.trans('reflar-twofactor.forum.modal.stAuthy'),
                })
              : ''}
            <div style="text-align: center" className="helpText Submit-Button">
              {this.enabled() !== 3
                ? app.translator.trans('reflar-twofactor.forum.modal.helpPhone')
                : app.translator.trans('reflar-twofactor.forum.modal.helpPhone2')}
            </div>
          </div>
          {this.enabled() !== 3 ? (
            <div className="Form-group">
              <ul className="Country-dropdown">{listItems(this.countryItems().toArray())}</ul>
              <input type="text" id="phone" oninput={m.withAttr('value', this.phone)} className="FormControl Phone-Input" />
              {Button.component({
                className: 'Button Button--primary',
                onclick: () => {
                  app.request({
                    url: app.forum.attribute('apiUrl') + '/twofactor/verifycode',
                    method: 'POST',
                    data: {
                      step: 3,
                      phone: this.country.mcode + this.phone().replace(/[- )(]/g, ''),
                    },
                  });
                  this.enabled(3);
                  m.redraw();
                },
                children: app.translator.trans('reflar-twofactor.forum.modal.submitPhone'),
              })}
            </div>
          ) : (
            <div>
              {Button.component({
                className: 'Button Button--primary TwoFactor-button',
                loading: this.loading,
                onclick: () => {
                  app
                    .request({
                      url: app.forum.attribute('apiUrl') + '/twofactor/verifycode',
                      method: 'POST',
                      data: {
                        step: 1,
                      },
                      errorHandler: this.onerror.bind(this),
                    })
                    .then(() => {
                      app.modal.close();
                      app.modal.show(new TwoFactorModal(this.user));
                    });

                  this.loading = false;
                },
                children: app.translator.trans('reflar-twofactor.forum.modal.back'),
              })}
              <input
                type="text"
                id="code"
                style="text-transform: uppercase;"
                oninput={m.withAttr('value', this.twoFactorCode)}
                className="FormControl"
              />
              {Button.component({
                className: 'Button Button--primary TwoFactor-button',
                loading: this.loading,
                type: 'submit',
                children: app.translator.trans('reflar-twofactor.forum.modal.button'),
              })}
            </div>
          )}
        </div>
      </div>
    );
  }

  onsubmit(e) {
    e.preventDefault();

    if (this.loading) return;

    this.loading = true;
    app
      .request({
        url: app.forum.attribute('apiUrl') + '/twofactor/verifycode',
        method: 'POST',
        data: {
          step: 4,
          code: this.twoFactorCode(),
        },
      })
      .then(response => {
        const data = response.data.id;
        if (data === 'IncorrectCode') {
          this.alert = new Alert({
            type: 'error',
            children: app.translator.trans('reflar-twofactor.forum.incorrect_2fa'),
          });
          m.redraw();
        } else {
          app.alerts.show(
            (this.successAlert = new Alert({
              type: 'success',
              children: app.translator.trans('reflar-twofactor.forum.2fa_enabled'),
            }))
          );
          app.modal.show(new RecoveryModal({ data }));
        }
      });

    this.loading = false;
  }
}
