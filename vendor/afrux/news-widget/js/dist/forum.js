module.exports=function(e){var n={};function t(i){if(n[i])return n[i].exports;var r=n[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,t),r.l=!0,r.exports}return t.m=e,t.c=n,t.d=function(e,n,i){t.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:i})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,n){if(1&n&&(e=t(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(t.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var r in e)t.d(i,r,function(n){return e[n]}.bind(null,r));return i},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},t.p="",t(t.s=7)}([function(e,n){e.exports=flarum.core.compat["extensions/afrux-forum-widgets-core/common/extend/Widgets"]},function(e,n){e.exports=flarum.core.compat["common/helpers/icon"]},function(e,n){e.exports=flarum.core.compat["common/utils/classList"]},function(e,n){e.exports=flarum.core.compat["common/utils/Stream"]},function(e,n){e.exports=flarum.core.compat["extensions/afrux-forum-widgets-core/common/components/Widget"]},function(e,n,t){"use strict";var i=t(0),r=t.n(i);function o(e,n){return(o=Object.setPrototypeOf||function(e,n){return e.__proto__=n,e})(e,n)}var s=t(1),u=t.n(s),c=t(2),a=t.n(c),l=t(3),f=t.n(l),p=t(4),d=function(e){var n,t;function i(){for(var n,t=arguments.length,i=new Array(t),r=0;r<t;r++)i[r]=arguments[r];return(n=e.call.apply(e,[this].concat(i))||this).newslines=void 0,n.line=void 0,n.switching=void 0,n}t=e,(n=i).prototype=Object.create(t.prototype),n.prototype.constructor=n,o(n,t);var r=i.prototype;return r.oninit=function(n){e.prototype.oninit.call(this,n),this.newslines=app.forum.attribute("afrux-news-widget.lines"),this.line=f()({index:0,text:this.newslines[0]}),this.switching=!1},r.className=function(){return"Afrux-NewsWidget"},r.icon=function(){return"fas fa-bullhorn"},r.title=function(){return""},r.content=function(){var e,n=this;return this.newslines.length>1&&!this.switching&&(this.switching=!0,setTimeout((function(){var e=(n.line().index+1)%n.newslines.length;n.switching=!1,n.line({index:e,text:n.newslines[e]}),m.redraw()}),7e3)),this.newslines.length>1&&(e=this.newslines[(this.line().index-1+this.newslines.length)%this.newslines.length]),m("div",{className:"Afrux-NewsWidget-content"},m("div",{className:"Afrux-NewsWidget-icon"},u()("fas fa-bullhorn")),m("div",{className:"Afrux-NewsWidget-line-container"},this.newslines.map((function(t,i){return m("div",{className:a()(["Afrux-NewsWidget-line",n.line().index===i?"Afrux-NewsWidget-line--current":"",e===t?"Afrux-NewsWidget-line--previous":""]),key:i},t)}))))},i}(t.n(p).a);n.a=function(e){(new r.a).add({key:"news",component:d,isDisabled:function(){return!e.forum.attribute("afrux-news-widget.lines").length},isUnique:!0,placement:"top",position:1}).extend(e,"afrux-news-widget")}},,function(e,n,t){"use strict";t.r(n);var i=t(5);app.initializers.add("afrux/news-widget",(function(){Object(i.a)(app)}))}]);
//# sourceMappingURL=forum.js.map