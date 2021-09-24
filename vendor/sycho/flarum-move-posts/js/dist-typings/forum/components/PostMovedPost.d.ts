/// <reference types="mithril" />
import EventPost from 'flarum/forum/components/EventPost';
export default class PostMovedPost extends EventPost {
    icon(): string;
    descriptionKey(): string;
    descriptionData(): {
        target_discussion: JSX.Element;
        count: any;
    };
}
