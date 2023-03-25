import app from 'flarum/forum/app';
import highlight from 'flarum/common/helpers/highlight';
import avatar from 'flarum/common/helpers/avatar';
import username from 'flarum/common/helpers/username';

export default class UserSearchSource {
  view(query) {
    if(query.length<3 || this.loading){
      return;
    } 

    if(!app.cache.userSearchResults){
      app.cache.userSearchResults = [];
    }

    this.query = query;
    const currentUserID = app.session.user.id();

    if (!app.cache.userSearchResults[this.query]) {
      this.loading = true;

      app.cache.userSearchResults[this.query] = [];
      app.store
        .find('users', {
          filter: { q: this.query + ' allows-pd' },
          page: { limit: 5 },
        })
        .then(this.pushResults.bind(this));
    } else
      return [
        <li className="Dropdown-header">{app.translator.trans('ziven-transfer-money.forum.search_user_header')}</li>,
        app.cache.userSearchResults[this.query].map((user) => {
          if(currentUserID!=user.id()){
            const name = username(user);
            const children = [highlight(name.text, this.query)];

            return (
              <li className="SearchResult" data-index={'users:' + user.id()}>
                <a data-index={'users:' + user.id()}>
                  {avatar(user)}
                  {{ ...name, text: undefined, children }}
                </a>
              </li>
            );
          }
        }),
      ];
  }

  pushResults(results) {
    results.payload.data.map((result) => {
      var user = app.store.getById('users', result.id);
      app.cache.userSearchResults[this.query].push(user);
    });
    this.loading = false;
    m.redraw();
  }
}
