import Component, { ComponentAttrs } from 'flarum/common/Component';
import { Children, Vnode } from 'mithril';
interface MobileTabItemAttrs extends ComponentAttrs {
    route: string;
    icon: string;
    label: string;
}
export default class MobileTabItem extends Component {
    attrs: MobileTabItemAttrs;
    view(vnode: Vnode<MobileTabItemAttrs, this>): Children;
}
export {};
