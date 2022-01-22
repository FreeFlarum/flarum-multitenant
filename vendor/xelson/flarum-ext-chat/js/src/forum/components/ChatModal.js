import Modal from 'flarum/components/Modal';
import ChatSearchUser from './ChatSearchUser';
import Stream from 'flarum/utils/Stream';
import classList from 'flarum/utils/classList';
import { fa5IconsList } from '../resources';
import highlight from 'flarum/helpers/highlight';

export default class ChatModal extends Modal {
    oninit(vnode) {
        super.oninit(vnode);

        this.model = this.attrs.model;

        app.search.neonchat = { usersSelected: [] };
        this.usersSelected = app.search.neonchat.usersSelected;

        this.input = {
            title: Stream(''),
            color: Stream(''),
            icon: Stream(''),
            iconState: {
                matches: [],
                lastInput: null,
            },
        };
    }

    onremove(vnode) {
        super.onremove(vnode);
        app.search.neonchat = null;
    }

    getInput() {
        return this.input;
    }

    setSelectedUsers(users) {
        app.search.neonchat.usersSelected = users;
        this.usersSelected = app.search.neonchat.usersSelected;
    }

    getSelectedUsers() {
        return this.usersSelected;
    }

    className() {
        return 'ChatModal Modal--small';
    }

    isChatExists() {
        return this.getSelectedUsers().length === 1 && app.chat.isExistsPMChat(app.session.user, this.getSelectedUsers()[0]);
    }

    alertText() {
        if (this.isChatExists()) return app.translator.trans('xelson-chat.forum.chat.list.add_modal.alerts.exists');

        return null;
    }

    componentAlert() {
        return !this.alertText() ? null : <div className="Alert">{this.alertText()}</div>;
    }

    componentFormUsersSelect(label = 'xelson-chat.forum.chat.list.add_modal.form.users') {
        return [<label>{app.translator.trans(label)}</label>, this.componentUsersSelect()];
    }

    userMentionContent(user) {
        return '@' + user.displayName();
    }

    userMentionClassname(user) {
        return 'deletable';
    }

    userMentionOnClick(event, user) {
        return this.getSelectedUsers().splice(this.getSelectedUsers().indexOf(user), 1);
    }

    componentUsersMentions() {
        return (
            <div className="UsersTags">
                {this.getSelectedUsers().map((u) => (
                    <div className={classList(['UserMention', this.userMentionClassname(u)])} onclick={this.userMentionOnClick.bind(this, u)}>
                        {this.userMentionContent(u)}
                    </div>
                ))}
            </div>
        );
    }

    componentUsersSelect() {
        return [
            this.componentAlert(),
            this.componentUsersMentions(),
            <div className="UsersSearch">
                <ChatSearchUser state={app.search} />
            </div>,
        ];
    }

    componentFormIcon(options) {
        return [
            options.title ? <label>{options.title}</label> : null,
            <div className="IconSearch">
                {options.desc ? <label>{options.desc}</label> : null}
                <div className="Icon-Input IconSearchResult">
                    <input
                        class="FormControl"
                        type="text"
                        bidi={options.stream}
                        placeholder={options.placeholder}
                        onupdate={this.formInputOnUpdate.bind(this)}
                        onfocus={() => (this.inputIconHasFocus = true)}
                        onclick={() => (this.inputIconHasFocus = true)}
                        onkeypress={(e) => (this.inputIconHasFocus = !(e.keyCode == 13))}
                    />
                    <icon className="Chat-FullColor">
                        <i className={this.input.icon()?.length ? this.input.icon() : 'fas fa-bolt'} />
                    </icon>
                    {this.inputIconHasFocus ? this.dropdownIconMatches(this.input.icon()) : null}
                </div>
            </div>,
        ];
    }

    componentFormColor(options) {
        return [
            options.title ? <label>{options.title}</label> : null,
            <div>
                {options.desc ? <label>{options.desc}</label> : null}
                <div className="Color-Input">
                    <input
                        class="FormControl"
                        type="text"
                        bidi={options.stream}
                        placeholder={options.placeholder}
                        onupdate={this.formInputOnUpdate.bind(this)}
                    />
                    <color className="Chat-FullColor" />
                </div>
            </div>,
        ];
    }

    dropdownIconMatches(search) {
        let inputIcon = this.input.icon();
        let iconState = this.input.iconState;

        if (inputIcon !== iconState.lastInput) {
            iconState.matches = fa5IconsList.filter((icon) => icon.includes(inputIcon));
            if (iconState.matches.length > 5) iconState.matches = iconState.matches.sort((a, b) => 0.5 - Math.random());

            iconState.lastInput = inputIcon;
        }

        return inputIcon.length && iconState.matches.length > 0 && !(iconState.matches.length == 1 && iconState.matches[0] === inputIcon) ? (
            <ul className="Dropdown-menu Dropdown--Icons Search-results">
                <li className="Dropdown-header">Font Awesome 5</li>
                {iconState.matches.slice(-5).map((icon) => (
                    <li className="IconSearchResult" onclick={(e) => this.input.icon(icon)}>
                        <icon className="Chat-FullColor">
                            <i className={icon}></i>
                        </icon>
                        <span>{highlight(icon, inputIcon)}</span>
                    </li>
                ))}
            </ul>
        ) : null;
    }

    formInputOnUpdate(vnode) {
        $('.Chat-FullColor').css({ color: this.input.color(), backgroundColor: this.input.color() });
    }

    componentFormInput(options) {
        return [
            options.title ? <label>{options.title}</label> : null,
            <div>
                {options.desc ? <label>{options.desc}</label> : null}
                <input class="FormControl" type="text" bidi={options.stream} placeholder={options.placeholder} />
            </div>,
        ];
    }
}
