module.exports=function(t){var r={};function a(n){if(r[n])return r[n].exports;var o=r[n]={i:n,l:!1,exports:{}};return t[n].call(o.exports,o,o.exports,a),o.l=!0,o.exports}return a.m=t,a.c=r,a.d=function(t,r,n){a.o(t,r)||Object.defineProperty(t,r,{enumerable:!0,get:n})},a.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},a.t=function(t,r){if(1&r&&(t=a(t)),8&r)return t;if(4&r&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&r&&"string"!=typeof t)for(var o in t)a.d(n,o,function(r){return t[r]}.bind(null,o));return n},a.n=function(t){var r=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(r,"a",r),r},a.o=function(t,r){return Object.prototype.hasOwnProperty.call(t,r)},a.p="",a(a.s=6)}([function(t,r){t.exports=flarum.core.compat["forum/app"]},function(t,r){t.exports=flarum.core.compat["common/components/Button"]},function(t,r){t.exports=flarum.core.compat["common/extend"]},function(t,r){t.exports=flarum.core.compat["forum/components/AvatarEditor"]},function(t,r){t.exports=flarum.core.compat["common/models/User"]},function(t,r){t.exports=flarum.core.compat["common/components/Modal"]},function(t,r,a){"use strict";a.r(r);var n=a(2),o=a(0),e=a.n(o),i=a(1),s=a.n(i),u=a(4),c=a.n(u),p=a(3),l=a.n(p);function f(t,r){return(f=Object.setPrototypeOf||function(t,r){return t.__proto__=r,t})(t,r)}var d=a(5),h=function(t){var r,a;function n(){return t.apply(this,arguments)||this}a=t,(r=n).prototype=Object.create(a.prototype),r.prototype.constructor=r,f(r,a);var o=n.prototype;return o.oninit=function(r){t.prototype.oninit.call(this,r),this.success=!1,this.oldMinotar=app.session.user.attribute("minotar"),this.minotar=app.session.user.attribute("minotar")},o.className=function(){return"NearataMinecraftAvatarsModal Modal--small"},o.title=function(){return app.translator.trans("nearata-minecraft-avatars.forum.title")},o.content=function(){var t=this;return[m(".Modal-body",[m(".Form.Form--centered",[this.success?[m("p.helpText",app.translator.trans("nearata-minecraft-avatars.forum.avatar_changed")),m(".Form-group",[m(s.a,{class:"Button Button--primary Button--block",onclick:this.hide.bind(this)},app.translator.trans("nearata-minecraft-avatars.forum.dismiss_button"))])]:[m("p.helpText",app.translator.trans("nearata-minecraft-avatars.forum.help_text")),m(".Form-group",[m("input",{type:"name",name:"minotar",class:"FormControl",placeholder:this.oldMinotar||"Notch",oninput:function(r){return t.minotar=r.target.value},disabled:this.loading,autocomplete:"off"})]),m(".Form-group",[m(s.a,{class:"Button Button--primary Button--block",type:"submit",loading:this.loading},app.translator.trans("nearata-minecraft-avatars.forum.submit_button"))])]])]),m(".Modal-footer",[m("span",["Powered by ",m("a",{href:"https://crafatar.com/",target:"_blank"},"Crafatar")])])]},o.onsubmit=function(t){var r=this;t.preventDefault(),this.minotar!==this.oldMinotar?(this.loading=!0,this.alertAttrs=null,app.session.user.save({minotar:this.minotar},{errorHandler:this.onerror.bind(this),meta:{minotar:this.minotar}}).then((function(){return r.success=!0})).catch((function(){})).then(this.loaded.bind(this))):this.hide()},n}(a.n(d).a);e.a.initializers.add("nearata-minecraft-avatars",(function(){c.a.prototype.avatarUrl=function(){var t=this.attribute("avatarUrl"),r=this.attribute("minotar");return r?"https://crafatar.com/avatars/"+r+"?size=64":t},Object(n.extend)(l.a.prototype,"controlItems",(function(t){var r=e.a.session.user.attribute("minotar"),a=e.a.translator.trans("nearata-minecraft-avatars.forum.change_button"),n=e.a.translator.trans("nearata-minecraft-avatars.forum.use_button");t.add("nearataMinecraftAvatars",m(s.a,{icon:"fas fa-cloud-upload-alt",onclick:function(){return e.a.modal.show(h)}},r?a:n),1);var o=e.a.session.user.avatarUrl();o?o.startsWith("https://crafatar.com")?t.remove("upload"):t.remove("nearataMinecraftAvatars"):t.remove("remove")})),Object(n.override)(l.a.prototype,"quickUpload",(function(){})),Object(n.extend)(l.a.prototype,"remove",(function(){this.attrs.user.attribute("minotar")&&e.a.session.user.save({minotar:""}).then(this.success.bind(this),this.failure.bind(this))}))}))}]);
//# sourceMappingURL=forum.js.map