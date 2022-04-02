import Page from 'flarum/components/Page';

import ConversationView from './ConversationView';

export default class ConversationViewPage extends Page {
  init() {
    super.init();

    app.history.push('conversations');

    const idParam = m.route.param('id');

    app.store.find('whisper/conversations', idParam)
      .then(conversation => {
        app.cache.conversations = [];
        app.cache.conversations.push(conversation);
        this.list = ConversationView.component({conversation, mobile: true});
        m.redraw();
      });


    this.bodyClass = 'App--messages';
  }

  view() {
    return (
      <div className="MessagesPage">
        <div className="ConversationsList">
          <div className="container clearfix">
            {this.list ? this.list : null}
          </div>
        </div>
      </div>
    );
  }
}