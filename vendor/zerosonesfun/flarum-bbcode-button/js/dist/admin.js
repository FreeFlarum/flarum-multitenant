module.exports=function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=8)}({0:function(e,t){e.exports=flarum.core.compat["admin/app"]},8:function(e,t,n){"use strict";n.r(t);var o=n(0),r=n.n(o);r.a.initializers.add("zerosonesfun/flarum-bbcode-button",(function(){r.a.extensionData.for("zerosonesfun-bbcode-button").registerSetting({setting:"zerosonesfun-bbcode-button.intro",name:"zerosonesfun-bbcode-button.intro",type:"text",help:r.a.translator.trans("flarum-bbcode-button.admin.settings.introdesc"),label:r.a.translator.trans("flarum-bbcode-button.admin.settings.introlabel")},3),r.a.extensionData.for("zerosonesfun-bbcode-button").registerSetting({setting:"zerosonesfun-bbcode-button.code",name:"zerosonesfun-bbcode-button.code",type:"text",placeholder:"[bbcode][/bbcode]",help:r.a.translator.trans("flarum-bbcode-button.admin.settings.codedesc"),label:r.a.translator.trans("flarum-bbcode-button.admin.settings.codelabel")},2),r.a.extensionData.for("zerosonesfun-bbcode-button").registerSetting({setting:"zerosonesfun-bbcode-button.pos",name:"zerosonesfun-bbcode-button.pos",type:"number",value:"4",placeholder:"4",help:r.a.translator.trans("flarum-bbcode-button.admin.settings.posdesc"),label:r.a.translator.trans("flarum-bbcode-button.admin.settings.poslabel")},0),r.a.extensionData.for("zerosonesfun-bbcode-button").registerSetting({setting:"zerosonesfun-bbcode-button.icon",name:"zerosonesfun-bbcode-button.icon",type:"text",value:"fas fa-font",placeholder:"fas fa-font",help:r.a.translator.trans("flarum-bbcode-button.admin.settings.icondesc"),label:r.a.translator.trans("flarum-bbcode-button.admin.settings.iconlabel")},1)}))}});
//# sourceMappingURL=admin.js.map