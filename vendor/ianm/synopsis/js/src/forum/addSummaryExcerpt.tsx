import { extend } from 'flarum/common/extend';
import app from 'flarum/forum/app';
import DiscussionListState from 'flarum/forum/states/DiscussionListState';
import DiscussionListItem from 'flarum/forum/components/DiscussionListItem';
import { truncate } from 'flarum/common/utils/string';
import ItemList from 'flarum/common/utils/ItemList';
import Tag from 'flarum/tags/models/Tag';
import Model from 'flarum/common/Model';
import { getPlainContent } from './util/getPlainContent';

export default function addSummaryExcerpt() {
  if (app.initializers.has('flarum-tags')) {
    Tag.prototype.richExcerpts = Model.attribute('richExcerpts');
    Tag.prototype.excerptLength = Model.attribute('excerptLength');
  }

  extend(DiscussionListState.prototype, 'requestParams', function (params: any) {
    if (app.forum.attribute('synopsis.excerpt_type') === 'first') params.include.push('firstPost');
    else params.include.push('lastPost');
  });

  extend(DiscussionListItem.prototype, 'infoItems', function (items: ItemList) {
    // Skip if we are searching to preserve most relevant post content as excerpt,
    // that way we also preserve highlighting of search terms in the most relevant post.
    if (app.forum.attribute('synopsis.disable_when_searching') && app.discussions.params.q) return;

    const discussion = this.attrs.discussion;

    if (app.session.user && !app.session.user.preferences().showSynopsisExcerpts) {
      return;
    }

    const tags = discussion.tags();
    let tag;
    if (tags) {
      tag = tags[tags.length - 1];
    }

    const excerptPost = app.forum.attribute('synopsis.excerpt_type') === 'first' ? discussion.firstPost() : discussion.lastPost();
    const excerptLength = typeof tag?.excerptLength() === 'number' ? tag?.excerptLength() : app.forum.attribute('synopsis.excerpt_length');
    const richExcerpt = typeof tag?.richExcerpts() === 'number' ? tag?.richExcerpts() : app.forum.attribute('synopsis.rich_excerpts');
    const onMobile = app.session.user ? app.session.user.preferences().showSynopsisExcerptsOnMobile : false;

    // A length of zero means we don't want a synopsis for this discussion, so do nothing.
    if (excerptLength === 0) {
      return;
    }

    if (!excerptPost?.contentHtml?.()) return;
    const content = richExcerpt ? m.trust(truncate(excerptPost.contentHtml(), excerptLength)) : truncate(excerptPost.contentPlain(), excerptLength);

    if (excerptPost) {
      const excerpt = <div>{content}</div>;

      items.add(onMobile ? 'excerptM' : 'excerpt', excerpt, -100);
    }
  });
}
