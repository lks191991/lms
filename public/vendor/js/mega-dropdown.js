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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/vendor/js/mega-dropdown.js":
/*!*****************************************************!*\
  !*** ./resources/assets/vendor/js/mega-dropdown.js ***!
  \*****************************************************/
/*! exports provided: MegaDropdown */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MegaDropdown", function() { return MegaDropdown; });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var TIMEOUT = 150;

var MegaDropdown = /*#__PURE__*/function () {
  function MegaDropdown(element) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    _classCallCheck(this, MegaDropdown);

    this._onHover = options.trigger === 'hover' || element.getAttribute('data-trigger') === 'hover';
    this._container = this._findParent(element, 'mega-dropdown');
    if (!this._container) return;
    this._menu = this._container.querySelector('.dropdown-toggle ~ .dropdown-menu');
    if (!this._menu) return;
    element.setAttribute('aria-expanded', 'false');
    this._el = element;

    this._bindEvents();
  }

  _createClass(MegaDropdown, [{
    key: "open",
    value: function open() {
      if (this._timeout) {
        clearTimeout(this._timeout);
        this._timeout = null;
      }

      if (this._focusTimeout) {
        clearTimeout(this._focusTimeout);
        this._focusTimeout = null;
      }

      if (this._el.getAttribute('aria-expanded') !== 'true') {
        this._triggerEvent('show');

        this._container.classList.add('show');

        this._menu.classList.add('show');

        this._el.setAttribute('aria-expanded', 'true');

        this._el.focus();

        this._triggerEvent('shown');
      }
    }
  }, {
    key: "close",
    value: function close(force) {
      var _this = this;

      if (this._timeout) {
        clearTimeout(this._timeout);
        this._timeout = null;
      }

      if (this._focusTimeout) {
        clearTimeout(this._focusTimeout);
        this._focusTimeout = null;
      }

      if (this._onHover && !force) {
        this._timeout = setTimeout(function () {
          if (_this._timeout) {
            clearTimeout(_this._timeout);
            _this._timeout = null;
          }

          _this._close();
        }, TIMEOUT);
      } else {
        this._close();
      }
    }
  }, {
    key: "toggle",
    value: function toggle() {
      this._el.getAttribute('aria-expanded') === 'true' ? this.close(true) : this.open();
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this._unbindEvents();

      this._el = null;

      if (this._timeout) {
        clearTimeout(this._timeout);
        this._timeout = null;
      }

      if (this._focusTimeout) {
        clearTimeout(this._focusTimeout);
        this._focusTimeout = null;
      }
    }
  }, {
    key: "_close",
    value: function _close() {
      if (this._el.getAttribute('aria-expanded') === 'true') {
        this._triggerEvent('hide');

        this._container.classList.remove('show');

        this._menu.classList.remove('show');

        this._el.setAttribute('aria-expanded', 'false');

        this._triggerEvent('hidden');
      }
    }
  }, {
    key: "_bindEvents",
    value: function _bindEvents() {
      var _this2 = this;

      this._elClickEvnt = function (e) {
        e.preventDefault();

        _this2.toggle();
      };

      this._el.addEventListener('click', this._elClickEvnt);

      this._bodyClickEvnt = function (e) {
        if (!_this2._container.contains(e.target) && _this2._container.classList.contains('show')) {
          _this2.close(true);
        }
      };

      document.body.addEventListener('click', this._bodyClickEvnt, true);

      this._menuClickEvnt = function (e) {
        if (e.target.classList.contains('mega-link')) {
          _this2.close(true);
        }
      };

      this._menu.addEventListener('click', this._menuClickEvnt, true);

      this._focusoutEvnt = function (e) {
        if (_this2._focusTimeout) {
          clearTimeout(_this2._focusTimeout);
          _this2._focusTimeout = null;
        }

        if (_this2._el.getAttribute('aria-expanded') !== 'true') return;
        _this2._focusTimeout = setTimeout(function () {
          if (document.activeElement.tagName.toUpperCase() !== 'BODY' && _this2._findParent(document.activeElement, 'mega-dropdown') !== _this2._container) {
            _this2.close(true);
          }
        }, 100);
      };

      this._container.addEventListener('focusout', this._focusoutEvnt, true);

      if (this._onHover) {
        this._enterEvnt = function (e) {
          if (window.getComputedStyle(_this2._menu, null).getPropertyValue('position') === 'static') return;

          _this2.open();
        };

        this._leaveEvnt = function (e) {
          if (window.getComputedStyle(_this2._menu, null).getPropertyValue('position') === 'static') return;

          _this2.close();
        };

        this._el.addEventListener('mouseenter', this._enterEvnt);

        this._menu.addEventListener('mouseenter', this._enterEvnt);

        this._el.addEventListener('mouseleave', this._leaveEvnt);

        this._menu.addEventListener('mouseleave', this._leaveEvnt);
      }
    }
  }, {
    key: "_unbindEvents",
    value: function _unbindEvents() {
      if (this._elClickEvnt) {
        this._el.removeEventListener('click', this._elClickEvnt);

        this._elClickEvnt = null;
      }

      if (this._bodyClickEvnt) {
        document.body.removeEventListener('click', this._bodyClickEvnt, true);
        this._bodyClickEvnt = null;
      }

      if (this._menuClickEvnt) {
        this._menu.removeEventListener('click', this._menuClickEvnt, true);

        this._menuClickEvnt = null;
      }

      if (this._focusoutEvnt) {
        this._container.removeEventListener('focusout', this._focusoutEvnt, true);

        this._focusoutEvnt = null;
      }

      if (this._enterEvnt) {
        this._el.removeEventListener('mouseenter', this._enterEvnt);

        this._menu.removeEventListener('mouseenter', this._enterEvnt);

        this._enterEvnt = null;
      }

      if (this._leaveEvnt) {
        this._el.removeEventListener('mouseleave', this._leaveEvnt);

        this._menu.removeEventListener('mouseleave', this._leaveEvnt);

        this._leaveEvnt = null;
      }
    }
  }, {
    key: "_findParent",
    value: function _findParent(el, cls) {
      if (el.tagName.toUpperCase() === 'BODY') return null;
      el = el.parentNode;

      while (el.tagName.toUpperCase() !== 'BODY' && !el.classList.contains(cls)) {
        el = el.parentNode;
      }

      return el.tagName.toUpperCase() !== 'BODY' ? el : null;
    }
  }, {
    key: "_triggerEvent",
    value: function _triggerEvent(event) {
      if (document.createEvent) {
        var customEvent;

        if (typeof Event === 'function') {
          customEvent = new Event(event);
        } else {
          customEvent = document.createEvent('Event');
          customEvent.initEvent(event, false, true);
        }

        this._container.dispatchEvent(customEvent);
      } else {
        this._container.fireEvent('on' + event, document.createEventObject());
      }
    }
  }]);

  return MegaDropdown;
}();



/***/ }),

/***/ 4:
/*!***********************************************************!*\
  !*** multi ./resources/assets/vendor/js/mega-dropdown.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\js\mega-dropdown.js */"./resources/assets/vendor/js/mega-dropdown.js");


/***/ })

/******/ })));