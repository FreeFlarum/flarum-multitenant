import app from 'flarum/app';
import LinkButton from 'flarum/common/components/LinkButton';

/* global m, dayjs */

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.round-alert.';

export default class UpdateAlert {
    view(vnode) {
        return m('.Alert.Alert-info', m('.container', [
            m('span.Alert-body', [
                app.translator.trans(translationPrefix + 'message', {
                    name: vnode.attrs.round.name(),
                    time: dayjs(vnode.attrs.round.ends_at()).calendar(),
                }),
            ]),
            app.forum.catchTheFishCanSeeRankingsPage() ? m('ul.Alert-controls', m('li', LinkButton.component({
                href: app.route('catchTheFishRankings'),
            }, app.translator.trans(translationPrefix + 'rankings')))) : null,
        ]));
    }
}
