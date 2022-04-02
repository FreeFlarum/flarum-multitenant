import {ClassComponent} from 'mithril';
import app from 'flarum/forum/app';
import User from 'flarum/common/models/User';
import FishImage from './FishImage';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.basket.';

export default class Basket implements ClassComponent {
    view() {
        if (!app.session.user) {
            return m('div');
        }

        const basket = (app.session.user as User).catchTheFishBasket();

        if (!basket) {
            return m('div');
        }

        const fishesThatCanBePlaced = basket.filter(fish => fish.canPlace());

        if (fishesThatCanBePlaced.length === 0) {
            return m('div');
        }

        return m('.catchthefish-basket', [
            m('.catchthefish-basket-title', app.translator.trans(translationPrefix + 'title')),
            m('p', app.translator.trans(translationPrefix + 'drag-help')),
            fishesThatCanBePlaced.map(fish => m('.catchthefish-basket-entry', [
                m('.catchthefish-basket-fish', {
                    draggable: true,
                    ondragstart(event: DragEvent) {
                        if (!event.dataTransfer) {
                            return;
                        }

                        event.dataTransfer.setData('text/plain', 'fish:' + fish.id());
                    },
                }, m(FishImage, {
                    fish,
                })),
                m('.catchthefish-basket-time', app.translator.trans(translationPrefix + 'time', {
                    time: dayjs(fish.placeUntil()).fromNow(),
                })),
            ])),
        ]);
    }
}
