module.exports =
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./forum.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./forum.js":
/*!******************!*\
  !*** ./forum.js ***!
  \******************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _src_forum__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./src/forum */ "./src/forum/index.js");
/* harmony import */ var _src_forum__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_src_forum__WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _src_forum__WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _src_forum__WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));

!function () {
  "use strict";

  function s() {
    var t = this,
        e = this,
        i = soundManager,
        s = navigator.userAgent.match(/msie/i);
    this.playableClass = "inline-playable", this.excludeClass = "inline-exclude", this.links = [], this.sounds = [], this.soundsByURL = [], this.indexByURL = [], this.lastSound = null, this.soundCount = 0, this.config = {
      playNext: !1,
      autoPlay: !1
    }, this.css = {
      sDefault: "sm2_link",
      sLoading: "sm2_loading",
      sPlaying: "sm2_playing",
      sPaused: "sm2_paused"
    }, this.addEventHandler = void 0 !== window.addEventListener ? function (s, e, n) {
      return s.addEventListener(e, n, !1);
    } : function (s, e, n) {
      s.attachEvent("on" + e, n);
    }, this.removeEventHandler = void 0 !== window.removeEventListener ? function (s, e, n) {
      return s.removeEventListener(e, n, !1);
    } : function (s, e, n) {
      return s.detachEvent("on" + e, n);
    }, this.classContains = function (s, e) {
      return void 0 !== s.className && s.className.match(new RegExp("(\\s|^)" + e + "(\\s|$)"));
    }, this.addClass = function (s, e) {
      s && e && !t.classContains(s, e) && (s.className = (s.className ? s.className + " " : "") + e);
    }, this.removeClass = function (s, e) {
      s && e && t.classContains(s, e) && (s.className = s.className.replace(new RegExp("( " + e + ")|(" + e + ")", "g"), ""));
    }, this.getSoundByURL = function (s) {
      return void 0 !== t.soundsByURL[s] ? t.soundsByURL[s] : null;
    }, this.isChildOfNode = function (s, e) {
      if (!s || !s.parentNode) return !1;

      for (e = e.toLowerCase(); s = s.parentNode, s && s.parentNode && s.nodeName.toLowerCase() !== e;) {
        ;
      }

      return s.nodeName.toLowerCase() === e ? s : null;
    }, this.events = {
      play: function play() {
        e.removeClass(this._data.oLink, this._data.className), this._data.className = e.css.sPlaying, e.addClass(this._data.oLink, this._data.className);
      },
      stop: function stop() {
        e.removeClass(this._data.oLink, this._data.className), this._data.className = "";
      },
      pause: function pause() {
        e.removeClass(this._data.oLink, this._data.className), this._data.className = e.css.sPaused, e.addClass(this._data.oLink, this._data.className);
      },
      resume: function resume() {
        e.removeClass(this._data.oLink, this._data.className), this._data.className = e.css.sPlaying, e.addClass(this._data.oLink, this._data.className);
      },
      finish: function finish() {
        var s;
        e.removeClass(this._data.oLink, this._data.className), this._data.className = "", !e.config.playNext || (s = e.indexByURL[this._data.oLink.href] + 1) < e.links.length && e.handleClick({
          target: e.links[s]
        });
      }
    }, this.stopEvent = function (s) {
      return void 0 !== s && void 0 !== s.preventDefault ? s.preventDefault() : "undefined" != typeof event && void 0 !== event.returnValue && (event.returnValue = !1), !1;
    }, this.getTheDamnLink = s ? function (s) {
      return s && s.target ? s.target : window.event.srcElement;
    } : function (s) {
      return s.target;
    }, this.handleClick = function (s) {
      if (void 0 !== s.button && 1 < s.button) return !0;
      var e = t.getTheDamnLink(s);
      if ("a" !== e.nodeName.toLowerCase() && !(e = t.isChildOfNode(e, "a"))) return !0;
      if (!e.href || !i.canPlayLink(e) && !t.classContains(e, t.playableClass) || t.classContains(e, t.excludeClass)) return !0;
      var n = e.href,
          a = t.getSoundByURL(n);
      return a ? (a === t.lastSound || (i._writeDebug("sound different than last sound: " + t.lastSound.id), t.lastSound && t.stopSound(t.lastSound)), a.togglePause()) : (t.lastSound && t.stopSound(t.lastSound), (a = i.createSound({
        id: "inlineMP3Sound" + t.soundCount++,
        url: n,
        onplay: t.events.play,
        onstop: t.events.stop,
        onpause: t.events.pause,
        onresume: t.events.resume,
        onfinish: t.events.finish,
        type: e.type || null
      }))._data = {
        oLink: e,
        className: t.css.sPlaying
      }, t.soundsByURL[n] = a, t.sounds.push(a), a.play()), t.lastSound = a, void 0 !== s && void 0 !== s.preventDefault ? s.preventDefault() : event.returnValue = !1, !1;
    }, this.stopSound = function (s) {
      soundManager.stop(s.id), soundManager.unload(s.id);
    }, this.init = function () {
      i._writeDebug("inlinePlayer.init()");

      for (var s = document.getElementsByTagName("a"), e = 0, n = 0, a = s.length; n < a; n++) {
        !i.canPlayLink(s[n]) && !t.classContains(s[n], t.playableClass) || t.classContains(s[n], t.excludeClass) || (t.addClass(s[n], t.css.sDefault), t.links[e] = s[n], t.indexByURL[s[n].href] = e, e++);
      }

      0 < e && (t.addEventHandler(document, "click", t.handleClick), t.config.autoPlay && t.handleClick({
        target: t.links[0],
        preventDefault: function preventDefault() {}
      })), i._writeDebug("inlinePlayer.init(): Found " + e + " relevant items.");
    }, this.init();
  }

  window.inlinePlayer = null, soundManager.setup({
    debugMode: !1,
    preferFlash: !1,
    useFlashBlock: !1,
    url: "../../swf/",
    flashVersion: 9
  }), soundManager.onready(function () {
    new s();
  });
}();

/***/ }),

/***/ "./src/forum/index.js":
/*!****************************!*\
  !*** ./src/forum/index.js ***!
  \****************************/
/*! no static exports found */
/***/ (function(module, exports) {

app.initializers.add('zerosonesfun/flarum-inline-audio', function () {
  return;
});

/***/ })

/******/ });
//# sourceMappingURL=forum.js.map