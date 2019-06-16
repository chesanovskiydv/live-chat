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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/sass/app.scss":
/*!****************************************!*\
  !*** ./resources/assets/sass/app.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/macros/macros.scss":
/*!**************************************************!*\
  !*** ./resources/assets/sass/macros/macros.scss ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/ts/macros/Actions.ts":
/*!***********************************************!*\
  !*** ./resources/assets/ts/macros/Actions.ts ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var Actions = /** @class */ (function () {
    /**
     * @param {String} dataAttributePrefix
     */
    function Actions(dataAttributePrefix) {
        this.dataAttributePrefix = dataAttributePrefix || 'data-action-form';
    }
    Object.defineProperty(Actions.prototype, "dataAttributeKey", {
        get: function () {
            return this.dataAttributePrefix + "-key";
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Actions.prototype, "confirmationAttributes", {
        get: function () {
            return {
                title: this.dataAttributePrefix + "-confirmation-title",
                text: this.dataAttributePrefix + "-confirmation-text"
            };
        },
        enumerable: true,
        configurable: true
    });
    /**
     * Initialize a Macros.
     *
     * @param {String} dataAttributePrefix
     */
    Actions.init = function (dataAttributePrefix) {
        var instance = new Actions(dataAttributePrefix);
        jQuery(document).on('click', "[" + instance.dataAttributeKey + "]", instance.handle.bind(instance));
    };
    /**
     * Execute an Action.
     *
     * @param {JQuery.TriggeredEvent} event
     */
    Actions.prototype.handle = function (event) {
        var $this = jQuery(event.currentTarget), id = $this.attr("" + this.dataAttributeKey), confirmation = {
            title: $this.attr(this.confirmationAttributes.title),
            text: $this.attr(this.confirmationAttributes.text)
        };
        var doAction = function () { return jQuery("#" + id).trigger('submit'); };
        if (typeof confirmation.title === 'string' && typeof confirmation.text === 'string') {
            eModal.confirm(confirmation.text, confirmation.title)
                .then(doAction);
        }
        else {
            doAction();
        }
        event.preventDefault();
    };
    return Actions;
}());
exports.default = Actions;


/***/ }),

/***/ "./resources/assets/ts/macros/index.ts":
/*!*********************************************!*\
  !*** ./resources/assets/ts/macros/index.ts ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
var Actions_1 = __importDefault(__webpack_require__(/*! ./Actions */ "./resources/assets/ts/macros/Actions.ts"));
exports.Actions = Actions_1.default;


/***/ }),

/***/ "./resources/assets/ts/macros/init.ts":
/*!********************************************!*\
  !*** ./resources/assets/ts/macros/init.ts ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __importStar = (this && this.__importStar) || function (mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (Object.hasOwnProperty.call(mod, k)) result[k] = mod[k];
    result["default"] = mod;
    return result;
};
Object.defineProperty(exports, "__esModule", { value: true });
var Macros = __importStar(__webpack_require__(/*! ./index */ "./resources/assets/ts/macros/index.ts"));
jQuery(document).ready(function () {
    for (var _i = 0, _a = Object.values(Macros); _i < _a.length; _i++) {
        var value = _a[_i];
        value.init();
    }
});


/***/ }),

/***/ 0:
/*!******************************************************************************************************************************!*\
  !*** multi ./resources/assets/ts/macros/init.ts ./resources/assets/sass/macros/macros.scss ./resources/assets/sass/app.scss ***!
  \******************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\programming\OSPanel\domains\live-chat\src\resources\assets\ts\macros\init.ts */"./resources/assets/ts/macros/init.ts");
__webpack_require__(/*! D:\programming\OSPanel\domains\live-chat\src\resources\assets\sass\macros\macros.scss */"./resources/assets/sass/macros/macros.scss");
module.exports = __webpack_require__(/*! D:\programming\OSPanel\domains\live-chat\src\resources\assets\sass\app.scss */"./resources/assets/sass/app.scss");


/***/ })

/******/ });