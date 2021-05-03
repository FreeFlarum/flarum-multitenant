import Component from 'flarum/Component';
import classList from 'flarum/utils/classList';

export default class ChatAvatar extends Component {
    oninit(vnode) {
        super.oninit(vnode);

        this.model = this.attrs.model;
    }

    componentAvatarPM() {
        return (
            <div
                className={classList({ avatar: true, image: this.model.avatarUrl() })}
                style={{
                    'background-color': this.model.color(),
                    color: this.model.textColor(),
                    'background-image': this.model.avatarUrl() ? `url(${this.model.avatarUrl()})` : null,
                }}
            >
                {this.model.icon() ? (
                    <i class={this.model.icon()}></i>
                ) : this.model.avatarUrl() ? null : (
                    this.firstLetter(this.model.title()).toUpperCase()
                )}
            </div>
        );
    }

    componentAvatarChannel() {
        return (
            <div className="avatar" style={{ 'background-color': this.model.color(), color: this.model.textColor() }}>
                {this.model.icon() ? (
                    <i class={this.model.icon()}></i>
                ) : this.model.avatarUrl() ? null : (
                    this.firstLetter(this.model.title()).toUpperCase()
                )}
            </div>
        );
    }

    view(vnode) {
        return this.model.type() == 1 ? this.componentAvatarChannel() : this.componentAvatarPM();
    }

    firstLetter(string) {
        for (let i = 0; i < string.length; i++) {
            if (this.isLetter(string[i])) return string[i];
        }
        return string[0];
    }

    isLetter(c) {
        return c.toLowerCase() != c.toUpperCase();
    }
}
