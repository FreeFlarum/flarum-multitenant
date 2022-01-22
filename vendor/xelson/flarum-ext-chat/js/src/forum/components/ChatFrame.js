import Component from 'flarum/Component';
import LoadingIndicator from 'flarum/components/LoadingIndicator';
import ChatHeader from './ChatHeader';
import ChatList from './ChatList';
import ChatPage from './ChatPage';
import ChatViewport from './ChatViewport';

export default class ChatFrame extends Component {
    oninit(vnode) {
        super.oninit(vnode);

        document.addEventListener('mousedown', this.chatMoveListener.bind(this, 'mousedown'));
        document.addEventListener('mouseup', this.chatMoveListener.bind(this, 'mouseup'));
    }

    oncreate(vnode) {
        super.oncreate(vnode);
    }

    calcHeight() {
        if (!app.chat.getFrameState('beingShown')) {
            return '30px';
        } else if (app.screen() !== 'phone') {
            return app.chat.getFrameState('transform').y + 'px';
        } else {
            return '70vh';
        }
    }

    view(vnode) {
        if (app.current.matches(ChatPage)) return;

        const style = { right: app.chat.getFrameState('transform').x + 'px', height: this.calcHeight() };

        return (
            <div className={'NeonChatFrame ' + (app.chat.getFrameState('beingShown') ? '' : 'hidden')} style={style}>
                <div tabindex="0" className="frame" id="chat">
                    <ChatList></ChatList>

                    <div id="chat-panel">
                        <ChatHeader ondragstart={() => false} onmousedown={this.chatHeaderOnMouseDown.bind(this)} inFrame={true}></ChatHeader>
                        {app.chat.chatsLoading ? (
                            <LoadingIndicator></LoadingIndicator>
                        ) : (
                            <ChatViewport chatModel={app.chat.getCurrentChat()}></ChatViewport>
                        )}
                    </div>
                </div>
            </div>
        );
    }

    chatHeaderOnMouseDown(e) {
        if (e.button !== 0) return;

        var path = e.path || (e.composedPath && e.composedPath());
        if (path) {
            for (let i = 0, el; i < path.length; i++) {
                el = path[i];
                if (el.classList && el.classList.contains('icon')) return;
            }
        }

        if (!this.chatMoveStart(e)) {
            e.stopPropagation();
            e.preventDefault();
        }
    }

    chatMoveListener(event, e) {
        switch (event) {
            case 'mouseup': {
                if (this.chatMoving) this.chatMoveEnd(e);
                break;
            }
        }
    }

    chatMoveStart(e) {
        if (!app.chat.getFrameState('beingShown')) return;
        this.chatMoving = true;
        this.mouseMoveEvent = this.chatMoveProcess.bind(this);
        this.moveLast = { x: e.clientX, y: e.clientY };

        document.addEventListener('mousemove', this.mouseMoveEvent);
        document.body.classList.add('moving');

        return false;
    }

    chatMoveEnd(e) {
        this.chatMoving = false;
        document.removeEventListener('mousemove', this.mouseMoveEvent);
        document.body.classList.remove('moving');

        if (!app.current.matches(ChatPage)) {
            app.chat.saveFrameState('transform', { x: parseInt(this.element.style.right), y: this.element.offsetHeight || 400 });
        }
    }

    chatMoveProcess(e) {
        let move = { x: e.clientX - this.moveLast.x, y: e.clientY - this.moveLast.y };
        let right = parseInt(this.element.style.right) || 0;
        let nextPos = { x: right - move.x, y: this.element.offsetHeight - move.y };

        if ((nextPos.x < window.innerWidth - this.element.querySelector('#chat').offsetWidth && move.x < 0) || (nextPos.x > 0 && move.x > 0))
            this.element.style.right = nextPos.x + 'px';

        if (this.element.querySelector('.ChatHeader').clientHeight < nextPos.y && nextPos.y < window.innerHeight - 100) {
            this.element.style.height = nextPos.y + 'px';
        }

        this.moveLast = { x: e.clientX, y: e.clientY };
    }
}
