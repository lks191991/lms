(function(e, a) { for(var i in a) e[i] = a[i]; }(window, /******/ (function(modules) { // webpackBootstrap
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
/******/ 	return __webpack_require__(__webpack_require__.s = 57);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/vendor/libs/bootstrap-tagsinput/_extension.js":
/*!************************************************************************!*\
  !*** ./resources/assets/vendor/libs/bootstrap-tagsinput/_extension.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Fix input position calculation
//
var tagsinputBuild = $.fn.tagsinput.Constructor.prototype.build;
var tagsinputDestroy = $.fn.tagsinput.Constructor.prototype.destroy;

$.fn.tagsinput.Constructor.prototype.build = function (options) {
  var _this = this;

  if (options && options.typeahead) {
    $.extend(options.typeahead, {
      minLength: 1,
      afterSelect: function afterSelect() {
        _this.$input[0].value = '';

        _this.$input.data('typeahead').lookup('');
      }
    });
  }

  var result = tagsinputBuild.call(this, options);
  var re = /<|>/g;
  this.$inpWidth = $('<div class="bootstrap-tagsinput-input" style="position:absolute;z-index:-101;top:-9999px;opacity:0;white-space:nowrap;"></div>');
  $('<div style="position:absolute;width:0;height:0;z-index:-100;opacity:0;overflow:hidden;"></div>').append(this.$inpWidth).prependTo(this.$container);

  var getWidth = function getWidth(val) {
    return Math.ceil(_this.$inpWidth.html((val || '').replace(re, '#')).outerWidth() + 12) + 'px';
  };

  this.$input[0].style.width = getWidth();
  this.$input.on('keydown keyup focusout', function () {
    this.style.width = getWidth(this.value);

    if (this.value.length < 1 && options && options.typeahead) {
      $(this).data('typeahead').lookup('');
    }
  });
  this.$input.on('paste', function () {
    setTimeout($.proxy(function () {
      this.style.width = getWidth(this.value);
    }, this), 100);
  });
  return result;
};

$.fn.tagsinput.Constructor.prototype.destroy = function () {
  this.$input.off('keydown keyup focusout paste change');
  return tagsinputDestroy.call(this);
}; // Re-initialize [data-role=tagsinput]


$(function () {
  $('input[data-role=tagsinput], select[multiple][data-role=tagsinput]').tagsinput('destroy');
  $('input[data-role=tagsinput], select[multiple][data-role=tagsinput]').tagsinput();
});

/***/ }),

/***/ 57:
/*!******************************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/bootstrap-tagsinput/_extension.js ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\bootstrap-tagsinput\_extension.js */"./resources/assets/vendor/libs/bootstrap-tagsinput/_extension.js");


/***/ })

/******/ })));