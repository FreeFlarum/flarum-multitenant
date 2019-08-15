import { extend } from 'flarum/extend';
import app from 'flarum/app';
import DiscussionList from 'flarum/components/DiscussionList';
import DiscussionListItem from 'flarum/components/DiscussionListItem';
import { truncate } from 'flarum/utils/string';

export default function addSummaryExcerpt() {
  extend(DiscussionList.prototype, 'requestParams', function(params) {
    params.include.push('firstPost');
  });

  extend(DiscussionListItem.prototype, 'infoItems', function(items) {
    const discussion = this.props.discussion;

    const firstPost = discussion.firstPost();
    const excerptLength = app.forum.attribute('flarum-ext-summaries.excerpt_length') || 200;

    if (firstPost) {
      const excerpt = <span>{truncate(firstPost.contentPlain(), excerptLength)}</span>;

      items.add('excerpt', excerpt, -100);
    }
  });
}
