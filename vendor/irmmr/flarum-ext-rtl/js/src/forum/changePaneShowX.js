import app from 'flarum/app';
import DiscussionListPane from 'flarum/components/DiscussionListPane';
import DiscussionPage from 'flarum/components/DiscussionPage';

/*
 * see here: https://github.com/flarum/core/blob/master/js/src/forum/components/DiscussionListPane.js
 */

/**
 * new version of hotEdge
 * @param e
 */
const hotEdgeRtl = (e) => {
    let width   = document.body.offsetWidth;
    let fip     = width * 95 / 100;
    let ex      = e.pageX;

    if (ex >= fip) {
        app.pane.show();
    }
}

export default function () {
    /**
     * @param vnode
     */
    DiscussionListPane.prototype.onremove = (vnode) => {
        app.cache.discussionListPaneScrollTop = $(vnode.dom).scrollTop();
        $(document).off('mousemove', hotEdgeRtl);
    }

    /**
     * @param vnode
     */
    DiscussionListPane.prototype.oncreate = (vnode) => {
        const $list = $(vnode.dom);
        const pane  = app.pane;

        $list.hover(pane.show.bind(pane), pane.onmouseleave.bind(pane));
        $(document).on('mousemove', hotEdgeRtl);

        if (app.previous.matches(DiscussionPage)) {
            const top = app.cache.discussionListPaneScrollTop || 0;

            $list.scrollTop(top);
        } else {
            const $discussion = $list.find('.DiscussionListItem.active');

            if ($discussion.length) {
                const listTop           = $list.offset().top;
                const listBottom        = listTop + $list.outerHeight();
                const discussionTop     = $discussion.offset().top;
                const discussionBottom  = discussionTop + $discussion.outerHeight();

                if (discussionTop < listTop || discussionBottom > listBottom) {
                    $list.scrollTop($list.scrollTop() - listTop + discussionTop);
                }
            }
        }
    }
}