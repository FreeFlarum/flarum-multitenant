import Search, { SearchAttrs } from 'flarum/forum/components/Search';
import ItemList from 'flarum/common/utils/ItemList';
import DiscussionSearchSource from './DiscussionSearchSource';
import type Discussion from "flarum/common/models/Discussion";

export interface DiscussionSearchAttrs extends SearchAttrs {
  onSelect: (discussion: Discussion) => void;
  ignore: number;
}

export default class DiscussionSearch<T extends DiscussionSearchAttrs> extends Search<T> {
  view() {
    this.hasFocus = true;

    const vdom = super.view();

    // @ts-ignore
    vdom.attrs.className = `UiKit-Search ${this.state.getValue() && 'open'} ` + vdom.attrs.className.replace(/(focused|open)/g, '');

    return vdom;
  }

  sourceItems() {
    const items = new ItemList();

    items.add('discussions', new DiscussionSearchSource((discussion: Discussion) => {
      this.state.setValue(discussion.title());
      this.attrs.onSelect(discussion);
    }, this.attrs.ignore));

    return items;
  }
}
