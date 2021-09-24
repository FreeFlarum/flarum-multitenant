/// <reference types="mithril" />
import Modal from 'flarum/common/components/Modal';
export default class MovePostsModal extends Modal {
    oninit(vnode: any): void;
    className(): string;
    title(): any;
    content(): JSX.Element;
    data(): Record<string, unknown>;
    emulate(): void;
    onsubmit(e: any, emulate: boolean): any;
}
