import Notification from 'flarum/forum/components/Notification';
export default class PostMovedNotification extends Notification {
    icon(): string;
    href(): any;
    content(): any;
}
