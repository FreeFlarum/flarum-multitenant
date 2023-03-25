import Component from 'flarum/common/Component';
import type Mithril from 'mithril';
import { ValueOrArray } from '@askvortsov/rich-icu-message-formatter';
import Model from 'flarum/common/Model';
export default class MoreDiscussions<CustomAttrs> extends Component {
    loading: boolean;
    discussions: Array<Model>;
    limit: number;
    blockName: ValueOrArray<string>;
    filterBy: string;
    oninit(vnode: Mithril.Vnode<CustomAttrs, this>): void;
    view(vnode: Mithril.Vnode<CustomAttrs, this>): JSX.Element;
    load(): void;
}
