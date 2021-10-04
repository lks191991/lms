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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/bootstrap-table/src/extensions/multiple-sort/bootstrap-table-multiple-sort.js":
/*!****************************************************************************************************!*\
  !*** ./node_modules/bootstrap-table/src/extensions/multiple-sort/bootstrap-table-multiple-sort.js ***!
  \****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/**
 * @author Nadim Basalamah <dimbslmh@gmail.com>
 * @version: v1.1.0
 * https://github.com/dimbslmh/bootstrap-table/tree/master/src/extensions/multiple-sort/bootstrap-table-multiple-sort.js
 * Modification: ErwannNevou <https://github.com/ErwannNevou>
 */
var isSingleSort = false;
var Utils = $.fn.bootstrapTable.utils;
var bootstrap = {
  bootstrap3: {
    icons: {
      plus: 'glyphicon-plus',
      minus: 'glyphicon-minus',
      sort: 'glyphicon-sort'
    },
    html: {
      multipleSortModal: "\n        <div class=\"modal fade\" id=\"%s\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n        <div class=\"modal-dialog\">\n            <div class=\"modal-content\">\n                <div class=\"modal-header\">\n                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n                     <h4 class=\"modal-title\" id=\"%sLabel\">%s</h4>\n                </div>\n                <div class=\"modal-body\">\n                    <div class=\"bootstrap-table\">\n                        <div class=\"fixed-table-toolbar\">\n                            <div class=\"bars\">\n                                <div id=\"toolbar\">\n                                     <button id=\"add\" type=\"button\" class=\"btn btn-default\">%s %s</button>\n                                     <button id=\"delete\" type=\"button\" class=\"btn btn-default\" disabled>%s %s</button>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"fixed-table-container\">\n                            <table id=\"multi-sort\" class=\"table\">\n                                <thead>\n                                    <tr>\n                                        <th></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                    </tr>\n                                </thead>\n                                <tbody></tbody>\n                            </table>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"modal-footer\">\n                     <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">%s</button>\n                     <button type=\"button\" class=\"btn btn-primary multi-sort-order-button\">%s</button>\n                </div>\n            </div>\n        </div>\n    </div>\n      ",
      multipleSortButton: '<button class="multi-sort btn btn-default" type="button" data-toggle="modal" data-target="#%s" title="%s">%s</button>',
      multipleSortSelect: '<select class="%s %s form-control">'
    }
  },
  bootstrap4: {
    icons: {
      'plus': 'fa-plus',
      'minus': 'fa-minus',
      'sort': 'fa-sort'
    },
    html: {
      multipleSortModal: "\n        <div class=\"modal fade\" id=\"%s\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n          <div class=\"modal-dialog\" role=\"document\">\n            <div class=\"modal-content\">\n              <div class=\"modal-header\">\n                <h5 class=\"modal-title\" id=\"%sLabel\">%s</h5>\n                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n                  <span aria-hidden=\"true\">&times;</span>\n                </button>\n              </div>\n              <div class=\"modal-body\">\n                <div class=\"bootstrap-table\">\n                        <div class=\"fixed-table-toolbar\">\n                            <div class=\"bars\">\n                                <div id=\"toolbar\" class=\"pb-3\">\n                                     <button id=\"add\" type=\"button\" class=\"btn btn-secondary\">%s %s</button>\n                                     <button id=\"delete\" type=\"button\" class=\"btn btn-secondary\" disabled>%s %s</button>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"fixed-table-container\">\n                            <table id=\"multi-sort\" class=\"table\">\n                                <thead>\n                                    <tr>\n                                        <th></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                         <th><div class=\"th-inner\">%s</div></th>\n                                    </tr>\n                                </thead>\n                                <tbody></tbody>\n                            </table>\n                        </div>\n                    </div>\n              </div>\n              <div class=\"modal-footer\">\n                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">%s</button>\n                <button type=\"button\" class=\"btn btn-primary multi-sort-order-button\">%s</button>\n              </div>\n            </div>\n          </div>\n        </div>\n      ",
      multipleSortButton: '<button class="multi-sort btn btn-secondary" type="button" data-toggle="modal" data-target="#%s" title="%s">%s</button>',
      multipleSortSelect: '<select class="%s %s form-control">'
    }
  },
  semantic: {
    icons: {
      'plus': 'fa-plus',
      'minus': 'fa-minus',
      'sort': 'fa-sort'
    },
    html: {
      multipleSortModal: "\n        <div class=\"ui modal tiny\" id=\"%s\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n        <i class=\"close icon\"></i>\n        <div class=\"header\" id=\"%sLabel\">\n          %s\n        </div>\n        <div class=\"image content\">\n          <div class=\"bootstrap-table\">\n            <div class=\"fixed-table-toolbar\">\n                <div class=\"bars\">\n                  <div id=\"toolbar\" class=\"pb-3\">\n                    <button id=\"add\" type=\"button\" class=\"ui button\">%s %s</button>\n                    <button id=\"delete\" type=\"button\" class=\"ui button\" disabled>%s %s</button>\n                  </div>\n                </div>\n            </div>\n            <div class=\"fixed-table-container\">\n                <table id=\"multi-sort\" class=\"table\">\n                    <thead>\n                        <tr>\n                            <th></th>\n                            <th><div class=\"th-inner\">%s</div></th>\n                            <th><div class=\"th-inner\">%s</div></th>\n                        </tr>\n                    </thead>\n                    <tbody></tbody>\n                </table>\n            </div>\n          </div>\n        </div>\n        <div class=\"actions\">\n          <div class=\"ui button deny\">%s</div>\n          <div class=\"ui button approve multi-sort-order-button\">%s</div>\n        </div>\n      </div>\n      ",
      multipleSortButton: '<button class="multi-sort ui button" type="button" data-toggle="modal" data-target="#%s" title="%s">%s</button>',
      multipleSortSelect: '<select class="%s %s">'
    }
  },
  materialize: {
    icons: {
      'plus': 'plus',
      'minus': 'minus',
      'sort': 'sort'
    },
    html: {
      multipleSortModal: "\n        <div id=\"%s\" class=\"modal\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n          <div class=\"modal-content\" id=\"%sLabel\">\n            <h4>%s</h4>\n            <div class=\"bootstrap-table\">\n            <div class=\"fixed-table-toolbar\">\n                <div class=\"bars\">\n                  <div id=\"toolbar\" class=\"pb-3\">\n                    <button id=\"add\" type=\"button\" class=\"waves-effect waves-light btn\">%s %s</button>\n                    <button id=\"delete\" type=\"button\" class=\"waves-effect waves-light btn\" disabled>%s %s</button>\n                  </div>\n                </div>\n            </div>\n            <div class=\"fixed-table-container\">\n                <table id=\"multi-sort\" class=\"table\">\n                    <thead>\n                        <tr>\n                            <th></th>\n                            <th><div class=\"th-inner\">%s</div></th>\n                            <th><div class=\"th-inner\">%s</div></th>\n                        </tr>\n                    </thead>\n                    <tbody></tbody>\n                </table>\n            </div>\n          </div>\n          <div class=\"modal-footer\">\n            <a href=\"javascript:void(0)\" class=\"modal-close waves-effect waves-light btn\">%s</a>\n            <a href=\"javascript:void(0)\" class=\"modal-close waves-effect waves-light btn multi-sort-order-button\">%s</a>\n          </div>\n          </div>\n        </div>\n      ",
      multipleSortButton: '<a href="#%s" class="multi-sort waves-effect waves-light btn modal-trigger" type="button" data-toggle="modal" title="%s">%s</a>',
      multipleSortSelect: '<select class="%s %s browser-default">'
    }
  },
  foundation: {
    icons: {
      'plus': 'fa-plus',
      'minus': 'fa-minus',
      'sort': 'fa-sort'
    },
    html: {
      multipleSortModal: "\n        <div class=\"reveal\" id=\"%s\" data-reveal aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n            <div id=\"%sLabel\">\n              <h1>%s</h1>\n              <div class=\"bootstrap-table\">\n                <div class=\"fixed-table-toolbar\">\n                    <div class=\"bars\">\n                      <div id=\"toolbar\" class=\"padding-bottom-2\">\n                        <button id=\"add\" type=\"button\" class=\"waves-effect waves-light button\">%s %s</button>\n                        <button id=\"delete\" type=\"button\" class=\"waves-effect waves-light button\" disabled>%s %s</button>\n                      </div>\n                    </div>\n                </div>\n                <div class=\"fixed-table-container\">\n                    <table id=\"multi-sort\" class=\"table\">\n                        <thead>\n                            <tr>\n                                <th></th>\n                                <th><div class=\"th-inner\">%s</div></th>\n                                <th><div class=\"th-inner\">%s</div></th>\n                            </tr>\n                        </thead>\n                        <tbody></tbody>\n                    </table>\n                </div>\n              </div>\n              \n              <button class=\"waves-effect waves-light button\" data-close aria-label=\"Close modal\" type=\"button\">\n                <span aria-hidden=\"true\">%s</span>\n              </button>\n              <button class=\"waves-effect waves-light button multi-sort-order-button\" data-close aria-label=\"Order\" type=\"button\">\n                  <span aria-hidden=\"true\">%s</span>\n              </button>\n            </div>\n        </div>\n      ",
      multipleSortButton: '<button class="button multi-sort" data-open="%s" title="%s">%s</button>',
      multipleSortSelect: '<select class="%s %s browser-default">'
    }
  },
  bulma: {
    icons: {
      'plus': 'fa-plus',
      'minus': 'fa-minus',
      'sort': 'fa-sort'
    },
    html: {
      multipleSortModal: "\n        <div class=\"modal\" id=\"%s\" aria-labelledby=\"%sLabel\" aria-hidden=\"true\">\n          <div class=\"modal-background\"></div>\n          <div class=\"modal-content\" id=\"%sLabel\">\n            <div class=\"box\">\n            <h2>%s</h2>\n              <div class=\"bootstrap-table\">\n                  <div class=\"fixed-table-toolbar\">\n                      <div class=\"bars\">\n                        <div id=\"toolbar\" class=\"padding-bottom-2\">\n                          <button id=\"add\" type=\"button\" class=\"waves-effect waves-light button\">%s %s</button>\n                          <button id=\"delete\" type=\"button\" class=\"waves-effect waves-light button\" disabled>%s %s</button>\n                        </div>\n                      </div>\n                  </div>\n                  <div class=\"fixed-table-container\">\n                      <table id=\"multi-sort\" class=\"table\">\n                          <thead>\n                              <tr>\n                                  <th></th>\n                                  <th><div class=\"th-inner\">%s</div></th>\n                                  <th><div class=\"th-inner\">%s</div></th>\n                              </tr>\n                          </thead>\n                          <tbody></tbody>\n                      </table>\n                    </div>\n                </div>\n                <button type=\"button\" class=\"waves-effect waves-light button\" data-close>%s</button>\n                <button type=\"button\" class=\"waves-effect waves-light button multi-sort-order-button\" data-close>%s</button>\n            </div>\n          </div>\n        </div>\n      ",
      multipleSortButton: '<button class="button multi-sort" data-target="%s" title="%s">%s</button>',
      multipleSortSelect: '<select class="%s %s browser-default">'
    }
  }
}[$.fn.bootstrapTable.theme];
$.extend($.fn.bootstrapTable.defaults.icons, bootstrap.icons);
$.extend($.fn.bootstrapTable.defaults.html, bootstrap.html);

var showSortModal = function showSortModal(that) {
  var _selector = that.sortModalSelector;

  var _id = "#".concat(_selector);

  var o = that.options;

  if (!$(_id).hasClass('modal')) {
    var sModal = Utils.sprintf(that.constants.html.multipleSortModal, _selector, _selector, _selector, that.options.formatMultipleSort(), Utils.sprintf(that.constants.html.icon, o.iconsPrefix, that.constants.icons.plus), that.options.formatAddLevel(), Utils.sprintf(that.constants.html.icon, o.iconsPrefix, that.constants.icons.minus), that.options.formatDeleteLevel(), that.options.formatColumn(), that.options.formatOrder(), that.options.formatCancel(), that.options.formatSort());
    $('body').append($(sModal));
    that.$sortModal = $(_id);
    var $rows = that.$sortModal.find('tbody > tr');
    that.$sortModal.off('click', '#add').on('click', '#add', function () {
      var total = that.$sortModal.find('.multi-sort-name:first option').length;
      var current = that.$sortModal.find('tbody tr').length;

      if (current < total) {
        current++;
        that.addLevel();
        that.setButtonStates();
      }
    });
    that.$sortModal.off('click', '#delete').on('click', '#delete', function () {
      var total = that.$sortModal.find('.multi-sort-name:first option').length;
      var current = that.$sortModal.find('tbody tr').length;

      if (current > 1 && current <= total) {
        current--;
        that.$sortModal.find('tbody tr:last').remove();
        that.setButtonStates();
      }
    });
    that.$sortModal.off('click', '.multi-sort-order-button').on('click', '.multi-sort-order-button', function () {
      var $rows = that.$sortModal.find('tbody > tr');
      var $alert = that.$sortModal.find('div.alert');
      var fields = [];
      var results = [];
      that.options.sortPriority = $.map($rows, function (row) {
        var $row = $(row);
        var name = $row.find('.multi-sort-name').val();
        var order = $row.find('.multi-sort-order').val();
        fields.push(name);
        return {
          sortName: name,
          sortOrder: order
        };
      });
      var sorted_fields = fields.sort();

      for (var i = 0; i < fields.length - 1; i++) {
        if (sorted_fields[i + 1] === sorted_fields[i]) {
          results.push(sorted_fields[i]);
        }
      }

      if (results.length > 0) {
        if ($alert.length === 0) {
          $alert = "<div class=\"alert alert-danger\" role=\"alert\"><strong>".concat(that.options.formatDuplicateAlertTitle(), "</strong> ").concat(that.options.formatDuplicateAlertDescription(), "</div>");
          $($alert).insertBefore(that.$sortModal.find('.bars'));
        }
      } else {
        if ($alert.length === 1) {
          $($alert).remove();
        }

        if ($.inArray($.fn.bootstrapTable.theme, ['bootstrap3', 'bootstrap4']) !== -1) {
          that.$sortModal.modal('hide');
        }

        that.options.sortName = '';

        if (that.options.sidePagination === 'server') {
          var t = that.options.queryParams;

          that.options.queryParams = function (params) {
            params.multiSort = that.options.sortPriority;
            return $.fn.bootstrapTable.utils.calculateObjectValue(that.options, t, [params]);
          };

          isSingleSort = false;
          that.initServer(that.options.silentSort);
          return;
        }

        that.onMultipleSort();
      }
    });

    if (that.options.sortPriority === null || that.options.sortPriority.length === 0) {
      if (that.options.sortName) {
        that.options.sortPriority = [{
          sortName: that.options.sortName,
          sortOrder: that.options.sortOrder
        }];
      }
    }

    if (that.options.sortPriority !== null && that.options.sortPriority.length > 0) {
      if ($rows.length < that.options.sortPriority.length && _typeof(that.options.sortPriority) === 'object') {
        for (var i = 0; i < that.options.sortPriority.length; i++) {
          that.addLevel(i, that.options.sortPriority[i]);
        }
      }
    } else {
      that.addLevel(0);
    }

    that.setButtonStates();
  }
};

$.fn.bootstrapTable.methods.push('multipleSort');
$.extend($.fn.bootstrapTable.defaults, {
  showMultiSort: false,
  showMultiSortButton: true,
  sortPriority: null,
  onMultipleSort: function onMultipleSort() {
    return false;
  }
});
$.extend($.fn.bootstrapTable.Constructor.EVENTS, {
  'multiple-sort.bs.table': 'onMultipleSort'
});
$.extend($.fn.bootstrapTable.locales, {
  formatMultipleSort: function formatMultipleSort() {
    return 'Multiple Sort';
  },
  formatAddLevel: function formatAddLevel() {
    return 'Add Level';
  },
  formatDeleteLevel: function formatDeleteLevel() {
    return 'Delete Level';
  },
  formatColumn: function formatColumn() {
    return 'Column';
  },
  formatOrder: function formatOrder() {
    return 'Order';
  },
  formatSortBy: function formatSortBy() {
    return 'Sort by';
  },
  formatThenBy: function formatThenBy() {
    return 'Then by';
  },
  formatSort: function formatSort() {
    return 'Sort';
  },
  formatCancel: function formatCancel() {
    return 'Cancel';
  },
  formatDuplicateAlertTitle: function formatDuplicateAlertTitle() {
    return 'Duplicate(s) detected!';
  },
  formatDuplicateAlertDescription: function formatDuplicateAlertDescription() {
    return 'Please remove or change any duplicate column.';
  },
  formatSortOrders: function formatSortOrders() {
    return {
      asc: 'Ascending',
      desc: 'Descending'
    };
  }
});
$.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales);
var BootstrapTable = $.fn.bootstrapTable.Constructor;
var _initToolbar = BootstrapTable.prototype.initToolbar;

BootstrapTable.prototype.initToolbar = function () {
  var _this = this;

  this.showToolbar = this.showToolbar || this.options.showMultiSort;
  var that = this;
  var sortModalSelector = "sortModal_".concat(this.$el.attr('id'));
  var sortModalId = "#".concat(sortModalSelector);
  this.$sortModal = $(sortModalId);
  this.sortModalSelector = sortModalSelector;

  if (that.options.sortPriority !== null) {
    that.onMultipleSort();
  }

  for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
    args[_key] = arguments[_key];
  }

  _initToolbar.apply(this, Array.prototype.slice.apply(args));

  if (that.options.sidePagination === 'server' && !isSingleSort && that.options.sortPriority !== null) {
    var t = that.options.queryParams;

    that.options.queryParams = function (params) {
      params.multiSort = that.options.sortPriority;
      return t(params);
    };
  }

  if (this.options.showMultiSort) {
    var $btnGroup = this.$toolbar.find('>.' + that.constants.classes.buttonsGroup.split(' ').join('.')).first();
    var $multiSortBtn = this.$toolbar.find('div.multi-sort');
    var o = that.options;

    if (!$multiSortBtn.length && this.options.showMultiSortButton) {
      $multiSortBtn = Utils.sprintf(that.constants.html.multipleSortButton, that.sortModalSelector, this.options.formatMultipleSort(), Utils.sprintf(that.constants.html.icon, o.iconsPrefix, o.icons.sort));
      $btnGroup.append($multiSortBtn);

      if ($.fn.bootstrapTable.theme === 'semantic') {
        this.$toolbar.find('.multi-sort').on('click', function () {
          $(sortModalId).modal('show');
        });
      } else if ($.fn.bootstrapTable.theme === 'materialize') {
        this.$toolbar.find('.multi-sort').on('click', function () {
          $(sortModalId).modal();
        });
      } else if ($.fn.bootstrapTable.theme === 'foundation') {
        this.$toolbar.find('.multi-sort').on('click', function () {
          if (!_this.foundationModal) {
            // eslint-disable-next-line no-undef
            _this.foundationModal = new Foundation.Reveal($(sortModalId));
          }

          _this.foundationModal.open();
        });
      } else if ($.fn.bootstrapTable.theme === 'bulma') {
        this.$toolbar.find('.multi-sort').on('click', function () {
          $('html').toggleClass('is-clipped');
          $(sortModalId).toggleClass('is-active');
          $('button[data-close]').one('click', function () {
            $('html').toggleClass('is-clipped');
            $(sortModalId).toggleClass('is-active');
          });
        });
      }

      showSortModal(that);
    }

    this.$el.on('sort.bs.table', function () {
      isSingleSort = true;
    });
    this.$el.on('multiple-sort.bs.table', function () {
      isSingleSort = false;
    });
    this.$el.on('load-success.bs.table', function () {
      if (!isSingleSort && that.options.sortPriority !== null && _typeof(that.options.sortPriority) === 'object' && that.options.sidePagination !== 'server') {
        that.onMultipleSort();
      }
    });
    this.$el.on('column-switch.bs.table', function (field, checked) {
      for (var i = 0; i < that.options.sortPriority.length; i++) {
        if (that.options.sortPriority[i].sortName === checked) {
          that.options.sortPriority.splice(i, 1);
        }
      }

      that.assignSortableArrows();
      that.$sortModal.remove();
      showSortModal(that);
    });
    this.$el.on('reset-view.bs.table', function () {
      if (!isSingleSort && that.options.sortPriority !== null && _typeof(that.options.sortPriority) === 'object') {
        that.assignSortableArrows();
      }
    });
  }
};

BootstrapTable.prototype.multipleSort = function () {
  var that = this;

  if (!isSingleSort && that.options.sortPriority !== null && _typeof(that.options.sortPriority) === 'object' && that.options.sidePagination !== 'server') {
    that.onMultipleSort();
  }
};

BootstrapTable.prototype.onMultipleSort = function () {
  var that = this;

  var cmp = function cmp(x, y) {
    return x > y ? 1 : x < y ? -1 : 0;
  };

  var arrayCmp = function arrayCmp(a, b) {
    var arr1 = [];
    var arr2 = [];

    for (var i = 0; i < that.options.sortPriority.length; i++) {
      var order = that.options.sortPriority[i].sortOrder === 'desc' ? -1 : 1;
      var aa = a[that.options.sortPriority[i].sortName];
      var bb = b[that.options.sortPriority[i].sortName];

      if (aa === undefined || aa === null) {
        aa = '';
      }

      if (bb === undefined || bb === null) {
        bb = '';
      }

      if ($.isNumeric(aa) && $.isNumeric(bb)) {
        aa = parseFloat(aa);
        bb = parseFloat(bb);
      }

      if (typeof aa !== 'string') {
        aa = aa.toString();
      }

      arr1.push(order * cmp(aa, bb));
      arr2.push(order * cmp(bb, aa));
    }

    return cmp(arr1, arr2);
  };

  this.data.sort(function (a, b) {
    return arrayCmp(a, b);
  });
  this.initBody();
  this.assignSortableArrows();
  this.trigger('multiple-sort');
};

BootstrapTable.prototype.addLevel = function (index, sortPriority) {
  var text = index === 0 ? this.options.formatSortBy() : this.options.formatThenBy();
  this.$sortModal.find('tbody').append($('<tr>').append($('<td>').text(text)).append($('<td>').append($(Utils.sprintf(this.constants.html.multipleSortSelect, this.constants.classes.paginationDropdown, 'multi-sort-name')))).append($('<td>').append($(Utils.sprintf(this.constants.html.multipleSortSelect, this.constants.classes.paginationDropdown, 'multi-sort-order')))));
  var $multiSortName = this.$sortModal.find('.multi-sort-name').last();
  var $multiSortOrder = this.$sortModal.find('.multi-sort-order').last();
  $.each(this.columns, function (i, column) {
    if (column.sortable === false || column.visible === false) {
      return true;
    }

    $multiSortName.append("<option value=\"".concat(column.field, "\">").concat(column.title, "</option>"));
  });
  $.each(this.options.formatSortOrders(), function (value, order) {
    $multiSortOrder.append("<option value=\"".concat(value, "\">").concat(order, "</option>"));
  });

  if (sortPriority !== undefined) {
    $multiSortName.find("option[value=\"".concat(sortPriority.sortName, "\"]")).attr('selected', true);
    $multiSortOrder.find("option[value=\"".concat(sortPriority.sortOrder, "\"]")).attr('selected', true);
  }
};

BootstrapTable.prototype.assignSortableArrows = function () {
  var that = this;
  var headers = that.$header.find('th');

  for (var i = 0; i < headers.length; i++) {
    for (var c = 0; c < that.options.sortPriority.length; c++) {
      if ($(headers[i]).data('field') === that.options.sortPriority[c].sortName) {
        $(headers[i]).find('.sortable').removeClass('desc asc').addClass(that.options.sortPriority[c].sortOrder);
      }
    }
  }
};

BootstrapTable.prototype.setButtonStates = function () {
  var total = this.$sortModal.find('.multi-sort-name:first option').length;
  var current = this.$sortModal.find('tbody tr').length;

  if (current === total) {
    this.$sortModal.find('#add').attr('disabled', 'disabled');
  }

  if (current > 1) {
    this.$sortModal.find('#delete').removeAttr('disabled');
  }

  if (current < total) {
    this.$sortModal.find('#add').removeAttr('disabled');
  }

  if (current === 1) {
    this.$sortModal.find('#delete').attr('disabled', 'disabled');
  }
};

/***/ }),

/***/ "./resources/assets/vendor/libs/bootstrap-table/extensions/multiple-sort/multiple-sort.js":
/*!************************************************************************************************!*\
  !*** ./resources/assets/vendor/libs/bootstrap-table/extensions/multiple-sort/multiple-sort.js ***!
  \************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! bootstrap-table/src/extensions/multiple-sort/bootstrap-table-multiple-sort.js */ "./node_modules/bootstrap-table/src/extensions/multiple-sort/bootstrap-table-multiple-sort.js");

/***/ }),

/***/ 46:
/*!******************************************************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/bootstrap-table/extensions/multiple-sort/multiple-sort.js ***!
  \******************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\bootstrap-table\extensions\multiple-sort\multiple-sort.js */"./resources/assets/vendor/libs/bootstrap-table/extensions/multiple-sort/multiple-sort.js");


/***/ })

/******/ })));