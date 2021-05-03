import {extend} from 'flarum/common/extend';
import HeaderPrimary from 'flarum/forum/components/HeaderPrimary';
import Basket from './components/Basket';

/* global m */

export default function () {
    extend(HeaderPrimary.prototype, 'items', items => {
        items.add('catchthefish-basket', m(Basket));
    });
}
