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
/******/ 	return __webpack_require__(__webpack_require__.s = "./admin.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./admin.js":
/*!******************!*\
  !*** ./admin.js ***!
  \******************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _src_admin__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./src/admin */ "./src/admin/index.js");
/* empty/unused harmony star reexport */

/***/ }),

/***/ "./src/admin/getCategories.js":
/*!************************************!*\
  !*** ./src/admin/getCategories.js ***!
  \************************************/
/*! exports provided: default, getVendors */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return getCategories; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getVendors", function() { return getVendors; });
function getCategories() {
  switch (app.data.settings['sycho-ace.selected-categorization']) {
    case 'none':
      return {
        none: 0
      };

    case 'vendor':
      return getVendors();

    case 'availability':
      return {
        enabled: 10,
        disabled: 0
      };

    default:
      return app.extensionCategories;
  }
}
function getVendors() {
  var vendors = {};
  var vendorsArray = [];
  Object.keys(app.data.extensions).map(function (id) {
    vendorsArray.push(id.split('-')[0]);
  });
  vendorsArray.sort(function (a, b) {
    return a === 'flarum' ? -1 : a > b ? 1 : a === b ? 0 : -1;
  });
  var k = vendorsArray.length * 10;
  vendorsArray.forEach(function (v) {
    return vendors[v] = k -= 10;
  });
  if (vendors.flarum) vendors.flarum = 5000;
  return vendors;
}

/***/ }),

/***/ "./src/admin/getCategoryLabels.js":
/*!****************************************!*\
  !*** ./src/admin/getCategoryLabels.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return getCategoryLabels; });
/* harmony import */ var _getCategories__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./getCategories */ "./src/admin/getCategories.js");

function getCategoryLabels() {
  var labels = {};
  var categories = Object(_getCategories__WEBPACK_IMPORTED_MODULE_0__["default"])();
  Object.keys(categories).map(function (category) {
    switch (app.data.settings['sycho-ace.selected-categorization']) {
      case 'default':
        labels[category] = app.translator.trans("core.admin.nav.categories." + category);
        break;

      case 'vendor':
        labels[category] = category;
        break;

      default:
        labels[category] = app.translator.trans("sycho-ace.admin.categories." + category);
    }
  });
  return labels;
}

/***/ }),

/***/ "./src/admin/index.js":
/*!****************************!*\
  !*** ./src/admin/index.js ***!
  \****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/common/extend */ "flarum/common/extend");
/* harmony import */ var flarum_common_extend__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_common_extend__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var flarum_admin_components_AdminNav__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! flarum/admin/components/AdminNav */ "flarum/admin/components/AdminNav");
/* harmony import */ var flarum_admin_components_AdminNav__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_components_AdminNav__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var flarum_admin_components_ExtensionLinkButton__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! flarum/admin/components/ExtensionLinkButton */ "flarum/admin/components/ExtensionLinkButton");
/* harmony import */ var flarum_admin_components_ExtensionLinkButton__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_components_ExtensionLinkButton__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var flarum_admin_components_ExtensionsWidget__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! flarum/admin/components/ExtensionsWidget */ "flarum/admin/components/ExtensionsWidget");
/* harmony import */ var flarum_admin_components_ExtensionsWidget__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_components_ExtensionsWidget__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var flarum_admin_components_LoadingModal__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! flarum/admin/components/LoadingModal */ "flarum/admin/components/LoadingModal");
/* harmony import */ var flarum_admin_components_LoadingModal__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_components_LoadingModal__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! flarum/common/utils/ItemList */ "flarum/common/utils/ItemList");
/* harmony import */ var flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var flarum_common_components_Dropdown__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! flarum/common/components/Dropdown */ "flarum/common/components/Dropdown");
/* harmony import */ var flarum_common_components_Dropdown__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Dropdown__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! flarum/common/components/Button */ "flarum/common/components/Button");
/* harmony import */ var flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! flarum/common/helpers/icon */ "flarum/common/helpers/icon");
/* harmony import */ var flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var flarum_admin_utils_saveSettings__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! flarum/admin/utils/saveSettings */ "flarum/admin/utils/saveSettings");
/* harmony import */ var flarum_admin_utils_saveSettings__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_utils_saveSettings__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var flarum_admin_utils_isExtensionEnabled__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! flarum/admin/utils/isExtensionEnabled */ "flarum/admin/utils/isExtensionEnabled");
/* harmony import */ var flarum_admin_utils_isExtensionEnabled__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_utils_isExtensionEnabled__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var flarum_common_components_Link__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! flarum/common/components/Link */ "flarum/common/components/Link");
/* harmony import */ var flarum_common_components_Link__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(flarum_common_components_Link__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var _overrideGetCategorizedExtensions__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./overrideGetCategorizedExtensions */ "./src/admin/overrideGetCategorizedExtensions.js");
/* harmony import */ var _getCategories__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./getCategories */ "./src/admin/getCategories.js");
/* harmony import */ var _getCategoryLabels__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./getCategoryLabels */ "./src/admin/getCategoryLabels.js");















app.initializers.add('sycho-advanced-extension-categories', function (app) {
  var categorizationOptions = {
    "default": app.translator.trans('sycho-ace.admin.category_selection.options.default'),
    vendor: app.translator.trans('sycho-ace.admin.category_selection.options.vendor'),
    availability: app.translator.trans('sycho-ace.admin.category_selection.options.availability'),
    none: app.translator.trans('sycho-ace.admin.category_selection.options.none')
  };
  app.extensionData["for"]('sycho-advanced-extension-categories').registerSetting(function () {
    var selectbox = this.buildSettingComponent({
      setting: 'sycho-ace.selected-categorization',
      label: app.translator.trans('sycho-ace.admin.category_selection.label'),
      type: 'select',
      options: categorizationOptions,
      "default": 'default'
    });
    var originalSaveSettings = this.saveSettings;

    this.saveSettings = function (e) {
      originalSaveSettings.call(this, e);
      app.modal.show(flarum_admin_components_LoadingModal__WEBPACK_IMPORTED_MODULE_4___default.a);
      window.location.reload();
    };

    return selectbox;
  });

  var saveCategorization = function saveCategorization(value) {
    flarum_admin_utils_saveSettings__WEBPACK_IMPORTED_MODULE_9___default()({
      'sycho-ace.selected-categorization': value
    }).then(function () {
      return window.location.reload();
    });
    app.modal.show(flarum_admin_components_LoadingModal__WEBPACK_IMPORTED_MODULE_4___default.a);
  };

  app.extensionCategories = Object(_getCategories__WEBPACK_IMPORTED_MODULE_13__["default"])();
  var categoryLabels = Object(_getCategoryLabels__WEBPACK_IMPORTED_MODULE_14__["default"])();

  flarum_admin_components_ExtensionsWidget__WEBPACK_IMPORTED_MODULE_3___default.a.prototype.controlItems = function () {
    var _app$data$settings$sy;

    var items = new flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5___default.a();
    var selectedCategorization = (_app$data$settings$sy = app.data.settings['sycho-ace.selected-categorization']) != null ? _app$data$settings$sy : 'default';
    items.add('categorization', m("div", {
      className: "ExtensionsWidget-control-item"
    }, m(flarum_common_components_Dropdown__WEBPACK_IMPORTED_MODULE_6___default.a, {
      buttonClassName: "Button",
      label: app.translator.trans('sycho-ace.admin.category_selection.label')
    }, Object.keys(categorizationOptions).map(function (key) {
      return m(flarum_common_components_Button__WEBPACK_IMPORTED_MODULE_7___default.a, {
        icon: selectedCategorization === key ? 'fas fa-check' : true,
        active: selectedCategorization === key,
        onclick: function onclick() {
          return saveCategorization(key);
        }
      }, categorizationOptions[key]);
    }))));
    return items;
  };

  Object(flarum_common_extend__WEBPACK_IMPORTED_MODULE_0__["override"])(flarum_admin_components_ExtensionsWidget__WEBPACK_IMPORTED_MODULE_3___default.a.prototype, 'oninit', function () {
    this.categorizedExtensions = Object(_overrideGetCategorizedExtensions__WEBPACK_IMPORTED_MODULE_12__["default"])();
  });
  Object(flarum_common_extend__WEBPACK_IMPORTED_MODULE_0__["override"])(flarum_admin_components_ExtensionsWidget__WEBPACK_IMPORTED_MODULE_3___default.a.prototype, 'content', function (original) {
    return [m("div", {
      className: "ExtensionsWidget-list-heading"
    }, m("h2", {
      className: "ExtensionsWidget-list-name"
    }, m("span", {
      className: "ExtensionsWidget-list-icon"
    }, flarum_common_helpers_icon__WEBPACK_IMPORTED_MODULE_8___default()('fas fa-puzzle-piece')), m("span", {
      className: "ExtensionsWidget-list-title"
    }, app.translator.trans('sycho-ace.admin.extensions'))), m("div", {
      className: "ExtensionsWidget-list-controls"
    }, this.controlItems().toArray())), original()];
  });
  Object(flarum_common_extend__WEBPACK_IMPORTED_MODULE_0__["extend"])(flarum_admin_components_ExtensionsWidget__WEBPACK_IMPORTED_MODULE_3___default.a.prototype, 'extensionCategory', function (vnode, category) {
    vnode.children[0].text = categoryLabels[category];
  });
  Object(flarum_common_extend__WEBPACK_IMPORTED_MODULE_0__["override"])(flarum_admin_components_AdminNav__WEBPACK_IMPORTED_MODULE_1___default.a.prototype, 'extensionItems', function () {
    var _this = this;

    var items = new flarum_common_utils_ItemList__WEBPACK_IMPORTED_MODULE_5___default.a();
    var categorizedExtensions = Object(_overrideGetCategorizedExtensions__WEBPACK_IMPORTED_MODULE_12__["default"])();
    var categories = app.extensionCategories;
    Object.keys(categorizedExtensions).map(function (category) {
      if (!_this.query()) {
        items.add("category-" + category, m("h4", {
          className: "ExtensionListTitle"
        }, categoryLabels[category]), categories[category]);
      }

      categorizedExtensions[category].map(function (extension) {
        var query = _this.query().toUpperCase();

        var title = extension.extra['flarum-extension'].title;

        if (!query || title.toUpperCase().includes(query) || extension.description.toUpperCase().includes(query)) {
          items.add("extension-" + extension.id, m(flarum_admin_components_ExtensionLinkButton__WEBPACK_IMPORTED_MODULE_2___default.a, {
            href: app.route('extension', {
              id: extension.id
            }),
            extensionId: extension.id,
            className: "ExtensionNavButton",
            title: extension.description
          }, title), categories[category]);
        }
      });
    });
    return items;
  });
}, -999);

/***/ }),

/***/ "./src/admin/overrideGetCategorizedExtensions.js":
/*!*******************************************************!*\
  !*** ./src/admin/overrideGetCategorizedExtensions.js ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return overrideGetCategorizedExtensions; });
/* harmony import */ var flarum_admin_utils_getCategorizedExtensions__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/admin/utils/getCategorizedExtensions */ "flarum/admin/utils/getCategorizedExtensions");
/* harmony import */ var flarum_admin_utils_getCategorizedExtensions__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_utils_getCategorizedExtensions__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _utils_getAlphabeticallyOrderedExtensions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./utils/getAlphabeticallyOrderedExtensions */ "./src/admin/utils/getAlphabeticallyOrderedExtensions.js");
/* harmony import */ var _utils_getVendorCategorizedExtensions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./utils/getVendorCategorizedExtensions */ "./src/admin/utils/getVendorCategorizedExtensions.js");
/* harmony import */ var _utils_getAvailabilityCategorizedExtensions__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./utils/getAvailabilityCategorizedExtensions */ "./src/admin/utils/getAvailabilityCategorizedExtensions.js");




function overrideGetCategorizedExtensions() {
  switch (app.data.settings['sycho-ace.selected-categorization']) {
    case 'none':
      return Object(_utils_getAlphabeticallyOrderedExtensions__WEBPACK_IMPORTED_MODULE_1__["default"])();

    case 'vendor':
      return Object(_utils_getVendorCategorizedExtensions__WEBPACK_IMPORTED_MODULE_2__["default"])();

    case 'availability':
      return Object(_utils_getAvailabilityCategorizedExtensions__WEBPACK_IMPORTED_MODULE_3__["default"])();

    default:
      return flarum_admin_utils_getCategorizedExtensions__WEBPACK_IMPORTED_MODULE_0___default()();
  }
}

/***/ }),

/***/ "./src/admin/utils/getAlphabeticallyOrderedExtensions.js":
/*!***************************************************************!*\
  !*** ./src/admin/utils/getAlphabeticallyOrderedExtensions.js ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return getAlphabeticallyOrderedExtensions; });
function getAlphabeticallyOrderedExtensions() {
  var extensions = {};
  extensions.none = Object.values(app.data.extensions);
  return extensions;
}

/***/ }),

/***/ "./src/admin/utils/getAvailabilityCategorizedExtensions.js":
/*!*****************************************************************!*\
  !*** ./src/admin/utils/getAvailabilityCategorizedExtensions.js ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return getAvailabilityCategorizedExtensions; });
/* harmony import */ var flarum_admin_utils_isExtensionEnabled__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flarum/admin/utils/isExtensionEnabled */ "flarum/admin/utils/isExtensionEnabled");
/* harmony import */ var flarum_admin_utils_isExtensionEnabled__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flarum_admin_utils_isExtensionEnabled__WEBPACK_IMPORTED_MODULE_0__);

function getAvailabilityCategorizedExtensions() {
  var extensions = {
    enabled: [],
    disabled: []
  };
  Object.keys(app.data.extensions).map(function (id) {
    var category = flarum_admin_utils_isExtensionEnabled__WEBPACK_IMPORTED_MODULE_0___default()(id) ? 'enabled' : 'disabled';
    extensions[category].push(app.data.extensions[id]);
  });
  return extensions;
}

/***/ }),

/***/ "./src/admin/utils/getVendorCategorizedExtensions.js":
/*!***********************************************************!*\
  !*** ./src/admin/utils/getVendorCategorizedExtensions.js ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return getVendorCategorizedExtensions; });
function getVendorCategorizedExtensions() {
  var extensions = {};
  Object.keys(app.data.extensions).map(function (id) {
    var vendor = id.split('-')[0];
    extensions[vendor] = extensions[vendor] || [];
    extensions[vendor].push(app.data.extensions[id]);
  });
  return extensions;
}

/***/ }),

/***/ "flarum/admin/components/AdminNav":
/*!******************************************************************!*\
  !*** external "flarum.core.compat['admin/components/AdminNav']" ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['admin/components/AdminNav'];

/***/ }),

/***/ "flarum/admin/components/ExtensionLinkButton":
/*!*****************************************************************************!*\
  !*** external "flarum.core.compat['admin/components/ExtensionLinkButton']" ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['admin/components/ExtensionLinkButton'];

/***/ }),

/***/ "flarum/admin/components/ExtensionsWidget":
/*!**************************************************************************!*\
  !*** external "flarum.core.compat['admin/components/ExtensionsWidget']" ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['admin/components/ExtensionsWidget'];

/***/ }),

/***/ "flarum/admin/components/LoadingModal":
/*!**********************************************************************!*\
  !*** external "flarum.core.compat['admin/components/LoadingModal']" ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['admin/components/LoadingModal'];

/***/ }),

/***/ "flarum/admin/utils/getCategorizedExtensions":
/*!*****************************************************************************!*\
  !*** external "flarum.core.compat['admin/utils/getCategorizedExtensions']" ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['admin/utils/getCategorizedExtensions'];

/***/ }),

/***/ "flarum/admin/utils/isExtensionEnabled":
/*!***********************************************************************!*\
  !*** external "flarum.core.compat['admin/utils/isExtensionEnabled']" ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['admin/utils/isExtensionEnabled'];

/***/ }),

/***/ "flarum/admin/utils/saveSettings":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['admin/utils/saveSettings']" ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['admin/utils/saveSettings'];

/***/ }),

/***/ "flarum/common/components/Button":
/*!*****************************************************************!*\
  !*** external "flarum.core.compat['common/components/Button']" ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/components/Button'];

/***/ }),

/***/ "flarum/common/components/Dropdown":
/*!*******************************************************************!*\
  !*** external "flarum.core.compat['common/components/Dropdown']" ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/components/Dropdown'];

/***/ }),

/***/ "flarum/common/components/Link":
/*!***************************************************************!*\
  !*** external "flarum.core.compat['common/components/Link']" ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/components/Link'];

/***/ }),

/***/ "flarum/common/extend":
/*!******************************************************!*\
  !*** external "flarum.core.compat['common/extend']" ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/extend'];

/***/ }),

/***/ "flarum/common/helpers/icon":
/*!************************************************************!*\
  !*** external "flarum.core.compat['common/helpers/icon']" ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/helpers/icon'];

/***/ }),

/***/ "flarum/common/utils/ItemList":
/*!**************************************************************!*\
  !*** external "flarum.core.compat['common/utils/ItemList']" ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = flarum.core.compat['common/utils/ItemList'];

/***/ })

/******/ });
//# sourceMappingURL=admin.js.map