module.exports=function(t){var s={};function e(n){if(s[n])return s[n].exports;var r=s[n]={i:n,l:!1,exports:{}};return t[n].call(r.exports,r,r.exports,e),r.l=!0,r.exports}return e.m=t,e.c=s,e.d=function(t,s,n){e.o(t,s)||Object.defineProperty(t,s,{enumerable:!0,get:n})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,s){if(1&s&&(t=e(t)),8&s)return t;if(4&s&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(e.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&s&&"string"!=typeof t)for(var r in t)e.d(n,r,function(s){return t[s]}.bind(null,r));return n},e.n=function(t){var s=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(s,"a",s),s},e.o=function(t,s){return Object.prototype.hasOwnProperty.call(t,s)},e.p="",e(e.s=10)}([,function(t,s,e){"use strict";function n(t,s){return(n=Object.setPrototypeOf||function(t,s){return t.__proto__=s,t})(t,s)}function r(t,s){t.prototype=Object.create(s.prototype),t.prototype.constructor=t,n(t,s)}e.d(s,"a",(function(){return r}))},,function(t,s){t.exports=flarum.core.compat["admin/app"]},,,,,function(t,s){t.exports=flarum.core.compat["admin/components/ExtensionPage"]},,function(t,s,e){"use strict";e.r(s);var n=e(3),r=e.n(n),o=e(1),i=e(8),a="datlechin-keyboard-shortcuts.",l=function(t){function s(){return t.apply(this,arguments)||this}Object(o.a)(s,t);var e=s.prototype;return e.oninit=function(s){t.prototype.oninit.call(this,s)},e.content=function(){return m("div",{className:"ExtensionPage-settings"},m("div",{className:"container"},m("div",{className:"KeyboardShortcuts-settings Form"},m("div",{className:"KeyboardShortcuts-first"},m("h2",null,app.translator.trans(a+"lib.global_heading")),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.help")),this.buildSettingComponent({type:"text",setting:a+"help"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.search")),this.buildSettingComponent({type:"text",setting:a+"search"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.new_discussion")),this.buildSettingComponent({type:"text",setting:a+"newDiscussion"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.notifications")),this.buildSettingComponent({type:"text",setting:a+"notifications"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.flags")),this.buildSettingComponent({type:"text",setting:a+"flags"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.session")),this.buildSettingComponent({type:"text",setting:a+"session"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.login")),this.buildSettingComponent({type:"text",setting:a+"login"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.signup")),this.buildSettingComponent({type:"text",setting:a+"signup"}))),m("div",{className:"KeyboardShortcuts-second"},m("h2",null,app.translator.trans(a+"lib.discussion_page_heading")),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.back")),this.buildSettingComponent({type:"text",setting:a+"back"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.pin_nav")),this.buildSettingComponent({type:"text",setting:a+"pinNav"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.reply")),this.buildSettingComponent({type:"text",setting:a+"reply"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.follow")),this.buildSettingComponent({type:"text",setting:a+"follow"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.first_post")),this.buildSettingComponent({type:"text",setting:a+"firstPost"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.last_post")),this.buildSettingComponent({type:"text",setting:a+"lastPost"}))),m("div",{className:"KeyboardShortcuts-third"},m("h2",null,app.translator.trans(a+"lib.discussion_list_heading")),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.mark_all_as_read")),this.buildSettingComponent({type:"text",setting:a+"markAllAsRead"})),m("div",{class:"Form-group"},m("div",{class:"helpText"},app.translator.trans(a+"lib.shortcuts.refresh")),this.buildSettingComponent({type:"text",setting:a+"refresh"})))),m("div",{class:"Form-group button"},this.submitButton())))},s}(e.n(i).a);r.a.initializers.add("datlechin/flarum-keyboard-shortcuts",(function(){r.a.extensionData.for("datlechin-keyboard-shortcuts").registerPage(l)}))}]);
//# sourceMappingURL=admin.js.map