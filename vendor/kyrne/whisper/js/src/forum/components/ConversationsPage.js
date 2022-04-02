import Page from 'flarum/components/Page';

import ConversationsList from './ConversationsList';

export default class ConversationsPage extends Page {
  oninit() {
    super.oninit();

    app.history.push('messages');

    this.bodyClass = 'App--conversations';
  }

  view() {
    return <div className="ConversationsPage"><ConversationsList mobile={true}></ConversationsList></div>;
  }
}
