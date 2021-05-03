/*
 *  Achievements Extension for Flarum
 *  Author: Miguel A. Lago
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 */

import app from 'flarum/app';
import icon from "flarum/helpers/icon";
import Modal from 'flarum/components/Modal';
import ItemList from "flarum/utils/ItemList";
import Button from "flarum/components/Button";

export default class NewAchievementModal extends Modal {


    title() {
        return app.translator.trans('malago-achievements.forum.new_achievement_title');
    }

    oninit(vnode) {
        super.oninit(vnode);
    }

    fields() {
        const items = new ItemList();
        for (var i = 0; i < this.attrs.achievements.length; i++) {
            var rectangle = this.attrs.achievements[i].rectangle.split(',');

            if (this.attrs.achievements[i].image.includes("http")) {
                var style = "background:url(" + this.attrs.achievements[i].image + ");\
                    background-position:-"+ rectangle[0] + "px -" + rectangle[1] + "px;\
                    height:"+ rectangle[2] + "px;\
                    width:"+ rectangle[3] + "px;";

                items.add(
                    "image" + i,
                    <div className="Form-group">
                        <span class='Badge Achievement' style={style}></span>
                    </div>,
                    -10
                );
            } else {
                items.add(
                    "image" + i,
                    <div className="Form-group">
                        <span class='Badge Achievement--Icon'>{icon(this.attrs.achievements[i].image)}</span>
                    </div>,
                    -10
                );
            }

            items.add(
                "name" + i,
                <div className="Form-group">
                    <h1>{this.attrs.achievements[i].name}</h1>
                </div>,
                -10
            );

            items.add(
                "description" + i,
                <div className="Form-group">
                    <h3>{this.attrs.achievements[i].description}</h3>
                </div>,
                -10
            );
        }

        items.add(
            "close",
            <div className="NewAchievementModal--Button">
                {Button.component(
                    {
                        type: "button",
                        className: "Button Button--primary",
                        onclick: this.hide.bind(this),
                    },
                    app.translator.trans(
                        "malago-achievements.forum.new_achievement_close"
                    )
                )}

            </div>,
            -10
        );

        return items;
    }

    // Hide the footer completely
    footer() {
        return null;
    }

    content() {
        if (this.loading) {
            return (
                <div className="Modal-body">
                    <div className="Form">
                        <div className="container">
                            <LoadingIndicator />
                        </div>
                    </div>
                </div>
            );
        }

        return (
            <div className="Modal-body">
                <div className="Modal--New-Achievement">{this.fields().toArray()}</div>
            </div>
        );
    }

    // Instead of hitting /register (which would change which user is connected in this session)
    // We just hit the API that's already used behind the scenes when registering
    // Doing it this way skips connecting the new account and just returns the new user data
    // onsubmit(e) {
    //     e.preventDefault();

    //     this.loading = true;

    //     app.request({
    //         url: app.forum.attribute('apiUrl') + '/users',
    //         method: 'POST',
    //         body: {
    //             data: {
    //                 attributes: this.submitData(),
    //             },
    //         },
    //         errorHandler: this.onerror.bind(this)
    //     }).then(
    //         payload => {
    //             const user = app.store.pushPayload(payload);

    //             // Add the missing groups relationship we can't include from the CreateUserController
    //             // Without this there's an error trying to access the user edit modal just after the redirect to the profile
    //             user.pushData({
    //                 relationships: {
    //                     groups: {
    //                         data: [],
    //                     },
    //                 },
    //             });

    //             m.route.set(app.route.user(user));
    //         },
    //         this.loaded.bind(this)
    //     );
    // }
}