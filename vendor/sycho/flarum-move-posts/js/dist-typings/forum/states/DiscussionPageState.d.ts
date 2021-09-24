import type StreamType from 'mithril/stream';
export default class DiscussionPageState {
    selectedPostsToMove: StreamType;
    constructor();
    push(postId: number): void;
    remove(postId: number): void;
    has(postId: number): boolean;
}
