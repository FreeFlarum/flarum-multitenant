module.exports=function(t){var e={};function o(n){if(e[n])return e[n].exports;var a=e[n]={i:n,l:!1,exports:{}};return t[n].call(a.exports,a,a.exports,o),a.l=!0,a.exports}return o.m=t,o.c=e,o.d=function(t,e,n){o.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},o.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},o.t=function(t,e){if(1&e&&(t=o(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var a in t)o.d(n,a,function(e){return t[e]}.bind(null,a));return n},o.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return o.d(e,"a",e),e},o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},o.p="",o(o.s=15)}([function(t,e){t.exports=flarum.core.compat["common/Model"]},function(t,e){t.exports=flarum.core.compat["common/utils/Stream"]},function(t,e){t.exports=flarum.core.compat["common/components/Button"]},function(t,e){t.exports=flarum.core.compat["common/utils/withAttr"]},function(t,e){t.exports=flarum.core.compat["common/components/Select"]},function(t,e){t.exports=flarum.core.compat["common/components/Dropdown"]},function(t,e){t.exports=flarum.core.compat["common/components/Alert"]},function(t,e){t.exports=flarum.core.compat["common/components/Switch"]},function(t,e){t.exports=flarum.core.compat["common/models/Forum"]},function(t,e){t.exports=flarum.core.compat["admin/components/ExtensionPage"]},function(t,e){t.exports=flarum.core.compat["common/Component"]},function(t,e){t.exports=flarum.core.compat["common/helpers/icon"]},function(t,e){t.exports=flarum.core.compat["common/models/Group"]},function(t,e){t.exports=flarum.core.compat["common/components/Modal"]},function(t,e){t.exports=flarum.core.compat["tags/common/helpers/tagIcon"]},function(t,e,o){"use strict";o.r(e);var n=o(0),a=o.n(n),r=o(8),s=o.n(r);function i(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}function l(t,e){t.prototype=Object.create(e.prototype),t.prototype.constructor=t,t.__proto__=e}function u(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var c=function(t){function e(){for(var e,o=arguments.length,n=new Array(o),r=0;r<o;r++)n[r]=arguments[r];return u(i(e=t.call.apply(t,[this].concat(n))||this),"id",a.a.attribute("id")),u(i(e),"service",a.a.attribute("service")),u(i(e),"url",a.a.attribute("url")),u(i(e),"error",a.a.attribute("error")),u(i(e),"events",a.a.attribute("events")),u(i(e),"tagId",a.a.attribute("tag_id")),u(i(e),"groupId",a.a.attribute("group_id")),u(i(e),"extraText",a.a.attribute("extra_text")),u(i(e),"isValid",a.a.attribute("is_valid",Boolean)),u(i(e),"usePlainText",a.a.attribute("use_plain_text",Boolean)),u(i(e),"maxPostContentLength",a.a.attribute("max_post_content_length")),e}l(e,t);var o=e.prototype;return o.apiEndpoint=function(){return"/fof/webhooks"+(this.exists?"/"+this.data.id:"")},o.tag=function(){return app.store.getById("tags",this.tagId())},e}(a.a),p=o(9),h=o.n(p),d=o(1),f=o.n(d),b=o(3),g=o.n(b),k=o(2),v=o.n(k),w=o(4),x=o.n(w),y=o(10),_=o.n(y),N=o(5),W=o.n(N),P=o(6),T=o.n(P),C=o(7),B=o.n(C),I=o(11),O=o.n(I),j=o(12),F=o.n(j),L=o(13),M=function(t){function e(){return t.apply(this,arguments)||this}l(e,t);var o=e.prototype;return o.oninit=function(e){t.prototype.oninit.call(this,e),this.webhook=this.attrs.webhook;var o=app.data["fof-webhooks.events"];this.groupId=f()(this.webhook.groupId()||F.a.GUEST_ID),this.extraText=f()(this.webhook.extraText()||""),this.usePlainText=f()(this.webhook.usePlainText()),this.maxPostContentLength=f()(this.webhook.maxPostContentLength()),this.events=function(t,e){var o=Object.keys(t),n=Object.values(t);return o.map("function"==typeof e?e:function(t){return t[e]}).reduce((function(t,e,a){return t[e]||(t[e]={}),t[e][o[a]]=n[a],t}),{})}(o.reduce((function(t,e){var o=/((?:[a-z]+\\?)+?)\\Events?\\([a-z]+)/i.exec(e);if(!o)return t.other.push({full:e,name:e}),t.other=t.other.sort(),t;var n=o[1].toLowerCase().replace("\\",".");return t[n]||(t[n]=[]),t[n]=t[n].concat({full:e,name:o[2]}).sort(),t}),{other:[]}),(function(t){return t.split(".")[0]}))},o.className=function(){return"Modal--medium"},o.title=function(){return app.translator.trans("fof-webhooks.admin.settings.modal.title")},o.content=function(){var t=this,e={2:"fas fa-globe",3:"fas fa-user"},o=app.store.getById("groups",this.groupId());return m("div",{className:"FofWebhooksModal Modal-body"},m("form",{className:"Form",onsubmit:this.onsubmit.bind(this)},m(B.a,{state:this.usePlainText(),onchange:this.usePlainText},app.translator.trans("fof-webhooks.admin.settings.modal.use_plain_text_label")),m("div",{className:"Form-group"},m("label",{className:"label"},app.translator.trans("fof-webhooks.admin.settings.modal.max_post_content_length_label")),m("p",{className:"helpText"},app.translator.trans("fof-webhooks.admin.settings.modal.max_post_content_length_help")),m("input",{type:"number",min:"0",className:"FormControl",bidi:this.maxPostContentLength,onkeypress:this.onkeypress.bind(this)})),m("div",{className:"Form-group hasLoading"},m("label",{className:"label"},app.translator.trans("fof-webhooks.admin.settings.modal.extra_text_label")),m("p",{className:"helpText"},app.translator.trans("fof-webhooks.admin.settings.modal.extra_text_help")),m("input",{type:"text",className:"FormControl",bidi:this.extraText,onkeypress:this.onkeypress.bind(this)})),m("div",{className:"Form-group"},m("label",{className:"label"},app.translator.trans("fof-webhooks.admin.settings.modal.group_label")),m("p",{className:"helpText"},app.translator.trans("fof-webhooks.admin.settings.modal.group_help")),m(W.a,{label:[O()(o.icon()||e[o.id()]),o.namePlural()],buttonClassName:"Button Button--danger"},app.store.all("groups").filter((function(t){return["1","2"].includes(t.id())})).map((function(n){return m(v.a,{active:o.id()===n.id(),disabled:o.id()===n.id(),icon:n.icon()||e[n.id()],onclick:function(){return t.groupId(n.id())}},n.namePlural())})))),m("div",{className:"Form-group Webhook-events"},m("label",{className:"label"},app.translator.trans("fof-webhooks.admin.settings.modal.events_label")),app.translator.trans("fof-webhooks.admin.settings.modal.description"),Object.entries(this.events).map((function(e){var o,n=e[1];return m("div",null,Object.entries(n).sort((o=0,function(t,e){var n=t[o].toUpperCase(),a=e[o].toUpperCase();return n<a?-1:n>a?1:0})).map((function(e){var o=e[0],n=e[1];return n.length?m("div",null,m("h3",null,t.translate(o)),n.map((function(e){return m(B.a,{state:t.webhook.events().includes(e.full),onchange:t.onchange.bind(t,e.full)},t.translate(o,e.name.toLowerCase()))}))):null})))}))),m("div",{className:"Form-group"},m(v.a,{type:"submit",className:"Button Button--primary",loading:this.loading,disabled:!this.isDirty()},app.translator.trans("core.admin.settings.submit_button")))))},o.translate=function(t,e){return void 0===e&&(e="title"),app.translator.trans("fof-webhooks.admin.settings.actions."+t+"."+e)},o.isDirty=function(){return this.extraText()!=this.webhook.extraText()||this.groupId()!==this.webhook.groupId()||this.usePlainText()!==this.webhook.usePlainText()||this.maxPostContentLength()!=this.webhook.maxPostContentLength()},o.onsubmit=function(t){var e=this;return t.preventDefault(),this.loading=!0,this.webhook.save({extraText:this.extraText(),group_id:this.groupId(),use_plain_text:this.usePlainText(),max_post_content_length:this.maxPostContentLength()||0}).then((function(){e.loading=!1,m.redraw()})).catch((function(){e.loading=!1,m.redraw()}))},o.onkeypress=function(t){"Enter"===t.key&&this.onsubmit(t)},o.onchange=function(t,e,o){o.loading=!0;var n=this.webhook.events();return e?n.push(t):n.splice(n.indexOf(t),1),this.attrs.updateWebhook(n).then((function(){o.loading=!1,m.redraw()}))},e}(o.n(L).a),S=function(t){function e(){return t.apply(this,arguments)||this}l(e,t);var n=e.prototype;return n.oninit=function(e){t.prototype.oninit.call(this,e),this.webhook=this.attrs.webhook,this.services=this.attrs.services,this.url=f()(this.webhook.url()),this.service=f()(this.webhook.service()),this.events=f()(this.webhook.events()),this.error=f()(this.webhook.error()),this.loading={}},n.view=function(){var t=this,e=this.webhook,n=this.services,a=e.service(),r=[e.error&&e.error()];n[a]?e.isValid()||r.push(app.translator.trans("fof-webhooks.admin.errors.url_invalid")):r.push(app.translator.trans("fof-webhooks.admin.errors.service_not_found",{service:a}));var s=o(14),i=e.tag(),l=!!this.loading.tag_id;return m("div",{className:"Webhooks--row"},m("div",{className:"Webhook-input"},m(x.a,{options:n,value:a,onchange:this.update("service"),disabled:this.loading.service}),m("input",{className:"FormControl Webhook-url",type:"url",value:this.url(),onchange:g()("value",this.update("url")),disabled:this.loading.url,placeholder:app.translator.trans("fof-webhooks.admin.settings.help.url")}),s&&m(W.a,{buttonClassName:"Button",label:i?m("span",null,!l&&s(i,{className:"Button-icon"})," ",i.name()):app.translator.trans("fof-webhooks.admin.settings.item.tag_any_label"),icon:l?"fas fa-spinner fa-spin":!!i||"fas fa-tag",caretIcon:null},m(v.a,{icon:"fas fa-tag",onclick:function(){return t.update("tag_id")(null)}},app.translator.trans("fof-webhooks.admin.settings.item.tag_any_label")),m("hr",null),app.store.all("tags").map((function(e){return m(v.a,{icon:!0,onclick:function(){return t.update("tag_id")(e.id())}},s(e,{className:"Button-icon"})," ",e.name())}))),m(v.a,{type:"button",className:"Button Webhook-button",icon:"fas fa-edit",onclick:function(){return app.modal.show(M,{webhook:e,updateWebhook:t.update("events")})}}),m(v.a,{type:"button",className:"Button Button--warning Webhook-button",icon:"fas fa-times",onclick:this.delete.bind(this)})),!this.events().length&&m(T.a,{className:"Webhook-error",dismissible:!1},app.translator.trans("fof-webhooks.admin.settings.help.disabled")),r.filter(Boolean).map((function(t){return m(T.a,{className:"Webhook-error",type:"error",dismissible:!1},app.translator.trans(t))})))},n.update=function(t){var e=this;return function(o){var n;return e.loading[t]=!0,e.webhook.save((n={},n[t]=o,n)).catch((function(){})).then((function(){e.loading[t]=!1,e[t]&&e[t](o),m.redraw()}))}},n.delete=function(){return this.webhook.delete().then((function(){return m.redraw()}))},e}(_.a),E=function(t){function e(){return t.apply(this,arguments)||this}l(e,t);var o=e.prototype;return o.oninit=function(e){t.prototype.oninit.call(this,e),this.values={},this.services=app.data["fof-webhooks.services"].reduce((function(t,e){return t[e]=app.translator.trans("fof-webhooks.admin.settings.services."+e),t}),{}),this.newWebhook={service:f()("discord"),url:f()(""),loading:f()(!1)}},o.content=function(){var t=this,e=app.store.all("webhooks");return m("div",{className:"WebhookContent"},m("div",{className:"container"},m("form",null,m("p",{className:"helpText"},app.translator.trans("fof-webhooks.admin.settings.help.general")),m("fieldset",null,m("div",{className:"Webhooks--Container"},e.map((function(e){return m(S,{webhook:e,services:t.services})})),m("div",{className:"Webhooks--row"},m("div",{className:"Webhook-input"},m(x.a,{options:this.services,value:this.newWebhook.service(),onchange:this.newWebhook.service}),m("input",{className:"FormControl Webhook-url",type:"url",placeholder:app.translator.trans("fof-webhooks.admin.settings.help.url"),onchange:g()("value",this.newWebhook.url),onkeypress:this.onkeypress.bind(this)}),m(v.a,{type:"button",loading:this.newWebhook.loading(),className:"Button Button--warning Webhook-button",icon:"fas fa-plus",onclick:this.addWebhook.bind(this)}))))))))},o.addWebhook=function(){var t=this;if(!this.newWebhook.loading())return this.newWebhook.loading(!0),app.store.createRecord("webhooks").save({service:this.newWebhook.service(),url:this.newWebhook.url()}).then((function(){t.newWebhook.service("discord"),t.newWebhook.url(""),t.newWebhook.loading(!1),m.redraw()})).catch((function(){t.newWebhook.loading(!1),m.redraw()}))},o.onkeypress=function(t){"Enter"===t.key&&this.addWebhook()},o.changed=function(){var t=this;return this.fields.some((function(e){return t.values[e]()!==(app.data.settings[t.addPrefix(e)]||"")}))},e}(h.a);app.initializers.add("fof/webhooks",(function(){app.store.models.webhooks=c,s.a.prototype.webhooks=a.a.hasMany("webhooks"),app.extensionData.for("fof-webhooks").registerPage(E)}))}]);
//# sourceMappingURL=admin.js.map