
import app from 'flarum/forum/app';
import Component from 'flarum/common/Component';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import classList from 'flarum/common/utils/classList';
import extractText from 'flarum/common/utils/extractText';

export default class TagList extends Component {
    oninit(vnode) {
      super.oninit(vnode);
    }

    view() {
        const user = this.attrs.user;

        let tags = ``;
        let tagList = user.tagList().split(",");

        if(tagList.length > 0) {
            for(let tag of tagList) {
                tags += `<span class="userTag">${tag}</span>`;
            }
        }

        return (
            <div className="userTags">
                {m.trust(tags)}
            </div>
        );
    }
}