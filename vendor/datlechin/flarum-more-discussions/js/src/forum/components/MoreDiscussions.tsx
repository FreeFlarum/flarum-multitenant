import app from 'flarum/forum/app';
import Component, { ComponentAttrs } from 'flarum/common/Component';
import DiscussionListItem from 'flarum/forum/components/DiscussionListItem';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import type Mithril from 'mithril';
import { ValueOrArray } from '@askvortsov/rich-icu-message-formatter';
import Model from 'flarum/common/Model';

export default class MoreDiscussions<CustomAttrs> extends Component {
  loading: boolean = false;
  discussions: Array<Model> = [];
  limit: number = 0;
  blockName: ValueOrArray<string> = '';
  filterBy: string = '';

  oninit(vnode: Mithril.Vnode<CustomAttrs, this>) {
    super.oninit(vnode);

    this.loading = true;
    this.discussions = [];
    this.limit = app.forum.attribute('datlechin-more-discussions.discussionLimit') || 5;
    this.filterBy = app.forum.attribute('datlechin-more-discussions.filterBy');
    this.blockName =
      app.forum.attribute('datlechin-more-discussions.blockName') || app.translator.trans('datlechin-more-discussions.forum.block_default_name');

    this.load();
  }

  view(vnode: Mithril.Vnode<CustomAttrs, this>) {
    const discussions = this.discussions;
    return (
      <>
        <div className="DiscussionList">
          <h2 className="MoreDiscussions-title">{m.trust(this.blockName)}</h2>
          <ul role="feed" aria-busy={this.loading} className="DiscussionList-discussions">
            {this.loading ? (
              <LoadingIndicator />
            ) : (
              discussions.map((discussion) => (
                <li key={discussion.id()} data-id={discussion.id()} role="article" aria-setsize="-1">
                  <DiscussionListItem discussion={discussion} params={{}} />
                </li>
              ))
            )}
          </ul>
        </div>
      </>
    );
  }

  load() {
    app.store
      .find('discussions', {
        page: {
          limit: this.limit,
        },
        sort: this.filterBy,
      })
      .then((results) => {
        this.discussions = results;
        this.loading = false;
        m.redraw();
      });
  }
}
