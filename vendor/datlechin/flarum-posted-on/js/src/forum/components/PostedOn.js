import app from 'flarum/forum/app';
import Component from 'flarum/common/Component';
import Tooltip from 'flarum/common/components/Tooltip';
import icon from 'flarum/common/helpers/icon';

export default class PostedOn extends Component {
  oninit(vnode) {
    super.oninit(vnode);
  }

  view() {
    const post = this.attrs.post;

    return (
      <Tooltip text={this.getPostedOn(post)}>
        <span className="PostedOn">
          {icon(this.getIcon(post))} {post.postedOn()}
        </span>
      </Tooltip>
    );
  }

  getPostedOn(post) {
    return app.translator.trans('datlechin-posted-on.forum.post.posted_on_text', { posted_on: post.postedOn() });
  }

  getIcon(post) {
    switch (post.postedOn()) {
      case 'Windows':
        return 'fab fa-windows';
      case 'Ubuntu':
        return 'fab fa-ubuntu';
      case 'Linux':
        return 'fab fa-linux';
      case 'Mac OS':
        return 'fab fa-apple';
      case 'Android':
        return 'fab fa-android';
      case 'iPhone':
        return 'fab fa-apple';
      case 'iPad':
        return 'fab fa-apple';
      case 'BlackBerry':
        return 'fab fa-blackberry';
      case 'Mobile':
        return 'fas fa-mobile-alt';
      default:
        return 'fas fa-globe';
    }
  }
}
