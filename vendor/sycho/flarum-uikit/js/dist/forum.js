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
/* harmony import */ var _src_forum__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./src/forum */ "./src/forum/index.ts");
/* empty/unused harmony star reexport */

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/extends.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/extends.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _extends; });
function _extends() {
  _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  return _extends.apply(this, arguments);
}

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

/***/ "./src/common/compat.ts":
/*!******************************!*\
  !*** ./src/common/compat.ts ***!
  \******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_Input__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/Input */ "./src/common/components/Input.js");
/* harmony import */ var _components_ProgressBar__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/ProgressBar */ "./src/common/components/ProgressBar.js");
/* harmony import */ var _components_Label__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/Label */ "./src/common/components/Label.js");
/* harmony import */ var _components_LabelGroup__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/LabelGroup */ "./src/common/components/LabelGroup.js");




/* harmony default export */ __webpack_exports__["default"] = ({
  'uikit/common/components/Input': _components_Input__WEBPACK_IMPORTED_MODULE_0__["default"],
  'uikit/common/components/ProgressBar': _components_ProgressBar__WEBPACK_IMPORTED_MODULE_1__["default"],
  'uikit/common/components/Label': _components_Label__WEBPACK_IMPORTED_MODULE_2__["default"],
  'uikit/common/components/LabelGroup': _components_LabelGroup__WEBPACK_IMPORTED_MODULE_3__["default"]
});

/***/ }),

/***/ "./src/common/components/Input.js":
/*!****************************************!*\
  !*** ./src/common/components/Input.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Input; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_Component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/Component */ "flarum/Component");
/* harmony import */ var flarum_Component__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_Component__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_helpers_icon__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/helpers/icon */ "flarum/helpers/icon");
/* harmony import */ var flarum_helpers_icon__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_helpers_icon__WEBPACK_IMPORTED_MODULE_2__);




var Input = /*#__PURE__*/function (_Component) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(Input, _Component);

  function Input() {
    return _Component.apply(this, arguments) || this;
  }

  var _proto = Input.prototype;

  _proto.view = function view() {
    this.attrs.className = this.attrs.className || '';
    this.attrs.className += ' UiKit-FormControl';

    if (this.attrs.icon) {
      this.attrs.className += ' hasIcon';
    }

    var className = "UiKit-Input " + (this.attrs.parentClassName || '');
    return m("div", {
      className: className
    }, this.icon(), m("input", this.attrs));
  };

  _proto.icon = function icon() {
    if (!this.attrs.icon) return;
    var iconValue = this.attrs.icon;
    delete this.attrs.icon;
    return m("span", {
      "class": "UiKit-Input-icon"
    }, flarum_helpers_icon__WEBPACK_IMPORTED_MODULE_2___default()(iconValue));
  };

  return Input;
}(flarum_Component__WEBPACK_IMPORTED_MODULE_1___default.a);



/***/ }),

/***/ "./src/common/components/Label.js":
/*!****************************************!*\
  !*** ./src/common/components/Label.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Label; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_Component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/Component */ "flarum/Component");
/* harmony import */ var flarum_Component__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_Component__WEBPACK_IMPORTED_MODULE_1__);



var Label = /*#__PURE__*/function (_Component) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(Label, _Component);

  function Label() {
    return _Component.apply(this, arguments) || this;
  }

  var _proto = Label.prototype;

  _proto.view = function view(vnode) {
    var style = {};
    var className = ['UiKit-Label'];
    if (this.attrs.className) className.push(this.attrs.className);

    if (this.attrs.color) {
      style.backgroundColor = "#" + this.attrs.color;
      className.push('colored');
    }

    return m("span", {
      className: className.join(' '),
      style: style
    }, m("span", {
      className: "UiKit-Label-text"
    }, vnode.children));
  };

  return Label;
}(flarum_Component__WEBPACK_IMPORTED_MODULE_1___default.a);



/***/ }),

/***/ "./src/common/components/LabelGroup.js":
/*!*********************************************!*\
  !*** ./src/common/components/LabelGroup.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return LabelGroup; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_Component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/Component */ "flarum/Component");
/* harmony import */ var flarum_Component__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_Component__WEBPACK_IMPORTED_MODULE_1__);



var LabelGroup = /*#__PURE__*/function (_Component) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(LabelGroup, _Component);

  function LabelGroup() {
    return _Component.apply(this, arguments) || this;
  }

  var _proto = LabelGroup.prototype;

  _proto.view = function view(vnode) {
    var className = ['UiKit-LabelGroup'];
    if (this.attrs.className) className.push(this.attrs.className);
    return m("span", {
      className: className.join(' ')
    }, vnode.children);
  };

  return LabelGroup;
}(flarum_Component__WEBPACK_IMPORTED_MODULE_1___default.a);



/***/ }),

/***/ "./src/common/components/ProgressBar.js":
/*!**********************************************!*\
  !*** ./src/common/components/ProgressBar.js ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ProgressBar; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_Component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/Component */ "flarum/Component");
/* harmony import */ var flarum_Component__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_Component__WEBPACK_IMPORTED_MODULE_1__);



var ProgressBar = /*#__PURE__*/function (_Component) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(ProgressBar, _Component);

  function ProgressBar() {
    return _Component.apply(this, arguments) || this;
  }

  var _proto = ProgressBar.prototype;

  _proto.view = function view() {
    var className = ['UiKit-ProgressBar'];
    if (this.attrs.className) className.push(this.attrs.className);
    if (this.attrs.mini) className.push('UiKit-ProgressBar--mini');
    if (this.attrs.fancy) className.push('UiKit-ProgressBar--fancy');
    if (this.attrs.alternate) className.push('UiKit-ProgressBar--alternate');
    return m("div", {
      className: className.join(' ')
    }, m("div", {
      className: "UiKit-ProgressBar-bar",
      style: {
        width: this.getProgress() + "%"
      }
    }));
  };

  _proto.getProgress = function getProgress() {
    return this.attrs.progress;
  };

  return ProgressBar;
}(flarum_Component__WEBPACK_IMPORTED_MODULE_1___default.a);



/***/ }),

/***/ "./src/forum/compat.ts":
/*!*****************************!*\
  !*** ./src/forum/compat.ts ***!
  \*****************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_esm_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _components_DiscussionSearch__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/DiscussionSearch */ "./src/forum/components/DiscussionSearch.tsx");
/* harmony import */ var _components_DiscussionSearchSource__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/DiscussionSearchSource */ "./src/forum/components/DiscussionSearchSource.tsx");
/* harmony import */ var _common_compat__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../common/compat */ "./src/common/compat.ts");




/* harmony default export */ __webpack_exports__["default"] = (Object(_babel_runtime_helpers_esm_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, _common_compat__WEBPACK_IMPORTED_MODULE_3__["default"], {
  'uikit/forum/DiscussionSearch': _components_DiscussionSearch__WEBPACK_IMPORTED_MODULE_1__["default"],
  'uikit/forum/DiscussionSearchSource': _components_DiscussionSearchSource__WEBPACK_IMPORTED_MODULE_2__["default"]
}));

/***/ }),

/***/ "./src/forum/components/DiscussionSearch.tsx":
/*!***************************************************!*\
  !*** ./src/forum/components/DiscussionSearch.tsx ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return DiscussionSearch; });
/* harmony import */ var _babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/inheritsLoose */ "./node_modules/@babel/runtime/helpers/esm/inheritsLoose.js");
/* harmony import */ var flarum_forum_components_Search__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/forum/components/Search */ "flarum/forum/components/Search");
/* harmony import */ var flarum_forum_components_Search__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_components_Search__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/utils/ItemList */ "flarum/common/utils/ItemList");
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _DiscussionSearchSource__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./DiscussionSearchSource */ "./src/forum/components/DiscussionSearchSource.tsx");





var DiscussionSearch = /*#__PURE__*/function (_Search) {
  Object(_babel_runtime_helpers_esm_inheritsLoose__WEBPACK_IMPORTED_MODULE_0__["default"])(DiscussionSearch, _Search);

  function DiscussionSearch() {
    return _Search.apply(this, arguments) || this;
  }

  var _proto = DiscussionSearch.prototype;

  _proto.view = function view() {
    this.hasFocus = true;

    var vdom = _Search.prototype.view.call(this); // @ts-ignore


    vdom.attrs.className = "UiKit-Search " + (this.state.getValue() && 'open') + " " + vdom.attrs.className.replace(/(focused|open)/g, '');
    return vdom;
  };

  _proto.sourceItems = function sourceItems() {
    var _this = this;

    var items = new flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_2___default.a();
    items.add('discussions', new _DiscussionSearchSource__WEBPACK_IMPORTED_MODULE_3__["default"](function (discussion) {
      _this.state.setValue(discussion.title());

      _this.attrs.onSelect(discussion);
    }, this.attrs.ignore));
    return items;
  };

  return DiscussionSearch;
}(flarum_forum_components_Search__WEBPACK_IMPORTED_MODULE_1___default.a);



/***/ }),

/***/ "./src/forum/components/DiscussionSearchSource.tsx":
/*!*********************************************************!*\
  !*** ./src/forum/components/DiscussionSearchSource.tsx ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return DiscussionSearchSource; });
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/forum/app */ "flarum/forum/app");
/* harmony import */ var flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_forum_app__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_common_helpers_highlight__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/common/helpers/highlight */ "flarum/common/helpers/highlight");
/* harmony import */ var flarum_common_helpers_highlight__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_highlight__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_2__);




var DiscussionSearchSource = /*#__PURE__*/function () {
  function DiscussionSearchSource(onSelect, ignore) {
    this.results = new Map();
    this.onSelect = void 0;
    this.ignore = void 0;
    this.results = new Map();
    this.onSelect = onSelect;
    this.ignore = ignore;
  }

  var _proto = DiscussionSearchSource.prototype;

  _proto.search = function search(query) {
    var _this = this;

    query = query.toLowerCase();
    this.results.set(query, []);
    var params = {
      filter: {
        q: query
      },
      page: {
        limit: 3
      }
    };
    var id = Number(query);

    if (!Number.isNaN(id) && id !== this.ignore) {
      return flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default.a.store.find('discussions', id).then(function (d) {
        _this.results.set(query, [d]);
      })["catch"](function () {
        return [];
      });
    }

    return flarum_forum_app__WEBPACK_IMPORTED_MODULE_0___default.a.store.find('discussions', params).then(function (results) {
      _this.results.set(query, results.filter(function (d) {
        return d.id() !== _this.ignore;
      }));
    });
  } // @ts-ignore
  ;

  _proto.view = function view(query) {
    var _this2 = this;

    query = query.toLowerCase();
    return (this.results.get(query) || []).map(function (discussion) {
      return m("li", {
        className: "DiscussionSearchResult",
        "data-index": 'discussions' + discussion.id()
      }, m(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_2___default.a, {
        onclick: function onclick() {
          return _this2.onSelect(discussion);
        }
      }, m("div", {
        className: "DiscussionSearchResult-id"
      }, discussion.id()), m("div", {
        className: "DiscussionSearchResult-title"
      }, flarum_common_helpers_highlight__WEBPACK_IMPORTED_MODULE_1___default()(discussion.title(), query))));
    });
  };

  return DiscussionSearchSource;
}();



/***/ }),

/***/ "./src/forum/index.ts":
/*!****************************!*\
  !*** ./src/forum/index.ts ***!
  \****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _compat__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./compat */ "./src/forum/compat.ts");
/* harmony import */ var _flarum_core_forum__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @flarum/core/forum */ "@flarum/core/forum");
/* harmony import */ var _flarum_core_forum__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_flarum_core_forum__WEBPACK_IMPORTED_MODULE_1__);
// Expose compat API
 // @ts-ignore


Object.assign(_flarum_core_forum__WEBPACK_IMPORTED_MODULE_1__["compat"], _compat__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "@flarum/core/forum":
/*!******************************!*\
  !*** external "flarum.core" ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core;

/***/ }),

/***/ "flarum/Component":
/*!**************************************************!*\
  !*** external "flarum.core.compat['Component']" ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['Component'];

/***/ }),

/***/ "flarum/common/components/Button":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['common/components/Button']" ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/components/Button'];

/***/ }),

/***/ "flarum/common/helpers/highlight":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['common/helpers/highlight']" ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/helpers/highlight'];

/***/ }),

/***/ "flarum/common/utils/ItemList":
/*!**************************************************************!*\
  !*** external "flarum.core.compat['common/utils/ItemList']" ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/utils/ItemList'];

/***/ }),

/***/ "flarum/forum/app":
/*!**************************************************!*\
  !*** external "flarum.core.compat['forum/app']" ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['forum/app'];

/***/ }),

/***/ "flarum/forum/components/Search":
/*!****************************************************************!*\
  !*** external "flarum.core.compat['forum/components/Search']" ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['forum/components/Search'];

/***/ }),

/***/ "flarum/helpers/icon":
/*!*****************************************************!*\
  !*** external "flarum.core.compat['helpers/icon']" ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['helpers/icon'];

/***/ })

/******/ });
//# sourceMappingURL=forum.js.map