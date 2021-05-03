import humanTime from 'flarum/utils/humanTime';
import Component from 'flarum/Component';
import classList from 'flarum/utils/classList';
import extractText from 'flarum/utils/extractText';
import SubtreeRetainer from 'flarum/utils/SubtreeRetainer';

import ChatAvatar from './ChatAvatar';

export default class ChatPreview extends Component {
    oninit(vnode) {
        super.oninit(vnode);

        this.model = this.attrs.model;

        this.subtree = new SubtreeRetainer(
            () => this.model.freshness,
            () => app.chat.getCurrentChat(),

            // Reactive attrs
            () => this.model.isNeedToFlash
        );
    }

    onbeforeupdate(vnode) {
        super.onbeforeupdate(vnode);
        this.model = this.attrs.model;

        return this.subtree.needsRebuild();
    }

    view(vnode) {
        return (
            <div style={{ position: 'relative' }}>
                <div className={classList({ 'panel-preview': true, active: app.chat.getCurrentChat() == this.model })}>{this.componentPreview()}</div>
                {this.model.unreaded() ? <div className="unreaded">{this.model.unreaded()}</div> : null}
            </div>
        );
    }

    oncreate(vnode) {
        if (this.model.isNeedToFlash) {
            app.chat.flashItem($(vnode.dom));
            this.model.isNeedToFlash = false;
        }
    }

    onupdate(vnode) {
        if (this.model.isNeedToFlash) {
            app.chat.flashItem($(vnode.dom));
            this.model.isNeedToFlash = false;
        }
    }

    componentMessageTime() {
        let lastMessage = this.model.last_message();
        let time = new Date(lastMessage.created_at());
        if (Date.now() - time.getTime() < 60 * 60 * 12 * 1000) return time.toLocaleTimeString().slice(0, 5);

        return humanTime(lastMessage.created_at());
    }

    componentPreview() {
        return [
            <ChatAvatar model={this.model} />,
            <div class="previewBody">
                <div className="title" title={this.model.title()}>
                    {this.model.icon() ? <i class={this.model.icon()} style={{ color: this.model.color() }}></i> : null}
                    {this.model.title()}
                </div>
                {this.model.last_message() ? this.componentTextPreview() : this.componentTextEmpty()}
            </div>,
            this.model.last_message() ? (
                <div className="timestamp" title={extractText(this.model.last_message().created_at())}>
                    {(this.humanTime = this.componentMessageTime())}
                </div>
            ) : null,
        ];
    }

    componentPreviewChannel() {
        return [
            <ChatAvatar model={this.model} />,
            <div style="display: flex; flex-direction: column">
                <div className="title" title={this.model.title()}>
                    {this.model.title()}
                </div>
                {this.componentTextPreview()}
            </div>,
            <div className="timestamp" title={extractText(this.model.last_message().created_at())}>
                {(this.humanTime = this.componentMessageTime())}
            </div>,
        ];
    }

    formatTextPreview(text) {
        let type;
        if (text.startsWith('```')) {
            text = app.translator.trans('xelson-chat.forum.chat.message.type.code');
            type = 'media';
        } else if (text.startsWith('http://') || text.startsWith('https://')) {
            text = app.translator.trans('xelson-chat.forum.chat.message.type.url');
            type = 'media';
        }
        return { text, type };
    }

    componentTextPreview() {
        let lastMessage = this.model.last_message();
        if (lastMessage.type() != 0) {
            return (
                <div className="message">
                    <span className="media">{app.translator.trans('xelson-chat.forum.chat.message.type.event')}</span>
                </div>
            );
        }

        let formatResult = this.formatTextPreview(lastMessage.message());
        let senderName,
            users = this.model.users(),
            sender = lastMessage.user();
        if (app.session.user) {
            if (app.session.user == sender) senderName = `${app.translator.trans('xelson-chat.forum.chat.message.you')}: `;
            else if (users.length > 2 || this.model.type()) senderName = sender.displayName() + ': ';
        }

        return (
            <div
                className={classList({ message: true, censored: lastMessage.is_censored() })}
                title={lastMessage.is_censored() ? app.translator.trans('xelson-chat.forum.chat.message.censored') : null}
            >
                <span className="sender">{senderName}</span>
                <span className={formatResult.type}>{formatResult.text}</span>
            </div>
        );
    }

    componentTextEmpty() {
        return (
            <div className="message">
                <span className="empty">{app.translator.trans('xelson-chat.forum.chat.list.preview.empty')}</span>
            </div>
        );
    }
}
