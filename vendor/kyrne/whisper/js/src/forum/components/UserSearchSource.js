import highlight from 'flarum/helpers/highlight';
import avatar from 'flarum/helpers/avatar';
import username from 'flarum/helpers/username';

export default class UserSearchSource {
  view(query) {
    if (query.length < 3 || this.loading) return;

    if (!app.cache.conversationResults) {
      app.cache.conversationResults = [];
    }

    this.query = query;

    if (!app.cache.conversationResults[this.query]) {

      this.loading = true;

      app.cache.conversationResults[this.query] = [];
      app.store.find('users', {
        filter: {q: this.query},
        page: {limit: 5}
      }).then(this.pushResults.bind(this));
    } else

      return [
        <li className="Dropdown-header">{app.translator.trans('core.forum.search.users_heading')}</li>,
        app.cache.conversationResults[this.query].map(user => {
          let name = username(user);
          name = highlight(name.text, this.query);

          return (
            <li className='SearchResult' data-index={user.id()}>
              <a data-index={'users:' + user.id()}>
                {avatar(user)}
                {name}
              </a>
            </li>
          );
        })
      ];
  }

  pushResults(results) {
    results.payload.data.map(result => {
      let user = app.store.getById('users', result.id);
      if (parseInt(user.id()) !== parseInt(app.session.user.id())) {
        app.cache.conversationResults[this.query].push(user);
      }
    });
    this.loading = false;
    m.redraw();
  }
}
