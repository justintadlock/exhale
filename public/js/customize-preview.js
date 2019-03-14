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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/customize-preview.js":
/*!*******************************************!*\
  !*** ./resources/js/customize-preview.js ***!
  \*******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _customize_preview_color__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./customize-preview/color */ "./resources/js/customize-preview/color.js");
/* harmony import */ var _customize_preview_custom_header__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./customize-preview/custom-header */ "./resources/js/customize-preview/custom-header.js");
/* harmony import */ var _customize_preview_custom_header__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_customize_preview_custom_header__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _customize_preview_font_family__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./customize-preview/font-family */ "./resources/js/customize-preview/font-family.js");
/* harmony import */ var _customize_preview_font_family__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_customize_preview_font_family__WEBPACK_IMPORTED_MODULE_2__);
/**
 * Customize preview script.
 *
 * This file handles the JavaScript for the live preview frame in the customizer.
 * Any includes or imports should be handled in this file. The final result gets
 * saved back into `dist/js/customize-preview.js`.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */


 //import { footerCredit } from './customize-preview/footer-credit';

/***/ }),

/***/ "./resources/js/customize-preview/color.js":
/*!*************************************************!*\
  !*** ./resources/js/customize-preview/color.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _tools_hex_to_rgb__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../tools/hex-to-rgb */ "./resources/js/tools/hex-to-rgb.js");
/**
 * Custom header preview.
 *
 * This file handles the JavaScript for the live preview of the `custom-header`
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

var settings = exhaleCustomizePreview.colorSettings;
Object.keys(settings).forEach(function (setting) {
  wp.customize(settings[setting].modName, function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty(settings[setting].property, Object(_tools_hex_to_rgb__WEBPACK_IMPORTED_MODULE_0__["hexToRgb"])(to));
    });
  });
});

/***/ }),

/***/ "./resources/js/customize-preview/custom-header.js":
/*!*********************************************************!*\
  !*** ./resources/js/customize-preview/custom-header.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Custom header preview.
 *
 * This file handles the JavaScript for the live preview of the `custom-header`
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
// Site title.
wp.customize('blogname', function (value) {
  value.bind(function (to) {
    document.querySelector('.app-header__title-link').textContent = to;
  });
});
/*
// Site description.
wp.customize( 'blogdescription', value => {
	value.bind( to => {
		document.querySelector( '.app-header__description' ).textContent = to;
	} );
} );


// Header text color.
wp.customize( 'header_textcolor', value => {
	value.bind( to => {
		var headerItems = document.querySelectorAll(
			'.app-header__title-link, .app-header__description'
		);

		headerItems.forEach( function( text ) {

			if ( 'blank' === to ) {
				text.style.clip     = 'rect(0 0 0 0)';
				text.style.position = 'absolute';
			} else {
				text.style.clip     = null;
				text.style.position = null;
				text.style.color    = to;
			}
		} );
	} );
} );
*/

/***/ }),

/***/ "./resources/js/customize-preview/font-family.js":
/*!*******************************************************!*\
  !*** ./resources/js/customize-preview/font-family.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Fonts live preview.
 *
 * This file handles the JavaScript for the live preview of the theme fonts
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
var settings = exhaleCustomizePreview.fontFamilySettings;
var choices = exhaleCustomizePreview.fontFamilyChoices;
Object.keys(settings).forEach(function (setting) {
  wp.customize(settings[setting].modName, function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty(settings[setting].property, choices[to].stack);
    });
  });
});

/***/ }),

/***/ "./resources/js/tools/hex-to-rgb.js":
/*!******************************************!*\
  !*** ./resources/js/tools/hex-to-rgb.js ***!
  \******************************************/
/*! exports provided: hexToRgb */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "hexToRgb", function() { return hexToRgb; });
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function hexToRgb(str) {
  var pattern = /^#?(?:([\da-f]{3})[\da-f]?|([\da-f]{6})(?:[\da-f]{2})?)$/i;

  var _ref = String(str).match(pattern) || [],
      _ref2 = _slicedToArray(_ref, 3),
      short = _ref2[1],
      long = _ref2[2];

  if (long) {
    var value = Number.parseInt(long, 16);
    return [value >> 16, value >> 8 & 0xFF, value & 0xFF];
  } else if (short) {
    return Array.from(short, function (s) {
      return Number.parseInt(s, 16);
    }).map(function (n) {
      return n << 4 | n;
    });
  }
}

/***/ }),

/***/ 2:
/*!*************************************************!*\
  !*** multi ./resources/js/customize-preview.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! c:\xampp\htdocs\wp-content\themes\exhale\resources\js\customize-preview.js */"./resources/js/customize-preview.js");


/***/ })

/******/ });
//# sourceMappingURL=customize-preview.js.map