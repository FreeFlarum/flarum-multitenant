import app from 'flarum/forum/app';
import Component from 'flarum/common/Component';

export default class LandingPage extends Component {
  oninit(vnode) {
    super.oninit(vnode);
  }

  oncreate(vnode) {
    super.oncreate(vnode);
  }

  onupdate(vnode) {
    super.onupdate(vnode);
  }

  view() {
    return (
      <div className="LandingPage">
        <div className="LandingPage header">{m.trust(app.forum.attribute('datlechin-landing-page.headerHTML'))}</div>
        <div className="LandingPage content">{m.trust(app.forum.attribute('datlechin-landing-page.bodyHTML'))}</div>
      </div>
    );
  }
}
