module.exports=function(t){var n={};function e(o){if(n[o])return n[o].exports;var a=n[o]={i:o,l:!1,exports:{}};return t[o].call(a.exports,a,a.exports,e),a.l=!0,a.exports}return e.m=t,e.c=n,e.d=function(t,n,o){e.o(t,n)||Object.defineProperty(t,n,{enumerable:!0,get:o})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,n){if(1&n&&(t=e(t)),8&n)return t;if(4&n&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(e.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&n&&"string"!=typeof t)for(var a in t)e.d(o,a,function(n){return t[n]}.bind(null,a));return o},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},e.p="",e(e.s=18)}([function(t,n){t.exports=flarum.core.compat.app},function(t,n){t.exports=flarum.core.compat["admin/app"]},function(t,n){t.exports=flarum.core.compat["common/Model"]},function(t,n){t.exports=flarum.core.compat["common/components/Button"]},function(t,n){t.exports=flarum.core.compat["common/helpers/icon"]},function(t,n){t.exports=flarum.core.compat["common/helpers/username"]},function(t,n){t.exports=flarum.core.compat["common/components/Badge"]},function(t,n){t.exports=flarum.core.compat["common/models/Group"]},function(t,n){t.exports=flarum.core.compat["common/helpers/avatar"]},function(t,n){t.exports=flarum.core.compat["admin/components/ExtensionPage"]},function(t,n){t.exports=flarum.core.compat["common/Component"]},function(t,n){t.exports=flarum.core.compat["common/components/LoadingIndicator"]},function(t,n){t.exports=flarum.core.compat["common/components/Placeholder"]},function(t,n){t.exports=flarum.core.compat["common/components/Dropdown"]},function(t,n){t.exports=flarum.core.compat["common/components/GroupBadge"]},function(t,n){t.exports=flarum.core.compat["common/helpers/humanTime"]},function(t,n){t.exports=flarum.core.compat["common/utils/extractText"]},function(t,n){t.exports=flarum.core.compat["common/utils/ItemList"]},function(t,n,e){"use strict";e.r(n);var o=e(1),a=e.n(o);function r(t,n){return(r=Object.setPrototypeOf||function(t,n){return t.__proto__=n,t})(t,n)}function s(t,n){t.prototype=Object.create(n.prototype),t.prototype.constructor=t,r(t,n)}var i=e(2),u=e.n(i),c=function(t){function n(){for(var n,e=arguments.length,o=new Array(e),a=0;a<e;a++)o[a]=arguments[a];return(n=t.call.apply(t,[this].concat(o))||this).actorId=u.a.attribute("actorId"),n.client=u.a.attribute("client"),n.ipAddress=u.a.attribute("ipAddress"),n.action=u.a.attribute("action"),n.payload=u.a.attribute("payload"),n.createdAt=u.a.attribute("createdAt",u.a.transformDate),n.actor=u.a.hasOne("actor"),n.discussion=u.a.hasOne("discussion"),n.post=u.a.hasOne("post"),n.tag=u.a.hasOne("tag"),n.user=u.a.hasOne("user"),n}return s(n,t),n}(u.a),l=e(9),d=e.n(l),p=e(4),f=e.n(p),h=e(0),g=e.n(h),_=e(10),w=e.n(_),b=e(3),y=e.n(b),v=e(11),k=e.n(v),A=e(12),x=e.n(A),R=e(6),O=e.n(R),I=e(13),B=e.n(I),L=e(14),P=e.n(L),S=e(8),N=e.n(S),j=e(15),q=e.n(j),M=e(5),D=e.n(M),V=e(7),T=e.n(V),C=e(16),U=e.n(C),G=e(17),E=e.n(G),J="kilowhat-audit.lib.browser.";function Q(t,n){void 0===n&&(n=!1);var e=t?JSON.parse(JSON.stringify(t)):[];if(!e.length){if(!n)return m("em",g.a.translator.trans(J+"noValue"));e.push(T.a.ADMINISTRATOR_ID)}return e.map((function(t){if(t+""===T.a.GUEST_ID)return O.a.component({icon:"fas fa-globe",label:g.a.translator.trans(J+"permissionGroup.everyone")});if(t+""===T.a.MEMBER_ID)return O.a.component({icon:"fas fa-user",label:g.a.translator.trans(J+"permissionGroup.members")});var n=g.a.store.getById("groups",t);return n?P.a.component({group:n}):O.a.component({icon:"fas fa-question",label:U()(g.a.translator.trans(J+"deletedResource.group",{id:t}))})})).map((function(t,n){return[n>0?", ":null,t]}))}function z(t){return(t||[]).map((function(t,n){return[n>0?", ":null,m("code",t)]}))}var F=function(){function t(){}var n=t.prototype;return n.oninit=function(){this.showRaw=!1},n.view=function(t){var n,e,o,a=this,r=t.attrs,s=r.log,i=r.changeQuery,u=s.actor(),c=s.payload()||{},l=s.discussion(),d=s.post(),p=s.tag(),h=s.user(),_=[];s.ipAddress()&&_.push(m("a",{onclick:function(){i("ip:"+s.ipAddress())}},s.ipAddress())),"session"!==s.client()&&"cli"!==s.client()&&_.push(m("a",{onclick:function(){i("client:"+s.client())}},g.a.translator.trans(J+"client."+s.client()))),_.push(q()(s.createdAt())),n="cli"===s.client()?f()("fas fa-terminal"):null===s.actorId()?f()("fas fa-user-secret"):u?m("a",{href:u?g.a.route.user(u):"#"},N()(u)):N()(null),e="cli"===s.client()?m("a",{onclick:function(){i("client:cli")}},g.a.translator.trans(J+"client.cli")):null===s.actorId()?m("a",{onclick:function(){i("actor:guest")}},g.a.translator.trans(J+"withoutActor")):u?m("a",{onclick:function(){i("actor:"+u.username())}},D()(u)):D()(u);var w=J+s.action();if("setting_changed"===s.action()&&c.hasOwnProperty("new_value")&&(w=J+"setting_changed_with_values"),"string"==typeof g.a.translator.translations[w]){var b={username:m("a",{href:h?g.a.route.user(h):"#"},h?D()(h):g.a.translator.trans(J+"deletedResource.user",{id:c.user_id})),discussion:m("a",{href:l?g.a.route.discussion(l):"#"},l?l.title():g.a.translator.trans(J+"deletedResource.discussion",{id:c.discussion_id})),tag:m("a",{href:p?g.a.route.tag(p):"#"},p?p.name():g.a.translator.trans(J+"deletedResource.tag",{id:c.tag_id})),post:m("a",{href:d&&d.discussion()?g.a.route.post(d):"#"},d?g.a.translator.trans(J+"genericResource."+("comment"===d.contentType()?"comment":"post")):g.a.translator.trans(J+"deletedResource.post",{id:c.post_id})),postuser:m("a",{href:d&&d.user()?g.a.route.user(d.user()):"#"},D()(d?d.user():null)),until:c.until?dayjs(c.until).format("LLLL"):"?",old_title:m("em",c.old_title),new_title:c.new_title&&l?m("a",{href:g.a.route.discussion(l)},c.new_title):c.new_title,package:m("code",c.package),provider:m("code",c.provider),ip:m("code",c.ip),key:m("code",c.key),permission:m("code",c.permission),old_value:c.old_value?m("code",c.old_value):m("em",g.a.translator.trans(J+"noValue")),new_value:c.new_value?m("code",c.new_value):m("em",g.a.translator.trans(J+"noValue")),old_groups:Q(c.old_group_ids,"permission_changed"===s.action()),new_groups:Q(c.new_group_ids,"permission_changed"===s.action()),old_username:m("code",c.old_username),new_username:m("code",c.new_username),old_nickname:c.old_nickname?m("code",c.old_nickname):m("em",g.a.translator.trans(J+"noValue")),new_nickname:c.new_nickname?m("code",c.new_nickname):m("em",g.a.translator.trans(J+"noValue")),old_email:m("code",c.old_email),new_email:m("code",c.new_email),old_tags:z(c.old_tags),new_tags:z(c.new_tags),post_count:c.post_count,old_user:c.old_user_id?g.a.translator.trans(J+"deletedResource.user",{id:c.old_user_id}):m("em",g.a.translator.trans(J+"noValue")),new_user:c.new_user_id?g.a.translator.trans(J+"deletedResource.user",{id:c.new_user_id}):m("em",g.a.translator.trans(J+"noValue")),old_date:c.old_date?dayjs(c.old_date).format("LLLL"):m("em",g.a.translator.trans(J+"noValue")),new_date:c.new_date?dayjs(c.new_date).format("LLLL"):m("em",g.a.translator.trans(J+"noValue")),reason:c.reason?m("code",c.reason):m("em",g.a.translator.trans(J+"noReason"))};o=g.a.translator.trans(w,b),this.showRaw&&(o=[o,m("pre",JSON.stringify(c,null,2))])}else o=JSON.stringify(c);var v=new E.a;return v.add("raw",y.a.component({onclick:function(){a.showRaw=!a.showRaw}},g.a.translator.trans(J+"controls."+(this.showRaw?"hideRaw":"showRaw")))),u&&v.add("actor",y.a.component({onclick:function(){i("actor:"+u.username())}},g.a.translator.trans(J+"controls.filterActor"))),s.ipAddress()&&v.add("ip",y.a.component({onclick:function(){i("ip:"+s.ipAddress())}},g.a.translator.trans(J+"controls.filterIp"))),v.add("client",y.a.component({onclick:function(){i("client:"+s.client())}},g.a.translator.trans(J+"controls.filterClient"))),v.add("action",y.a.component({onclick:function(){i("action:"+s.action())}},g.a.translator.trans(J+"controls.filterAction"))),h&&v.add("user",y.a.component({onclick:function(){i("user:"+h.username())}},g.a.translator.trans(J+"controls.filterUser"))),c.discussion_id&&v.add("discussion",y.a.component({onclick:function(){i("discussion:"+c.discussion_id)}},g.a.translator.trans(J+"controls.filterDiscussion"))),m(".AuditItem",[m(".AuditItemAvatar",n),m(".AuditItemData",[B.a.component({menuClassName:"Dropdown-menu--right",buttonClassName:"Button Button--icon Button--flat",label:g.a.translator.trans(J+"controls"),icon:"fas fa-ellipsis-v"},v.toArray()),m(".AuditItemRow",[e," - ",m("a",{onclick:function(){i("action:"+s.action())}},s.action())]),m(".AuditItemRow",o),m(".AuditItemRow",_.map((function(t,n){return[0===n?null:" - ",t]})))])])},t}(),W=function(t){function n(){return t.apply(this,arguments)||this}s(n,t);var e=n.prototype;return e.oninit=function(n){t.prototype.oninit.call(this,n),this.q="",this.loading=!0,this.moreResults=!1,this.logs=[],this.refresh()},e.view=function(){var t,n=this;return this.loading?t=k.a.component():this.moreResults&&(t=y.a.component({className:"Button Button--block",onclick:this.loadMore.bind(this)},g.a.translator.trans("kilowhat-audit.lib.browser.loadMore"))),m("div",[m(".AuditSearch",[m(".AuditSearchWrapper",[m("input.FormControl",{value:this.q,onchange:function(t){n.q=t.target.value},placeholder:g.a.translator.trans("kilowhat-audit.lib.browser.filterPlaceholder")}),this.q?y.a.component({className:"Search-clear Button Button--icon Button--link",onclick:function(){n.q="",n.refresh()},icon:"fas fa-times-circle"}):null]),y.a.component({className:"Button",onclick:function(){n.refresh()}},g.a.translator.trans("kilowhat-audit.lib.browser.filterApply"))]),0!==this.logs.length||this.loading?null:x.a.component({text:g.a.translator.trans("kilowhat-audit.lib.browser.empty")}),m(".AuditList",this.logs.map((function(t){return m(F,{log:t,changeQuery:function(t){n.q=t,n.refresh()}})}))),m(".AuditMore",t)])},e.requestParams=function(){var t={filter:{}},n=this.attrs.baseQ||"";return this.q&&(n+=" "+this.q),n&&(t.filter.q=n.trim()),t},e.refresh=function(t){var n=this;return void 0===t&&(t=!0),t&&(this.loading=!0,this.logs=[]),this.loadResults().then((function(t){n.logs=[],n.parseResults(t)}),(function(){n.loading=!1,m.redraw()}))},e.loadResults=function(t){var n=this.requestParams();return n.page={offset:t},g.a.store.find("kilowhat-audit/logs",n)},e.loadMore=function(){this.loading=!0,this.loadResults(this.logs.length).then(this.parseResults.bind(this))},e.parseResults=function(t){return[].push.apply(this.logs,t),this.loading=!1,this.moreResults=!!t.payload.links.next,m.redraw(),t},n}(w.a),H=function(t){function n(){return t.apply(this,arguments)||this}s(n,t);var e=n.prototype;return e.className=function(){return t.prototype.className.call(this)+" AuditPage"},e.header=function(){var n=t.prototype.header.call(this);return n[0].children.push(f()("fas fa-book",{className:"AuditBanner"})),n[0].children[0].children[0].children[1].children=[m("h2",[a.a.translator.trans("kilowhat-audit.admin.header.title"),m("span.badge",a.a.translator.trans("kilowhat-audit.admin.header.free")),m("a.AuditUpgrade",{target:"_blank",href:"https://kilowhat.net/flarum/extensions/audit"},[f()("fas fa-rocket")," ",a.a.translator.trans("kilowhat-audit.admin.header.upgrade")])])],n},e.content=function(){return m(".AuditPageContainer",m(W))},n}(d.a);a.a.initializers.add("kilowhat-audit",(function(){a.a.store.models["kilowhat-audit"]=c,a.a.route.discussion||(a.a.route.discussion=function(t){return a.a.forum.attribute("baseUrl")+"/d/"+t.slug()}),a.a.route.post||(a.a.route.post=function(t){return a.a.route.discussion(t.discussion())+"/"+t.number()}),a.a.route.tag||(a.a.route.tag=function(t){return a.a.forum.attribute("baseUrl")+"/t/"+t.slug()}),a.a.route.user||(a.a.route.user=function(t){return a.a.forum.attribute("baseUrl")+"/u/"+t.slug()}),a.a.extensionData.for("kilowhat-audit-free").registerPage(H)}))}]);
//# sourceMappingURL=admin.js.map