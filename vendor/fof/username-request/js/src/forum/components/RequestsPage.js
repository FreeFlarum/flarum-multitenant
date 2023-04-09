import app from 'flarum/forum/app';
import Page from 'flarum/common/components/Page';

import RequestsList from './RequestsList';

export default class RequestsPage extends Page {
  oninit(vnode) {
    super.oninit(vnode);

    app.history.push('requests');

    app.usernameRequests.load();

    this.bodyClass = 'App--requests';
  }

  view() {
    return (
      <div className="RequestsPage">
        <RequestsList state={app.usernameRequests}></RequestsList>
      </div>
    );
  }
}
