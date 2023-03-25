import Component from "flarum/Component";
import app from "flarum/app";
import LoadingIndicator from "flarum/components/LoadingIndicator";
import Button from "flarum/components/Button";

import TransferHistoryListItem from "./TransferHistoryListItem";

export default class TransferHistoryList extends Component {
  oninit(vnode) {
    super.oninit(vnode);
    this.loading = true;
    this.moreResults = false;
    this.transferHistory = [];
    this.user = this.attrs.params.user;
    this.loadResults();
  }

  view() {
    let loading;

    if (this.loading) {
      loading = LoadingIndicator.component({ size: "large" });
    }

    return (
      <div>
        <div style="padding-bottom:10px; font-size: 24px;font-weight: bold;">
          {app.translator.trans("ziven-transfer-money.forum.transfer-money-history")}
        </div>
        <ul style="margin: 0;padding: 0;list-style-type: none;position: relative;">
          {this.transferHistory.map((transferHistory) => {
            return (
              <li style="padding-top:5px" key={transferHistory.id()} data-id={transferHistory.id()}>
                {TransferHistoryListItem.component({ transferHistory })}
              </li>
            );
          })}
        </ul>
          
        {!this.loading && this.transferHistory.length===0 && (
          <div>
            <div style="font-size:1.4em;color: var(--muted-more-color);text-align: center;height: 300px;line-height: 100px;">{app.translator.trans("ziven-transfer-money.forum.transfer-list-empty")}</div>
          </div>
        )}

        {this.hasMoreResults() && (
          <div style="text-align:center;padding:20px">
            <Button className={'Button Button--primary'} disabled={this.loading} loading={this.loading} onclick={() => this.loadMore()}>
              {app.translator.trans('ziven-transfer-money.forum.transfer-list-load-more')}
            </Button>
          </div>
        )}
      </div>
    );
  }

  loadMore() {
    this.loading = true;
    this.loadResults(this.transferHistory.length);
  }

  parseResults(results) {
    this.moreResults = !!results.payload.links && !!results.payload.links.next;
    [].push.apply(this.transferHistory, results);
    this.loading = false;
    m.redraw();

    return results;
  }

  hasMoreResults() {
    return this.moreResults;
  }

  loadResults(offset = 0) {
    return app.store
      .find("transferHistory", {
        filter: {
          user: this.user.id(),
        },
        page: {
          offset,
        },
      })
      .catch(() => {})
      .then(this.parseResults.bind(this));
  }
}
