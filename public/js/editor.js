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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/lodash.assign/index.js":
/*!*********************************************!*\
  !*** ./node_modules/lodash.assign/index.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */

/** Used as references for various `Number` constants. */
var MAX_SAFE_INTEGER = 9007199254740991;

/** `Object#toString` result references. */
var argsTag = '[object Arguments]',
    funcTag = '[object Function]',
    genTag = '[object GeneratorFunction]';

/** Used to detect unsigned integer values. */
var reIsUint = /^(?:0|[1-9]\d*)$/;

/**
 * A faster alternative to `Function#apply`, this function invokes `func`
 * with the `this` binding of `thisArg` and the arguments of `args`.
 *
 * @private
 * @param {Function} func The function to invoke.
 * @param {*} thisArg The `this` binding of `func`.
 * @param {Array} args The arguments to invoke `func` with.
 * @returns {*} Returns the result of `func`.
 */
function apply(func, thisArg, args) {
  switch (args.length) {
    case 0: return func.call(thisArg);
    case 1: return func.call(thisArg, args[0]);
    case 2: return func.call(thisArg, args[0], args[1]);
    case 3: return func.call(thisArg, args[0], args[1], args[2]);
  }
  return func.apply(thisArg, args);
}

/**
 * The base implementation of `_.times` without support for iteratee shorthands
 * or max array length checks.
 *
 * @private
 * @param {number} n The number of times to invoke `iteratee`.
 * @param {Function} iteratee The function invoked per iteration.
 * @returns {Array} Returns the array of results.
 */
function baseTimes(n, iteratee) {
  var index = -1,
      result = Array(n);

  while (++index < n) {
    result[index] = iteratee(index);
  }
  return result;
}

/**
 * Creates a unary function that invokes `func` with its argument transformed.
 *
 * @private
 * @param {Function} func The function to wrap.
 * @param {Function} transform The argument transform.
 * @returns {Function} Returns the new function.
 */
function overArg(func, transform) {
  return function(arg) {
    return func(transform(arg));
  };
}

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var objectToString = objectProto.toString;

/** Built-in value references. */
var propertyIsEnumerable = objectProto.propertyIsEnumerable;

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeKeys = overArg(Object.keys, Object),
    nativeMax = Math.max;

/** Detect if properties shadowing those on `Object.prototype` are non-enumerable. */
var nonEnumShadows = !propertyIsEnumerable.call({ 'valueOf': 1 }, 'valueOf');

/**
 * Creates an array of the enumerable property names of the array-like `value`.
 *
 * @private
 * @param {*} value The value to query.
 * @param {boolean} inherited Specify returning inherited property names.
 * @returns {Array} Returns the array of property names.
 */
function arrayLikeKeys(value, inherited) {
  // Safari 8.1 makes `arguments.callee` enumerable in strict mode.
  // Safari 9 makes `arguments.length` enumerable in strict mode.
  var result = (isArray(value) || isArguments(value))
    ? baseTimes(value.length, String)
    : [];

  var length = result.length,
      skipIndexes = !!length;

  for (var key in value) {
    if ((inherited || hasOwnProperty.call(value, key)) &&
        !(skipIndexes && (key == 'length' || isIndex(key, length)))) {
      result.push(key);
    }
  }
  return result;
}

/**
 * Assigns `value` to `key` of `object` if the existing value is not equivalent
 * using [`SameValueZero`](http://ecma-international.org/ecma-262/7.0/#sec-samevaluezero)
 * for equality comparisons.
 *
 * @private
 * @param {Object} object The object to modify.
 * @param {string} key The key of the property to assign.
 * @param {*} value The value to assign.
 */
function assignValue(object, key, value) {
  var objValue = object[key];
  if (!(hasOwnProperty.call(object, key) && eq(objValue, value)) ||
      (value === undefined && !(key in object))) {
    object[key] = value;
  }
}

/**
 * The base implementation of `_.keys` which doesn't treat sparse arrays as dense.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Array} Returns the array of property names.
 */
function baseKeys(object) {
  if (!isPrototype(object)) {
    return nativeKeys(object);
  }
  var result = [];
  for (var key in Object(object)) {
    if (hasOwnProperty.call(object, key) && key != 'constructor') {
      result.push(key);
    }
  }
  return result;
}

/**
 * The base implementation of `_.rest` which doesn't validate or coerce arguments.
 *
 * @private
 * @param {Function} func The function to apply a rest parameter to.
 * @param {number} [start=func.length-1] The start position of the rest parameter.
 * @returns {Function} Returns the new function.
 */
function baseRest(func, start) {
  start = nativeMax(start === undefined ? (func.length - 1) : start, 0);
  return function() {
    var args = arguments,
        index = -1,
        length = nativeMax(args.length - start, 0),
        array = Array(length);

    while (++index < length) {
      array[index] = args[start + index];
    }
    index = -1;
    var otherArgs = Array(start + 1);
    while (++index < start) {
      otherArgs[index] = args[index];
    }
    otherArgs[start] = array;
    return apply(func, this, otherArgs);
  };
}

/**
 * Copies properties of `source` to `object`.
 *
 * @private
 * @param {Object} source The object to copy properties from.
 * @param {Array} props The property identifiers to copy.
 * @param {Object} [object={}] The object to copy properties to.
 * @param {Function} [customizer] The function to customize copied values.
 * @returns {Object} Returns `object`.
 */
function copyObject(source, props, object, customizer) {
  object || (object = {});

  var index = -1,
      length = props.length;

  while (++index < length) {
    var key = props[index];

    var newValue = customizer
      ? customizer(object[key], source[key], key, object, source)
      : undefined;

    assignValue(object, key, newValue === undefined ? source[key] : newValue);
  }
  return object;
}

/**
 * Creates a function like `_.assign`.
 *
 * @private
 * @param {Function} assigner The function to assign values.
 * @returns {Function} Returns the new assigner function.
 */
function createAssigner(assigner) {
  return baseRest(function(object, sources) {
    var index = -1,
        length = sources.length,
        customizer = length > 1 ? sources[length - 1] : undefined,
        guard = length > 2 ? sources[2] : undefined;

    customizer = (assigner.length > 3 && typeof customizer == 'function')
      ? (length--, customizer)
      : undefined;

    if (guard && isIterateeCall(sources[0], sources[1], guard)) {
      customizer = length < 3 ? undefined : customizer;
      length = 1;
    }
    object = Object(object);
    while (++index < length) {
      var source = sources[index];
      if (source) {
        assigner(object, source, index, customizer);
      }
    }
    return object;
  });
}

/**
 * Checks if `value` is a valid array-like index.
 *
 * @private
 * @param {*} value The value to check.
 * @param {number} [length=MAX_SAFE_INTEGER] The upper bounds of a valid index.
 * @returns {boolean} Returns `true` if `value` is a valid index, else `false`.
 */
function isIndex(value, length) {
  length = length == null ? MAX_SAFE_INTEGER : length;
  return !!length &&
    (typeof value == 'number' || reIsUint.test(value)) &&
    (value > -1 && value % 1 == 0 && value < length);
}

/**
 * Checks if the given arguments are from an iteratee call.
 *
 * @private
 * @param {*} value The potential iteratee value argument.
 * @param {*} index The potential iteratee index or key argument.
 * @param {*} object The potential iteratee object argument.
 * @returns {boolean} Returns `true` if the arguments are from an iteratee call,
 *  else `false`.
 */
function isIterateeCall(value, index, object) {
  if (!isObject(object)) {
    return false;
  }
  var type = typeof index;
  if (type == 'number'
        ? (isArrayLike(object) && isIndex(index, object.length))
        : (type == 'string' && index in object)
      ) {
    return eq(object[index], value);
  }
  return false;
}

/**
 * Checks if `value` is likely a prototype object.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a prototype, else `false`.
 */
function isPrototype(value) {
  var Ctor = value && value.constructor,
      proto = (typeof Ctor == 'function' && Ctor.prototype) || objectProto;

  return value === proto;
}

/**
 * Performs a
 * [`SameValueZero`](http://ecma-international.org/ecma-262/7.0/#sec-samevaluezero)
 * comparison between two values to determine if they are equivalent.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to compare.
 * @param {*} other The other value to compare.
 * @returns {boolean} Returns `true` if the values are equivalent, else `false`.
 * @example
 *
 * var object = { 'a': 1 };
 * var other = { 'a': 1 };
 *
 * _.eq(object, object);
 * // => true
 *
 * _.eq(object, other);
 * // => false
 *
 * _.eq('a', 'a');
 * // => true
 *
 * _.eq('a', Object('a'));
 * // => false
 *
 * _.eq(NaN, NaN);
 * // => true
 */
function eq(value, other) {
  return value === other || (value !== value && other !== other);
}

/**
 * Checks if `value` is likely an `arguments` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an `arguments` object,
 *  else `false`.
 * @example
 *
 * _.isArguments(function() { return arguments; }());
 * // => true
 *
 * _.isArguments([1, 2, 3]);
 * // => false
 */
function isArguments(value) {
  // Safari 8.1 makes `arguments.callee` enumerable in strict mode.
  return isArrayLikeObject(value) && hasOwnProperty.call(value, 'callee') &&
    (!propertyIsEnumerable.call(value, 'callee') || objectToString.call(value) == argsTag);
}

/**
 * Checks if `value` is classified as an `Array` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an array, else `false`.
 * @example
 *
 * _.isArray([1, 2, 3]);
 * // => true
 *
 * _.isArray(document.body.children);
 * // => false
 *
 * _.isArray('abc');
 * // => false
 *
 * _.isArray(_.noop);
 * // => false
 */
var isArray = Array.isArray;

/**
 * Checks if `value` is array-like. A value is considered array-like if it's
 * not a function and has a `value.length` that's an integer greater than or
 * equal to `0` and less than or equal to `Number.MAX_SAFE_INTEGER`.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is array-like, else `false`.
 * @example
 *
 * _.isArrayLike([1, 2, 3]);
 * // => true
 *
 * _.isArrayLike(document.body.children);
 * // => true
 *
 * _.isArrayLike('abc');
 * // => true
 *
 * _.isArrayLike(_.noop);
 * // => false
 */
function isArrayLike(value) {
  return value != null && isLength(value.length) && !isFunction(value);
}

/**
 * This method is like `_.isArrayLike` except that it also checks if `value`
 * is an object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an array-like object,
 *  else `false`.
 * @example
 *
 * _.isArrayLikeObject([1, 2, 3]);
 * // => true
 *
 * _.isArrayLikeObject(document.body.children);
 * // => true
 *
 * _.isArrayLikeObject('abc');
 * // => false
 *
 * _.isArrayLikeObject(_.noop);
 * // => false
 */
function isArrayLikeObject(value) {
  return isObjectLike(value) && isArrayLike(value);
}

/**
 * Checks if `value` is classified as a `Function` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a function, else `false`.
 * @example
 *
 * _.isFunction(_);
 * // => true
 *
 * _.isFunction(/abc/);
 * // => false
 */
function isFunction(value) {
  // The use of `Object#toString` avoids issues with the `typeof` operator
  // in Safari 8-9 which returns 'object' for typed array and other constructors.
  var tag = isObject(value) ? objectToString.call(value) : '';
  return tag == funcTag || tag == genTag;
}

/**
 * Checks if `value` is a valid array-like length.
 *
 * **Note:** This method is loosely based on
 * [`ToLength`](http://ecma-international.org/ecma-262/7.0/#sec-tolength).
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a valid length, else `false`.
 * @example
 *
 * _.isLength(3);
 * // => true
 *
 * _.isLength(Number.MIN_VALUE);
 * // => false
 *
 * _.isLength(Infinity);
 * // => false
 *
 * _.isLength('3');
 * // => false
 */
function isLength(value) {
  return typeof value == 'number' &&
    value > -1 && value % 1 == 0 && value <= MAX_SAFE_INTEGER;
}

/**
 * Checks if `value` is the
 * [language type](http://www.ecma-international.org/ecma-262/7.0/#sec-ecmascript-language-types)
 * of `Object`. (e.g. arrays, functions, objects, regexes, `new Number(0)`, and `new String('')`)
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an object, else `false`.
 * @example
 *
 * _.isObject({});
 * // => true
 *
 * _.isObject([1, 2, 3]);
 * // => true
 *
 * _.isObject(_.noop);
 * // => true
 *
 * _.isObject(null);
 * // => false
 */
function isObject(value) {
  var type = typeof value;
  return !!value && (type == 'object' || type == 'function');
}

/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */
function isObjectLike(value) {
  return !!value && typeof value == 'object';
}

/**
 * Assigns own enumerable string keyed properties of source objects to the
 * destination object. Source objects are applied from left to right.
 * Subsequent sources overwrite property assignments of previous sources.
 *
 * **Note:** This method mutates `object` and is loosely based on
 * [`Object.assign`](https://mdn.io/Object/assign).
 *
 * @static
 * @memberOf _
 * @since 0.10.0
 * @category Object
 * @param {Object} object The destination object.
 * @param {...Object} [sources] The source objects.
 * @returns {Object} Returns `object`.
 * @see _.assignIn
 * @example
 *
 * function Foo() {
 *   this.a = 1;
 * }
 *
 * function Bar() {
 *   this.c = 3;
 * }
 *
 * Foo.prototype.b = 2;
 * Bar.prototype.d = 4;
 *
 * _.assign({ 'a': 0 }, new Foo, new Bar);
 * // => { 'a': 1, 'c': 3 }
 */
var assign = createAssigner(function(object, source) {
  if (nonEnumShadows || isPrototype(source) || isArrayLike(source)) {
    copyObject(source, keys(source), object);
    return;
  }
  for (var key in source) {
    if (hasOwnProperty.call(source, key)) {
      assignValue(object, key, source[key]);
    }
  }
});

/**
 * Creates an array of the own enumerable property names of `object`.
 *
 * **Note:** Non-object values are coerced to objects. See the
 * [ES spec](http://ecma-international.org/ecma-262/7.0/#sec-object.keys)
 * for more details.
 *
 * @static
 * @since 0.1.0
 * @memberOf _
 * @category Object
 * @param {Object} object The object to query.
 * @returns {Array} Returns the array of property names.
 * @example
 *
 * function Foo() {
 *   this.a = 1;
 *   this.b = 2;
 * }
 *
 * Foo.prototype.c = 3;
 *
 * _.keys(new Foo);
 * // => ['a', 'b'] (iteration order is not guaranteed)
 *
 * _.keys('hi');
 * // => ['0', '1']
 */
function keys(object) {
  return isArrayLike(object) ? arrayLikeKeys(object) : baseKeys(object);
}

module.exports = assign;


/***/ }),

/***/ "./resources/js/editor.js":
/*!********************************!*\
  !*** ./resources/js/editor.js ***!
  \********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _editor_filter_block_edit__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./editor/filter-block-edit */ "./resources/js/editor/filter-block-edit.js");
/* harmony import */ var _editor_filter_block_register__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./editor/filter-block-register */ "./resources/js/editor/filter-block-register.js");
/* harmony import */ var _editor_rich_text_format_font_size_small_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./editor/rich-text/format-font-size-small.js */ "./resources/js/editor/rich-text/format-font-size-small.js");
/* harmony import */ var _editor_rich_text_format_font_size_small_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_editor_rich_text_format_font_size_small_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _editor_rich_text_format_underline_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./editor/rich-text/format-underline.js */ "./resources/js/editor/rich-text/format-underline.js");
/* harmony import */ var _editor_rich_text_format_underline_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_editor_rich_text_format_underline_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _editor_block_variations__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./editor/block-variations */ "./resources/js/editor/block-variations.js");
/**
 * Editor Script.
 *
 * This imports all modules for the block editor. The final result gets saved
 * back into `public/js/editor.js`.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

 // Import rich text formats.


 // Import block variations.



/***/ }),

/***/ "./resources/js/editor/block-controls/control-box-shadow.js":
/*!******************************************************************!*\
  !*** ./resources/js/editor/block-controls/control-box-shadow.js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util_update_class__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../util/update-class */ "./resources/js/editor/util/update-class.js");
/**
 * Box Shadow Control.
 *
 * Outputs a select dropdown control for handling the box-shadow.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
// Import the class update utility.
 // Get the core WP select control.

var SelectControl = wp.components.SelectControl; // Global set via `wp_localize_script()`.

var _exhaleEditor = exhaleEditor,
    labels = _exhaleEditor.labels;
/* harmony default export */ __webpack_exports__["default"] = (function (props) {
  var options = [{
    label: labels.default,
    value: ''
  }, {
    label: labels.none,
    value: 'none'
  }, {
    label: labels.sizes.small,
    value: 'sm'
  }, {
    label: labels.sizes.medium,
    value: 'md'
  }, {
    label: labels.sizes.large,
    value: 'lg'
  }, {
    label: labels.sizes.extraLarge,
    value: 'xl'
  }]; // Get the box-shadow attribute.

  var boxShadow = props.attributes.boxShadow;
  return React.createElement(SelectControl, {
    key: "boxShadow",
    label: labels.shadow,
    value: boxShadow,
    options: options,
    onChange: function onChange(selected) {
      props.setAttributes({
        boxShadow: selected,
        className: Object(_util_update_class__WEBPACK_IMPORTED_MODULE_0__["default"])(props.attributes.className, selected ? 'shadow-' + selected : '', options.filter(function (opt) {
          return opt.value;
        }).map(function (opt) {
          return 'shadow-' + opt.value;
        }))
      });
    }
  });
});

/***/ }),

/***/ "./resources/js/editor/block-controls/control-gap.js":
/*!***********************************************************!*\
  !*** ./resources/js/editor/block-controls/control-gap.js ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util_update_class__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../util/update-class */ "./resources/js/editor/util/update-class.js");
/**
 * List Style Type Control.
 *
 * Outputs a select dropdown control for handling the list-style-type.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
// Import the class update utility.
 // Get the core WP select control.

var SelectControl = wp.components.SelectControl; // Global set via `wp_localize_script()`.

var _exhaleEditor = exhaleEditor,
    labels = _exhaleEditor.labels;
/* harmony default export */ __webpack_exports__["default"] = (function (props) {
  var options = [{
    label: labels.default,
    value: ''
  }, {
    label: 'Gap 0',
    value: '0'
  }, {
    label: 'Gap 4',
    value: '4'
  }, {
    label: 'Gap 8',
    value: '8'
  }, {
    label: 'Gap 12',
    value: '12'
  }, {
    label: 'Gap 16',
    value: '16'
  }]; // Get the gap attribute.

  var gap = props.attributes.gap;
  return React.createElement(SelectControl, {
    key: "gap",
    label: 'Gap',
    value: gap,
    options: options,
    onChange: function onChange(selected) {
      props.setAttributes({
        gap: selected,
        className: Object(_util_update_class__WEBPACK_IMPORTED_MODULE_0__["default"])(props.attributes.className, selected ? 'gap-' + selected : '', options.filter(function (opt) {
          return opt.value;
        }).map(function (opt) {
          return 'gap-' + opt.value;
        }))
      });
    }
  });
});

/***/ }),

/***/ "./resources/js/editor/block-controls/control-list-type.js":
/*!*****************************************************************!*\
  !*** ./resources/js/editor/block-controls/control-list-type.js ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util_update_class__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../util/update-class */ "./resources/js/editor/util/update-class.js");
/**
 * List Style Type Control.
 *
 * Outputs a select dropdown control for handling the list-style-type.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
// Import the class update utility.
 // Get the core WP select control.

var SelectControl = wp.components.SelectControl; // Global set via `wp_localize_script()`.

var _exhaleEditor = exhaleEditor,
    labels = _exhaleEditor.labels;
/* harmony default export */ __webpack_exports__["default"] = (function (props) {
  var options = [{
    label: labels.default,
    value: ''
  }, {
    label: labels.none,
    value: 'none'
  }, {
    label: labels.lists.disc,
    value: 'disc'
  }, {
    label: labels.lists.circle,
    value: 'circle'
  }, {
    label: labels.lists.square,
    value: 'square'
  }]; // Get the list-style-type attribute.

  var listType = props.attributes.listType;
  return React.createElement(SelectControl, {
    key: "listType",
    label: labels.listType,
    value: listType,
    options: options,
    onChange: function onChange(selected) {
      props.setAttributes({
        listType: selected,
        className: Object(_util_update_class__WEBPACK_IMPORTED_MODULE_0__["default"])(props.attributes.className, selected ? 'list-' + selected : '', options.filter(function (opt) {
          return opt.value;
        }).map(function (opt) {
          return 'list-' + opt.value;
        }))
      });
    }
  });
});

/***/ }),

/***/ "./resources/js/editor/block-controls/fields.js":
/*!******************************************************!*\
  !*** ./resources/js/editor/block-controls/fields.js ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _control_box_shadow__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./control-box-shadow */ "./resources/js/editor/block-controls/control-box-shadow.js");
/* harmony import */ var _control_gap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./control-gap */ "./resources/js/editor/block-controls/control-gap.js");
/* harmony import */ var _control_list_type__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./control-list-type */ "./resources/js/editor/block-controls/control-list-type.js");
/**
 * Block Design Setting Fields.
 *
 * Returns an array of design setting fields to output in the block editor.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
// Import block controls.



/* harmony default export */ __webpack_exports__["default"] = ([{
  name: 'listType',
  type: 'string',
  default: '',
  control: _control_list_type__WEBPACK_IMPORTED_MODULE_2__["default"],
  blocks: ['core/list']
}, {
  name: 'borderRadius',
  type: 'string',
  default: '',
  control: ControlBorderRadius,
  blocks: ['core/image', 'core/gallery', 'core/group', 'core/media-text', 'core/paragraph']
}, {
  name: 'boxShadow',
  type: 'string',
  default: '',
  control: _control_box_shadow__WEBPACK_IMPORTED_MODULE_0__["default"],
  blocks: ['core/column', 'core/group', 'core/image', 'core/gallery', 'core/media-text', 'core/paragraph']
}, {
  name: 'gap',
  type: 'string',
  default: '',
  control: _control_gap__WEBPACK_IMPORTED_MODULE_1__["default"],
  blocks: ['core/query-loop']
}]);

/***/ }),

/***/ "./resources/js/editor/block-controls/panel-design-settings.js":
/*!*********************************************************************!*\
  !*** ./resources/js/editor/block-controls/panel-design-settings.js ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/**
 * Design Settings Panel.
 *
 * Creates the design settings panel for the block editor.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
var PanelBody = wp.components.PanelBody;
var __ = wp.i18n.__; // Global set via `wp_localize_script()`.

var _exhaleEditor = exhaleEditor,
    labels = _exhaleEditor.labels;
/* harmony default export */ __webpack_exports__["default"] = (function (props, fields) {
  return React.createElement(PanelBody, {
    title: labels.designSettings,
    initialOpen: false
  }, fields.map(function (field, i) {
    return field.control(props);
  }));
});

/***/ }),

/***/ "./resources/js/editor/block-variations.js":
/*!*************************************************!*\
  !*** ./resources/js/editor/block-variations.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _block_variations_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./block-variations/index */ "./resources/js/editor/block-variations/index.js");

wp.domReady(function () {
  Object.keys(_block_variations_index__WEBPACK_IMPORTED_MODULE_0__).forEach(function (block) {
    _block_variations_index__WEBPACK_IMPORTED_MODULE_0__[block].variations.forEach(function (options) {
      wp.blocks.registerBlockVariation(_block_variations_index__WEBPACK_IMPORTED_MODULE_0__[block].block, options);
    });
  });
});

/***/ }),

/***/ "./resources/js/editor/block-variations/core-cover.js":
/*!************************************************************!*\
  !*** ./resources/js/editor/block-variations/core-cover.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  block: 'core/cover',
  variations: [// Creates a default Cover variation that uses the correct
  // default paragraph font size. Core's use of the "large"
  // size should be a variation itself since it is an opionated
  // style, and not all themes have a "large" size.
  {
    name: 'default',
    title: 'Cover',
    scope: ['block', 'inserter', 'transform'],
    isDefault: true,
    attributes: {
      className: 'is-default'
    },
    innerBlocks: [['core/paragraph', {
      align: 'center'
    }]]
  }]
});

/***/ }),

/***/ "./resources/js/editor/block-variations/core-gallery.js":
/*!**************************************************************!*\
  !*** ./resources/js/editor/block-variations/core-gallery.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  block: 'core/gallery',
  variations: [{
    name: 'classic',
    title: 'Gallery: Classic',
    scope: ['block', 'inserter', 'transform'],
    attributes: {
      className: 'is-classic'
    },
    isActive: function isActive(block, variation) {
      return block.className.includes(variation.className);
    }
  }, {
    name: 'default',
    title: 'Gallery: Overlay',
    scope: 'transform',
    isDefault: true,
    attributes: {
      className: 'is-default'
    }
  }]
});

/***/ }),

/***/ "./resources/js/editor/block-variations/core-group.js":
/*!************************************************************!*\
  !*** ./resources/js/editor/block-variations/core-group.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  block: 'core/group',
  variations: [{
    name: 'default',
    title: 'Group: Default',
    scope: ['block', 'inserter', 'transform'],
    isDefault: true
  }, {
    name: 'padded',
    title: 'Group: Padded',
    scope: ['block', 'inserter', 'transform'],
    isDefault: true,
    attributes: {
      style: {
        spacing: {
          padding: {
            top: "2rem",
            bottom: "2rem",
            left: "2rem",
            right: "2rem"
          }
        }
      },
      backgroundColor: 'neutral-100',
      className: 'is-var-padded'
    },
    innerBlocks: [['core/paragraph', {
      align: 'center'
    }]]
  }, {
    name: 'site-branding',
    title: 'Site Branding',
    scope: ['inserter'],
    attributes: {
      align: "full",
      style: {
        spacing: {
          padding: {
            top: "0rem",
            right: "2rem",
            bottom: "0rem",
            left: "2rem"
          },
          margin: {
            top: "0px",
            right: "0px",
            bottom: "0px",
            left: "0px"
          }
        }
      },
      className: "overflow-hidden flex justify-start items-center md:flex-grow-0"
    },
    innerBlocks: [["core/site-title", {
      className: "m-0 mr-2 leading-none",
      style: {
        typography: {
          lineHeight: "1"
        },
        spacing: {
          margin: {
            top: "0px",
            right: "8px",
            bottom: "0px",
            left: "0px"
          }
        }
      },
      fontSize: "extra-large"
    }], ["core/site-tagline", {
      style: {
        typography: {
          fontFamily: "var:preset|font-family|secondary",
          lineHeight: "1"
        },
        spacing: {
          margin: {
            top: "0px",
            right: "0px",
            bottom: "0px",
            left: "8px"
          }
        }
      },
      className: "hidden sm:block",
      fontSize: "sm"
    }]]
  }]
});

/***/ }),

/***/ "./resources/js/editor/block-variations/core-image.js":
/*!************************************************************!*\
  !*** ./resources/js/editor/block-variations/core-image.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  block: 'core/image',
  variations: [{
    name: 'default',
    title: 'Image: Classic',
    scope: 'transform',
    isDefault: true,
    attributes: {
      className: 'is-var-classic'
    }
  }, {
    name: 'classic',
    title: 'Image: Overlay',
    scope: ['block', 'inserter', 'transform'],
    attributes: {
      className: 'is-var-overlay'
    }
  }]
});

/***/ }),

/***/ "./resources/js/editor/block-variations/core-navigation.js":
/*!*****************************************************************!*\
  !*** ./resources/js/editor/block-variations/core-navigation.js ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  block: 'core/navigation',
  variations: [{
    name: 'primary',
    title: 'Navigation: Primary',
    scope: ['block', 'inserter', 'transform'],
    attributes: {
      orientation: 'primary-horizontal',
      isResponsive: true,
      className: 'menu--primary'
    },
    innerBlocks: [['core/home-link', {
      label: 'Home'
    }], ['core/navigation-link', {
      label: 'About',
      url: '/about',
      kind: 'custom'
    }], ['core/navigation-link', {
      label: 'Blog',
      url: '/blog',
      kind: 'custom'
    }]]
  }]
});

/***/ }),

/***/ "./resources/js/editor/block-variations/core-spacer.js":
/*!*************************************************************!*\
  !*** ./resources/js/editor/block-variations/core-spacer.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  block: 'core/spacer',
  variations: [{
    name: 'default',
    title: 'Spacer',
    scope: ['block', 'inserter', 'transform'],
    attributes: {
      height: 100
    },
    isDefault: true
  }, {
    name: 'spacing-1',
    title: 'Theme Spacer: 1 (0.25rem)',
    scope: ['transform'],
    attributes: {
      height: 4
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-2',
    title: 'Theme Spacer: 2 (0.5rem)',
    scope: ['transform'],
    attributes: {
      height: 8
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-3',
    title: 'Theme Spacer: 3 (0.75rem)',
    scope: ['transform'],
    attributes: {
      height: 12
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-4',
    title: 'Theme Spacer: 4 (1rem)',
    scope: ['transform'],
    attributes: {
      height: 16
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-5',
    title: 'Theme Spacer: 5 (1.25rem)',
    scope: ['transform'],
    attributes: {
      height: 20
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-6',
    title: 'Theme Spacer: 6 (1.5rem)',
    scope: ['transform'],
    attributes: {
      height: 24
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-8',
    title: 'Theme Spacer: 8 (2rem)',
    scope: ['transform'],
    attributes: {
      height: 32
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-12',
    title: 'Theme Spacer: 12 (3rem)',
    scope: ['transform'],
    attributes: {
      height: 48
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-16',
    title: 'Theme Spacer: 16 (4rem)',
    scope: ['transform'],
    attributes: {
      height: 64
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-20',
    title: 'Theme Spacer: 20 (5rem)',
    scope: ['transform'],
    attributes: {
      height: 80
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-24',
    title: 'Theme Spacer: 24 (6rem)',
    scope: ['transform'],
    attributes: {
      height: 96
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-28',
    title: 'Theme Spacer: 28 (7rem)',
    scope: ['transform'],
    attributes: {
      height: 112
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-32',
    title: 'Theme Spacer: 32 (8rem)',
    scope: ['transform'],
    attributes: {
      height: 128
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-36',
    title: 'Theme Spacer: 36 (9rem)',
    scope: ['transform'],
    attributes: {
      height: 144
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }, {
    name: 'spacing-40',
    title: 'Theme Spacer: 40 (10rem)',
    scope: ['transform'],
    attributes: {
      height: 160
    },
    isActive: function isActive(block, variation) {
      return block.height === variation.height;
    }
  }]
});

/***/ }),

/***/ "./resources/js/editor/block-variations/index.js":
/*!*******************************************************!*\
  !*** ./resources/js/editor/block-variations/index.js ***!
  \*******************************************************/
/*! exports provided: cover, image, gallery, group, navigation, spacer */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _core_cover__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./core-cover */ "./resources/js/editor/block-variations/core-cover.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "cover", function() { return _core_cover__WEBPACK_IMPORTED_MODULE_0__["default"]; });

/* harmony import */ var _core_image__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./core-image */ "./resources/js/editor/block-variations/core-image.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "image", function() { return _core_image__WEBPACK_IMPORTED_MODULE_1__["default"]; });

/* harmony import */ var _core_gallery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./core-gallery */ "./resources/js/editor/block-variations/core-gallery.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "gallery", function() { return _core_gallery__WEBPACK_IMPORTED_MODULE_2__["default"]; });

/* harmony import */ var _core_group__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./core-group */ "./resources/js/editor/block-variations/core-group.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "group", function() { return _core_group__WEBPACK_IMPORTED_MODULE_3__["default"]; });

/* harmony import */ var _core_navigation__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./core-navigation */ "./resources/js/editor/block-variations/core-navigation.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "navigation", function() { return _core_navigation__WEBPACK_IMPORTED_MODULE_4__["default"]; });

/* harmony import */ var _core_spacer__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./core-spacer */ "./resources/js/editor/block-variations/core-spacer.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "spacer", function() { return _core_spacer__WEBPACK_IMPORTED_MODULE_5__["default"]; });








/***/ }),

/***/ "./resources/js/editor/filter-block-edit.js":
/*!**************************************************!*\
  !*** ./resources/js/editor/filter-block-edit.js ***!
  \**************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util_color_map__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./util/color-map */ "./resources/js/editor/util/color-map.js");
/* harmony import */ var _block_controls_fields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block-controls/fields */ "./resources/js/editor/block-controls/fields.js");
/* harmony import */ var _block_controls_panel_design_settings__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./block-controls/panel-design-settings */ "./resources/js/editor/block-controls/panel-design-settings.js");
/**
 * Block Edit Filter.
 *
 * Adds a filter on `editor.BlockEdit` and adds custom inspector controls to
 * any blocks that has custom design settings.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
// Imports the design setting fields.

 // Imports the design settings panel.

 // Assign core WP variables.

var createHigherOrderComponent = wp.compose.createHigherOrderComponent;
var Fragment = wp.element.Fragment;
var InspectorControls = wp.blockEditor.InspectorControls;
var addFilter = wp.hooks.addFilter;
/**
 * Filter on block edit to add custom inspector controls.
 *
 * @since  2.1.0
 * @access public
 * @param  object   BlockEdit
 * @return function
 */

var ExhaleBlockEdit = createHigherOrderComponent(function (BlockEdit) {
  return function (props) {
    // Back-compat layer. What we're doing here is updating block
    // attributes to match up with new attribute values in newer
    // versions of the theme.
    if (props.attributes.backgroundColor && props.attributes.backgroundColor in _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"]) {
      props.attributes.backgroundColor = _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"][props.attributes.backgroundColor];
    }

    if (props.attributes.overlayColor && props.attributes.overlayColor in _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"]) {
      props.attributes.overlayColor = _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"][props.attributes.overlayColor];
    }

    if (props.attributes.mainColor && props.attributes.mainColor in _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"]) {
      props.attributes.mainColor = _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"][props.attributes.mainColor];
    }

    if (props.attributes.textColor && props.attributes.textColor in _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"]) {
      props.attributes.textColor = _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"][props.attributes.textColor];
    }

    if (props.attributes.color && props.attributes.color in _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"]) {
      props.attributes.color = _util_color_map__WEBPACK_IMPORTED_MODULE_0__["default"][props.attributes.color];
    } // \*/ End back-compat.
    // Create an array to hold the fields for the current block.


    var blockFields = []; // Loop through the global fields and add them to the block
    // fields array if they belong to the current block. `props.name`
    // is the current block ID.

    _block_controls_fields__WEBPACK_IMPORTED_MODULE_1__["default"].forEach(function (field) {
      if (field.blocks.includes(props.name)) {
        blockFields.push(field);
      }
    }); // If there are no fields for the current block, return the
    // block edit component.

    if (!blockFields.length) {
      return React.createElement(BlockEdit, props);
    } // Insert a new design settings panel and pass along the fields
    // to display.


    return React.createElement(Fragment, null, React.createElement(BlockEdit, props), React.createElement(InspectorControls, null, Object(_block_controls_panel_design_settings__WEBPACK_IMPORTED_MODULE_2__["default"])(props, blockFields)));
  };
}, 'ExhaleBlockEdit');
addFilter('editor.BlockEdit', 'exhale/block/edit', ExhaleBlockEdit);

/***/ }),

/***/ "./resources/js/editor/filter-block-register.js":
/*!******************************************************!*\
  !*** ./resources/js/editor/filter-block-register.js ***!
  \******************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _block_controls_fields__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./block-controls/fields */ "./resources/js/editor/block-controls/fields.js");
/* harmony import */ var lodash_assign__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash.assign */ "./node_modules/lodash.assign/index.js");
/* harmony import */ var lodash_assign__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash_assign__WEBPACK_IMPORTED_MODULE_1__);
function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}
/**
 * Block Registration Filter.
 *
 * Adds a filter on `editor.BlockEdit` and adds custom inspector controls to
 * any blocks that has custom design settings.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
// Imports the design setting fields.


 // Imports the assign function from lodash.


var addFilter = wp.hooks.addFilter;
/**
 * Filter on the block registration process to add custom attributes.
 *
 * @since  2.1.0
 * @access public
 * @param  object  Settings for the block.
 * @param  string  Block name.
 * @return object
 */

addFilter('blocks.registerBlockType', 'exhale/block/register', function (settings, name) {
  _block_controls_fields__WEBPACK_IMPORTED_MODULE_0__["default"].forEach(function (field) {
    // If a given field is registered for the current block, add the
    // attributes for the field.
    if (field.blocks.includes(name)) {
      settings.attributes = lodash_assign__WEBPACK_IMPORTED_MODULE_1___default()(settings.attributes, _defineProperty({}, field.name, {
        type: field.type,
        default: field.default
      }));
    }
  });
  return settings;
});

/***/ }),

/***/ "./resources/js/editor/rich-text/format-font-size-small.js":
/*!*****************************************************************!*\
  !*** ./resources/js/editor/rich-text/format-font-size-small.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var _wp$richText = wp.richText,
    registerFormatType = _wp$richText.registerFormatType,
    toggleFormat = _wp$richText.toggleFormat;
var RichTextToolbarButton = wp.blockEditor.RichTextToolbarButton;

var FormatFontSizeSmallButton = function FormatFontSizeSmallButton(props) {
  return React.createElement(RichTextToolbarButton, {
    icon: "verse",
    title: "Small",
    onClick: function onClick() {
      props.onChange(toggleFormat(props.value, {
        type: 'exhale/font-size-sm'
      }));
    },
    isActive: props.isActive
  });
};

registerFormatType('exhale/font-size-sm', {
  title: 'Small',
  tagName: 'span',
  className: 'has-sm-font-size',
  edit: FormatFontSizeSmallButton
});

/***/ }),

/***/ "./resources/js/editor/rich-text/format-underline.js":
/*!***********************************************************!*\
  !*** ./resources/js/editor/rich-text/format-underline.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var _wp$richText = wp.richText,
    registerFormatType = _wp$richText.registerFormatType,
    toggleFormat = _wp$richText.toggleFormat;
var RichTextToolbarButton = wp.blockEditor.RichTextToolbarButton;

var FormatUnderlineButton = function FormatUnderlineButton(props) {
  return React.createElement(RichTextToolbarButton, {
    icon: "underline",
    title: "Underline",
    onClick: function onClick() {
      props.onChange(toggleFormat(props.value, {
        type: 'exhale/underline'
      }));
    },
    isActive: props.isActive
  });
};

registerFormatType('exhale/underline', {
  title: 'Small',
  tagName: 'span',
  className: 'underline',
  edit: FormatUnderlineButton
});

/***/ }),

/***/ "./resources/js/editor/util/color-map.js":
/*!***********************************************!*\
  !*** ./resources/js/editor/util/color-map.js ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/**
 * Replace Class Utility Function.
 *
 * Updates an HTML class name.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

/**
 * Helper function for updating class names.
 *
 * @since  2.1.0
 * @access public
 * @param  string  className  HTML class name.
 * @param  string  add        New class to add.
 * @param  array   remove     Old classes to remove.
 * @return string
 */
/* harmony default export */ __webpack_exports__["default"] = ({
  'gray-darkest': 'gray-900',
  'gray-darker': 'gray-700',
  'gray-dark': 'gray-600',
  'gray': 'gray-500',
  'gray-light': 'gray-400',
  'gray-lighter': 'gray-300',
  'gray-lightest': 'gray-100',
  'red-darkest': 'red-900',
  'red-darker': 'red-700',
  'red-dark': 'red-600',
  'red': 'red-500',
  'red-light': 'red-400',
  'red-lighter': 'red-300',
  'red-lightest': 'red-100',
  'orange-darkest': 'orange-900',
  'orange-darker': 'orange-700',
  'orange-dark': 'orange-600',
  'orange': 'orange-500',
  'orange-light': 'orange-400',
  'orange-lighter': 'orange-300',
  'orange-lightest': 'orange-100',
  'yellow-darkest': 'yellow-900',
  'yellow-darker': 'yellow-700',
  'yellow-dark': 'yellow-600',
  'yellow': 'yellow-500',
  'yellow-light': 'yellow-400',
  'yellow-lighter': 'yellow-300',
  'yellow-lightest': 'yellow-100',
  'green-darkest': 'green-900',
  'green-darker': 'green-700',
  'green-dark': 'green-600',
  'green': 'green-500',
  'green-light': 'green-400',
  'green-lighter': 'green-300',
  'green-lightest': 'green-100',
  'teal-darkest': 'teal-900',
  'teal-darker': 'teal-700',
  'teal-dark': 'teal-600',
  'teal': 'teal-500',
  'teal-light': 'teal-400',
  'teal-lighter': 'teal-300',
  'teal-lightest': 'teal-100',
  'primary-darkest': 'primary-900',
  'primary-darker': 'primary-700',
  'primary-dark': 'primary-600',
  'blue': 'primary-500',
  'primary-light': 'primary-400',
  'primary-lighter': 'primary-300',
  'primary-lightest': 'primary-100',
  'indigo-darkest': 'indigo-900',
  'indigo-darker': 'indigo-700',
  'indigo-dark': 'indigo-600',
  'indigo': 'indigo-500',
  'indigo-light': 'indigo-400',
  'indigo-lighter': 'indigo-300',
  'indigo-lightest': 'indigo-100',
  'secondary-darkest': 'secondary-900',
  'secondary-darker': 'secondary-700',
  'secondary-dark': 'secondary-600',
  'purple': 'secondary-500',
  'secondary-light': 'secondary-400',
  'secondary-lighter': 'secondary-300',
  'secondary-lightest': 'secondary-100',
  'pink-darkest': 'pink-900',
  'pink-darker': 'pink-700',
  'pink-dark': 'pink-600',
  'pink': 'pink-500',
  'pink-light': 'pink-400',
  'pink-lighter': 'pink-300',
  'pink-lightest': 'pink-100'
});

/***/ }),

/***/ "./resources/js/editor/util/update-class.js":
/*!**************************************************!*\
  !*** ./resources/js/editor/util/update-class.js ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/**
 * Replace Class Utility Function.
 *
 * Updates an HTML class name.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */
var TokenList = wp.tokenList;
/**
 * Helper function for updating class names.
 *
 * @since  2.1.0
 * @access public
 * @param  string  className  HTML class name.
 * @param  string  add        New class to add.
 * @param  array   remove     Old classes to remove.
 * @return string
 */

/* harmony default export */ __webpack_exports__["default"] = (function (className, add) {
  var remove = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  var list = new TokenList(className); // If there are classes to remove, loop through the list and remove them
  // if they exist in the class name.

  if (0 !== remove.length) {
    list.forEach(function (oldClassName) {
      if (remove.includes(oldClassName)) {
        list.remove(oldClassName);
      }
    });
  } // If there's a new class name, add it.


  if (add) {
    list.add(add);
  } // Return the class string.


  return list.value;
});

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/editor.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\wp-content\themes\exhale\resources\js\editor.js */"./resources/js/editor.js");


/***/ })

/******/ });
//# sourceMappingURL=editor.js.map