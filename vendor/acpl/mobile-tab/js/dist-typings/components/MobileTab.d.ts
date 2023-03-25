import Component from 'flarum/common/Component';
import { ComponentAttrs } from 'flarum/common/Component';
import { Vnode, Children } from 'mithril';
import ItemList from 'flarum/common/utils/ItemList';
export default class MobileTab extends Component {
    view(vnode: Vnode<ComponentAttrs, this>): Children;
    items(): ItemList<Children>;
}
