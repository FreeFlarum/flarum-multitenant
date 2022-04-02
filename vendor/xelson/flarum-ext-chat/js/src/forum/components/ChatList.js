import Component from 'flarum/Component';
import ChatCreateModal from './ChatCreateModal';
import ChatPreview from './ChatPreview';

export default class ChatFrame extends Component {
    view(vnode) {
        const classes = ['ChatList'];
        if (app.chat.getFrameState('beingShownChatsList') || this.attrs.inPage) classes.push('toggled');
        return (
            <div className={classes.join(' ')}>
                <div className="header">
                    <div className="input-wrapper input--down">
                        <input id="chat-find" bidi={app.chat.q} placeholder={app.translator.trans('xelson-chat.forum.chat.list.placeholder')} />
                    </div>
                    <div
                        className="icon icon-minimize"
                        onclick={this.toggleChat.bind(this)}
                        data-title={app.translator.trans(
                            'xelson-chat.forum.toolbar.' + (app.chat.getFrameState('beingShown') ? 'minimize' : 'maximize')
                        )}
                    >
                        <i className={app.chat.getFrameState('beingShown') ? 'fas fa-window-minimize' : 'fas fa-window-maximize'}></i>
                    </div>
                    {this.attrs.inPage ? (
                        ''
                    ) : (
                        <div
                            className="ToggleButton icon icon-toggle"
                            onclick={this.toggleChatsList.bind(this)}
                            data-title={app.translator.trans(
                                'xelson-chat.forum.chat.list.' + (app.chat.getFrameState('beingShownChatsList') ? 'unpin' : 'pin')
                            )}
                        >
                            <i className="fas fa-paperclip"></i>
                        </div>
                    )}
                </div>
                <div className="list">
                    {this.content()}
                    {app.session.user && app.chat.getPermissions().create.chat ? (
                        <div class="panel-add" onclick={() => app.modal.show(ChatCreateModal)}></div>
                    ) : null}
                </div>
            </div>
        );
    }

    content() {
        return app.chat.getChatsSortedByLastUpdate().map((model) => (
            <div onclick={this.onChatPreviewClicked.bind(this, model)}>
                <ChatPreview key={model.id()} model={model} />
            </div>
        ));
    }

    onChatPreviewClicked(model, e) {
        e.redraw = false;
        if (app.screen() == 'phone') app.chat.toggleChatsList();
        app.chat.onChatChanged(model);
    }

    toggleChatsList(e) {
        app.chat.toggleChatsList();

        e.preventDefault();
        e.stopPropagation();
    }

    toggleChat(e) {
        app.chat.toggleChat();

        e.preventDefault();
        e.stopPropagation();
    }
}
