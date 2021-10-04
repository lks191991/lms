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
/******/ 	return __webpack_require__(__webpack_require__.s = 42);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/bootstrap-table/src/extensions/group-by-v2/bootstrap-table-group-by.js":
/*!*********************************************************************************************!*\
  !*** ./node_modules/bootstrap-table/src/extensions/group-by-v2/bootstrap-table-group-by.js ***!
  \*********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * @author: Yura Knoxville
 * @version: v1.1.0
 */
var initBodyCaller;
var tableGroups; // it only does '%s', and return '' when arguments are undefined

var sprintf = function sprintf(str) {
  var args = arguments;
  var flag = true;
  var i = 1;
  str = str.replace(/%s/g, function () {
    var arg = args[i++];

    if (typeof arg === 'undefined') {
      flag = false;
      return '';
    }

    return arg;
  });
  return flag ? str : '';
};

var groupBy = function groupBy(array, f) {
  var groups = {};
  array.forEach(function (o) {
    var group = f(o);
    groups[group] = groups[group] || [];
    groups[group].push(o);
  });
  return groups;
};

$.extend($.fn.bootstrapTable.defaults, {
  groupBy: false,
  groupByField: '',
  groupByFormatter: undefined
});
var BootstrapTable = $.fn.bootstrapTable.Constructor;
var _initSort = BootstrapTable.prototype.initSort;
var _initBody = BootstrapTable.prototype.initBody;
var _updateSelected = BootstrapTable.prototype.updateSelected;

BootstrapTable.prototype.initSort = function () {
  for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
    args[_key] = arguments[_key];
  }

  _initSort.apply(this, Array.prototype.slice.apply(args));

  var that = this;
  tableGroups = [];

  if (this.options.groupBy && this.options.groupByField !== '') {
    if (this.options.sortName !== this.options.groupByField) {
      this.data.sort(function (a, b) {
        return a[that.options.groupByField].localeCompare(b[that.options.groupByField]);
      });
    }

    var groups = groupBy(that.data, function (item) {
      return [item[that.options.groupByField]];
    });
    var index = 0;
    $.each(groups, function (key, value) {
      tableGroups.push({
        id: index,
        name: key,
        data: value
      });
      value.forEach(function (item) {
        if (!item._data) {
          item._data = {};
        }

        item._data['parent-index'] = index;
      });
      index++;
    });
  }
};

BootstrapTable.prototype.initBody = function () {
  initBodyCaller = true;

  for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
    args[_key2] = arguments[_key2];
  }

  _initBody.apply(this, Array.prototype.slice.apply(args));

  if (this.options.groupBy && this.options.groupByField !== '') {
    var that = this;
    var checkBox = false;
    var visibleColumns = 0;
    this.columns.forEach(function (column) {
      if (column.checkbox) {
        checkBox = true;
      } else {
        if (column.visible) {
          visibleColumns += 1;
        }
      }
    });

    if (this.options.detailView && !this.options.cardView) {
      visibleColumns += 1;
    }

    tableGroups.forEach(function (item) {
      var html = [];
      html.push(sprintf('<tr class="info groupBy expanded" data-group-index="%s">', item.id));

      if (that.options.detailView && !that.options.cardView) {
        html.push('<td class="detail"></td>');
      }

      if (checkBox) {
        html.push('<td class="bs-checkbox">', '<input name="btSelectGroup" type="checkbox" />', '</td>');
      }

      var formattedValue = item.name;

      if (typeof that.options.groupByFormatter === 'function') {
        formattedValue = that.options.groupByFormatter(item.name, item.id, item.data);
      }

      html.push('<td', sprintf(' colspan="%s"', visibleColumns), '>', formattedValue, '</td>');
      html.push('</tr>');
      that.$body.find("tr[data-parent-index=".concat(item.id, "]:first")).before($(html.join('')));
    });
    this.$selectGroup = [];
    this.$body.find('[name="btSelectGroup"]').each(function () {
      var self = $(this);
      that.$selectGroup.push({
        group: self,
        item: that.$selectItem.filter(function () {
          return $(this).closest('tr').data('parent-index') === self.closest('tr').data('group-index');
        })
      });
    });
    this.$container.off('click', '.groupBy').on('click', '.groupBy', function () {
      $(this).toggleClass('expanded');
      that.$body.find("tr[data-parent-index=".concat($(this).closest('tr').data('group-index'), "]")).toggleClass('hidden');
    });
    this.$container.off('click', '[name="btSelectGroup"]').on('click', '[name="btSelectGroup"]', function (event) {
      event.stopImmediatePropagation();
      var self = $(this);
      var checked = self.prop('checked');
      that[checked ? 'checkGroup' : 'uncheckGroup']($(this).closest('tr').data('group-index'));
    });
  }

  initBodyCaller = false;
  this.updateSelected();
};

BootstrapTable.prototype.updateSelected = function () {
  if (!initBodyCaller) {
    for (var _len3 = arguments.length, args = new Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
      args[_key3] = arguments[_key3];
    }

    _updateSelected.apply(this, Array.prototype.slice.apply(args));

    if (this.options.groupBy && this.options.groupByField !== '') {
      this.$selectGroup.forEach(function (item) {
        var checkGroup = item.item.filter(':enabled').length === item.item.filter(':enabled').filter(':checked').length;
        item.group.prop('checked', checkGroup);
      });
    }
  }
};

BootstrapTable.prototype.getGroupSelections = function (index) {
  var that = this;
  return this.data.filter(function (row) {
    return row[that.header.stateField] && row._data['parent-index'] === index;
  });
};

BootstrapTable.prototype.checkGroup = function (index) {
  this.checkGroup_(index, true);
};

BootstrapTable.prototype.uncheckGroup = function (index) {
  this.checkGroup_(index, false);
};

BootstrapTable.prototype.checkGroup_ = function (index, checked) {
  var rows;

  var filter = function filter() {
    return $(this).closest('tr').data('parent-index') === index;
  };

  if (!checked) {
    rows = this.getGroupSelections(index);
  }

  this.$selectItem.filter(filter).prop('checked', checked);
  this.updateRows();
  this.updateSelected();

  if (checked) {
    rows = this.getGroupSelections(index);
  }

  this.trigger(checked ? 'check-all' : 'uncheck-all', rows);
};

/***/ }),

/***/ "./resources/assets/vendor/libs/bootstrap-table/extensions/group-by-v2/group-by-v2.js":
/*!********************************************************************************************!*\
  !*** ./resources/assets/vendor/libs/bootstrap-table/extensions/group-by-v2/group-by-v2.js ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! bootstrap-table/src/extensions/group-by-v2/bootstrap-table-group-by.js */ "./node_modules/bootstrap-table/src/extensions/group-by-v2/bootstrap-table-group-by.js");

/***/ }),

/***/ 42:
/*!**************************************************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/bootstrap-table/extensions/group-by-v2/group-by-v2.js ***!
  \**************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\bootstrap-table\extensions\group-by-v2\group-by-v2.js */"./resources/assets/vendor/libs/bootstrap-table/extensions/group-by-v2/group-by-v2.js");


/***/ })

/******/ })));