import Search from "flarum/components/Search";
import UserSearchSource from "./UserSearchSource";
import ItemList from "flarum/utils/ItemList";
import classList from "flarum/utils/classList";
import extractText from "flarum/utils/extractText";
import LoadingIndicator from "flarum/components/LoadingIndicator";
import recipientLabel from "./recipientLabel";
import Stream from 'flarum/utils/Stream';
import withAttr from 'flarum/utils/withAttr';

export default class RecipientSearch extends Search {

  oninit(attrs) {
    this.value = Stream();
    super.oninit(attrs);
  }

  onupdate(vnode) {


    const $search = this;

    this.$('.Search-results').on('click', (e) => {
      const target = this.$('.SearchResult.active')

      $search.addRecipient(target.data('index'));
      $search.$('.RecipientsInput').focus();
    });

    this.$('.Search-results').on('touchstart', (e) => {
      const target = this.$(e.target.parentNode);

      $search.addRecipient(target.data('index'));
      $search.$('.RecipientsInput').focus();
    });

    $('.RecipientsInput').on('keyup', () => {
      clearTimeout(this.typingTimer);
      this.doSearch = false;
      this.typingTimer = setTimeout(() => {
        this.doSearch = true;
        m.redraw();
      }, 900);
    }).on('keydown', () => {
      clearTimeout(this.typingTimer);
    });

    super.oncreate(vnode);
  }

  view() {
    if (typeof this.value() === 'undefined') {
      this.value('');
    }

    const loading = this.value() && this.value().length >= 3;

    if (!this.sources) {
      this.sources = this.sourceItems().toArray();
    }

    return (
      <div className="AddRecipientModal-body">
        {app.cache.conversationsRecipient === null ?
          <div className="AddRecipientModal-form-input">
            <input className={'RecipientsInput FormControl ' + classList({
              open: !!this.value(),
              focused: !!this.value(),
              active: !!this.value(),
              loading: !!this.loadingSources
            })}
                   config={function (element) {
                     element.focus();
                   }}
                   type="search"
                   placeholder={extractText(app.translator.trans('kyrne-whisper.forum.modal.search_recipients'))}
                   value={this.value()}
                   oninput={withAttr('value', this.value)}
                   onfocus={() => this.hasFocus = true}
                   onblur={() => this.hasFocus = false}
            />
            <ul className={
              'Dropdown-menu Search-results fade ' + classList({
                in: !!loading
              })
            }>
              {!this.doSearch
                ? LoadingIndicator.component({size: 'tiny', className: 'Button Button--icon Button--link'})
                : this.sources.map(source => source.view(this.value()))}
                <li>
                  <span>{app.translator.trans('kyrne-whisper.forum.modal.more_users')}</span>
                </li>
            </ul>
          </div>
          : <div className="RecipientsInput-selected RecipientsLabel">
            {recipientLabel(app.cache.conversationsRecipient, {
              onclick: () => {
                this.removeRecipient(app.cache.conversationsRecipient);
              }
            })}
          </div>
        }
      </div>
    )
  }

  /**
   * Build an item list of SearchSources.
   *
   * @return {ItemList}
   */
  sourceItems() {
    const items = new ItemList();

    items.add('users', new UserSearchSource());

    return items;
  }


  /**
   * Clear the search input and the current controller's active search.
   */
  clear() {
    this.value('');

    m.redraw();
  }

  /**
   * Adds a recipient.
   *
   * @param value
   */
  addRecipient(value) {
    app.cache.conversationsRecipient = app.store.getById('users', value);

    this.clear();
  }

  /**
   * Removes a recipient.
   *
   * @param recipient
   */
  removeRecipient(recipient) {
    app.cache.conversationsRecipient = null;

    m.redraw();
  }

  /**
   * Loads a recipient from the global store.
   *
   * @param store
   * @param id
   * @returns {Model}
   */
  findRecipient(store, id) {
    return app.store.getById(store, id);
  }
}
