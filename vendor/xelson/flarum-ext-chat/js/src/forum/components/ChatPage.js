import Page from 'flarum/common/components/Page';
import IndexPage from 'flarum/components/IndexPage';
import LoadingIndicator from 'flarum/components/LoadingIndicator';
import listItems from 'flarum/helpers/listItems';
import Stream from 'flarum/utils/Stream';
import ChatHeader from './ChatHeader';
import ChatList from './ChatList';
import ChatViewport from './ChatViewport';

export default class ChatPage extends Page {
    oninit(vnode) {
        super.oninit(vnode);

        this.bodyClass = 'App--chat';
        this.listOpen = Stream(false);
    }

    view() {
        const navItems = IndexPage.prototype.sidebarItems();

        if (navItems.has('forumStatisticsWidget')) navItems.remove('forumStatisticsWidget');

        return (
            <div className="ChatPage">
                <nav className="IndexPage-nav sideNav">
                    <ul>{listItems(navItems.toArray())}</ul>
                </nav>
                <ChatHeader showChatListStream={this.listOpen}></ChatHeader>
                {app.chat.chatsLoading ? <LoadingIndicator></LoadingIndicator> : <ChatViewport chatModel={app.chat.getCurrentChat()}></ChatViewport>}
                {this.listOpen() ? (
                    <div class="ChatPage--list">
                        <ChatList inPage={true}></ChatList>
                    </div>
                ) : (
                    ''
                )}
            </div>
        );
    }

    oncreate(vnode) {
        super.oncreate(vnode);

        this.clickHandler = (e) => {
            const chatList = this.$('.ChatList')[0];

            if (this.listOpen() && !(chatList && chatList.contains(e.target))) {
                this.listOpen(false);
                m.redraw();
            }
        };

        $(window).on('click', this.clickHandler);
    }

    onupdate(vnode) {
        super.onupdate(vnode);
        if (this.listOpen()) {
            this.element.querySelector('.ChatPage--list').style.height =
                document.documentElement.clientHeight - this.element.querySelector('.ChatPage--list').getBoundingClientRect().top + 'px';
        }
    }

    onremove(vnode) {
        super.onremove(vnode);

        $(window).off('click', this.clickHandler);
    }
}
