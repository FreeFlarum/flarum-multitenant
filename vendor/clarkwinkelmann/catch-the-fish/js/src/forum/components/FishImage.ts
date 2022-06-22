import {ClassComponent, Vnode} from 'mithril';
import app from 'flarum/forum/app';
import extractText from 'flarum/common/utils/extractText';
import Fish from '../models/Fish';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.fish-image.';

interface FishImageAttrs {
    fish: Fish
    animationDuration?: string
}

export default class FishImage implements ClassComponent<FishImageAttrs> {
    view(vnode: Vnode<FishImageAttrs, this>) {
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
                draggable: false, // Without this, browsers somehow drag the image URL across windows instead of the drop data
            });
        }

        return m('.catchthefish-no-image', app.translator.trans(translationPrefix + 'missing'));
    }
}
