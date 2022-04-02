(window["webpackJsonpmodule_exports"] = window["webpackJsonpmodule_exports"] || []).push([[0],{

/***/ "./src/forum/helpers/Giphy.js":
/*!************************************!*\
  !*** ./src/forum/helpers/Giphy.js ***!
  \************************************/
/*! exports provided: getTrendingSearches, getTrendingGifs, getGifs, extractGif, setApiKey, getLimit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getTrendingSearches", function() { return getTrendingSearches; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getTrendingGifs", function() { return getTrendingGifs; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getGifs", function() { return getGifs; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "extractGif", function() { return extractGif; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "setApiKey", function() { return setApiKey; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getLimit", function() { return getLimit; });
/* harmony import */ var _babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1__);


var limit = 20; // The maximum number of gifs per request

var apiKey;
/*
    Function to get an array of trending searches
 */

function getTrendingSearches() {
  return _getTrendingSearches.apply(this, arguments);
}
/*
    Function to get an object of trending GIFs
 */

function _getTrendingSearches() {
  _getTrendingSearches = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default.a.mark(function _callee() {
    var searches, url;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default.a.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            url = 'https://api.giphy.com/v1/trending/searches?api_key=' + apiKey;
            _context.next = 3;
            return fetch(url).then(function (response) {
              return response.json();
            }).then(function (content) {
              if (typeof content.data === 'undefined') {
                console.error('Sorry, there was something wrong with the Giphy API Key.');
                return;
              }

              searches = content['data'];
            });

          case 3:
            return _context.abrupt("return", searches);

          case 4:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));
  return _getTrendingSearches.apply(this, arguments);
}

function getTrendingGifs(_x, _x2) {
  return _getTrendingGifs.apply(this, arguments);
}
/*
    Funciton to get an object of GIFs
 */

function _getTrendingGifs() {
  _getTrendingGifs = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default.a.mark(function _callee2(offset, limit) {
    var gifs, url;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default.a.wrap(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            if (offset === void 0) {
              offset = 0;
            }

            if (limit === void 0) {
              limit = limit;
            }

            url = 'https://api.giphy.com/v1/gifs/trending?api_key=' + apiKey + '&limit=' + limit + '&offset=' + offset;
            _context2.next = 5;
            return fetch(url).then(function (response) {
              return response.json();
            }).then(function (content) {
              if (typeof content.data === 'undefined') {
                console.error('Sorry, there was something wrong with the Giphy API Key.');
                return;
              }

              gifs = content['data'];
            });

          case 5:
            return _context2.abrupt("return", gifs);

          case 6:
          case "end":
            return _context2.stop();
        }
      }
    }, _callee2);
  }));
  return _getTrendingGifs.apply(this, arguments);
}

function getGifs(_x3, _x4, _x5) {
  return _getGifs.apply(this, arguments);
}
/*
    Function to extract the url and title from the object
 */

function _getGifs() {
  _getGifs = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default.a.mark(function _callee3(query, offset, limit) {
    var gifs, url;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default.a.wrap(function _callee3$(_context3) {
      while (1) {
        switch (_context3.prev = _context3.next) {
          case 0:
            if (offset === void 0) {
              offset = 0;
            }

            if (limit === void 0) {
              limit = limit;
            }

            url = 'https://api.giphy.com/v1/gifs/search?api_key=' + apiKey + '&q=' + query + '&limit=' + limit + '&offset=' + offset;
            _context3.next = 5;
            return fetch(url).then(function (response) {
              return response.json();
            }).then(function (content) {
              if (typeof content.data === 'undefined') {
                console.error('Sorry, there was something wrong with the Giphy API Key.');
                return;
              }

              gifs = content['data'];
            });

          case 5:
            return _context3.abrupt("return", gifs);

          case 6:
          case "end":
            return _context3.stop();
        }
      }
    }, _callee3);
  }));
  return _getGifs.apply(this, arguments);
}

function extractGif(gif) {
  var gifType = 'downsized';
  var gif = {
    title: gif['title'],
    url: gif['images'][gifType]['url']
  };
  return gif;
}
/*
    Function to set the Giphy API key
 */

function setApiKey(key) {
  apiKey = key;
  return true;
}
/*
    Function to return the maximum number of gifs per request
 */

function getLimit() {
  return limit;
}

/***/ })

}]);
//# sourceMappingURL=0.js.map