import type Mithril from 'mithril';
import app from 'flarum/forum/app';
import highlight from 'flarum/common/helpers/highlight';
import Search from "flarum/forum/components/Search";
import type Discussion from "flarum/common/models/Discussion";
import Button from "flarum/common/components/Button";

export default class DiscussionSearchSource implements Search {
  protected results = new Map<string, unknown[]>();
  protected onSelect!: (discussion: Discussion) => void;
  protected ignore!: number;

  constructor(onSelect: (discussion: Discussion) => void, ignore: number) {
    this.results = new Map();

    this.onSelect = onSelect;
    this.ignore = ignore;
  }

  search(query: string) {
    query = query.toLowerCase();

    this.results.set(query, []);

    const params = {
      filter: { q: query },
      page: { limit: 3 },
    };

    const id = Number(query);

    if (!Number.isNaN(id) && id !== this.ignore) {
      return app.store
        .find('discussions', id)
        .then((d) => {
          this.results.set(query, [d]);
        })
        .catch(() => []);
    }

    return app.store.find('discussions', params).then((results) => {
      this.results.set(
        query,
        results.filter((d: Discussion) => d.id() !== this.ignore)
      );
    });
  }

  // @ts-ignore
  view(query: string): Mithril.Children {
    query = query.toLowerCase();

    return ((this.results.get(query) || []) as Discussion[]).map((discussion: Discussion) => {
      return (
        <li className="DiscussionSearchResult" data-index={'discussions' + discussion.id()}>
          <Button onclick={() => this.onSelect(discussion)}>
            {/* @ts-ignore */}
            <div className="DiscussionSearchResult-id">{discussion.id()}</div>
            <div className="DiscussionSearchResult-title">{highlight(discussion.title(), query)}</div>
          </Button>
        </li>
      );
    }) as Array<Mithril.Vnode>;
  }
}
