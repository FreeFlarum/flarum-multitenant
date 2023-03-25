import app from 'flarum/forum/app';
import Search from 'flarum/forum/components/Search';
import UserSearchSource from './sources/UserSearchSource';
import ItemList from 'flarum/common/utils/ItemList';
import classList from 'flarum/common/utils/classList';
import extractText from 'flarum/common/utils/extractText';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import User from 'flarum/common/models/User';
import username from 'flarum/common/helpers/username';
import avatar from 'flarum/common/helpers/avatar';

export default class TransferMoneySearchModal extends Search {

  inputUuid;

  oninit(vnode) {
    super.oninit(vnode);
    this.inputUuid = Math.random().toString(36).substring(2);
  }

  oncreate(vnode) {
    super.oncreate(vnode);

    const $search = this;

    this.$('.Search-results').on('click', (e) => {
      const target = this.$('.SearchResult.active');

      $search.addRecipient(target.data('index'));
      $search.$('.RecipientsInput').focus();
    });

    this.$('.Search-results').on('touchstart', (e) => {
      const target = this.$(e.target.parentNode);

      $search.addRecipient(target.data('index'));
      $search.$('.RecipientsInput').focus();
    });

    $('.RecipientsInput')
      .on('input', () => {
        clearTimeout(this.typingTimer);
        this.doSearch = false;
        this.typingTimer = setTimeout(() => {
          this.doSearch = true;
          m.redraw();
        }, 900);
      })
      .on('keydown', () => {
        clearTimeout(this.typingTimer);
      });

    super.oncreate(vnode);
  }

  view() {
    if (typeof this.searchState.getValue() === 'undefined') {
      this.searchState.setValue('');
    }

    const loading = this.searchState.getValue() && this.searchState.getValue().length >= 3;

    if (!this.sources) {
      this.sources = this.sourceItems().toArray();
    }

    const selectedUserArray = this.attrs.selected().toArray();

    return (
      <div role="search" className="Search">
        <div className="RecipientsInput-selected RecipientsLabel" aria-live="polite">
          <div style="padding-bottom:10px;font-weight:bold;font-size: 14px;color: var(--text-color);">{app.translator.trans('ziven-transfer-money.forum.transfer-money-to-user')}</div>

          {selectedUserArray.length===0 && (
            <div style="height:34px;cursor: default !important;" class="transferSearchUserContainer">{app.translator.trans('ziven-transfer-money.forum.transfer-money-no-user-selected')}</div>
          )}

          {this.attrs
            .selected()
            .toArray()
            .map((recipient) => {
              const userName = username(recipient);
              const userAvatar = avatar(recipient);
              const userID = recipient.data.id;
              this.attrs.selectedUsers[userID] = 1;

              return (
                <div class="transferSearchUserContainer" onclick={(e) => this.removeRecipient(recipient, e)}><span class='transferSearchUser'>{userAvatar}</span> {userName}</div>
              );
            })}
        </div>

        <div className="Form-group">
          <label for={`transfer-money-user-search-input-${this.inputUuid}`}>{app.translator.trans('ziven-transfer-money.forum.transfer-money-search-user')}</label>

          <div className="AddRecipientModal-form-input Search-input">
            <input
              id={`transfer-money-user-search-input-${this.inputUuid}`}
              className={classList('RecipientsInput', 'FormControl', {
                open: !!this.searchState.getValue(),
                focused: !!this.searchState.getValue(),
                active: !!this.searchState.getValue(),
                loading: !!this.loadingSources,
              })}
              type="search"
              placeholder={extractText(app.translator.trans('ziven-transfer-money.forum.transfer-money-search-user-placeholder'))}
              value={this.searchState.getValue()}
              oninput={(e) => this.searchState.setValue(e.target.value)}
              onfocus={() => (this.hasFocus = true)}
              onblur={() => (this.hasFocus = false)}
            />
            <ul
              className={classList('Dropdown-menu', 'Search-results', 'fade', {
                in: !!loading,
              })}
            >
              {!this.doSearch
                ? LoadingIndicator.component({ size: 'tiny', className: 'Button Button--icon Button--link' })
                : this.sources.map((source) => source.view(this.searchState.getValue()))}
            </ul>
          </div>
        </div>
      </div>
    );
  }

  sourceItems() {
    const items = new ItemList();
    items.add('users', new UserSearchSource());
    return items;
  }

  addRecipient(value) {
    let values = value.split(':');
    let type = values[0];
    let id = values[1];
    let recipient = this.findRecipient(type, id);
    const userID = recipient.data.id;

    this.attrs.selected().add(value, recipient);
    this.attrs.selectedUsers[userID] = 1;
    this.searchState.clear();
    this.attrs.needMoney(this.getNeedMoney());
    this.attrs.callback();
  }

  removeRecipient(recipient, e) {
    e.preventDefault();

    const userID = recipient.data.id;
    delete this.attrs.selectedUsers[userID];

    let type = "users";
    this.attrs.selected().remove(type + ':' + recipient.id());
    this.attrs.needMoney(this.getNeedMoney());
    this.attrs.callback();
  }

  getNeedMoney(){
    const moneyTransferValue = $("#moneyTransferInput").val();
    return moneyTransferValue*Object.keys(this.attrs.selectedUsers).length;
  }

  findRecipient(store, id) {
    return app.store.getById(store, id);
  }
}
