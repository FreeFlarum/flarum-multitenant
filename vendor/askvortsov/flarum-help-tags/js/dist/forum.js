module.exports=function(o){var t={};function e(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return o[n].call(r.exports,r,r.exports,e),r.l=!0,r.exports}return e.m=o,e.c=t,e.d=function(o,t,n){e.o(o,t)||Object.defineProperty(o,t,{enumerable:!0,get:n})},e.r=function(o){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(o,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(o,"__esModule",{value:!0})},e.t=function(o,t){if(1&t&&(o=e(o)),8&t)return o;if(4&t&&"object"==typeof o&&o&&o.__esModule)return o;var n=Object.create(null);if(e.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:o}),2&t&&"string"!=typeof o)for(var r in o)e.d(n,r,function(t){return o[t]}.bind(null,r));return n},e.n=function(o){var t=o&&o.__esModule?function(){return o.default}:function(){return o};return e.d(t,"a",t),t},e.o=function(o,t){return Object.prototype.hasOwnProperty.call(o,t)},e.p="",e(e.s=8)}([function(o,t){o.exports=flarum.core.compat.extend},function(o,t){o.exports=flarum.core.compat["models/Discussion"]},function(o,t){o.exports=flarum.core.compat.Model},function(o,t){o.exports=flarum.core.compat["utils/DiscussionControls"]},function(o,t){o.exports=flarum.core.compat.app},function(o,t){o.exports=flarum.core.compat["components/Badge"]},function(o,t){o.exports=flarum.core.compat["components/DiscussionPage"]},function(o,t){o.exports=flarum.core.compat["components/Button"]},function(o,t,e){"use strict";e.r(t);var n=e(4),r=e.n(n),a=e(2),s=e.n(a),l=e(1),c=e.n(l),u=e(0),i=e(5),p=e.n(i);var f=e(3),d=e.n(f),h=e(6),b=e.n(h),w=e(7),v=e.n(w);r.a.initializers.add("askvortsov-help-tags",(function(){c.a.prototype.showToAll=s.a.attribute("showToAll"),c.a.prototype.canShowToAll=s.a.attribute("canShowToAll"),Object(u.extend)(c.a.prototype,"badges",(function(o){this.showToAll()&&o.add("showToAll",p.a.component({type:"showToAll",label:app.translator.trans("askvortsov-help-tags.forum.badge.show_to_all_tooltip"),icon:"fas fa-eye"}),10)})),Object(u.extend)(d.a,"moderationControls",(function(o,t){t.canShowToAll()&&o.add("showToAll",v.a.component({icon:t.showToAll()?"fas fa-eye-slash":"fas fa-eye",onclick:this.showToAllAction.bind(t)},app.translator.trans(t.showToAll()?"askvortsov-help-tags.forum.discussion_controls.unshow_to_all_button":"askvortsov-help-tags.forum.discussion_controls.show_to_all_button")))})),d.a.showToAllAction=function(){this.save({showToAll:!this.showToAll()}).then((function(){app.current.matches(b.a)&&app.current.get("stream").update(),m.redraw()}))}}))}]);
//# sourceMappingURL=forum.js.map