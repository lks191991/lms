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
/******/ 	return __webpack_require__(__webpack_require__.s = 106);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/vendor/libs/sparkline/_extension.js":
/*!**************************************************************!*\
  !*** ./resources/assets/vendor/libs/sparkline/_extension.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// Extend sparkline plugin to handle resizing
//
// Inline id generator
function getUniqueId() {
  var t = (Math.floor(25 * Math.random()) + 10).toString(36) + "_";
  t += new Date().getTime().toString(36) + "_";

  do {
    t += Math.floor(35 * Math.random()).toString(36);
  } while (t.length < 32);

  return t;
} // Defaults


var DEFAULT_BAR_SPACING = '2px'; // Definition
//

var SparklineExt = /*#__PURE__*/function () {
  function SparklineExt(element, values, config) {
    _classCallCheck(this, SparklineExt);

    this.uniqueId = getUniqueId();
    this.element = element;
    this.$parent = $(element.parentNode);
    this.update(values, config);

    this._setListeners();
  } // public


  _createClass(SparklineExt, [{
    key: "update",
    value: function update(values, config) {
      if (values !== null) {
        this._values = values;
      }

      if (config !== null) {
        // Set defaults
        if (config.width === '100%' && (config.type === 'bar' || config.type === 'tristate') && typeof config.barSpacing === 'undefined') {
          config.barSpacing = DEFAULT_BAR_SPACING;
        }

        this.config = config;
      } // Copy config


      var _config = $.extend(true, {}, this.config);

      if (_config.width === '100%') {
        if (_config.type === 'bar' || _config.type === 'tristate') {
          _config.barWidth = this._getBarWidth(this.$parent, this._values.length, _config.barSpacing);
        } else {
          _config.width = Math.floor(this.$parent.width());
        }
      }

      $(this.element).sparkline(this._values, _config);
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this._unsetListeners();

      $(this.element).removeData('sparklineExt').removeData('_jqs_mhandler').removeData('_jqs_vcanvas').off().find('canvas').remove();
    } // private

  }, {
    key: "_getBarWidth",
    value: function _getBarWidth($parent, barsCount, spacer) {
      var width = $parent.width();
      var span = parseInt(spacer, 10) * (barsCount - 1);
      return Math.floor((width - span) / barsCount);
    }
  }, {
    key: "_setListeners",
    value: function _setListeners() {
      var _this = this;

      $(window).on("resize.sparklineExt.".concat(this.uniqueId), function () {
        if (_this.config.width !== '100%') {
          return;
        } // Copy config


        var _config = $.extend(true, {}, _this.config);

        if (_config.type === 'bar' || _config.type === 'tristate') {
          _config.barWidth = _this._getBarWidth(_this.$parent, _this._values.length, _config.barSpacing);
        } else {
          _config.width = Math.floor(_this.$parent.width());
        }

        $(_this.element).sparkline(_this._values, _config);
      });
    }
  }, {
    key: "_unsetListeners",
    value: function _unsetListeners() {
      $(window).off("resize.sparklineExt.".concat(this.uniqueId));
    } // static

  }], [{
    key: "_parseArgs",
    value: function _parseArgs(element, args) {
      var values;
      var config;

      if (Object.prototype.toString.call(args[0]) === '[object Array]' || args[0] === 'html' || args[0] === null) {
        values = args[0];
        config = args[1] || null;
      } else {
        config = args[0] || null;
      }

      if ((values === 'html' || values === undefined) && values !== null) {
        values = element.getAttribute('values');

        if (values === undefined || values === null) {
          values = $(element).html();
        }

        values = values.replace(/(^\s*<!--)|(-->\s*$)|\s+/g, '').split(',');
      }

      if (!values || Object.prototype.toString.call(values) !== '[object Array]' || values.length === 0) {
        values = null;
      }

      return {
        values: values,
        config: config
      };
    }
  }, {
    key: "_jQueryInterface",
    value: function _jQueryInterface() {
      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      return this.each(function () {
        var data = $(this).data('sparklineExt');
        var method = args[0] === 'update' || args[0] === 'destroy' ? args[0] : null;

        var _SparklineExt$_parseA = SparklineExt._parseArgs(this, method ? args.slice(1) : args),
            values = _SparklineExt$_parseA.values,
            config = _SparklineExt$_parseA.config;

        if (!data) {
          data = new SparklineExt(this, values || [], config || {});
          $(this).data('sparklineExt', data);
        } else if (values) {
          data.update(values, config);
        }

        if (method === 'update') {
          data.update(values, config);
        } else if (method === 'destroy') {
          data.destroy();
        }
      });
    }
  }]);

  return SparklineExt;
}(); // jQuery
//


$.fn.sparkline2 = SparklineExt._jQueryInterface;
$.fn.sparkline2.Constructor = SparklineExt;

$.fn.sparkline2.noConflict = function () {
  $.fn.sparkline2 = JQUERY_NO_CONFLICT;
  return SparklineExt._jQueryInterface;
};

/***/ }),

/***/ 106:
/*!********************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/sparkline/_extension.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\sparkline\_extension.js */"./resources/assets/vendor/libs/sparkline/_extension.js");


/***/ })

/******/ })));