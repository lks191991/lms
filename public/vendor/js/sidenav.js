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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/vendor/js/sidenav.js":
/*!***********************************************!*\
  !*** ./resources/assets/vendor/js/sidenav.js ***!
  \***********************************************/
/*! exports provided: SideNav */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "SideNav", function() { return SideNav; });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var TRANSITION_EVENTS = ['transitionend', 'webkitTransitionEnd', 'oTransitionEnd'];
var TRANSITION_PROPERTIES = ['transition', 'MozTransition', 'webkitTransition', 'WebkitTransition', 'OTransition'];
var DELTA = 5;

var SideNav = /*#__PURE__*/function () {
  function SideNav(el) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    var _PS = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;

    _classCallCheck(this, SideNav);

    this._el = el;
    this._horizontal = options.orientation === 'horizontal';
    this._animate = options.animate !== false && this._supportsTransitionEnd();
    this._accordion = options.accordion !== false;
    this._closeChildren = Boolean(options.closeChildren);
    this._showDropdownOnHover = Boolean(options.showDropdownOnHover);
    this._rtl = document.documentElement.getAttribute('dir') === 'rtl' || document.body.getAttribute('dir') === 'rtl';
    this._lastWidth = this._horizontal ? window.innerWidth : null;

    this._onOpen = options.onOpen || function () {};

    this._onOpened = options.onOpened || function () {};

    this._onClose = options.onClose || function () {};

    this._onClosed = options.onClosed || function () {};

    el.classList.add('sidenav');
    el.classList[this._animate ? 'remove' : 'add']('sidenav-no-animation');

    if (!this._horizontal) {
      el.classList.add('sidenav-vertical');
      el.classList.remove('sidenav-horizontal');
      var PerfectScrollbarLib = _PS || window.PerfectScrollbar;

      if (PerfectScrollbarLib) {
        this._scrollbar = new PerfectScrollbarLib(el.querySelector('.sidenav-inner'), {
          suppressScrollX: true,
          wheelPropagation: true
        });
      }
    } else {
      el.classList.add('sidenav-horizontal');
      el.classList.remove('sidenav-vertical');
      this._inner = el.querySelector('.sidenav-inner');
      var container = this._inner.parentNode;
      this._prevBtn = el.querySelector('.sidenav-horizontal-prev');

      if (!this._prevBtn) {
        this._prevBtn = document.createElement('a');
        this._prevBtn.href = '#';
        this._prevBtn.className = 'sidenav-horizontal-prev';
        container.appendChild(this._prevBtn);
      }

      this._wrapper = el.querySelector('.sidenav-horizontal-wrapper');

      if (!this._wrapper) {
        this._wrapper = document.createElement('div');
        this._wrapper.className = 'sidenav-horizontal-wrapper';

        this._wrapper.appendChild(this._inner);

        container.appendChild(this._wrapper);
      }

      this._nextBtn = el.querySelector('.sidenav-horizontal-next');

      if (!this._nextBtn) {
        this._nextBtn = document.createElement('a');
        this._nextBtn.href = '#';
        this._nextBtn.className = 'sidenav-horizontal-next';
        container.appendChild(this._nextBtn);
      }

      this._innerPosition = 0;
      this.update();
    }

    this._bindEvents(); // Link sidenav instance to element


    el.sidenavInstance = this;
  }

  _createClass(SideNav, [{
    key: "open",
    value: function open(el) {
      var _this = this;

      var closeChildren = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this._closeChildren;

      var item = this._findUnopenedParent(this._getItem(el, true), closeChildren);

      if (!item) return;

      var toggleLink = this._getLink(item, true);

      this._promisify(this._onOpen, this, item, toggleLink, this._findMenu(item)).then(function () {
        if (!_this._horizontal || !_this._isRoot(item)) {
          if (_this._animate) {
            window.requestAnimationFrame(function () {
              return _this._toggleAnimation(true, item, false);
            });
            if (_this._accordion) _this._closeOther(item, closeChildren);
          } else {
            item.classList.add('open');
            _this._onOpened && _this._onOpened(_this, item, toggleLink, _this._findMenu(item));
            if (_this._accordion) _this._closeOther(item, closeChildren);
          }
        } else {
          _this._toggleDropdown(true, item, closeChildren);

          _this._onOpened && _this._onOpened(_this, item, toggleLink, _this._findMenu(item));
        }
      })["catch"](function () {});
    }
  }, {
    key: "close",
    value: function close(el) {
      var _this2 = this;

      var closeChildren = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this._closeChildren;

      var _autoClose = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

      var item = this._getItem(el, true);

      var toggleLink = this._getLink(el, true);

      if (!item.classList.contains('open') || item.classList.contains('disabled')) return;

      this._promisify(this._onClose, this, item, toggleLink, this._findMenu(item), _autoClose).then(function () {
        if (!_this2._horizontal || !_this2._isRoot(item)) {
          if (_this2._animate) {
            window.requestAnimationFrame(function () {
              return _this2._toggleAnimation(false, item, closeChildren);
            });
          } else {
            item.classList.remove('open');

            if (closeChildren) {
              var opened = item.querySelectorAll('.sidenav-item.open');

              for (var i = 0, l = opened.length; i < l; i++) {
                opened[i].classList.remove('open');
              }
            }

            _this2._onClosed && _this2._onClosed(_this2, item, toggleLink, _this2._findMenu(item));
          }
        } else {
          _this2._toggleDropdown(false, item, closeChildren);

          _this2._onClosed && _this2._onClosed(_this2, item, toggleLink, _this2._findMenu(item));
        }
      })["catch"](function () {});
    }
  }, {
    key: "toggle",
    value: function toggle(el) {
      var closeChildren = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this._closeChildren;

      var item = this._getItem(el, true);

      if (item.classList.contains('open')) this.close(item, closeChildren);else this.open(item, closeChildren);
    }
  }, {
    key: "closeAll",
    value: function closeAll() {
      var closeChildren = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this._closeChildren;

      var opened = this._el.querySelectorAll('.sidenav-inner > .sidenav-item.open');

      for (var i = 0, l = opened.length; i < l; i++) {
        this.close(opened[i], closeChildren);
      }
    }
  }, {
    key: "setActive",
    value: function setActive(el, active) {
      var openTree = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
      var deactivateOthers = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : true;

      var item = this._getItem(el, false);

      if (active && deactivateOthers) {
        var activeItems = this._el.querySelectorAll('.sidenav-inner .sidenav-item.active');

        for (var i = 0, l = activeItems.length; i < l; i++) {
          activeItems[i].classList.remove('active');
        }
      }

      if (active && openTree) {
        var parentItem = this._findParent(item, 'sidenav-item', false);

        parentItem && this.open(parentItem);
      }

      while (item) {
        item.classList[active ? 'add' : 'remove']('active');
        item = this._findParent(item, 'sidenav-item', false);
      }
    }
  }, {
    key: "setDisabled",
    value: function setDisabled(el, disabled) {
      this._getItem(el, false).classList[disabled ? 'add' : 'remove']('disabled');
    }
  }, {
    key: "isActive",
    value: function isActive(el) {
      return this._getItem(el, false).classList.contains('active');
    }
  }, {
    key: "isOpened",
    value: function isOpened(el) {
      return this._getItem(el, false).classList.contains('open');
    }
  }, {
    key: "isDisabled",
    value: function isDisabled(el) {
      return this._getItem(el, false).classList.contains('disabled');
    }
  }, {
    key: "update",
    value: function update() {
      if (!this._horizontal) {
        if (this._scrollbar) {
          this._scrollbar.update();
        }
      } else {
        this.closeAll();
        var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
        var innerWidth = this._innerWidth;
        var position = this._innerPosition;

        if (wrapperWidth - position > innerWidth) {
          position = wrapperWidth - innerWidth;
          if (position > 0) position = 0;
          this._innerPosition = position;
        }

        this._updateSlider(wrapperWidth, innerWidth, position);
      }
    }
  }, {
    key: "_updateSlider",
    value: function _updateSlider() {
      var wrapperWidth = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var innerWidth = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      var position = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;

      var _wrapperWidth = wrapperWidth !== null ? wrapperWidth : Math.round(this._wrapper.getBoundingClientRect().width);

      var _innerWidth = innerWidth !== null ? innerWidth : this._innerWidth;

      var _position = position !== null ? position : this._innerPosition;

      if (_position === 0) this._prevBtn.classList.add('disabled');else this._prevBtn.classList.remove('disabled');
      if (_innerWidth + _position <= _wrapperWidth) this._nextBtn.classList.add('disabled');else this._nextBtn.classList.remove('disabled');
    }
  }, {
    key: "_promisify",
    value: function _promisify(fn) {
      for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        args[_key - 1] = arguments[_key];
      }

      var result = fn.apply(void 0, args);
      return result instanceof Promise ? result : result === false ? Promise.reject() : Promise.resolve();
    }
  }, {
    key: "destroy",
    value: function destroy() {
      if (!this._el) return;

      this._unbindEvents();

      var items = this._el.querySelectorAll('.sidenav-item');

      for (var i = 0, l = items.length; i < l; i++) {
        this._unbindAnimationEndEvent(items[i]);

        items[i].classList.remove('sidenav-item-animating');
        items[i].classList.remove('open');
        items[i].style.overflow = null;
        items[i].style.height = null;
      }

      var menus = this._el.querySelectorAll('.sidenav-menu');

      for (var i2 = 0, l2 = menus.length; i2 < l2; i2++) {
        menus[i2].style.marginRight = null;
        menus[i2].style.marginLeft = null;
      }

      this._el.classList.remove('sidenav-no-animation');

      if (this._wrapper) {
        this._prevBtn.parentNode.removeChild(this._prevBtn);

        this._nextBtn.parentNode.removeChild(this._nextBtn);

        this._wrapper.parentNode.insertBefore(this._inner, this._wrapper);

        this._wrapper.parentNode.removeChild(this._wrapper);

        this._inner.style.marginLeft = null;
        this._inner.style.marginRight = null;
      }

      this._el.sidenavInstance = null;
      delete this._el.sidenavInstance;
      this._el = null;
      this._horizontal = null;
      this._animate = null;
      this._accordion = null;
      this._closeChildren = null;
      this._showDropdownOnHover = null;
      this._rtl = null;
      this._onOpen = null;
      this._onOpened = null;
      this._onClose = null;
      this._onClosed = null;

      if (this._scrollbar) {
        this._scrollbar.destroy();

        this._scrollbar = null;
      }

      this._inner = null;
      this._prevBtn = null;
      this._wrapper = null;
      this._nextBtn = null;
    }
  }, {
    key: "_getLink",
    value: function _getLink(el, toggle) {
      var found = [];
      var selector = toggle ? 'sidenav-toggle' : 'sidenav-link';
      if (el.classList.contains(selector)) found = [el];else if (el.classList.contains('sidenav-item')) found = this._findChild(el, [selector]);
      if (!found.length) throw new Error("`".concat(selector, "` element not found."));
      return found[0];
    }
  }, {
    key: "_getItem",
    value: function _getItem(el, toggle) {
      var item = null;
      var selector = toggle ? 'sidenav-toggle' : 'sidenav-link';

      if (el.classList.contains('sidenav-item')) {
        if (this._findChild(el, [selector]).length) item = el;
      } else if (el.classList.contains(selector)) {
        item = el.parentNode.classList.contains('sidenav-item') ? el.parentNode : null;
      }

      if (!item) {
        throw new Error("".concat(toggle ? 'Toggable ' : '', "`.sidenav-item` element not found."));
      }

      return item;
    }
  }, {
    key: "_findUnopenedParent",
    value: function _findUnopenedParent(item, closeChildren) {
      var tree = [];
      var parentItem = null;

      while (item) {
        if (item.classList.contains('disabled')) {
          parentItem = null;
          tree = [];
        } else {
          if (!item.classList.contains('open')) parentItem = item;
          tree.push(item);
        }

        item = this._findParent(item, 'sidenav-item', false);
      }

      if (!parentItem) return null;
      if (tree.length === 1) return parentItem;
      tree = tree.slice(0, tree.indexOf(parentItem));

      for (var i = 0, l = tree.length; i < l; i++) {
        tree[i].classList.add('open');

        if (this._accordion) {
          var openedItems = this._findChild(tree[i].parentNode, ['sidenav-item', 'open']);

          for (var j = 0, k = openedItems.length; j < k; j++) {
            if (openedItems[j] === tree[i]) continue;
            openedItems[j].classList.remove('open');

            if (closeChildren) {
              var openedChildren = openedItems[j].querySelectorAll('.sidenav-item.open');

              for (var x = 0, z = openedChildren.length; x < z; x++) {
                openedChildren[x].classList.remove('open');
              }
            }
          }
        }
      }

      return parentItem;
    }
  }, {
    key: "_closeOther",
    value: function _closeOther(item, closeChildren) {
      var opened = this._findChild(item.parentNode, ['sidenav-item', 'open']);

      for (var i = 0, l = opened.length; i < l; i++) {
        if (opened[i] !== item) this.close(opened[i], closeChildren, true);
      }
    }
  }, {
    key: "_toggleAnimation",
    value: function _toggleAnimation(open, item, closeChildren) {
      var _this3 = this;

      var toggleLink = this._getLink(item, true);

      var menu = this._findMenu(item);

      this._unbindAnimationEndEvent(item);

      var linkHeight = Math.round(toggleLink.getBoundingClientRect().height);
      item.style.overflow = 'hidden';

      var clearItemStyle = function clearItemStyle() {
        item.classList.remove('sidenav-item-animating');
        item.classList.remove('sidenav-item-closing');
        item.style.overflow = null;
        item.style.height = null;
        if (!_this3._horizontal) _this3.update();
      };

      if (open) {
        item.style.height = "".concat(linkHeight, "px");
        item.classList.add('sidenav-item-animating');
        item.classList.add('open');

        this._bindAnimationEndEvent(item, function () {
          clearItemStyle();
          _this3._onOpened && _this3._onOpened(_this3, item, toggleLink, menu);
        });

        setTimeout(function () {
          return item.style.height = "".concat(linkHeight + Math.round(menu.getBoundingClientRect().height), "px");
        }, 50);
      } else {
        item.style.height = "".concat(linkHeight + Math.round(menu.getBoundingClientRect().height), "px");
        item.classList.add('sidenav-item-animating');
        item.classList.add('sidenav-item-closing');

        this._bindAnimationEndEvent(item, function () {
          item.classList.remove('open');
          clearItemStyle();

          if (closeChildren) {
            var opened = item.querySelectorAll('.sidenav-item.open');

            for (var i = 0, l = opened.length; i < l; i++) {
              opened[i].classList.remove('open');
            }
          }

          _this3._onClosed && _this3._onClosed(_this3, item, toggleLink, menu);
        });

        setTimeout(function () {
          return item.style.height = "".concat(linkHeight, "px");
        }, 50);
      }
    }
  }, {
    key: "_toggleDropdown",
    value: function _toggleDropdown(show, item, closeChildren) {
      var menu = this._findMenu(item);

      if (show) {
        var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
        var position = this._innerPosition;

        var itemOffset = this._getItemOffset(item);

        var itemWidth = Math.round(item.getBoundingClientRect().width);

        if (itemOffset - DELTA <= -1 * position) {
          this._innerPosition = -1 * itemOffset;
        } else if (itemOffset + position + itemWidth + DELTA >= wrapperWidth) {
          if (itemWidth > wrapperWidth) {
            this._innerPosition = -1 * itemOffset;
          } else {
            this._innerPosition = -1 * (itemOffset + itemWidth - wrapperWidth);
          }
        }

        item.classList.add('open');
        var menuWidth = Math.round(menu.getBoundingClientRect().width);

        if (itemOffset + this._innerPosition + menuWidth > wrapperWidth && menuWidth < wrapperWidth && menuWidth > itemWidth) {
          menu.style[this._rtl ? 'marginRight' : 'marginLeft'] = "-".concat(menuWidth - itemWidth, "px");
        }

        this._closeOther(item, closeChildren);

        this._updateSlider();
      } else {
        var toggle = this._findChild(item, ['sidenav-toggle']);

        toggle.length && toggle[0].removeAttribute('data-hover', 'true');
        item.classList.remove('open');
        menu.style[this._rtl ? 'marginRight' : 'marginLeft'] = null;

        if (closeChildren) {
          var opened = menu.querySelectorAll('.sidenav-item.open');

          for (var i = 0, l = opened.length; i < l; i++) {
            opened[i].classList.remove('open');
          }
        }
      }
    }
  }, {
    key: "_slide",
    value: function _slide(direction) {
      var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
      var innerWidth = this._innerWidth;
      var newPosition;

      if (direction === 'next') {
        newPosition = this._getSlideNextPos();

        if (innerWidth + newPosition < wrapperWidth) {
          newPosition = wrapperWidth - innerWidth;
        }
      } else {
        newPosition = this._getSlidePrevPos();
        if (newPosition > 0) newPosition = 0;
      }

      this._innerPosition = newPosition;
      this.update();
    }
  }, {
    key: "_getSlideNextPos",
    value: function _getSlideNextPos() {
      var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
      var position = this._innerPosition;
      var curItem = this._inner.childNodes[0];
      var left = 0;

      while (curItem) {
        if (curItem.tagName) {
          var curItemWidth = Math.round(curItem.getBoundingClientRect().width);

          if (left + position - DELTA <= wrapperWidth && left + position + curItemWidth + DELTA >= wrapperWidth) {
            if (curItemWidth > wrapperWidth && left === -1 * position) left += curItemWidth;
            break;
          }

          left += curItemWidth;
        }

        curItem = curItem.nextSibling;
      }

      return -1 * left;
    }
  }, {
    key: "_getSlidePrevPos",
    value: function _getSlidePrevPos() {
      var wrapperWidth = Math.round(this._wrapper.getBoundingClientRect().width);
      var position = this._innerPosition;
      var curItem = this._inner.childNodes[0];
      var left = 0;

      while (curItem) {
        if (curItem.tagName) {
          var curItemWidth = Math.round(curItem.getBoundingClientRect().width);

          if (left - DELTA <= -1 * position && left + curItemWidth + DELTA >= -1 * position) {
            if (curItemWidth <= wrapperWidth) left = left + curItemWidth - wrapperWidth;
            break;
          }

          left += curItemWidth;
        }

        curItem = curItem.nextSibling;
      }

      return -1 * left;
    }
  }, {
    key: "_getItemOffset",
    value: function _getItemOffset(item) {
      var curItem = this._inner.childNodes[0];
      var left = 0;

      while (curItem !== item) {
        if (curItem.tagName) {
          left += Math.round(curItem.getBoundingClientRect().width);
        }

        curItem = curItem.nextSibling;
      }

      return left;
    }
  }, {
    key: "_bindAnimationEndEvent",
    value: function _bindAnimationEndEvent(el, handler) {
      var _this4 = this;

      var cb = function cb(e) {
        if (e.target !== el) return;

        _this4._unbindAnimationEndEvent(el);

        handler(e);
      };

      var duration = window.getComputedStyle(el).transitionDuration;
      duration = parseFloat(duration) * (duration.indexOf('ms') !== -1 ? 1 : 1000);
      el._sideNavAnimationEndEventCb = cb;
      TRANSITION_EVENTS.forEach(function (ev) {
        return el.addEventListener(ev, el._sideNavAnimationEndEventCb, false);
      });
      el._sideNavAnimationEndEventTimeout = setTimeout(function () {
        cb({
          target: el
        });
      }, duration + 50);
    }
  }, {
    key: "_unbindAnimationEndEvent",
    value: function _unbindAnimationEndEvent(el) {
      var cb = el._sideNavAnimationEndEventCb;

      if (el._sideNavAnimationEndEventTimeout) {
        clearTimeout(el._sideNavAnimationEndEventTimeout);
        el._sideNavAnimationEndEventTimeout = null;
      }

      if (!cb) return;
      TRANSITION_EVENTS.forEach(function (ev) {
        return el.removeEventListener(ev, cb, false);
      });
      el._sideNavAnimationEndEventCb = null;
    }
  }, {
    key: "_bindEvents",
    value: function _bindEvents() {
      var _this5 = this;

      this._evntElClick = function (e) {
        var toggleLink = e.target.classList.contains('sidenav-toggle') ? e.target : _this5._findParent(e.target, 'sidenav-toggle', false);

        if (toggleLink) {
          e.preventDefault();

          if (toggleLink.getAttribute('data-hover') !== 'true') {
            _this5.toggle(toggleLink);
          }
        }
      };

      this._el.addEventListener('click', this._evntElClick);

      this._evntWindowResize = function () {
        if (!_this5._horizontal) {
          _this5.update();
        } else if (_this5._lastWidth !== window.innerWidth) {
          _this5._lastWidth = window.innerWidth;

          _this5.update();
        }
      };

      window.addEventListener('resize', this._evntWindowResize);

      if (this._horizontal) {
        this._evntPrevBtnClick = function (e) {
          e.preventDefault();
          if (_this5._prevBtn.classList.contains('disabled')) return;

          _this5._slide('prev');
        };

        this._prevBtn.addEventListener('click', this._evntPrevBtnClick);

        this._evntNextBtnClick = function (e) {
          e.preventDefault();
          if (_this5._nextBtn.classList.contains('disabled')) return;

          _this5._slide('next');
        };

        this._nextBtn.addEventListener('click', this._evntNextBtnClick);

        this._evntBodyClick = function (e) {
          if (!_this5._inner.contains(e.target) && _this5._el.querySelectorAll('.sidenav-inner > .sidenav-item.open').length) _this5.closeAll();
        };

        document.body.addEventListener('click', this._evntBodyClick);

        this._evntHorizontalElClick = function (e) {
          var link = e.target.classList.contains('sidenav-link') ? e.target : _this5._findParent(e.target, 'sidenav-link', false);
          if (link && !link.classList.contains('sidenav-toggle')) _this5.closeAll();
        };

        this._el.addEventListener('click', this._evntHorizontalElClick);

        if (this._showDropdownOnHover) {
          this._evntInnerMousemove = function (e) {
            var curItem = _this5._findParent(e.target, 'sidenav-item', false);

            var item = null;

            while (curItem) {
              item = curItem;
              curItem = _this5._findParent(curItem, 'sidenav-item', false);
            }

            if (item && !item.classList.contains('open')) {
              var toggle = _this5._findChild(item, ['sidenav-toggle']);

              if (toggle.length) {
                toggle[0].setAttribute('data-hover', 'true');

                _this5.open(toggle[0], _this5._closeChildren, true);

                setTimeout(function () {
                  toggle[0].removeAttribute('data-hover');
                }, 500);
              }
            }
          };

          this._inner.addEventListener('mousemove', this._evntInnerMousemove);

          this._evntInnerMouseleave = function (e) {
            _this5.closeAll();
          };

          this._inner.addEventListener('mouseleave', this._evntInnerMouseleave);
        }
      }
    }
  }, {
    key: "_unbindEvents",
    value: function _unbindEvents() {
      if (this._evntElClick) {
        this._el.removeEventListener('click', this._evntElClick);

        this._evntElClick = null;
      }

      if (this._evntWindowResize) {
        window.removeEventListener('resize', this._evntWindowResize);
        this._evntWindowResize = null;
      }

      if (this._evntPrevBtnClick) {
        this._prevBtn.removeEventListener('click', this._evntPrevBtnClick);

        this._evntPrevBtnClick = null;
      }

      if (this._evntNextBtnClick) {
        this._nextBtn.removeEventListener('click', this._evntNextBtnClick);

        this._evntNextBtnClick = null;
      }

      if (this._evntBodyClick) {
        document.body.removeEventListener('click', this._evntBodyClick);
        this._evntBodyClick = null;
      }

      if (this._evntHorizontalElClick) {
        this._el.removeEventListener('click', this._evntHorizontalElClick);

        this._evntHorizontalElClick = null;
      }

      if (this._evntInnerMousemove) {
        this._inner.removeEventListener('mousemove', this._evntInnerMousemove);

        this._evntInnerMousemove = null;
      }

      if (this._evntInnerMouseleave) {
        this._inner.removeEventListener('mouseleave', this._evntInnerMouseleave);

        this._evntInnerMouseleave = null;
      }
    }
  }, {
    key: "_findMenu",
    value: function _findMenu(item) {
      var curEl = item.childNodes[0];
      var menu = null;

      while (curEl && !menu) {
        if (curEl.classList && curEl.classList.contains('sidenav-menu')) menu = curEl;
        curEl = curEl.nextSibling;
      }

      if (!menu) throw new Error('Cannot find `.sidenav-menu` element for the current `.sidenav-toggle`');
      return menu;
    }
  }, {
    key: "_isRoot",
    value: function _isRoot(item) {
      return !this._findParent(item, 'sidenav-item', false);
    }
  }, {
    key: "_findParent",
    value: function _findParent(el, cls) {
      var throwError = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
      if (el.tagName.toUpperCase() === 'BODY') return null;
      el = el.parentNode;

      while (el.tagName.toUpperCase() !== 'BODY' && !el.classList.contains(cls)) {
        el = el.parentNode;
      }

      el = el.tagName.toUpperCase() !== 'BODY' ? el : null;
      if (!el && throwError) throw new Error("Cannot find `.".concat(cls, "` parent element"));
      return el;
    }
  }, {
    key: "_findChild",
    value: function _findChild(el, cls) {
      var items = el.childNodes;
      var found = [];

      for (var i = 0, l = items.length; i < l; i++) {
        if (items[i].classList) {
          var passed = 0;

          for (var j = 0; j < cls.length; j++) {
            if (items[i].classList.contains(cls[j])) passed++;
          }

          if (cls.length === passed) found.push(items[i]);
        }
      }

      return found;
    }
  }, {
    key: "_supportsTransitionEnd",
    value: function _supportsTransitionEnd() {
      if (window.QUnit) {
        return false;
      }

      var el = document.body || document.documentElement;
      var result = false;
      TRANSITION_PROPERTIES.forEach(function (evnt) {
        if (typeof el.style[evnt] !== 'undefined') result = true;
      });
      return result;
    }
  }, {
    key: "_innerWidth",
    get: function get() {
      var items = this._inner.childNodes;
      var width = 0;

      for (var i = 0, l = items.length; i < l; i++) {
        if (items[i].tagName) {
          width += Math.round(items[i].getBoundingClientRect().width);
        }
      }

      return width;
    }
  }, {
    key: "_innerPosition",
    get: function get() {
      return parseInt(this._inner.style[this._rtl ? 'marginRight' : 'marginLeft'] || '0px');
    },
    set: function set(value) {
      this._inner.style[this._rtl ? 'marginRight' : 'marginLeft'] = "".concat(value, "px");
      return value;
    }
  }]);

  return SideNav;
}();



/***/ }),

/***/ 7:
/*!*****************************************************!*\
  !*** multi ./resources/assets/vendor/js/sidenav.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\js\sidenav.js */"./resources/assets/vendor/js/sidenav.js");


/***/ })

/******/ })));