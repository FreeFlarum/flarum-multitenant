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
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _src_forum__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./src/forum */ "./src/forum/index.js");
/* empty/unused harmony star reexport */

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _inheritsLoose; });
/* harmony import */ var _setPrototypeOf_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./setPrototypeOf.js */ "./node_modules/@babel/runtime/helpers/esm/setPrototypeOf.js");

function _inheritsLoose(subClass, superClass) {
  subClass.prototype = Object.create(superClass.prototype);
  subClass.prototype.constructor = subClass;
  Object(_setPrototypeOf_js__WEBPACK_IMPORTED_MODULE_0__["default"])(subClass, superClass);
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/setPrototypeOf.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/setPrototypeOf.js ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _setPrototypeOf; });
function _setPrototypeOf(o, p) {
  _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };

  return _setPrototypeOf(o, p);
}

/***/ }),

/***/ "./src/forum/components/ComposerPage.js":
/*!**********************************************!*\
  !*** ./src/forum/components/ComposerPage.js ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ComposerPage; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_forum_components_Page__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/components/Page */ "flarum/forum/components/Page");
/* harmony import */ var flarum_forum_components_Page__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_Page__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_forum_components_DiscussionComposer__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/forum/components/DiscussionComposer */ "flarum/forum/components/DiscussionComposer");
/* harmony import */ var flarum_forum_components_DiscussionComposer__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_DiscussionComposer__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_forum_components_LogInModal__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/forum/components/LogInModal */ "flarum/forum/components/LogInModal");
/* harmony import */ var flarum_forum_components_LogInModal__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_LogInModal__WEBPACK_IMPORTED_MODULE_4__);






var ComposerPage = /*#__PURE__*/function (_Page) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ComposerPage, _Page);

  function ComposerPage() {
    return _Page.apply(this, arguments) || this;
  }

  var _proto = ComposerPage.prototype;

  _proto.oninit = function oninit(v) {
    _Page.prototype.oninit.call(this, v);

    if (!flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.session.user) {
      setTimeout(function () {
        return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.modal.show(flarum_forum_components_LogInModal__WEBPACK_IMPORTED_MODULE_4___default.a);
      }, 500);
      return m.route.set('/');
    }

    var params = m.route.param();
    m.route.set('/all');
    setTimeout(function () {
      var composerProps = {
        user: flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.session.user
      };

      if (params.content) {
        composerProps.originalContent = params.content;
      }

      flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.composer.load(flarum_forum_components_DiscussionComposer__WEBPACK_IMPORTED_MODULE_3___default.a, composerProps);
      flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.composer.show();

      if (params.title) {
        flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.composer.fields.title(params.title);
      }

      console.debug(params);

      if (params.primary_tag) {
        var tag = flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.store.getBy('tags', 'slug', params.primary_tag);

        if (tag) {
          var parent = tag.parent();
          flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.composer.fields.tags = parent ? [parent, tag] : [tag];
        }
      }
    }, 0);
  };

  _proto.view = function view() {
    return m('div');
  };

  return ComposerPage;
}(flarum_forum_components_Page__WEBPACK_IMPORTED_MODULE_2___default.a);



/***/ }),

/***/ "./src/forum/components/ForgotPage.js":
/*!********************************************!*\
  !*** ./src/forum/components/ForgotPage.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ForgotPage; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var _RedirectToHomeAndOpenModalPage__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RedirectToHomeAndOpenModalPage */ "./src/forum/components/RedirectToHomeAndOpenModalPage.js");
/* harmony import */ var flarum_forum_components_ForgotPasswordModal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/components/ForgotPasswordModal */ "flarum/forum/components/ForgotPasswordModal");
/* harmony import */ var flarum_forum_components_ForgotPasswordModal__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_ForgotPasswordModal__WEBPACK_IMPORTED_MODULE_2__);




var ForgotPage = /*#__PURE__*/function (_RedirectToHomeAndOpe) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ForgotPage, _RedirectToHomeAndOpe);

  function ForgotPage() {
    return _RedirectToHomeAndOpe.apply(this, arguments) || this;
  }

  var _proto = ForgotPage.prototype;

  _proto.createModal = function createModal() {
    if (!app.session.user) {
      return flarum_forum_components_ForgotPasswordModal__WEBPACK_IMPORTED_MODULE_2___default.a;
    }
  };

  return ForgotPage;
}(_RedirectToHomeAndOpenModalPage__WEBPACK_IMPORTED_MODULE_1__["default"]);



/***/ }),

/***/ "./src/forum/components/LoginPage.js":
/*!*******************************************!*\
  !*** ./src/forum/components/LoginPage.js ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return LoginPage; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var _RedirectToHomeAndOpenModalPage__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RedirectToHomeAndOpenModalPage */ "./src/forum/components/RedirectToHomeAndOpenModalPage.js");
/* harmony import */ var flarum_forum_components_LogInModal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/components/LogInModal */ "flarum/forum/components/LogInModal");
/* harmony import */ var flarum_forum_components_LogInModal__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_LogInModal__WEBPACK_IMPORTED_MODULE_2__);




var LoginPage = /*#__PURE__*/function (_RedirectToHomeAndOpe) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(LoginPage, _RedirectToHomeAndOpe);

  function LoginPage() {
    return _RedirectToHomeAndOpe.apply(this, arguments) || this;
  }

  var _proto = LoginPage.prototype;

  _proto.createModal = function createModal() {
    if (!app.session.user) {
      return flarum_forum_components_LogInModal__WEBPACK_IMPORTED_MODULE_2___default.a;
    }
  };

  return LoginPage;
}(_RedirectToHomeAndOpenModalPage__WEBPACK_IMPORTED_MODULE_1__["default"]);



/***/ }),

/***/ "./src/forum/components/RedirectToHomeAndOpenModalPage.js":
/*!****************************************************************!*\
  !*** ./src/forum/components/RedirectToHomeAndOpenModalPage.js ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return RedirectToHomeAndOpenModalPage; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_forum_components_Page__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/components/Page */ "flarum/forum/components/Page");
/* harmony import */ var flarum_forum_components_Page__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_Page__WEBPACK_IMPORTED_MODULE_2__);




var RedirectToHomeAndOpenModalPage = /*#__PURE__*/function (_Page) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(RedirectToHomeAndOpenModalPage, _Page);

  function RedirectToHomeAndOpenModalPage() {
    return _Page.apply(this, arguments) || this;
  }

  var _proto = RedirectToHomeAndOpenModalPage.prototype;

  _proto.oninit = function oninit(vnode) {
    var _this = this;

    _Page.prototype.oninit.call(this, vnode);

    m.route.set('/');
    setTimeout(function () {
      return flarum_forum_app__WEBPACK_IMPORTED_MODULE_1___default.a.modal.show(_this.createModal());
    }, 1500);
  };

  _proto.createModal = function createModal() {
    return null;
  };

  _proto.view = function view() {
    return m('div');
  };

  return RedirectToHomeAndOpenModalPage;
}(flarum_forum_components_Page__WEBPACK_IMPORTED_MODULE_2___default.a);



/***/ }),

/***/ "./src/forum/components/SignupPage.js":
/*!********************************************!*\
  !*** ./src/forum/components/SignupPage.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return SignupPage; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var _RedirectToHomeAndOpenModalPage__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RedirectToHomeAndOpenModalPage */ "./src/forum/components/RedirectToHomeAndOpenModalPage.js");
/* harmony import */ var flarum_forum_components_SignUpModal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/forum/components/SignUpModal */ "flarum/forum/components/SignUpModal");
/* harmony import */ var flarum_forum_components_SignUpModal__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_SignUpModal__WEBPACK_IMPORTED_MODULE_2__);




var SignupPage = /*#__PURE__*/function (_RedirectToHomeAndOpe) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(SignupPage, _RedirectToHomeAndOpe);

  function SignupPage() {
    return _RedirectToHomeAndOpe.apply(this, arguments) || this;
  }

  var _proto = SignupPage.prototype;

  _proto.createModal = function createModal() {
    if (!app.session.user) {
      return flarum_forum_components_SignUpModal__WEBPACK_IMPORTED_MODULE_2___default.a;
    }
  };

  return SignupPage;
}(_RedirectToHomeAndOpenModalPage__WEBPACK_IMPORTED_MODULE_1__["default"]);



/***/ }),

/***/ "./src/forum/index.js":
/*!****************************!*\
  !*** ./src/forum/index.js ***!
  \****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_LoginPage__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/LoginPage */ "./src/forum/components/LoginPage.js");
/* harmony import */ var _components_SignupPage__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/SignupPage */ "./src/forum/components/SignupPage.js");
/* harmony import */ var _components_ForgotPage__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/ForgotPage */ "./src/forum/components/ForgotPage.js");
/* harmony import */ var _components_ComposerPage__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/ComposerPage */ "./src/forum/components/ComposerPage.js");





flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default.a.initializers.add('direct-links', function () {
  flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default.a.routes.directLinksLogin = {
    path: '/login',
    component: _components_LoginPage__WEBPACK_IMPORTED_MODULE_1__["default"]
  };
  flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default.a.routes.directLinksSignup = {
    path: '/signup',
    component: _components_SignupPage__WEBPACK_IMPORTED_MODULE_2__["default"]
  };
  flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default.a.routes.directLinksForgot = {
    path: '/forgot',
    component: _components_ForgotPage__WEBPACK_IMPORTED_MODULE_3__["default"]
  };
  flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default.a.routes.directLinksComposer = {
    path: '/composer',
    component: _components_ComposerPage__WEBPACK_IMPORTED_MODULE_4__["default"]
  };
});

/***/ }),

/***/ "flarum/forum/app":
/*!**************************************************!*\
  !*** external "flarum.core.compat['forum/app']" ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['forum/app'];

/***/ }),

/***/ "flarum/forum/components/DiscussionComposer":
/*!****************************************************************************!*\
  !*** external "flarum.core.compat['forum/components/DiscussionComposer']" ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['forum/components/DiscussionComposer'];

/***/ }),

/***/ "flarum/forum/components/ForgotPasswordModal":
/*!*****************************************************************************!*\
  !*** external "flarum.core.compat['forum/components/ForgotPasswordModal']" ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['forum/components/ForgotPasswordModal'];

/***/ }),

/***/ "flarum/forum/components/LogInModal":
/*!********************************************************************!*\
  !*** external "flarum.core.compat['forum/components/LogInModal']" ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['forum/components/LogInModal'];

/***/ }),

/***/ "flarum/forum/components/Page":
/*!**************************************************************!*\
  !*** external "flarum.core.compat['forum/components/Page']" ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['forum/components/Page'];

/***/ }),

/***/ "flarum/forum/components/SignUpModal":
/*!*********************************************************************!*\
  !*** external "flarum.core.compat['forum/components/SignUpModal']" ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['forum/components/SignUpModal'];

/***/ })

/******/ });
//# sourceMappingURL=forum.js.map