/*
 *
 *  This file is part of fof/username-request.
 *
 *  Copyright (c) 2019 FriendsOfFlarum.
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 *
 */

import Stream from 'flarum/utils/Stream';
import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';

export default class FlagPostModal extends Modal {
    oninit(vnode) {
        super.oninit(vnode);

        this.username = Stream(app.session.user.username());

        if (app.session.user.username_requests()) this.username(app.session.user.username_requests().requestedUsername());

        this.success = false;

        this.password = Stream('');
    }

    className() {
        return 'RequestUsernameModal Modal--small';
    }

    title() {
        return app.translator.trans('fof-username-request.forum.request.title');
    }

    content() {
        if (this.success) {
            return (
                <div className="Modal-body">
                    <div className="Form Form--centered">
                        <p className="helpText">{app.translator.trans('fof-username-request.forum.request.confirmation_message')}</p>
                        <div className="Form-group">
                            <Button className="Button Button--primary Button--block" onclick={this.hide.bind(this)}>
                                {app.translator.trans('fof-username-request.forum.request.dismiss_button')}
                            </Button>
                        </div>
                    </div>
                </div>
            );
        }

        return (
            <div className="Modal-body">
                <div className="Form Form--centered">
                    {app.session.user.username_requests() ? (
                        <p className="helpText">
                            {app.translator.trans('fof-username-request.forum.request.current_request', {
                                username: app.session.user.username_requests().requestedUsername(),
                            })}
                        </p>
                    ) : (
                        ''
                    )}
                    <div className="Form-group">
                        <input
                            type="text"
                            name="text"
                            className="FormControl"
                            placeholder={app.session.user.username()}
                            bidi={this.username}
                            disabled={this.loading}
                        />
                    </div>
                    <div className="Form-group">
                        <input
                            type="password"
                            name="password"
                            className="FormControl"
                            placeholder={app.translator.trans('core.forum.change_email.confirm_password_placeholder')}
                            bidi={this.password}
                            disabled={this.loading}
                        />
                    </div>
                    <div className="Form-group">
                        {Button.component(
                            {
                                className: 'Button Button--primary Button--block',
                                type: 'submit',
                                loading: this.loading,
                            },
                            app.translator.trans('fof-username-request.forum.request.submit_button')
                        )}
                    </div>
                    {app.session.user.username_requests() ? (
                        <div className="Form-group">
                            {Button.component(
                                {
                                    className: 'Button Button--primary Button--block',
                                    onclick: this.deleteRequest.bind(this),
                                    loading: this.loading,
                                },
                                app.translator.trans('fof-username-request.forum.request.delete_button')
                            )}
                        </div>
                    ) : (
                        ''
                    )}
                </div>
            </div>
        );
    }

    deleteRequest(e) {
        e.preventDefault();

        this.loading = true;

        app.session.user.username_requests().delete();

        this.successAlert = app.alerts.show({ type: 'success' }, app.translator.trans('fof-username-request.forum.request.deleted'));

        app.session.user.username_requests = Stream();

        this.hide();
    }

    onsubmit(e) {
        e.preventDefault();

        this.alert = null;

        if (this.username() === app.session.user.username()) {
            this.hide();
            return;
        }

        this.loading = true;

        app.store
            .createRecord('username-requests')
            .save(
                { username: this.username() },
                {
                    meta: { password: this.password() },
                    errorHandler: this.onerror.bind(this),
                }
            )
            .then((request) => {
                app.session.user.username_requests = Stream(request);
                this.success = true;
            })
            .catch(() => {})
            .then(this.loaded.bind(this));
    }

    onerror(error) {
        if (error.status === 401) {
            error.alert.attrs.content = app.translator.trans('core.forum.change_email.incorrect_password_message');
        }

        super.onerror(error);
    }
}
