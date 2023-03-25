import type StreamType from 'mithril/stream';
import Stream from 'flarum/common/utils/Stream';

export default class DiscussionPageState {
  public selectedPostsToMove: StreamType;

  constructor() {
    this.selectedPostsToMove = Stream([]);
  }

  push(postId: number): void {
    this.selectedPostsToMove([...this.selectedPostsToMove(), postId]);
  }

  remove(postId: number): void {
    this.selectedPostsToMove(this.selectedPostsToMove().filter((id: number) => id !== postId));
  }

  has(postId: number): boolean {
    return this.selectedPostsToMove().includes(postId);
  }
}
