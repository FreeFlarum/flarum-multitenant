import app from 'flarum/app';
import FishImage from './FishImage';

/* global m, dayjs */

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.basket.';

export default class Basket {
    view() {
        if (!app.session.user) {
            return m('div');
        }

        const basket = app.session.user.catchTheFishBasket();

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
                    ondragstart(event) {
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
