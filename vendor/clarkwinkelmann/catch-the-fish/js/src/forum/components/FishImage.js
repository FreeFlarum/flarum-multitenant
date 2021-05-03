import app from 'flarum/app';
import extractText from 'flarum/common/utils/extractText';

/* global m */

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.fish-image.';

export default class FishImage {
    view(vnode) {
        const src = vnode.attrs.fish.image_url();

        if (src) {
            return m('img.catchthefish-image', {
                alt: extractText(app.translator.trans(translationPrefix + 'alt', {
                    name: vnode.attrs.fish.name(),
                })),
                src,
                style: {
                    animationDuration: vnode.attrs.animationDuration || '10s',
                },
            });
        }

        return m('.catchthefish-no-image', app.translator.trans(translationPrefix + 'missing'));
    }
}
