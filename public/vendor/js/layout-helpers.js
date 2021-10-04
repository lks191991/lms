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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/vendor/js/layout-helpers.js":
/*!******************************************************!*\
  !*** ./resources/assets/vendor/js/layout-helpers.js ***!
  \******************************************************/
/*! exports provided: layoutHelpers */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "layoutHelpers", function() { return layoutHelpers; });
function _toArray(arr) { return _arrayWithHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(n); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

// Constants
var TRANSITION_EVENTS = ['transitionend', 'webkitTransitionEnd', 'oTransitionEnd'];
var TRANSITION_PROPERTIES = ['transition', 'MozTransition', 'webkitTransition', 'WebkitTransition', 'OTransition'];
var INLINE_STYLE = "\n.layout-fixed .layout-1 .layout-sidenav,\n.layout-fixed-offcanvas .layout-1 .layout-sidenav {\n  top: {navbarHeight}px !important;\n}\n.layout-container {\n  padding-top: {navbarHeight}px !important;\n}\n.layout-content {\n  padding-bottom: {footerHeight}px !important;\n}"; // Guard

function requiredParam(name) {
  throw new Error("Parameter required".concat(name ? ': `' + name + '`' : ''));
}

var layoutHelpers = {
  // Root container
  CONTAINER: typeof window !== 'undefined' ? document.documentElement : null,
  // Large screens breakpoint
  LAYOUT_BREAKPOINT: 992,
  // Resize delay in milliseconds
  RESIZE_DELAY: 200,
  // Internal variables
  _curStyle: null,
  _styleEl: null,
  _resizeTimeout: null,
  _resizeCallback: null,
  _transitionCallback: null,
  _transitionCallbackTimeout: null,
  _listeners: [],
  _initialized: false,
  _autoUpdate: false,
  _lastWindowHeight: 0,
  // *******************************************************************************
  // * Utilities
  // ---
  // Add class
  _addClass: function _addClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.CONTAINER;
    cls.split(' ').forEach(function (c) {
      return el.classList.add(c);
    });
  },
  // ---
  // Remove class
  _removeClass: function _removeClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.CONTAINER;
    cls.split(' ').forEach(function (c) {
      return el.classList.remove(c);
    });
  },
  // ---
  // Has class
  _hasClass: function _hasClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.CONTAINER;
    var result = false;
    cls.split(' ').forEach(function (c) {
      if (el.classList.contains(c)) result = true;
    });
    return result;
  },
  // ---
  // Check for transition support
  _supportsTransitionEnd: function _supportsTransitionEnd() {
    if (window.QUnit) return false;
    var el = document.body || document.documentElement;
    if (!el) return false;
    var result = false;
    TRANSITION_PROPERTIES.forEach(function (evnt) {
      if (typeof el.style[evnt] !== 'undefined') result = true;
    });
    return result;
  },
  // ---
  // Get animation duration of element
  _getAnimationDuration: function _getAnimationDuration(el) {
    var duration = window.getComputedStyle(el).transitionDuration;
    return parseFloat(duration) * (duration.indexOf('ms') !== -1 ? 1 : 1000);
  },
  // ---
  // Trigger window event
  _triggerWindowEvent: function _triggerWindowEvent(name) {
    if (typeof window === 'undefined') return;

    if (document.createEvent) {
      var event;

      if (typeof Event === 'function') {
        event = new Event(name);
      } else {
        event = document.createEvent('Event');
        event.initEvent(name, false, true);
      }

      window.dispatchEvent(event);
    } else {
      window.fireEvent("on".concat(name), document.createEventObject());
    }
  },
  // ---
  // Trigger event
  _triggerEvent: function _triggerEvent(name) {
    this._triggerWindowEvent("layout".concat(name));

    this._listeners.filter(function (listener) {
      return listener.event === name;
    }).forEach(function (listener) {
      return listener.callback.call(null);
    });
  },
  // ---
  // Update style
  _updateInlineStyle: function _updateInlineStyle() {
    var navbarHeight = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
    var footerHeight = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

    if (!this._styleEl) {
      this._styleEl = document.createElement('style');
      this._styleEl.type = 'text/css';
      document.head.appendChild(this._styleEl);
    }

    var newStyle = INLINE_STYLE.replace(/\{navbarHeight\}/ig, navbarHeight).replace(/\{footerHeight\}/ig, footerHeight);

    if (this._curStyle !== newStyle) {
      this._curStyle = newStyle;
      this._styleEl.textContent = newStyle;
    }
  },
  // ---
  // Remove style
  _removeInlineStyle: function _removeInlineStyle() {
    if (this._styleEl) document.head.removeChild(this._styleEl);
    this._styleEl = null;
    this._curStyle = null;
  },
  // ---
  // Redraw layout sidenav (Safari bugfix)
  _redrawLayoutSidenav: function _redrawLayoutSidenav() {
    var layoutSidenav = this.getLayoutSidenav();

    if (layoutSidenav && layoutSidenav.querySelector('.sidenav')) {
      var inner = layoutSidenav.querySelector('.sidenav-inner');
      var scrollTop = inner.scrollTop;
      var pageScrollTop = document.documentElement.scrollTop;
      layoutSidenav.style.display = 'none';
      layoutSidenav.offsetHeight;
      layoutSidenav.style.display = '';
      inner.scrollTop = scrollTop;
      document.documentElement.scrollTop = pageScrollTop;
      return true;
    }

    return false;
  },
  // ---
  // Calculate current navbar height
  _getNavbarHeight: function _getNavbarHeight() {
    var _this = this;

    var layoutNavbar = this.getLayoutNavbar();
    if (!layoutNavbar) return 0;
    if (!this.isSmallScreen()) return layoutNavbar.getBoundingClientRect().height; // Needs some logic to get navbar height on small screens

    var clonedEl = layoutNavbar.cloneNode(true);
    clonedEl.id = null;
    clonedEl.style.visibility = 'hidden';
    clonedEl.style.position = 'absolute';
    Array.prototype.slice.call(clonedEl.querySelectorAll('.collapse.show')).forEach(function (el) {
      return _this._removeClass('show', el);
    });
    layoutNavbar.parentNode.insertBefore(clonedEl, layoutNavbar);
    var navbarHeight = clonedEl.getBoundingClientRect().height;
    clonedEl.parentNode.removeChild(clonedEl);
    return navbarHeight;
  },
  // ---
  // Get current footer height
  _getFooterHeight: function _getFooterHeight() {
    var layoutFooter = this.getLayoutFooter();
    if (!layoutFooter) return 0;
    return layoutFooter.getBoundingClientRect().height;
  },
  // ---
  // Add layout sivenav toggle animationEnd event
  _bindLayoutAnimationEndEvent: function _bindLayoutAnimationEndEvent(modifier, cb) {
    var _this2 = this;

    var sidenav = this.getSidenav();
    var duration = sidenav ? this._getAnimationDuration(sidenav) + 50 : 0;

    if (!duration) {
      modifier.call(this);
      cb.call(this);
      return;
    }

    this._transitionCallback = function (e) {
      if (e.target !== sidenav) return;

      _this2._unbindLayoutAnimationEndEvent();

      cb.call(_this2);
    };

    TRANSITION_EVENTS.forEach(function (e) {
      sidenav.addEventListener(e, _this2._transitionCallback, false);
    });
    modifier.call(this);
    this._transitionCallbackTimeout = setTimeout(function () {
      _this2._transitionCallback.call(_this2, {
        target: sidenav
      });
    }, duration);
  },
  // ---
  // Remove layout sivenav toggle animationEnd event
  _unbindLayoutAnimationEndEvent: function _unbindLayoutAnimationEndEvent() {
    var _this3 = this;

    var sidenav = this.getSidenav();

    if (this._transitionCallbackTimeout) {
      clearTimeout(this._transitionCallbackTimeout);
      this._transitionCallbackTimeout = null;
    }

    if (sidenav && this._transitionCallback) {
      TRANSITION_EVENTS.forEach(function (e) {
        sidenav.removeEventListener(e, _this3._transitionCallback, false);
      });
    }

    if (this._transitionCallback) {
      this._transitionCallback = null;
    }
  },
  // ---
  // Bind delayed window resize event
  _bindWindowResizeEvent: function _bindWindowResizeEvent() {
    var _this4 = this;

    this._unbindWindowResizeEvent();

    var cb = function cb() {
      if (_this4._resizeTimeout) {
        clearTimeout(_this4._resizeTimeout);
        _this4._resizeTimeout = null;
      }

      _this4._triggerEvent('resize');
    };

    this._resizeCallback = function () {
      if (_this4._resizeTimeout) clearTimeout(_this4._resizeTimeout);
      _this4._resizeTimeout = setTimeout(cb, _this4.RESIZE_DELAY);
    };

    window.addEventListener('resize', this._resizeCallback, false);
  },
  // ---
  // Unbind delayed window resize event
  _unbindWindowResizeEvent: function _unbindWindowResizeEvent() {
    if (this._resizeTimeout) {
      clearTimeout(this._resizeTimeout);
      this._resizeTimeout = null;
    }

    if (this._resizeCallback) {
      window.removeEventListener('resize', this._resizeCallback, false);
      this._resizeCallback = null;
    }
  },
  // ---
  // Set sidenav hover state
  _setSidenavHoverState: function _setSidenavHoverState(hovered) {
    this[hovered ? '_addClass' : '_removeClass']('layout-sidenav-hover');
  },
  // ---
  // Toggle collapsed
  _setCollapsed: function _setCollapsed(collapsed) {
    var _this5 = this;

    if (this.isSmallScreen()) {
      if (collapsed) {
        this._removeClass('layout-expanded');
      } else {
        setTimeout(function () {
          _this5._addClass('layout-expanded');
        }, this._redrawLayoutSidenav() ? 5 : 0);
      }
    } else {
      this[collapsed ? '_addClass' : '_removeClass']('layout-collapsed');
    }
  },
  _findParent: function _findParent(el, cls) {
    if (el && el.tagName.toUpperCase() === 'BODY') return null;
    el = el.parentNode;

    while (el && el.tagName.toUpperCase() !== 'BODY' && !el.classList.contains(cls)) {
      el = el.parentNode;
    }

    el = el && el.tagName.toUpperCase() !== 'BODY' ? el : null;
    return el;
  },
  _bindSidenavMouseEvents: function _bindSidenavMouseEvents() {
    var _this6 = this;

    if (this._sidenavMouseEnter && this._sidenavMouseLeave && this._windowTouchStart) return;
    var layoutSidenav = this.getLayoutSidenav();
    if (!layoutSidenav) return this._unbindSidenavMouseEvents();

    if (!this._sidenavMouseEnter) {
      this._sidenavMouseEnter = function () {
        if (_this6.isSmallScreen() || !_this6._hasClass('layout-collapsed') || _this6.isOffcanvas() || _this6._hasClass('layout-transitioning')) {
          return _this6._setSidenavHoverState(false);
        }

        _this6._setSidenavHoverState(true);
      };

      layoutSidenav.addEventListener('mouseenter', this._sidenavMouseEnter, false);
      layoutSidenav.addEventListener('touchstart', this._sidenavMouseEnter, false);
    }

    if (!this._sidenavMouseLeave) {
      this._sidenavMouseLeave = function () {
        _this6._setSidenavHoverState(false);
      };

      layoutSidenav.addEventListener('mouseleave', this._sidenavMouseLeave, false);
    }

    if (!this._windowTouchStart) {
      this._windowTouchStart = function (e) {
        if (!e || !e.target || !_this6._findParent(e.target, '.layout-sidenav')) {
          _this6._setSidenavHoverState(false);
        }
      };

      window.addEventListener('touchstart', this._windowTouchStart, true);
    }
  },
  _unbindSidenavMouseEvents: function _unbindSidenavMouseEvents() {
    if (!this._sidenavMouseEnter && !this._sidenavMouseLeave && !this._windowTouchStart) return;
    var layoutSidenav = this.getLayoutSidenav();

    if (this._sidenavMouseEnter) {
      if (layoutSidenav) {
        layoutSidenav.removeEventListener('mouseenter', this._sidenavMouseEnter, false);
        layoutSidenav.removeEventListener('touchstart', this._sidenavMouseEnter, false);
      }

      this._sidenavMouseEnter = null;
    }

    if (this._sidenavMouseLeave) {
      if (layoutSidenav) {
        layoutSidenav.removeEventListener('mouseleave', this._sidenavMouseLeave, false);
      }

      this._sidenavMouseLeave = null;
    }

    if (this._windowTouchStart) {
      if (layoutSidenav) {
        window.addEventListener('touchstart', this._windowTouchStart, true);
      }

      this._windowTouchStart = null;
    }

    this._setSidenavHoverState(false);
  },
  // *******************************************************************************
  // * Getters
  getLayoutSidenav: function getLayoutSidenav() {
    return document.querySelector('.layout-sidenav');
  },
  getSidenav: function getSidenav() {
    var layoutSidenav = this.getLayoutSidenav();
    if (!layoutSidenav) return null;
    return !this._hasClass('sidenav', layoutSidenav) ? layoutSidenav.querySelector('.sidenav') : layoutSidenav;
  },
  getLayoutNavbar: function getLayoutNavbar() {
    return document.querySelector('.layout-navbar');
  },
  getLayoutFooter: function getLayoutFooter() {
    return document.querySelector('.layout-footer');
  },
  getLayoutContainer: function getLayoutContainer() {
    return document.querySelector('.layout-container');
  },
  // *******************************************************************************
  // * Tests
  isMobileDevice: function isMobileDevice() {
    return typeof window.orientation !== "undefined" || navigator.userAgent.indexOf('IEMobile') !== -1;
  },
  isSmallScreen: function isSmallScreen() {
    return (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) < this.LAYOUT_BREAKPOINT;
  },
  isLayout1: function isLayout1() {
    return !!document.querySelector('.layout-wrapper.layout-1');
  },
  isCollapsed: function isCollapsed() {
    if (this.isSmallScreen()) {
      return !this._hasClass('layout-expanded');
    } else {
      return this._hasClass('layout-collapsed');
    }
  },
  isFixed: function isFixed() {
    return this._hasClass('layout-fixed layout-fixed-offcanvas');
  },
  isOffcanvas: function isOffcanvas() {
    return this._hasClass('layout-offcanvas layout-fixed-offcanvas');
  },
  isNavbarFixed: function isNavbarFixed() {
    return this._hasClass('layout-navbar-fixed') || !this.isSmallScreen() && this.isFixed() && this.isLayout1();
  },
  isFooterFixed: function isFooterFixed() {
    return this._hasClass('layout-footer-fixed');
  },
  isReversed: function isReversed() {
    return this._hasClass('layout-reversed');
  },
  // *******************************************************************************
  // * Methods
  // ---
  // Collapse / expand layout
  setCollapsed: function setCollapsed() {
    var _this7 = this;

    var collapsed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('collapsed');
    var animate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
    var layoutSidenav = this.getLayoutSidenav();
    if (!layoutSidenav) return;

    this._unbindLayoutAnimationEndEvent();

    if (animate && this._supportsTransitionEnd()) {
      this._addClass('layout-transitioning');

      if (collapsed) this._setSidenavHoverState(false);

      this._bindLayoutAnimationEndEvent(function () {
        // Collapse / Expand
        _this7._setCollapsed(collapsed);
      }, function () {
        _this7._removeClass('layout-transitioning');

        _this7._triggerWindowEvent('resize');

        _this7._triggerEvent('toggle');

        _this7._setSidenavHoverState(false);
      });
    } else {
      this._addClass('layout-no-transition');

      if (collapsed) this._setSidenavHoverState(false); // Collapse / Expand

      this._setCollapsed(collapsed);

      setTimeout(function () {
        _this7._removeClass('layout-no-transition');

        _this7._triggerWindowEvent('resize');

        _this7._triggerEvent('toggle');

        _this7._setSidenavHoverState(false);
      }, 1);
    }
  },
  // ---
  // Toggle layout
  toggleCollapsed: function toggleCollapsed() {
    var animate = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    this.setCollapsed(!this.isCollapsed(), animate);
  },
  // ---
  // Set layout positioning
  setPosition: function setPosition() {
    var fixed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('fixed');
    var offcanvas = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : requiredParam('offcanvas');

    this._removeClass('layout-offcanvas layout-fixed layout-fixed-offcanvas');

    if (!fixed && offcanvas) {
      this._addClass('layout-offcanvas');
    } else if (fixed && !offcanvas) {
      this._addClass('layout-fixed');

      this._redrawLayoutSidenav();
    } else if (fixed && offcanvas) {
      this._addClass('layout-fixed-offcanvas');

      this._redrawLayoutSidenav();
    }

    this.update();
  },
  setNavbarFixed: function setNavbarFixed() {
    var fixed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('fixed');
    this[fixed ? '_addClass' : '_removeClass']('layout-navbar-fixed');
    this.update();
  },
  setFooterFixed: function setFooterFixed() {
    var fixed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('fixed');
    this[fixed ? '_addClass' : '_removeClass']('layout-footer-fixed');
    this.update();
  },
  setReversed: function setReversed() {
    var reversed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('reversed');
    this[reversed ? '_addClass' : '_removeClass']('layout-reversed');
  },
  // *******************************************************************************
  // * Update
  update: function update() {
    if (this.getLayoutNavbar() && (!this.isSmallScreen() && this.isLayout1() && this.isFixed() || this.isNavbarFixed()) || this.getLayoutFooter() && this.isFooterFixed()) {
      this._updateInlineStyle(this._getNavbarHeight(), this._getFooterHeight());
    }

    this._bindSidenavMouseEvents();
  },
  setAutoUpdate: function setAutoUpdate() {
    var _this8 = this;

    var enable = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('enable');

    if (enable && !this._autoUpdate) {
      this.on('resize.layoutHelpers:autoUpdate', function () {
        return _this8.update();
      });
      this._autoUpdate = true;
    } else if (!enable && this._autoUpdate) {
      this.off('resize.layoutHelpers:autoUpdate');
      this._autoUpdate = false;
    }
  },
  // *******************************************************************************
  // * Events
  on: function on() {
    var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('event');
    var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : requiredParam('callback');

    var _event$split = event.split('.'),
        _event$split2 = _toArray(_event$split),
        _event = _event$split2[0],
        namespace = _event$split2.slice(1);

    namespace = namespace.join('.') || null;

    this._listeners.push({
      event: _event,
      namespace: namespace,
      callback: callback
    });
  },
  off: function off() {
    var _this9 = this;

    var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('event');

    var _event$split3 = event.split('.'),
        _event$split4 = _toArray(_event$split3),
        _event = _event$split4[0],
        namespace = _event$split4.slice(1);

    namespace = namespace.join('.') || null;

    this._listeners.filter(function (listener) {
      return listener.event === _event && listener.namespace === namespace;
    }).forEach(function (listener) {
      return _this9._listeners.splice(_this9._listeners.indexOf(listener), 1);
    });
  },
  // *******************************************************************************
  // * Life cycle
  init: function init() {
    var _this10 = this;

    if (this._initialized) return;
    this._initialized = true; // Initialize `style` element

    this._updateInlineStyle(0); // Bind window resize event


    this._bindWindowResizeEvent(); // Bind init event


    this.off('init._layoutHelpers');
    this.on('init._layoutHelpers', function () {
      _this10.off('resize._layoutHelpers:redrawSidenav');

      _this10.on('resize._layoutHelpers:redrawSidenav', function () {
        _this10.isSmallScreen() && !_this10.isCollapsed() && _this10._redrawLayoutSidenav();
      }); // Force repaint in IE 10


      if (typeof document.documentMode === 'number' && document.documentMode < 11) {
        _this10.off('resize._layoutHelpers:ie10RepaintBody');

        _this10.on('resize._layoutHelpers:ie10RepaintBody', function () {
          if (_this10.isFixed()) return;
          var scrollTop = document.documentElement.scrollTop;
          document.body.style.display = 'none';
          document.body.offsetHeight;
          document.body.style.display = 'block';
          document.documentElement.scrollTop = scrollTop;
        });
      }
    });

    this._triggerEvent('init');
  },
  destroy: function destroy() {
    var _this11 = this;

    if (!this._initialized) return;
    this._initialized = false;

    this._removeClass('layout-transitioning');

    this._removeInlineStyle();

    this._unbindLayoutAnimationEndEvent();

    this._unbindWindowResizeEvent();

    this._unbindSidenavMouseEvents();

    this.setAutoUpdate(false);
    this.off('init._layoutHelpers'); // Remove all listeners except `init`

    this._listeners.filter(function (listener) {
      return listener.event !== 'init';
    }).forEach(function (listener) {
      return _this11._listeners.splice(_this11._listeners.indexOf(listener), 1);
    });
  }
}; // *******************************************************************************
// * Initialization

if (typeof window !== 'undefined') {
  layoutHelpers.init();

  if (layoutHelpers.isMobileDevice() && window.chrome) {
    document.documentElement.classList.add('layout-sidenav-100vh');
  } // Update layout after page load


  if (document.readyState === 'complete') layoutHelpers.update();else document.addEventListener('DOMContentLoaded', function onContentLoaded() {
    layoutHelpers.update();
    document.removeEventListener('DOMContentLoaded', onContentLoaded);
  });
} // ---




/***/ }),

/***/ 2:
/*!************************************************************!*\
  !*** multi ./resources/assets/vendor/js/layout-helpers.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\js\layout-helpers.js */"./resources/assets/vendor/js/layout-helpers.js");


/***/ })

/******/ })));