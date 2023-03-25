import app from 'flarum/forum/app';
import Button from 'flarum/common/components/Button';
import Modal from 'flarum/common/components/Modal';
import Switch from 'flarum/common/components/Switch';
import DiscussionSearch from 'flarum/uikit/forum/DiscussionSearch';
import { ComponentAttrs } from 'flarum/common/Component';
import type Discussion from 'flarum/common/models/Discussion';
import GlobalSearchState from 'flarum/forum/states/GlobalSearchState';

export interface MovePostsModalAttrs extends ComponentAttrs {
  discussion: Discussion;
  postIds: number[];
}

export default class MovePostsModal<T extends MovePostsModalAttrs> extends Modal<T> {
  isLoading: string | boolean = false;
  newDiscussion: boolean = false;
  newDiscussionTitle: string = '';
  targetDiscussionId: number | null = null;
  search = new GlobalSearchState();

  className() {
    return 'MovePostsModal';
  }

  title() {
    return app.translator.trans('sycho-move-posts.forum.modal.title');
  }

  content() {
    return (
      <div className="Modal-body">
        <form className="Form" onsubmit={this.onsubmit.bind(this)}>
          <div className="Form-group">
            <label>{app.translator.trans('sycho-move-posts.forum.modal.selected_posts', { count: this.attrs.postIds.length })}</label>
            <input className="FormControl" readonly value={this.attrs.postIds.join(', ')} />
          </div>
          <div className="Form-group">
            <Switch state={this.newDiscussion} onchange={() => (this.newDiscussion = !this.newDiscussion)}>
              {app.translator.trans('sycho-move-posts.forum.modal.new_discussion')}
            </Switch>
          </div>
          {this.newDiscussion ? (
            <div className="Form-group">
              <label for="discussion_name">{app.translator.trans('sycho-move-posts.forum.modal.discussion_name')}</label>
              <p className="helptext">{app.translator.trans('sycho-move-posts.forum.modal.discussion_help')}</p>
              <input id="discussion_name" className="FormControl" required={true} oninput={(e: any) => (this.newDiscussionTitle = e.target.value)} />
            </div>
          ) : (
            <div className="Form-group">
              <label for="destination">{app.translator.trans('sycho-move-posts.forum.modal.destination')}</label>
              {/*<input
                id="destination"
                className="FormControl"
                type="number"
                required={true}
                onchange={(e: any) => (this.targetDiscussionId = e.target!.value)}
              />*/}
              <DiscussionSearch
                state={this.search}
                ignore={this.attrs.discussion.id()}
                onSelect={(discussion: Discussion) => (this.targetDiscussionId = discussion.id())}
              />
            </div>
          )}
          <div className="Form-group Form-controls">
            <Button
              className="Button Button--primary"
              type="submit"
              loading={this.isLoading === 'submit'}
              disabled={this.isLoading === 'check' || (!this.targetDiscussionId && !this.newDiscussionTitle)}
            >
              {app.translator.trans('sycho-move-posts.forum.modal.submit')}
            </Button>
            <Button
              className="Button"
              onclick={this.emulate.bind(this)}
              loading={this.isLoading === 'check'}
              disabled={this.isLoading === 'submit' || (!this.targetDiscussionId && !this.newDiscussionTitle)}
            >
              {app.translator.trans('sycho-move-posts.forum.modal.check')}
            </Button>
          </div>
        </form>
      </div>
    );
  }

  data() {
    const data: Record<string, unknown> = {
      sourceDiscussionId: this.attrs.discussion.id(),
      postIds: this.attrs.postIds,
    };

    if (this.newDiscussion) {
      data.newDiscussion = true;
      data.newDiscussionTitle = this.newDiscussionTitle;
    } else {
      data.targetDiscussionId = this.targetDiscussionId;
    }

    return data;
  }

  emulate() {
    this.onsubmit(null, true).then((response: any) => {
      switch (response.data.attributes.status) {
        case 'old_to_new_move':
          this.alertAttrs = { type: 'error', content: app.translator.trans('sycho-move-posts.forum.modal.status.old_to_new_move') };
          break;

        case 'simple_move':
          this.alertAttrs = { type: 'success', content: app.translator.trans('sycho-move-posts.forum.modal.status.simple_move') };
          break;

        case 'complex_move':
          this.alertAttrs = { type: 'warning', content: app.translator.trans('sycho-move-posts.forum.modal.status.complex_move') };
          break;

        default:
          break;
      }

      m.redraw();
    });
  }

  onsubmit(e: any, emulate: boolean) {
    if (e) e.preventDefault();

    this.isLoading = emulate ? 'check' : 'submit';
    let url = '/api/posts/move';

    if (emulate) url += '/check';

    return app
      .request({
        method: 'POST',
        url: `${app.forum.attribute('baseUrl')}${url}`,
        body: { data: this.data() },
        errorHandler: (e: any) => {
          const error = e.response.errors[0];
          this.isLoading = false;

          if (error.code !== 'move_old_post_to_newer_discussion') {
            throw e;
          }

          this.alertAttrs = {
            type: 'error',
            content: app.translator.trans('sycho-move-posts.forum.error.move_old_post_to_newer_discussion'),
          };

          m.redraw();
        },
      })
      .then((response: any) => {
        this.isLoading = false;
        if (!emulate) {
          m.redraw();
          window.location.reload();
          app.modal.close();
        }

        return response;
      });
  }
}
