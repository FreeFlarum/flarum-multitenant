module.exports=function(t){var e={};function n(i){if(e[i])return e[i].exports;var r=e[i]={i:i,l:!1,exports:{}};return t[i].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=t,n.c=e,n.d=function(t,e,i){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:i})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(i,r,function(e){return t[e]}.bind(null,r));return i},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=1)}([function(t,e){t.exports=flarum.core.compat["admin/app"]},function(t,e,n){"use strict";n.r(e);var i=n(0),r=n.n(i);r.a.initializers.add("clarkwinkelmann-email-whitelist",(function(){r.a.extensionData.for("clarkwinkelmann-email-whitelist").registerSetting({setting:"clarkwinkelmann-email-whitelist.regex",label:r.a.translator.trans("clarkwinkelmann-email-whitelist.admin.settings.regex"),help:r.a.translator.trans("clarkwinkelmann-email-whitelist.admin.settings.regexHelp"),type:"boolean"}).registerSetting({setting:"clarkwinkelmann-email-whitelist.message",label:r.a.translator.trans("clarkwinkelmann-email-whitelist.admin.settings.message"),type:"text"}).registerSetting((function(){return m(".Form-group",[m("label",r.a.translator.trans("clarkwinkelmann-email-whitelist.admin.settings.whitelist")),m(".helpText",r.a.translator.trans("clarkwinkelmann-email-whitelist.admin.settings.whitelistHelp")),m("textarea.FormControl",{bidi:this.setting("clarkwinkelmann-email-whitelist.whitelist")})])})).registerSetting((function(){return m(".Form-group",[m("label",r.a.translator.trans("clarkwinkelmann-email-whitelist.admin.settings.blacklist")),m(".helpText",r.a.translator.trans("clarkwinkelmann-email-whitelist.admin.settings.blacklistHelp")),m("textarea.FormControl",{bidi:this.setting("clarkwinkelmann-email-whitelist.blacklist")})])}))}))}]);
//# sourceMappingURL=admin.js.map