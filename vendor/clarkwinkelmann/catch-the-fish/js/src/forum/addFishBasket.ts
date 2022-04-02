import {extend} from 'flarum/common/extend';
import ItemList from 'flarum/common/utils/ItemList';
import HeaderPrimary from 'flarum/forum/components/HeaderPrimary';
import Basket from './components/Basket';

export default function () {
    extend(HeaderPrimary.prototype, 'items', function (items: ItemList) {
        items.add('catchthefish-basket', m(Basket));
    });
}
