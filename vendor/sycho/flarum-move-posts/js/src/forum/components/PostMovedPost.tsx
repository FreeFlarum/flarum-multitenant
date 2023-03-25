import EventPost from 'flarum/forum/components/EventPost';
import Link from 'flarum/common/components/Link';

export default class PostMovedPost extends EventPost {
  icon() {
    return 'fas fa-exchange-alt';
  }

  descriptionKey() {
    return 'sycho-move-posts.forum.post_stream.post_moved';
  }

  descriptionData() {
    const post = this.attrs.post;
    const data: any = post.content();

    return {
      target_discussion: (
        <Link className="EventPost-PostMoved-target" href={app.route('discussion.near', { id: data.targetDiscussionId, near: data.number })}>
          {data.targetDiscussionTitle}
        </Link>
      ),
      count: data.count,
    };
  }
}
