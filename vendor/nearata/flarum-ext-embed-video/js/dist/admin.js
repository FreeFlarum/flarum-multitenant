module.exports=function(e){var t={};function n(a){if(t[a])return t[a].exports;var i=t[a]={i:a,l:!1,exports:{}};return e[a].call(i.exports,i,i.exports,n),i.l=!0,i.exports}return n.m=e,n.c=t,n.d=function(e,t,a){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)n.d(a,i,function(t){return e[t]}.bind(null,i));return a},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=10)}({1:function(e,t){app.initializers.add("nearata-embed-video",(function(e){e.extensionData.for("nearata-embed-video").registerSetting({setting:"nearata-embed-video.admin.settings.video_type.dash",label:e.translator.trans("nearata-embed-video.admin.settings.video_types.dash"),type:"boolean"}).registerSetting({setting:"nearata-embed-video.admin.settings.video_type.flv",label:e.translator.trans("nearata-embed-video.admin.settings.video_types.flv"),type:"boolean"}).registerSetting({setting:"nearata-embed-video.admin.settings.video_type.hls",label:e.translator.trans("nearata-embed-video.admin.settings.video_types.hls"),type:"boolean"}).registerSetting({setting:"nearata-embed-video.admin.settings.video_type.shaka",label:e.translator.trans("nearata-embed-video.admin.settings.video_types.shaka"),type:"boolean"}).registerSetting({setting:"nearata-embed-video.admin.settings.video_type.webtorrent",label:e.translator.trans("nearata-embed-video.admin.settings.video_types.webtorrent"),type:"boolean"}).registerSetting((function(){return[m(".Form-group",[m("label",e.translator.trans("nearata-embed-video.admin.settings.options.theme")),m("input",{type:"text",class:"FormControl",bidi:this.setting("nearata-embed-video.admin.settings.options.theme"),placeholder:"#b7daff"})])]})).registerSetting({setting:"nearata-embed-video.admin.settings.options.logo",label:e.translator.trans("nearata-embed-video.admin.settings.options.logo"),type:"text"}).registerSetting({setting:"nearata-embed-video.admin.settings.options.lang",label:e.translator.trans("nearata-embed-video.admin.settings.options.lang"),type:"select",options:{en:"English","zh-cn":"Chinese Simplified","zh-tw":"Chinese Traditional"},default:"en"}).registerSetting({setting:"nearata-embed-video.admin.settings.options.airplay",label:e.translator.trans("nearata-embed-video.admin.settings.options.airplay"),type:"boolean"}).registerSetting({setting:"nearata-embed-video.admin.settings.options.hotkey",label:e.translator.trans("nearata-embed-video.admin.settings.options.hotkey"),type:"boolean"}).registerSetting({setting:"nearata-embed-video.admin.settings.options.quality_switching",label:e.translator.trans("nearata-embed-video.admin.settings.options.quality_switching"),type:"boolean"}).registerPermission({icon:"fas fa-tag",label:e.translator.trans("nearata-embed-video.admin.settings.permissions.can_create_video_player"),permission:"nearata.embedvideo.create"},"start",95)}))},10:function(e,t,n){"use strict";n.r(t);var a=n(1);for(var i in a)["default"].indexOf(i)<0&&function(e){n.d(t,e,(function(){return a[e]}))}(i)}});
//# sourceMappingURL=admin.js.map