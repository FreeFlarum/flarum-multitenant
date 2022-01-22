import app from 'flarum/forum/app';
import Modal from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';
import Stream from 'flarum/common/utils/Stream';

export default class ResultsModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);

    this.userRequestAttr = `last${this.attrs.nickname ? 'Nickname' : 'Username'}Request`;

    this.request = app.session.user[this.userRequestAttr]();

    this.translationPrefix = `fof-username-request.forum.${this.request.forNickname() ? 'nickname' : 'username'}_modals.results`;
  }

  className() {
    return 'ResultsModal Modal';
  }

  title() {
    return app.translator.trans(`${this.translationPrefix}.title`);
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form Form--centered">
          {this.request.status() === 'Approved'
            ? [
                <h2>{app.translator.trans(`${this.translationPrefix}.approved`)}</h2>,
                <h3>{app.translator.trans(`${this.translationPrefix}.new_name`, { name: app.session.user.displayName() })}</h3>,
              ]
            : [
                <h2>{app.translator.trans(`${this.translationPrefix}.rejected`)}</h2>,
                <h3>{app.translator.trans(`${this.translationPrefix}.reason`, { reason: this.request.reason(), i: <i /> })}</h3>,
                <p className="helpText">{app.translator.trans(`${this.translationPrefix}.resubmit`)}</p>,
              ]}
          <div className="Form-group">
            <Button className="Button Button--primary Button--block" onclick={this.hide.bind(this)}>
              {app.translator.trans(`${this.translationPrefix}.dismiss_button`)}
            </Button>
          </div>
        </div>
      </div>
    );
  }

  onremove() {
    app.session.user[this.userRequestAttr] = Stream();
    this.request.save({ delete: true });
  }
}
