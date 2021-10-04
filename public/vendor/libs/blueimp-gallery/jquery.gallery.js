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
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./blueimp-gallery":
/*!*********************************!*\
  !*** external "blueimpGallery" ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["blueimpGallery"]; }());

/***/ }),

/***/ "./node_modules/blueimp-gallery/js/jquery.blueimp-gallery.js":
/*!*******************************************************************!*\
  !*** ./node_modules/blueimp-gallery/js/jquery.blueimp-gallery.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*
 * blueimp Gallery jQuery plugin
 * https://github.com/blueimp/Gallery
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global define */

;(function(factory) {
  'use strict'
  if (true) {
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "jquery"), __webpack_require__(/*! ./blueimp-gallery */ "./blueimp-gallery")], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__))
  } else {}
})(function($, Gallery) {
  'use strict'

  // Global click handler to open links with data-gallery attribute
  // in the Gallery lightbox:
  $(document).on('click', '[data-gallery]', function(event) {
    // Get the container id from the data-gallery attribute:
    var id = $(this).data('gallery')
    var widget = $(id)
    var container =
      (widget.length && widget) || $(Gallery.prototype.options.container)
    var callbacks = {
      onopen: function() {
        container.data('gallery', this).trigger('open')
      },
      onopened: function() {
        container.trigger('opened')
      },
      onslide: function() {
        container.trigger('slide', arguments)
      },
      onslideend: function() {
        container.trigger('slideend', arguments)
      },
      onslidecomplete: function() {
        container.trigger('slidecomplete', arguments)
      },
      onclose: function() {
        container.trigger('close')
      },
      onclosed: function() {
        container.trigger('closed').removeData('gallery')
      }
    }
    var options = $.extend(
      // Retrieve custom options from data-attributes
      // on the Gallery widget:
      container.data(),
      {
        container: container[0],
        index: this,
        event: event
      },
      callbacks
    )
    // Select all links with the same data-gallery attribute:
    var links = $(this)
      .closest('[data-gallery-group], body')
      .find('[data-gallery="' + id + '"]')
    if (options.filter) {
      links = links.filter(options.filter)
    }
    return new Gallery(links, options)
  })
})


/***/ }),

/***/ "./resources/assets/vendor/libs/blueimp-gallery/jquery.gallery.js":
/*!************************************************************************!*\
  !*** ./resources/assets/vendor/libs/blueimp-gallery/jquery.gallery.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! blueimp-gallery/js/jquery.blueimp-gallery.js */ "./node_modules/blueimp-gallery/js/jquery.blueimp-gallery.js");

/***/ }),

/***/ 17:
/*!******************************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/blueimp-gallery/jquery.gallery.js ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\blueimp-gallery\jquery.gallery.js */"./resources/assets/vendor/libs/blueimp-gallery/jquery.gallery.js");


/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["jQuery"]; }());

/***/ })

/******/ })));