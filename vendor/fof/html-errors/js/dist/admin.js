module.exports=function(r){var e={};function t(n){if(e[n])return e[n].exports;var o=e[n]={i:n,l:!1,exports:{}};return r[n].call(o.exports,o,o.exports,t),o.l=!0,o.exports}return t.m=r,t.c=e,t.d=function(r,e,n){t.o(r,e)||Object.defineProperty(r,e,{enumerable:!0,get:n})},t.r=function(r){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(r,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(r,"__esModule",{value:!0})},t.t=function(r,e){if(1&e&&(r=t(r)),8&e)return r;if(4&e&&"object"==typeof r&&r&&r.__esModule)return r;var n=Object.create(null);if(t.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:r}),2&e&&"string"!=typeof r)for(var o in r)t.d(n,o,function(e){return r[e]}.bind(null,o));return n},t.n=function(r){var e=r&&r.__esModule?function(){return r.default}:function(){return r};return t.d(e,"a",e),e},t.o=function(r,e){return Object.prototype.hasOwnProperty.call(r,e)},t.p="",t(t.s=1)}([function(r,e){r.exports=flarum.core.compat.app},function(r,e,t){"use strict";t.r(e);var n=t(0);t.n(n).a.initializers.add("fof-html-errors",(function(r){r.extensionData.for("fof-html-errors").registerSetting((function(){var e=this;return[403,404,500,503].map((function(t){return m("div",{className:"Form-group"},m("label",null,r.translator.trans("fof-html-errors.admin.settings.error."+t)),m("textarea",{className:"FormControl",bidi:e.setting("flagrow-html-errors.custom"+t+"ErrorHtml"),placeholder:r.translator.trans("fof-html-errors.admin.settings.placeholder.empty_for_default")}))}))}))}))}]);
//# sourceMappingURL=admin.js.map