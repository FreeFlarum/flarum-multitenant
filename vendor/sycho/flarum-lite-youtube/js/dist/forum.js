(()=>{var t=t=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e={};(()=>{"use strict";function n(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}function o(t,e){return o=Object.setPrototypeOf?Object.setPrototypeOf.bind():function(t,e){return t.__proto__=e,t},o(t,e)}function i(t){return i=Object.setPrototypeOf?Object.getPrototypeOf.bind():function(t){return t.__proto__||Object.getPrototypeOf(t)},i(t)}function r(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(t){return!1}}function a(t,e,n){return a=r()?Reflect.construct.bind():function(t,e,n){var i=[null];i.push.apply(i,e);var r=new(Function.bind.apply(t,i));return n&&o(r,n.prototype),r},a.apply(null,arguments)}function s(t){var e="function"==typeof Map?new Map:void 0;return s=function(t){if(null===t||(n=t,-1===Function.toString.call(n).indexOf("[native code]")))return t;var n;if("function"!=typeof t)throw new TypeError("Super expression must either be null or a function");if(void 0!==e){if(e.has(t))return e.get(t);e.set(t,r)}function r(){return a(t,arguments,i(this).constructor)}return r.prototype=Object.create(t.prototype,{constructor:{value:r,enumerable:!1,writable:!0,configurable:!0}}),o(r,t)},s(t)}t(e);var c=function(t){var e,i;function r(){var e;return(e=t.call(this)||this).isIframeLoaded=!1,e.setupDom(),e}i=t,(e=r).prototype=Object.create(i.prototype),e.prototype.constructor=e,o(e,i);var a,s,c,l=r.prototype;return l.connectedCallback=function(){var t=this;this.addEventListener("pointerover",r.warmConnections,{once:!0}),this.addEventListener("click",(function(){return t.addIframe()}))},l.setupDom=function(){var t=this.attachShadow({mode:"open"});t.innerHTML='\n      <style>\n        :host {\n          contain: content;\n          display: block;\n          position: relative;\n          width: 100%;\n          padding-bottom: calc(100% / (16 / 9));\n          --lyt-animation: all 0.2s cubic-bezier(0, 0, 0.2, 1);\n          --lyt-play-btn-default: #212121;\n          --lyt-play-btn-hover: #f00;\n        }\n\n        @media (max-width: 40em) {\n          :host([short]) {\n            padding-bottom: calc(100% / (9 / 16));\n          }\n        }\n\n        #frame, #fallbackPlaceholder, iframe {\n          position: absolute;\n          width: 100%;\n          height: 100%;\n          left: 0;\n        }\n\n        #frame {\n          cursor: pointer;\n        }\n\n        #fallbackPlaceholder {\n          object-fit: cover;\n        }\n\n        #frame::before {\n          content: \'\';\n          display: block;\n          position: absolute;\n          top: 0;\n          background-image: linear-gradient(180deg, #111 -20%, transparent 90%);\n          height: 60px;\n          width: 100%;\n          transition: var(--lyt-animation);\n          z-index: 1;\n        }\n\n        #playButton {\n          width: 70px;\n          height: 46px;\n          background-color: var(--lyt-play-btn-hover);\n          z-index: 1;\n          opacity: 0.8;\n          border-radius: 14%;\n          transition: var(--lyt-animation);\n          border: 0;\n        }\n\n        #frame:hover > #playButton {\n          background-color: var(--lyt-play-btn-hover);\n          opacity: 1;\n        }\n\n        #playButton:before {\n          content: \'\';\n          border-style: solid;\n          border-width: 11px 0 11px 19px;\n          border-color: transparent transparent transparent #fff;\n        }\n\n        #playButton,\n        #playButton:before {\n          position: absolute;\n          top: 50%;\n          left: 50%;\n          transform: translate3d(-50%, -50%, 0);\n          cursor: inherit;\n        }\n\n        /* Post-click styles */\n        .activated {\n          cursor: unset;\n        }\n\n        #frame.activated::before,\n        #frame.activated > #playButton {\n          display: none;\n        }\n      </style>\n      <div id="frame">\n        <picture>\n          <source id="webpPlaceholder" type="image/webp">\n          <source id="jpegPlaceholder" type="image/jpeg">\n          <img id="fallbackPlaceholder" referrerpolicy="origin" loading="lazy">\n        </picture>\n        <button id="playButton"></button>\n      </div>\n    ',this.domRefFrame=t.querySelector("#frame"),this.domRefImg={fallback:t.querySelector("#fallbackPlaceholder"),webp:t.querySelector("#webpPlaceholder"),jpeg:t.querySelector("#jpegPlaceholder")},this.domRefPlayButton=t.querySelector("#playButton")},l.setupComponent=function(){this.initImagePlaceholder(),this.domRefPlayButton.setAttribute("aria-label",this.videoPlay+": "+this.videoTitle),this.setAttribute("title",this.videoPlay+": "+this.videoTitle),(this.autoLoad||this.isYouTubeShort())&&this.initIntersectionObserver()},l.attributeChangedCallback=function(t,e,n){switch(t){case"videoid":case"playlistid":case"videoTitle":case"videoPlay":e!==n&&(this.setupComponent(),this.domRefFrame.classList.contains("activated")&&(this.domRefFrame.classList.remove("activated"),this.shadowRoot.querySelector("iframe").remove(),this.isIframeLoaded=!1))}},l.addIframe=function(t){if(void 0===t&&(t=!1),!this.isIframeLoaded){var e,n=t?0:1,o=this.noCookie?"-nocookie":"";e=this.playlistId?"?listType=playlist&list="+this.playlistId+"&":this.videoId+"?",this.isYouTubeShort()&&(this.params="loop=1&mute=1&modestbranding=1&playsinline=1&rel=0&enablejsapi=1&playlist="+this.videoId,n=1);var i='\n<iframe frameborder="0"\n  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen\n  src="https://www.youtube'+o+".com/embed/"+e+"autoplay="+n+"&"+this.params+'"\n></iframe>';this.domRefFrame.insertAdjacentHTML("beforeend",i),this.domRefFrame.classList.add("activated"),this.isIframeLoaded=!0,this.attemptShortAutoPlay(),this.dispatchEvent(new CustomEvent("liteYoutubeIframeLoaded",{detail:{videoId:this.videoId},bubbles:!0,cancelable:!0}))}},l.initImagePlaceholder=function(){var t,e;r.addPrefetch("preconnect","https://i.ytimg.com/");var n="https://i.ytimg.com/vi_webp/"+this.videoId+"/"+this.posterQuality+".webp",o="https://i.ytimg.com/vi/"+this.videoId+"/"+this.posterQuality+".jpg";this.domRefImg.fallback.loading=this.posterLoading,this.domRefImg.webp.srcset=n,this.domRefImg.jpeg.srcset=o,this.domRefImg.fallback.src=o,this.domRefImg.fallback.setAttribute("aria-label",this.videoPlay+": "+this.videoTitle),null==(t=this.domRefImg)||null==(e=t.fallback)||e.setAttribute("alt",this.videoPlay+": "+this.videoTitle)},l.initIntersectionObserver=function(){var t=this;new IntersectionObserver((function(e,n){e.forEach((function(e){e.isIntersecting&&!t.isIframeLoaded&&(r.warmConnections(),t.addIframe(!0),n.unobserve(t))}))}),{root:null,rootMargin:"0px",threshold:0}).observe(this)},l.attemptShortAutoPlay=function(){var t=this;this.isYouTubeShort()&&setTimeout((function(){var e,n;null==(e=t.shadowRoot.querySelector("iframe"))||null==(n=e.contentWindow)||n.postMessage('{"event":"command","func":"playVideo","args":""}',"*")}),2e3)},l.isYouTubeShort=function(){return""===this.getAttribute("short")&&window.matchMedia("(max-width: 40em)").matches},r.addPrefetch=function(t,e){var n=document.createElement("link");n.rel=t,n.href=e,n.crossOrigin="true",document.head.append(n)},r.warmConnections=function(){r.isPreconnected||(r.addPrefetch("preconnect","https://s.ytimg.com"),r.addPrefetch("preconnect","https://www.youtube.com"),r.addPrefetch("preconnect","https://www.google.com"),r.addPrefetch("preconnect","https://googleads.g.doubleclick.net"),r.addPrefetch("preconnect","https://static.doubleclick.net"),r.isPreconnected=!0)},a=r,c=[{key:"observedAttributes",get:function(){return["videoid","playlistid"]}}],(s=[{key:"videoId",get:function(){return encodeURIComponent(this.getAttribute("videoid")||"")},set:function(t){this.setAttribute("videoid",t)}},{key:"playlistId",get:function(){return encodeURIComponent(this.getAttribute("playlistid")||"")},set:function(t){this.setAttribute("playlistid",t)}},{key:"videoTitle",get:function(){return this.getAttribute("videotitle")||"Video"},set:function(t){this.setAttribute("videotitle",t)}},{key:"videoPlay",get:function(){return this.getAttribute("videoPlay")||"Play"},set:function(t){this.setAttribute("videoPlay",t)}},{key:"videoStartAt",get:function(){return this.getAttribute("videoStartAt")||"0"}},{key:"autoLoad",get:function(){return this.hasAttribute("autoload")}},{key:"noCookie",get:function(){return this.hasAttribute("nocookie")}},{key:"posterQuality",get:function(){return this.getAttribute("posterquality")||"hqdefault"}},{key:"posterLoading",get:function(){return this.getAttribute("posterloading")||"lazy"}},{key:"params",get:function(){return"start="+this.videoStartAt+"&"+this.getAttribute("params")},set:function(t){this.setAttribute("params",t)}}])&&n(a.prototype,s),c&&n(a,c),Object.defineProperty(a,"prototype",{writable:!1}),r}(s(HTMLElement));c.isPreconnected=!1,customElements.define("lite-youtube",c)})(),module.exports=e})();
//# sourceMappingURL=forum.js.map