module.exports=function(e){var t={};function n(i){if(t[i])return t[i].exports;var r=t[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(i,r,function(t){return e[t]}.bind(null,r));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=14)}({0:function(e,t){e.exports=flarum.core.compat.app},14:function(e,t,n){"use strict";n.r(t);var i=n(0),r=n.n(i);r.a.initializers.add("cxsquared-signature",(function(){r.a.extensionData.for("kyrne-signature").registerSetting({setting:"Xengine-signature.maximum_image_width",type:"text",label:r.a.translator.trans("Xengine-signature.admin.settings.maximum_image_width.description")}).registerSetting({setting:"Xengine-signature.maximum_image_height",type:"text",label:r.a.translator.trans("Xengine-signature.admin.settings.maximum_image_height.description")}).registerSetting({setting:"Xengine-signature.maximum_image_count",type:"text",label:r.a.translator.trans("Xengine-signature.admin.settings.maximum_image_count.description")}).registerSetting({setting:"Xengine-signature.maximum_char_limit",type:"text",label:r.a.translator.trans("Xengine-signature.admin.settings.maximum_char_limit.description")})}))}});
//# sourceMappingURL=admin.js.map