import { extend } from 'flarum/extend';
import app from 'flarum/app';
import EditUserModal from 'flarum/common/components/EditUserModal';
import Model from 'flarum/Model';
import User from 'flarum/common/models/User';
import extractText from 'flarum/common/utils/extractText';
import Stream from 'flarum/common/utils/Stream';
import UserCard from 'flarum/forum/components/UserCard';
import PostUser from 'flarum/forum/components/PostUser';
import TagList from './components/tagList';


// From: https://github.com/clarkwinkelmann/flarum-ext-circle-groups/blob/f5c17aa696ef906f05e8b0fbe6d369f20e56ecb3/js/src/forum/index.js#L8
function matchTag(tag) {
    return node => node && node.tag && node.tag === tag;
}

app.initializers.add('serakoi/flarumstaffbadge', () => {
    User.prototype.staffBadge = Model.attribute('staffBadge');
    User.prototype.tagList = Model.attribute('tagList');

    extend(PostUser.prototype, 'oncreate', function (_out,vnode) {
        const user = this.attrs.post.user();

        if(!user) return;
        const data = user.data.attributes;
        const badge = data.staffBadge;
        if(!badge) return;
        if(badge.toLowerCase() !== "true") return;

        let staffBadgeText = app.forum.attribute('staffBadgeTitle')?.toString();
        let staffBadgeColor = app.forum.attribute('staffBadgeColor')?.toString();
        let staffBadgeBg = app.forum.attribute('staffBadgeBg')?.toString();
        if(!staffBadgeText) staffBadgeText = "STAFF";
        if(staffBadgeText == "") staffBadgeText = "STAFF";
        if(!staffBadgeBg) staffBadgeBg = "rgb(70, 209, 96)";
        if(staffBadgeBg == "") staffBadgeBg = "rgb(70, 209, 96)";
        if(!staffBadgeColor) staffBadgeColor = "#fff";
        if(staffBadgeColor == "") staffBadgeColor = "#fff";

        const anchor = vnode.dom;

        if(!anchor) return console.log('No anchor found');
        const newEl = document.createElement('div');
        newEl.className = 'badgeHolder';
        newEl.innerHTML = `<div style="background-color:${staffBadgeBg};color:${staffBadgeColor}" class="ext_staffbadge_sm">
            ${staffBadgeText}
        </div>`;

        anchor.appendChild(newEl);
        
        
    });

    extend(UserCard.prototype, 'oncreate', function(_out, vnode) {
        const card_user = this.attrs.user.data.attributes;
        if(card_user.staffBadge){
            if(card_user.staffBadge.toLowerCase() === "true"){
                let staffBadgeText = app.forum.attribute('staffBadgeTitle')?.toString();
                let staffBadgeColor = app.forum.attribute('staffBadgeColor')?.toString();
                let staffBadgeBg = app.forum.attribute('staffBadgeBg')?.toString();
                if(!staffBadgeText) staffBadgeText = "STAFF";
                if(staffBadgeText == "") staffBadgeText = "STAFF";
                if(!staffBadgeBg) staffBadgeBg = "rgb(70, 209, 96)";
                if(staffBadgeBg == "") staffBadgeBg = "rgb(70, 209, 96)";
                if(!staffBadgeColor) staffBadgeColor = "#fff";
                if(staffBadgeColor == "") staffBadgeColor = "#fff";
                const userCardDom = vnode.dom;
                const avatarDom = userCardDom.querySelector('.UserCard-avatar');
                const avatarStaffElement = document.createElement("div");
                avatarStaffElement.classList.add("ext_staffbadge");
                avatarStaffElement.style.color = staffBadgeColor;
                avatarStaffElement.style.backgroundColor = staffBadgeBg;
                avatarStaffElement.innerText = staffBadgeText;
                avatarDom.append(avatarStaffElement);
            }
        }
    });

    extend(UserCard.prototype, 'infoItems', function(items){
        let user = this.attrs.user;
        if(!user.attribute('tagList')) return;

        let tags = user.attribute('tagList').split(',');
        if(tags.length === 0) return;
        items.add('tagList',<TagList user={user}/>)
    });

    extend(EditUserModal.prototype, 'oninit', function () {
        this.status = Stream(this.attrs.user?.staffBadge() || '');
        this.tagList = Stream(this.attrs.user?.tagList() || '');
    });

    extend(EditUserModal.prototype, 'fields', function (items) {
        items.add('hasbadge',
            <div className="Form-group">
                <label>{app.translator.trans('serakoi-flarumstaffbadge.forum.edit_user.heading')}</label>
                <input className="FormControl"
                    placeholder={extractText(app.translator.trans('serakoi-flarumstaffbadge.forum.edit_user.placeholder'))}
                    bidi={this.status} />
            </div>, 100)
        items.add('tagList',
            <div className="Form-group">
                <label>{app.translator.trans('serakoi-flarumstaffbadge.forum.edit_user.tagList.heading')}</label>
                <input className="FormControl"
                    placeholder={extractText(app.translator.trans('serakoi-flarumstaffbadge.forum.edit_user.tagList.placeholder'))}
                    bidi={this.tagList} />
            </div>, 100)
    });

    extend(EditUserModal.prototype, 'data', function (data) {
        data.staffBadge = this.status();
        data.tagList = this.tagList();
    });
});
