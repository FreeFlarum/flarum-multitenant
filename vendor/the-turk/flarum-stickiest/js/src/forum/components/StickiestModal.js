/*
 * This file is part of Stickiest.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import app from 'flarum/app';
import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';
import tagIcon from 'flarum/tags/helpers/tagIcon';
import sortTags from 'flarum/tags/utils/sortTags';
import ItemList from 'flarum/utils/ItemList';
import Stream from 'flarum/utils/Stream';
import Switch from 'flarum/common/components/Switch';

export default class StickiestModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);

    const discussion = this.attrs.discussion;
    const discussionTags = discussion.tags();
    const stickyTags = Stream(discussion.stickyTags().filter((tag) => discussionTags.indexOf(tag) > -1) || []);

    this.isSticky = Stream(discussion.isSticky() || false);
    this.isStickiest = Stream(discussion.isStickiest() || false);
    this.isTagSticky = Stream(discussion.isTagSticky() || false);

    if (stickyTags().length > 0) {
      this.tagSlugs = sortTags(stickyTags()).map((tag) => tag.slug());
    } else {
      this.tagSlugs = sortTags(discussionTags).map((tag) => tag.slug());
    }
  }

  className() {
    return 'StickiestModal';
  }

  title() {
    return app.translator.trans('the-turk-stickiest.forum.stickiest_modal.title', { title: <em>{this.attrs.discussion.title()}</em> });
  }

  content() {
    return [
      <div className="Modal-body">
        <div className="Form">{this.bodyFields().toArray()}</div>
      </div>,
      <div className="Modal-footer">{this.footerFields().toArray()}</div>,
    ];
  }

  bodyFields() {
    const items = new ItemList();

    items.add(
      'sticky',
      <div className="Form-group">
        {Switch.component(
          {
            state: !!Number(this.isSticky()),
            onchange: (value) => {
              if (value === true) this.isStickiest = this.isTagSticky = Stream(false);

              this.isSticky = Stream(value);
            },
          },
          app.translator.trans('the-turk-stickiest.forum.stickiest_modal.sticky_label')
        )}

        <div className="helpText">{app.translator.trans('the-turk-stickiest.forum.stickiest_modal.sticky_text')}</div>
      </div>,
      30
    );

    if (this.attrs.discussion.canStickiest()) {
      items.add(
        'stickiest',
        <div className="Form-group">
          {Switch.component(
            {
              state: !!Number(this.isStickiest()),
              onchange: (value) => {
                if (value === true) this.isSticky = Stream(false);
                this.isStickiest = Stream(value);
              },
            },
            app.translator.trans('the-turk-stickiest.forum.stickiest_modal.super_sticky_label')
          )}

          <div className="helpText">{app.translator.trans('the-turk-stickiest.forum.stickiest_modal.super_sticky_text')}</div>
        </div>,
        20
      );
    }

    if (this.attrs.discussion.canTagSticky()) {
      items.add(
        'tagSticky',
        <div className="Form-group">
          {Switch.component(
            {
              state: !!Number(this.isTagSticky()),
              onchange: (value) => {
                if (value === true) this.isSticky = Stream(false);
                this.isTagSticky = Stream(value);
              },
            },
            app.translator.trans('the-turk-stickiest.forum.stickiest_modal.tag_sticky_label')
          )}

          <div className="helpText">{app.translator.trans('the-turk-stickiest.forum.stickiest_modal.tag_sticky_text')}</div>
        </div>,
        10
      );
    }

    return items;
  }

  footerFields() {
    const items = new ItemList();

    if (this.attrs.discussion.canTagSticky() && this.isTagSticky()) {
      items.add(
        'tags',
        <div className="Form-group StickiestModal-tags">
          <label>{app.translator.trans('the-turk-stickiest.forum.stickiest_modal.tags_label')}</label>
          <div>
            {this.attrs.discussion.tags().map((tag) => (
              <label className="checkbox">
                <input
                  type="checkbox"
                  checked={this.tagSlugs.indexOf(tag.slug()) > -1}
                  onchange={(e) => {
                    if (e.target.checked && !(this.tagSlugs.indexOf(tag.slug()) > -1)) {
                      this.tagSlugs.push(tag.slug());
                    } else if (!e.target.checked) {
                      const index = this.tagSlugs.indexOf(tag.slug());
                      if (index > -1) this.tagSlugs.splice(index, 1);
                    }
                  }}
                  disabled={!tag.canStartDiscussion()}
                />
                {tagIcon(tag)} {tag.name()}
              </label>
            ))}
          </div>
        </div>,
        10
      );
    }

    items.add(
      'submit',
      <div className="Form-group">
        {Button.component(
          {
            className: 'Button',
            type: 'submit',
            loading: this.loading,
            disabled: this.isTagSticky() && !(this.tagSlugs.length > 0),
          },
          app.translator.trans('the-turk-stickiest.forum.stickiest_modal.submit_button')
        )}
      </div>,
      -10
    );

    return items;
  }

  applyChanges() {
    this.hide.bind(this)();

    if (app.current.matches(DiscussionPage)) {
      app.current.get('stream').update();
    }

    m.redraw();
  }

  saveStickiest() {
    this.attrs.discussion
      .save(
        {
          isStickiest: !this.isSticky() && this.isStickiest(),
        },
        { errorHandler: this.onerror.bind(this) }
      )
      .then(this.applyChanges.bind(this))
      .catch(() => {
        this.loading = false;
        m.redraw();
      });
  }

  onsubmit(e) {
    e.preventDefault();

    this.loading = true;

    this.attrs.discussion
      .save(
        {
          isSticky: !this.isStickiest() && !this.isTagSticky() && this.isSticky(),
        },
        { errorHandler: this.onerror.bind(this) }
      )
      .then(() => {
        if (this.attrs.discussion.canTagSticky()) {
          this.attrs.discussion
            .save(
              {
                isTagSticky: !this.isSticky() && this.isTagSticky() && this.tagSlugs.length > 0,
                tagSlugs: this.isTagSticky() ? this.tagSlugs : [],
                relationships: {
                  stickyTags: this.isTagSticky() ? this.attrs.discussion.tags().filter((tag) => this.tagSlugs.indexOf(tag.slug()) > -1) : [],
                },
              },
              { errorHandler: this.onerror.bind(this) }
            )
            .then(() => {
              if (this.attrs.discussion.canStickiest()) {
                this.saveStickiest.bind(this)();
              } else {
                this.applyChanges.bind(this)();
              }
            })
            .catch(() => {
              this.loading = false;
              m.redraw();
            });
        } else if (this.attrs.discussion.canStickiest()) {
          this.saveStickiest.bind(this)();
        }
      })
      .catch(() => {
        this.loading = false;
        m.redraw();
      });
  }
}
