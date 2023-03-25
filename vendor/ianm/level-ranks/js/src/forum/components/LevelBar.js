import Component from 'flarum/common/Component';
import app from 'flarum/forum/app';
import Tooltip from 'flarum/common/components/Tooltip';

export default class LevelBar extends Component {
  oninit(vnode) {
    super.oninit(vnode);
  }

  view() {
    const user = this.attrs.user;
    const pointsText = app.forum.attribute('ianm-level-ranks.pointsText') || app.translator.trans('ianm-level-ranks.lib.defaults.level');

    let expComments = (user.commentCount() - user.discussionCount()) * 21,
      expDiscussions = user.discussionCount() * 33;

    let expTotal = expComments + expDiscussions,
      expLevel = Math.floor(expTotal / 135),
      expPercent = (100 / 135) * (expTotal - expLevel * 135);

    return (
      <Tooltip text={app.translator.trans('ianm-level-ranks.forum.desc.expText', { expTotal })}>
        <div class="PostUser-level">
          <span class="PostUser-text">
            <span class="PostUser-levelText">{pointsText}</span>
            &nbsp;
            <span class="PostUser-levelPoints">{expLevel}</span>
          </span>
          <div class="PostUser-bar PostUser-bar--empty"></div>
          <div class="PostUser-bar" style={'width: ' + expPercent + '%;'}></div>
        </div>
      </Tooltip>
    );
  }
}
