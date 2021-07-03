import {ClassComponent, Vnode} from 'mithril';
import app from 'flarum/forum/app';
import LinkButton from 'flarum/common/components/LinkButton';
import Round from '../models/Round';

const translationPrefix = 'clarkwinkelmann-catch-the-fish.forum.round-alert.';

interface UpdateAlertAttrs {
    round: Round
}

export default class UpdateAlert implements ClassComponent<UpdateAlertAttrs> {
    view(vnode: Vnode<UpdateAlertAttrs, this>) {
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
