module.exports=function(t){var e={};function r(o){if(e[o])return e[o].exports;var n=e[o]={i:o,l:!1,exports:{}};return t[o].call(n.exports,n,n.exports,r),n.l=!0,n.exports}return r.m=t,r.c=e,r.d=function(t,e,o){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:o})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(r.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)r.d(o,n,function(e){return t[e]}.bind(null,n));return o},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="",r(r.s=9)}([function(t,e){t.exports=flarum.core.compat["extensions/afrux-forum-widgets-core/common/extend/Widgets"]},function(t,e){t.exports=flarum.core.compat["common/components/LoadingIndicator"]},function(t,e){t.exports=flarum.core.compat["common/helpers/avatar"]},function(t,e){t.exports=flarum.core.compat["common/helpers/icon"]},function(t,e){t.exports=flarum.core.compat["extensions/afrux-forum-widgets-core/common/components/Widget"]},function(t,e,r){"use strict";var o=r(0),n=r.n(o);function s(t,e){return(s=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}var a=r(1),i=r.n(a),u=r(2),c=r.n(u),f=r(3),p=r.n(f),d=r(4),l=function(t){var e,r;function o(){for(var e,r=arguments.length,o=new Array(r),n=0;n<r;n++)o[n]=arguments[n];return(e=t.call.apply(t,[this].concat(o))||this).monthlyCounts=void 0,e}r=t,(e=o).prototype=Object.create(r.prototype),e.prototype.constructor=e,s(e,r);var n=o.prototype;return n.oninit=function(e){var r,o,n;t.prototype.oninit.call(this,e),this.monthlyCounts=app.forum.attribute("afrux-top-posters-widget.data"),null!=(r=this.attrs.state).users||(r.users=[]),null!=(o=this.attrs.state).isLoading||(o.isLoading=!1),null!=(n=this.attrs.state).hasLoaded||(n.hasLoaded=!1)},n.oncreate=function(e){t.prototype.oncreate.call(this,e),this.attrs.state.hasLoaded||this.load()},n.className=function(){return"Afrux-TopPostersWidget"},n.icon=function(){return"fas fa-sort-numeric-down"},n.title=function(){return app.translator.trans("afrux-top-posters-widget.forum.widget.title")},n.description=function(){return""},n.content=function(){var t=this;if(this.attrs.state.isLoading)return m(i.a,null);var e=this.attrs.state.users.sort((function(e,r){return t.monthlyCounts[r.id()]-t.monthlyCounts[e.id()]}));return m("div",{className:"Afrux-TopPostersWidget-users"},e.map((function(e){return m("div",{className:"Afrux-TopPostersWidget-users-item"},m("div",{className:"Afrux-TopPostersWidget-users-item-avatar"},c()(e)),m("div",{className:"Afrux-TopPostersWidget-users-item-content"},m("div",{className:"Afrux-TopPostersWidget-users-item-name"},e.displayName()),m("div",{className:"Afrux-TopPostersWidget-users-item-value"},p()("fas fa-comment-dots")," ",t.monthlyCounts[e.id()])))})))},n.load=function(){var t=this;this.attrs.state.isLoading=!0,app.store.find("users",{filter:{top_poster:!0}}).then((function(e){t.attrs.state.users=e,t.attrs.state.isLoading=!1,t.attrs.state.hasLoaded=!0,m.redraw()}))},o}(r.n(d).a);e.a=function(t){(new n.a).add({key:"topPosters",component:l,isDisabled:function(){var e=t.forum.attribute("afrux-top-posters-widget.data");return!t.forum.attribute("canSearchUsers")||!e||!Object.keys(e).length},isUnique:!0,placement:"end",position:3}).extend(t,"afrux-top-posters-widget")}},,,,function(t,e,r){"use strict";r.r(e);var o=r(5);app.initializers.add("afrux/top-posters-widget",(function(){Object(o.a)(app)}))}]);
//# sourceMappingURL=admin.js.map