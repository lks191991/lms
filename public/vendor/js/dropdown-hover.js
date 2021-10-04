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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/vendor/js/dropdown-hover.js":
/*!******************************************************!*\
  !*** ./resources/assets/vendor/js/dropdown-hover.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Add onHover event for dropdowns
(function ($) {
  if (!$ || !$.fn) return;
  var SELECTOR = '[data-toggle=dropdown][data-trigger=hover]';
  var TIMEOUT = 150;

  function openDropdown($i) {
    var t = $i.data('dd-timeout');

    if (t) {
      clearTimeout(t);
      t = null;
      $i.data('dd-timeout', t);
    }

    if ($i.attr('aria-expanded') !== 'true') $i.dropdown('toggle');
  }

  function closeDropdown($i) {
    var t = $i.data('dd-timeout');
    if (t) clearTimeout(t);
    t = setTimeout(function () {
      var t2 = $i.data('dd-timeout');

      if (t2) {
        clearTimeout(t2);
        t2 = null;
        $i.data('dd-timeout', t2);
      }

      if ($i.attr('aria-expanded') === 'true') $i.dropdown('toggle');
    }, TIMEOUT);
    $i.data('dd-timeout', t);
  }

  $(function () {
    $('body').on('mouseenter', "".concat(SELECTOR, ", ").concat(SELECTOR, " ~ .dropdown-menu"), function () {
      var $toggle = $(this).hasClass('dropdown-toggle') ? $(this) : $(this).prev('.dropdown-toggle');
      var $dropdown = $(this).hasClass('dropdown-menu') ? $(this) : $(this).next('.dropdown-menu');
      if (window.getComputedStyle($dropdown[0], null).getPropertyValue('position') === 'static') return; // Set hovered flag

      if ($(this).is(SELECTOR)) {
        $(this).data('hovered', true);
      }

      openDropdown($(this).hasClass('dropdown-toggle') ? $(this) : $(this).prev('.dropdown-toggle'));
    }).on('mouseleave', "".concat(SELECTOR, ", ").concat(SELECTOR, " ~ .dropdown-menu"), function () {
      var $toggle = $(this).hasClass('dropdown-toggle') ? $(this) : $(this).prev('.dropdown-toggle');
      var $dropdown = $(this).hasClass('dropdown-menu') ? $(this) : $(this).next('.dropdown-menu');
      if (window.getComputedStyle($dropdown[0], null).getPropertyValue('position') === 'static') return; // Remove hovered flag

      if ($(this).is(SELECTOR)) {
        $(this).data('hovered', false);
      }

      closeDropdown($(this).hasClass('dropdown-toggle') ? $(this) : $(this).prev('.dropdown-toggle'));
    }).on('hide.bs.dropdown', function (e) {
      if ($(this).find(SELECTOR).data('hovered')) e.preventDefault();
    });
  });
})(window.jQuery);

/***/ }),

/***/ 1:
/*!************************************************************!*\
  !*** multi ./resources/assets/vendor/js/dropdown-hover.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\js\dropdown-hover.js */"./resources/assets/vendor/js/dropdown-hover.js");


/***/ })

/******/ })));