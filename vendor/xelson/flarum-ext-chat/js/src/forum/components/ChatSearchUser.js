import Search from 'flarum/components/Search';
import LoadingIndicator from 'flarum/components/LoadingIndicator';
import ItemList from 'flarum/utils/ItemList';
import classList from 'flarum/utils/classList';
import icon from 'flarum/helpers/icon';
import UsersSearchSource from './UsersSearchResults';

export default class ChatSearchUser extends Search {
    oninit(vnode) {
        super.oninit(vnode);
    }

    sourceItems() {
        const items = new ItemList();
        this.state = this.attrs.state ?? {};
        if (app.forum.attribute('canViewUserList')) items.add('users', new UsersSearchSource({ state: app.search.neonchat }));

        return items;
    }

    view(vnode) {
        const currentSearch = this.state.getInitialSearch();

        if (!this.state.getValue().length) {
            this.state.setValue(currentSearch || '');
        }

        app.current.searching = () => this.state.getValue();

        if (!this.sources) {
            this.sources = this.sourceItems().toArray();
        }

        if (!this.sources.length) return <div></div>;

        return (
            <div
                className={
                    'Search ' +
                    classList({
                        open: this.hasFocus,
                        active: !!currentSearch,
                        loading: !!this.loadingSources,
                    })
                }
            >
                <div className="Search-input SearchInput">
                    <input
                        className="FormControl"
                        type="search"
                        placeholder={app.translator.trans('xelson-chat.forum.chat.list.add_modal.search.placeholder')}
                        value={this.state.getValue()}
                        oninput={(e) => this.state.setValue(e.target.value)}
                        onfocus={() => (this.hasFocus = true)}
                    />
                    {this.loadingSources ? (
                        <LoadingIndicator size="tiny" className="Button Button--icon Button--link" />
                    ) : currentSearch ? (
                        <button className="Search-clear Button Button--icon Button--link" onclick={this.clear.bind(this)}>
                            {icon('fas fa-times-circle')}
                        </button>
                    ) : (
                        ''
                    )}
                </div>
                {this.state.getValue() && this.hasFocus ? (
                    <ul className="Dropdown-menu Dropdown--Users Search-results">
                        {this.sources.map((source) => source.view(this.state.getValue()))}
                    </ul>
                ) : null}
            </div>
        );
    }
}
