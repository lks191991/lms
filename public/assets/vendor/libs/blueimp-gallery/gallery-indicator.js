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
/******/ 	return __webpack_require__(__webpack_require__.s = 12);
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

/***/ "./node_modules/blueimp-gallery/js/blueimp-gallery-indicator.js":
/*!**********************************************************************!*\
  !*** ./node_modules/blueimp-gallery/js/blueimp-gallery-indicator.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*
 * blueimp Gallery Indicator JS
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
    // Register as an anonymous AMD module:
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! ./blueimp-helper */ "jquery"), __webpack_require__(/*! ./blueimp-gallery */ "./blueimp-gallery")], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__))
  } else {}
})(function($, Gallery) {
  'use strict'

  $.extend(Gallery.prototype.options, {
    // The tag name, Id, element or querySelector of the indicator container:
    indicatorContainer: 'ol',
    // The class for the active indicator:
    activeIndicatorClass: 'active',
    // The list object property (or data attribute) with the thumbnail URL,
    // used as alternative to a thumbnail child element:
    thumbnailProperty: 'thumbnail',
    // Defines if the gallery indicators should display a thumbnail:
    thumbnailIndicators: true
  })

  var initSlides = Gallery.prototype.initSlides
  var addSlide = Gallery.prototype.addSlide
  var resetSlides = Gallery.prototype.resetSlides
  var handleClick = Gallery.prototype.handleClick
  var handleSlide = Gallery.prototype.handleSlide
  var handleClose = Gallery.prototype.handleClose

  $.extend(Gallery.prototype, {
    createIndicator: function(obj) {
      var indicator = this.indicatorPrototype.cloneNode(false)
      var title = this.getItemProperty(obj, this.options.titleProperty)
      var thumbnailProperty = this.options.thumbnailProperty
      var thumbnailUrl
      var thumbnail
      if (this.options.thumbnailIndicators) {
        if (thumbnailProperty) {
          thumbnailUrl = this.getItemProperty(obj, thumbnailProperty)
        }
        if (thumbnailUrl === undefined) {
          thumbnail = obj.getElementsByTagName && $(obj).find('img')[0]
          if (thumbnail) {
            thumbnailUrl = thumbnail.src
          }
        }
        if (thumbnailUrl) {
          indicator.style.backgroundImage = 'url("' + thumbnailUrl + '")'
        }
      }
      if (title) {
        indicator.title = title
      }
      return indicator
    },

    addIndicator: function(index) {
      if (this.indicatorContainer.length) {
        var indicator = this.createIndicator(this.list[index])
        indicator.setAttribute('data-index', index)
        this.indicatorContainer[0].appendChild(indicator)
        this.indicators.push(indicator)
      }
    },

    setActiveIndicator: function(index) {
      if (this.indicators) {
        if (this.activeIndicator) {
          this.activeIndicator.removeClass(this.options.activeIndicatorClass)
        }
        this.activeIndicator = $(this.indicators[index])
        this.activeIndicator.addClass(this.options.activeIndicatorClass)
      }
    },

    initSlides: function(reload) {
      if (!reload) {
        this.indicatorContainer = this.container.find(
          this.options.indicatorContainer
        )
        if (this.indicatorContainer.length) {
          this.indicatorPrototype = document.createElement('li')
          this.indicators = this.indicatorContainer[0].children
        }
      }
      initSlides.call(this, reload)
    },

    addSlide: function(index) {
      addSlide.call(this, index)
      this.addIndicator(index)
    },

    resetSlides: function() {
      resetSlides.call(this)
      this.indicatorContainer.empty()
      this.indicators = []
    },

    handleClick: function(event) {
      var target = event.target || event.srcElement
      var parent = target.parentNode
      if (parent === this.indicatorContainer[0]) {
        // Click on indicator element
        this.preventDefault(event)
        this.slide(this.getNodeIndex(target))
      } else if (parent.parentNode === this.indicatorContainer[0]) {
        // Click on indicator child element
        this.preventDefault(event)
        this.slide(this.getNodeIndex(parent))
      } else {
        return handleClick.call(this, event)
      }
    },

    handleSlide: function(index) {
      handleSlide.call(this, index)
      this.setActiveIndicator(index)
    },

    handleClose: function() {
      if (this.activeIndicator) {
        this.activeIndicator.removeClass(this.options.activeIndicatorClass)
      }
      handleClose.call(this)
    }
  })

  return Gallery
})


/***/ }),

/***/ "./resources/assets/vendor/libs/blueimp-gallery/gallery-indicator.js":
/*!***************************************************************************!*\
  !*** ./resources/assets/vendor/libs/blueimp-gallery/gallery-indicator.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! blueimp-gallery/js/blueimp-gallery-indicator.js */ "./node_modules/blueimp-gallery/js/blueimp-gallery-indicator.js");

/***/ }),

/***/ 12:
/*!*********************************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/blueimp-gallery/gallery-indicator.js ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\blueimp-gallery\gallery-indicator.js */"./resources/assets/vendor/libs/blueimp-gallery/gallery-indicator.js");


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