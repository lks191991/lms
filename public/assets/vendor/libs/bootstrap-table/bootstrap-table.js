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
/******/ 	return __webpack_require__(__webpack_require__.s = 30);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/bootstrap-table/src/bootstrap-table.js":
/*!*************************************************************!*\
  !*** ./node_modules/bootstrap-table/src/bootstrap-table.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _constants_index_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./constants/index.js */ "./node_modules/bootstrap-table/src/constants/index.js");
/* harmony import */ var _utils_index_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./utils/index.js */ "./node_modules/bootstrap-table/src/utils/index.js");
/* harmony import */ var _virtual_scroll_index_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./virtual-scroll/index.js */ "./node_modules/bootstrap-table/src/virtual-scroll/index.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e2) { throw _e2; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e3) { didErr = true; err = _e3; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(n); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * @author zhixin wen <wenzhixin2010@gmail.com>
 * version: 1.15.5
 * https://github.com/wenzhixin/bootstrap-table/
 */




var BootstrapTable = /*#__PURE__*/function () {
  function BootstrapTable(el, options) {
    _classCallCheck(this, BootstrapTable);

    this.options = options;
    this.$el = $(el);
    this.$el_ = this.$el.clone();
    this.timeoutId_ = 0;
    this.timeoutFooter_ = 0;
    this.init();
  }

  _createClass(BootstrapTable, [{
    key: "init",
    value: function init() {
      this.initConstants();
      this.initLocale();
      this.initContainer();
      this.initTable();
      this.initHeader();
      this.initData();
      this.initHiddenRows();
      this.initToolbar();
      this.initPagination();
      this.initBody();
      this.initSearchText();
      this.initServer();
    }
  }, {
    key: "initConstants",
    value: function initConstants() {
      var o = this.options;
      this.constants = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].CONSTANTS;
      this.constants.theme = $.fn.bootstrapTable.theme;
      var buttonsPrefix = o.buttonsPrefix ? "".concat(o.buttonsPrefix, "-") : '';
      this.constants.buttonsClass = [o.buttonsPrefix, buttonsPrefix + o.buttonsClass, _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf("".concat(buttonsPrefix, "%s"), o.iconSize)].join(' ').trim();
    }
  }, {
    key: "initLocale",
    value: function initLocale() {
      if (this.options.locale) {
        var locales = $.fn.bootstrapTable.locales;
        var parts = this.options.locale.split(/-|_/);
        parts[0] = parts[0].toLowerCase();

        if (parts[1]) {
          parts[1] = parts[1].toUpperCase();
        }

        if (locales[this.options.locale]) {
          $.extend(this.options, locales[this.options.locale]);
        } else if (locales[parts.join('-')]) {
          $.extend(this.options, locales[parts.join('-')]);
        } else if (locales[parts[0]]) {
          $.extend(this.options, locales[parts[0]]);
        }
      }
    }
  }, {
    key: "initContainer",
    value: function initContainer() {
      var topPagination = ['top', 'both'].includes(this.options.paginationVAlign) ? '<div class="fixed-table-pagination clearfix"></div>' : '';
      var bottomPagination = ['bottom', 'both'].includes(this.options.paginationVAlign) ? '<div class="fixed-table-pagination"></div>' : '';
      this.$container = $("\n      <div class=\"bootstrap-table ".concat(this.constants.theme, "\">\n      <div class=\"fixed-table-toolbar\"></div>\n      ").concat(topPagination, "\n      <div class=\"fixed-table-container\">\n      <div class=\"fixed-table-header\"><table></table></div>\n      <div class=\"fixed-table-body\">\n      <div class=\"fixed-table-loading\">\n      <span class=\"loading-wrap\">\n      <span class=\"loading-text\">").concat(this.options.formatLoadingMessage(), "</span>\n      <span class=\"animation-wrap\"><span class=\"animation-dot\"></span></span>\n      </span>\n      </div>\n      </div>\n      <div class=\"fixed-table-footer\"><table><thead><tr></tr></thead></table></div>\n      </div>\n      ").concat(bottomPagination, "\n      </div>\n    "));
      this.$container.insertAfter(this.$el);
      this.$tableContainer = this.$container.find('.fixed-table-container');
      this.$tableHeader = this.$container.find('.fixed-table-header');
      this.$tableBody = this.$container.find('.fixed-table-body');
      this.$tableLoading = this.$container.find('.fixed-table-loading');
      this.$tableFooter = this.$el.find('tfoot'); // checking if custom table-toolbar exists or not

      if (this.options.buttonsToolbar) {
        this.$toolbar = $('body').find(this.options.buttonsToolbar);
      } else {
        this.$toolbar = this.$container.find('.fixed-table-toolbar');
      }

      this.$pagination = this.$container.find('.fixed-table-pagination');
      this.$tableBody.append(this.$el);
      this.$container.after('<div class="clearfix"></div>');
      this.$el.addClass(this.options.classes);
      this.$tableLoading.addClass(this.options.classes);

      if (this.options.height) {
        this.$tableContainer.addClass('fixed-height');

        if (this.options.showFooter) {
          this.$tableContainer.addClass('has-footer');
        }

        if (this.options.classes.split(' ').includes('table-bordered')) {
          this.$tableBody.append('<div class="fixed-table-border"></div>');
          this.$tableBorder = this.$tableBody.find('.fixed-table-border');
          this.$tableLoading.addClass('fixed-table-border');
        }

        this.$tableFooter = this.$container.find('.fixed-table-footer');
      } else {
        if (!this.$tableFooter.length) {
          this.$el.append('<tfoot><tr></tr></tfoot>');
          this.$tableFooter = this.$el.find('tfoot');
        }
      }
    }
  }, {
    key: "initTable",
    value: function initTable() {
      var _this = this;

      var columns = [];
      var data = [];
      this.$header = this.$el.find('>thead');

      if (!this.$header.length) {
        this.$header = $("<thead class=\"".concat(this.options.theadClasses, "\"></thead>")).appendTo(this.$el);
      } else if (this.options.theadClasses) {
        this.$header.addClass(this.options.theadClasses);
      }

      this.$header.find('tr').each(function (i, el) {
        var column = [];
        $(el).find('th').each(function (i, el) {
          // #2014: getFieldIndex and elsewhere assume this is string, causes issues if not
          if (typeof $(el).data('field') !== 'undefined') {
            $(el).data('field', "".concat($(el).data('field')));
          }

          column.push($.extend({}, {
            title: $(el).html(),
            'class': $(el).attr('class'),
            titleTooltip: $(el).attr('title'),
            rowspan: $(el).attr('rowspan') ? +$(el).attr('rowspan') : undefined,
            colspan: $(el).attr('colspan') ? +$(el).attr('colspan') : undefined
          }, $(el).data()));
        });
        columns.push(column);
      });

      if (!Array.isArray(this.options.columns[0])) {
        this.options.columns = [this.options.columns];
      }

      this.options.columns = $.extend(true, [], columns, this.options.columns);
      this.columns = [];
      this.fieldsColumnsIndex = [];
      _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].setFieldIndex(this.options.columns);
      this.options.columns.forEach(function (columns, i) {
        columns.forEach(function (_column, j) {
          var column = $.extend({}, BootstrapTable.COLUMN_DEFAULTS, _column);

          if (typeof column.fieldIndex !== 'undefined') {
            _this.columns[column.fieldIndex] = column;
            _this.fieldsColumnsIndex[column.field] = column.fieldIndex;
          }

          _this.options.columns[i][j] = column;
        });
      }); // if options.data is setting, do not process tbody and tfoot data

      if (!this.options.data.length) {
        this.options.data = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].trToData(this.columns, this.$el.find('>tbody>tr'));

        if (data.length) {
          this.fromHtml = true;
        }
      }

      this.footerData = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].trToData(this.columns, this.$el.find('>tfoot>tr'));

      if (this.footerData) {
        this.$el.find('tfoot').html('<tr></tr>');
      }

      if (!this.options.showFooter || this.options.cardView) {
        this.$tableFooter.hide();
      } else {
        this.$tableFooter.show();
      }
    }
  }, {
    key: "initHeader",
    value: function initHeader() {
      var _this2 = this;

      var visibleColumns = {};
      var html = [];
      this.header = {
        fields: [],
        styles: [],
        classes: [],
        formatters: [],
        detailFormatters: [],
        events: [],
        sorters: [],
        sortNames: [],
        cellStyles: [],
        searchables: []
      };
      _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].updateFieldGroup(this.options.columns);
      this.options.columns.forEach(function (columns, i) {
        html.push('<tr>');

        if (i === 0 && !_this2.options.cardView && _this2.options.detailView && _this2.options.detailViewIcon) {
          html.push("<th class=\"detail\" rowspan=\"".concat(_this2.options.columns.length, "\">\n          <div class=\"fht-cell\"></div>\n          </th>\n        "));
        }

        columns.forEach(function (column, j) {
          var class_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' class="%s"', column['class']);
          var unitWidth = column.widthUnit;
          var width = parseFloat(column.width);
          var halign = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('text-align: %s; ', column.halign ? column.halign : column.align);
          var align = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('text-align: %s; ', column.align);
          var style = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('vertical-align: %s; ', column.valign);
          style += _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('width: %s; ', (column.checkbox || column.radio) && !width ? !column.showSelectTitle ? '36px' : undefined : width ? width + unitWidth : undefined);

          if (typeof column.fieldIndex === 'undefined' && !column.visible) {
            return;
          }

          if (typeof column.fieldIndex !== 'undefined') {
            _this2.header.fields[column.fieldIndex] = column.field;
            _this2.header.styles[column.fieldIndex] = align + style;
            _this2.header.classes[column.fieldIndex] = class_;
            _this2.header.formatters[column.fieldIndex] = column.formatter;
            _this2.header.detailFormatters[column.fieldIndex] = column.detailFormatter;
            _this2.header.events[column.fieldIndex] = column.events;
            _this2.header.sorters[column.fieldIndex] = column.sorter;
            _this2.header.sortNames[column.fieldIndex] = column.sortName;
            _this2.header.cellStyles[column.fieldIndex] = column.cellStyle;
            _this2.header.searchables[column.fieldIndex] = column.searchable;

            if (!column.visible) {
              return;
            }

            if (_this2.options.cardView && !column.cardVisible) {
              return;
            }

            visibleColumns[column.field] = column;
          }

          html.push("<th".concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' title="%s"', column.titleTooltip)), column.checkbox || column.radio ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' class="bs-checkbox %s"', column['class'] || '') : class_, _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' style="%s"', halign + style), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' rowspan="%s"', column.rowspan), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' colspan="%s"', column.colspan), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' data-field="%s"', column.field), // If `column` is not the first element of `this.options.columns[0]`, then className 'data-not-first-th' should be added.
          j === 0 && i > 0 ? ' data-not-first-th' : '', '>');
          html.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('<div class="th-inner %s">', _this2.options.sortable && column.sortable ? 'sortable both' : ''));
          var text = _this2.options.escape ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].escapeHTML(column.title) : column.title;
          var title = text;

          if (column.checkbox) {
            text = '';

            if (!_this2.options.singleSelect && _this2.options.checkboxHeader) {
              text = '<label><input name="btSelectAll" type="checkbox" /><span></span></label>';
            }

            _this2.header.stateField = column.field;
          }

          if (column.radio) {
            text = '';
            _this2.header.stateField = column.field;
            _this2.options.singleSelect = true;
          }

          if (!text && column.showSelectTitle) {
            text += title;
          }

          html.push(text);
          html.push('</div>');
          html.push('<div class="fht-cell"></div>');
          html.push('</div>');
          html.push('</th>');
        });
        html.push('</tr>');
      });
      this.$header.html(html.join(''));
      this.$header.find('th[data-field]').each(function (i, el) {
        $(el).data(visibleColumns[$(el).data('field')]);
      });
      this.$container.off('click', '.th-inner').on('click', '.th-inner', function (e) {
        var $this = $(e.currentTarget);

        if (_this2.options.detailView && !$this.parent().hasClass('bs-checkbox')) {
          if ($this.closest('.bootstrap-table')[0] !== _this2.$container[0]) {
            return false;
          }
        }

        if (_this2.options.sortable && $this.parent().data().sortable) {
          _this2.onSort(e);
        }
      });
      this.$header.children().children().off('keypress').on('keypress', function (e) {
        if (_this2.options.sortable && $(e.currentTarget).data().sortable) {
          var code = e.keyCode || e.which;

          if (code === 13) {
            // Enter keycode
            _this2.onSort(e);
          }
        }
      });
      var resizeEvent = "resize.bootstrap-table".concat(this.$el.attr('id') || '');
      $(window).off(resizeEvent);

      if (!this.options.showHeader || this.options.cardView) {
        this.$header.hide();
        this.$tableHeader.hide();
        this.$tableLoading.css('top', 0);
      } else {
        this.$header.show();
        this.$tableHeader.show();
        this.$tableLoading.css('top', this.$header.outerHeight() + 1); // Assign the correct sortable arrow

        this.getCaret();
        $(window).on(resizeEvent, function (e) {
          return _this2.resetWidth(e);
        });
      }

      this.$selectAll = this.$header.find('[name="btSelectAll"]');
      this.$selectAll.off('click').on('click', function (_ref) {
        var currentTarget = _ref.currentTarget;
        var checked = $(currentTarget).prop('checked');

        _this2[checked ? 'checkAll' : 'uncheckAll']();

        _this2.updateSelected();
      });
    }
  }, {
    key: "initData",
    value: function initData(data, type) {
      if (type === 'append') {
        this.options.data = this.options.data.concat(data);
      } else if (type === 'prepend') {
        this.options.data = [].concat(data).concat(this.options.data);
      } else {
        this.options.data = data || this.options.data;
      }

      this.data = this.options.data;

      if (this.options.sidePagination === 'server') {
        return;
      }

      this.initSort();
    }
  }, {
    key: "initSort",
    value: function initSort() {
      var _this3 = this;

      var name = this.options.sortName;
      var order = this.options.sortOrder === 'desc' ? -1 : 1;
      var index = this.header.fields.indexOf(this.options.sortName);
      var timeoutId = 0;

      if (index !== -1) {
        if (this.options.sortStable) {
          this.data.forEach(function (row, i) {
            if (!row.hasOwnProperty('_position')) {
              row._position = i;
            }
          });
        }

        if (this.options.customSort) {
          _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(this.options, this.options.customSort, [this.options.sortName, this.options.sortOrder, this.data]);
        } else {
          this.data.sort(function (a, b) {
            if (_this3.header.sortNames[index]) {
              name = _this3.header.sortNames[index];
            }

            var aa = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].getItemField(a, name, _this3.options.escape);
            var bb = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].getItemField(b, name, _this3.options.escape);
            var value = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(_this3.header, _this3.header.sorters[index], [aa, bb, a, b]);

            if (value !== undefined) {
              if (_this3.options.sortStable && value === 0) {
                return order * (a._position - b._position);
              }

              return order * value;
            }

            return _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sort(aa, bb, order, _this3.options.sortStable);
          });
        }

        if (this.options.sortClass !== undefined) {
          clearTimeout(timeoutId);
          timeoutId = setTimeout(function () {
            _this3.$el.removeClass(_this3.options.sortClass);

            var index = _this3.$header.find("[data-field=\"".concat(_this3.options.sortName, "\"]")).index();

            _this3.$el.find("tr td:nth-child(".concat(index + 1, ")")).addClass(_this3.options.sortClass);
          }, 250);
        }
      }
    }
  }, {
    key: "onSort",
    value: function onSort(_ref2) {
      var type = _ref2.type,
          currentTarget = _ref2.currentTarget;
      var $this = type === 'keypress' ? $(currentTarget) : $(currentTarget).parent();
      var $this_ = this.$header.find('th').eq($this.index());
      this.$header.add(this.$header_).find('span.order').remove();

      if (this.options.sortName === $this.data('field')) {
        this.options.sortOrder = this.options.sortOrder === 'asc' ? 'desc' : 'asc';
      } else {
        this.options.sortName = $this.data('field');

        if (this.options.rememberOrder) {
          this.options.sortOrder = $this.data('order') === 'asc' ? 'desc' : 'asc';
        } else {
          this.options.sortOrder = this.columns[this.fieldsColumnsIndex[$this.data('field')]].sortOrder || this.columns[this.fieldsColumnsIndex[$this.data('field')]].order;
        }
      }

      this.trigger('sort', this.options.sortName, this.options.sortOrder);
      $this.add($this_).data('order', this.options.sortOrder); // Assign the correct sortable arrow

      this.getCaret();

      if (this.options.sidePagination === 'server') {
        this.options.pageNumber = 1;
        this.initServer(this.options.silentSort);
        return;
      }

      this.initSort();
      this.initBody();
    }
  }, {
    key: "initToolbar",
    value: function initToolbar() {
      var _this4 = this;

      var o = this.options;
      var html = [];
      var timeoutId = 0;
      var $keepOpen;
      var $search;
      var switchableCount = 0;

      if (this.$toolbar.find('.bs-bars').children().length) {
        $('body').append($(o.toolbar));
      }

      this.$toolbar.html('');

      if (typeof o.toolbar === 'string' || _typeof(o.toolbar) === 'object') {
        $(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('<div class="bs-bars %s-%s"></div>', this.constants.classes.pull, o.toolbarAlign)).appendTo(this.$toolbar).append($(o.toolbar));
      } // showColumns, showToggle, showRefresh


      html = ["<div class=\"".concat(['columns', "columns-".concat(o.buttonsAlign), this.constants.classes.buttonsGroup, "".concat(this.constants.classes.pull, "-").concat(o.buttonsAlign)].join(' '), "\">")];

      if (typeof o.icons === 'string') {
        o.icons = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(null, o.icons);
      }

      if (o.showPaginationSwitch) {
        html.push("<button class=\"".concat(this.constants.buttonsClass, "\" type=\"button\" name=\"paginationSwitch\"\n        aria-label=\"Pagination Switch\" title=\"").concat(o.formatPaginationSwitch(), "\">\n        ").concat(o.showButtonIcons ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, o.iconsPrefix, o.icons.paginationSwitchDown) : '', "\n        ").concat(o.showButtonText ? o.formatPaginationSwitchUp() : '', "\n        </button>"));
      }

      if (o.showRefresh) {
        html.push("<button class=\"".concat(this.constants.buttonsClass, "\" type=\"button\" name=\"refresh\"\n        aria-label=\"Refresh\" title=\"").concat(o.formatRefresh(), "\">\n        ").concat(o.showButtonIcons ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, o.iconsPrefix, o.icons.refresh) : '', "\n        ").concat(o.showButtonText ? o.formatRefresh() : '', "\n        </button>"));
      }

      if (o.showToggle) {
        html.push("<button class=\"".concat(this.constants.buttonsClass, "\" type=\"button\" name=\"toggle\"\n        aria-label=\"Toggle\" title=\"").concat(o.formatToggle(), "\">\n        ").concat(o.showButtonIcons ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, o.iconsPrefix, o.icons.toggleOff) : '', "\n        ").concat(o.showButtonText ? o.formatToggleOn() : '', "\n        </button>"));
      }

      if (o.showFullscreen) {
        html.push("<button class=\"".concat(this.constants.buttonsClass, "\" type=\"button\" name=\"fullscreen\"\n        aria-label=\"Fullscreen\" title=\"").concat(o.formatFullscreen(), "\">\n        ").concat(o.showButtonIcons ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, o.iconsPrefix, o.icons.fullscreen) : '', "\n        ").concat(o.showButtonText ? o.formatFullscreen() : '', "\n        </button>"));
      }

      if (o.showColumns) {
        html.push("<div class=\"keep-open ".concat(this.constants.classes.buttonsDropdown, "\" title=\"").concat(o.formatColumns(), "\">\n        <button class=\"").concat(this.constants.buttonsClass, " dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\"\n        aria-label=\"Columns\" title=\"").concat(o.formatColumns(), "\">\n        ").concat(o.showButtonIcons ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, o.iconsPrefix, o.icons.columns) : '', "\n        ").concat(o.showButtonText ? o.formatColumns() : '', "\n        ").concat(this.constants.html.dropdownCaret, "\n        </button>\n        ").concat(this.constants.html.toolbarDropdown[0]));

        if (o.showColumnsToggleAll) {
          var allFieldsVisible = this.getVisibleColumns().length === this.columns.length;
          html.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.toolbarDropdownItem, _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('<input type="checkbox" class="toggle-all" %s> <span>%s</span>', allFieldsVisible ? 'checked="checked"' : '', o.formatColumnsToggleAll())));
          html.push(this.constants.html.toolbarDropdownSeparator);
        }

        this.columns.forEach(function (column, i) {
          if (column.radio || column.checkbox) {
            return;
          }

          if (o.cardView && !column.cardVisible) {
            return;
          }

          var checked = column.visible ? ' checked="checked"' : '';

          if (column.switchable) {
            html.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(_this4.constants.html.toolbarDropdownItem, _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('<input type="checkbox" data-field="%s" value="%s"%s> <span>%s</span>', column.field, i, checked, column.title)));
            switchableCount++;
          }
        });
        html.push(this.constants.html.toolbarDropdown[1], '</div>');
      }

      html.push('</div>'); // Fix #188: this.showToolbar is for extensions

      if (this.showToolbar || html.length > 2) {
        this.$toolbar.append(html.join(''));
      }

      if (o.showPaginationSwitch) {
        this.$toolbar.find('button[name="paginationSwitch"]').off('click').on('click', function () {
          return _this4.togglePagination();
        });
      }

      if (o.showFullscreen) {
        this.$toolbar.find('button[name="fullscreen"]').off('click').on('click', function () {
          return _this4.toggleFullscreen();
        });
      }

      if (o.showRefresh) {
        this.$toolbar.find('button[name="refresh"]').off('click').on('click', function () {
          return _this4.refresh();
        });
      }

      if (o.showToggle) {
        this.$toolbar.find('button[name="toggle"]').off('click').on('click', function () {
          _this4.toggleView();
        });
      }

      if (o.showColumns) {
        $keepOpen = this.$toolbar.find('.keep-open');
        var $checkboxes = $keepOpen.find('input:not(".toggle-all")');
        var $toggleAll = $keepOpen.find('input.toggle-all');

        if (switchableCount <= o.minimumCountColumns) {
          $keepOpen.find('input').prop('disabled', true);
        }

        $keepOpen.find('li, label').off('click').on('click', function (e) {
          e.stopImmediatePropagation();
        });
        $checkboxes.off('click').on('click', function (_ref3) {
          var currentTarget = _ref3.currentTarget;
          var $this = $(currentTarget);

          _this4._toggleColumn($this.val(), $this.prop('checked'), false);

          _this4.trigger('column-switch', $this.data('field'), $this.prop('checked'));

          $toggleAll.prop('checked', $checkboxes.filter(':checked').length === _this4.columns.length);
        });
        $toggleAll.off('click').on('click', function (_ref4) {
          var currentTarget = _ref4.currentTarget;

          _this4._toggleAllColumns($(currentTarget).prop('checked'));
        });
      } // Fix #4516: this.showSearchClearButton is for extensions


      if (o.search || this.showSearchClearButton) {
        html = [];
        var showSearchButton = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.searchButton, this.constants.buttonsClass, o.formatSearch(), o.showButtonIcons ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, o.iconsPrefix, o.icons.search) : '', o.showButtonText ? o.formatSearch() : '');
        var showSearchClearButton = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.searchClearButton, this.constants.buttonsClass, o.formatClearSearch(), o.showButtonIcons ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, o.iconsPrefix, o.icons.clearSearch) : '', o.showButtonText ? o.formatClearSearch() : '');
        var searchInputHtml = "<input class=\"".concat(this.constants.classes.input, "\n        ").concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' %s%s', this.constants.classes.inputPrefix, o.iconSize), "\n        search-input\" type=\"text\" placeholder=\"").concat(o.formatSearch(), "\">");
        var searchInputFinalHtml = searchInputHtml;

        if (o.showSearchButton || o.showSearchClearButton) {
          var buttonsHtml = (o.showSearchButton ? showSearchButton : '') + (o.showSearchClearButton ? showSearchClearButton : '');
          searchInputFinalHtml = o.search ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.inputGroup, searchInputHtml, buttonsHtml) : buttonsHtml;
        }

        html.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf("\n        <div class=\"".concat(this.constants.classes.pull, "-").concat(o.searchAlign, " search ").concat(this.constants.classes.inputGroup, "\">\n          %s\n        </div>\n      "), searchInputFinalHtml));
        this.$toolbar.append(html.join(''));
        var $searchInput = this.$toolbar.find('.search input');

        var handleInputEvent = function handleInputEvent() {
          var eventTriggers = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isIEBrowser() ? 'mouseup' : 'keyup drop blur';
          $searchInput.off(eventTriggers).on(eventTriggers, function (event) {
            if (o.searchOnEnterKey && event.keyCode !== 13) {
              return;
            }

            if ([37, 38, 39, 40].includes(event.keyCode)) {
              return;
            }

            clearTimeout(timeoutId); // doesn't matter if it's 0

            timeoutId = setTimeout(function () {
              _this4.onSearch(event);
            }, o.searchTimeOut);
          });
        };

        if (o.showSearchButton) {
          this.$toolbar.find('.search button[name=search]').off('click').on('click', function (event) {
            clearTimeout(timeoutId); // doesn't matter if it's 0

            timeoutId = setTimeout(function () {
              _this4.onSearch({
                currentTarget: $searchInput
              });
            }, o.searchTimeOut);
          });

          if (o.searchOnEnterKey) {
            handleInputEvent();
          }
        } else {
          handleInputEvent();
        }

        if (o.showSearchClearButton) {
          this.$toolbar.find('.search button[name=clearSearch]').click(function () {
            _this4.resetSearch();
          });
        }
      }
    }
  }, {
    key: "onSearch",
    value: function onSearch() {
      var _ref5 = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},
          currentTarget = _ref5.currentTarget,
          firedByInitSearchText = _ref5.firedByInitSearchText;

      var overwriteSearchText = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

      if (currentTarget !== undefined && $(currentTarget).length && overwriteSearchText) {
        var text = $(currentTarget).val().trim();

        if (this.options.trimOnSearch && $(currentTarget).val() !== text) {
          $(currentTarget).val(text);
        }

        if (this.searchText === text) {
          return;
        }

        if ($(currentTarget).hasClass('search-input')) {
          this.searchText = text;
          this.options.searchText = text;
        }
      }

      if (!firedByInitSearchText) {
        this.options.pageNumber = 1;
      }

      this.initSearch();

      if (firedByInitSearchText) {
        if (this.options.sidePagination === 'client') {
          this.updatePagination();
        }
      } else {
        this.updatePagination();
      }

      this.trigger('search', this.searchText);
    }
  }, {
    key: "initSearch",
    value: function initSearch() {
      var _this5 = this;

      this.filterOptions = this.filterOptions || this.options.filterOptions;

      if (this.options.sidePagination !== 'server') {
        if (this.options.customSearch) {
          this.data = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(this.options, this.options.customSearch, [this.options.data, this.searchText, this.filterColumns]);
          return;
        }

        var s = this.searchText && (this.options.escape ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].escapeHTML(this.searchText) : this.searchText).toLowerCase();
        var f = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isEmptyObject(this.filterColumns) ? null : this.filterColumns; // Check filter

        if (typeof this.filterOptions.filterAlgorithm === 'function') {
          this.data = this.options.data.filter(function (item, i) {
            return _this5.filterOptions.filterAlgorithm.apply(null, [item, f]);
          });
        } else if (typeof this.filterOptions.filterAlgorithm === 'string') {
          this.data = f ? this.options.data.filter(function (item, i) {
            var filterAlgorithm = _this5.filterOptions.filterAlgorithm;

            if (filterAlgorithm === 'and') {
              for (var key in f) {
                if (Array.isArray(f[key]) && !f[key].includes(item[key]) || !Array.isArray(f[key]) && item[key] !== f[key]) {
                  return false;
                }
              }
            } else if (filterAlgorithm === 'or') {
              var match = false;

              for (var _key in f) {
                if (Array.isArray(f[_key]) && f[_key].includes(item[_key]) || !Array.isArray(f[_key]) && item[_key] === f[_key]) {
                  match = true;
                }
              }

              return match;
            }

            return true;
          }) : this.options.data;
        }

        var visibleFields = this.getVisibleFields();
        this.data = s ? this.data.filter(function (item, i) {
          for (var j = 0; j < _this5.header.fields.length; j++) {
            if (!_this5.header.searchables[j] || _this5.options.visibleSearch && visibleFields.indexOf(_this5.header.fields[j]) === -1) {
              continue;
            }

            var key = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isNumeric(_this5.header.fields[j]) ? parseInt(_this5.header.fields[j], 10) : _this5.header.fields[j];
            var column = _this5.columns[_this5.fieldsColumnsIndex[key]];
            var value = void 0;

            if (typeof key === 'string') {
              value = item;
              var props = key.split('.');

              for (var _i = 0; _i < props.length; _i++) {
                if (value[props[_i]] !== null) {
                  value = value[props[_i]];
                }
              }
            } else {
              value = item[key];
            } // Fix #142: respect searchFormatter boolean


            if (column && column.searchFormatter) {
              value = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(column, _this5.header.formatters[j], [value, item, i, column.field], value);
            }

            if (typeof value === 'string' || typeof value === 'number') {
              if (_this5.options.strictSearch) {
                if ("".concat(value).toLowerCase() === s) {
                  return true;
                }
              } else {
                var largerSmallerEqualsRegex = /(?:(<=|=>|=<|>=|>|<)(?:\s+)?(\d+)?|(\d+)?(\s+)?(<=|=>|=<|>=|>|<))/gm;
                var matches = largerSmallerEqualsRegex.exec(s);
                var comparisonCheck = false;

                if (matches) {
                  var operator = matches[1] || "".concat(matches[5], "l");
                  var comparisonValue = matches[2] || matches[3];
                  var int = parseInt(value, 10);
                  var comparisonInt = parseInt(comparisonValue, 10);

                  switch (operator) {
                    case '>':
                    case '<l':
                      comparisonCheck = int > comparisonInt;
                      break;

                    case '<':
                    case '>l':
                      comparisonCheck = int < comparisonInt;
                      break;

                    case '<=':
                    case '=<':
                    case '>=l':
                    case '=>l':
                      comparisonCheck = int <= comparisonInt;
                      break;

                    case '>=':
                    case '=>':
                    case '<=l':
                    case '=<l':
                      comparisonCheck = int >= comparisonInt;
                      break;

                    default:
                      break;
                  }
                }

                if (comparisonCheck || "".concat(value).toLowerCase().includes(s)) {
                  return true;
                }
              }
            }
          }

          return false;
        }) : this.data;
      }
    }
  }, {
    key: "initPagination",
    value: function initPagination() {
      var _this6 = this;

      var o = this.options;

      if (!o.pagination) {
        this.$pagination.hide();
        return;
      }

      this.$pagination.show();
      var html = [];
      var $allSelected = false;
      var i;
      var from;
      var to;
      var $pageList;
      var $pre;
      var $next;
      var $number;
      var data = this.getData({
        includeHiddenRows: false
      });
      var pageList = o.pageList;

      if (o.sidePagination !== 'server') {
        o.totalRows = data.length;
      }

      this.totalPages = 0;

      if (o.totalRows) {
        if (o.pageSize === o.formatAllRows()) {
          o.pageSize = o.totalRows;
          $allSelected = true;
        } else if (o.pageSize === o.totalRows) {
          // Fix #667 Table with pagination,
          // multiple pages and a search this matches to one page throws exception
          var pageLst = typeof o.pageList === 'string' ? o.pageList.replace('[', '').replace(']', '').replace(/ /g, '').toLowerCase().split(',') : o.pageList;

          if (pageLst.includes(o.formatAllRows().toLowerCase())) {
            $allSelected = true;
          }
        }

        this.totalPages = ~~((o.totalRows - 1) / o.pageSize) + 1;
        o.totalPages = this.totalPages;
      }

      if (this.totalPages > 0 && o.pageNumber > this.totalPages) {
        o.pageNumber = this.totalPages;
      }

      this.pageFrom = (o.pageNumber - 1) * o.pageSize + 1;
      this.pageTo = o.pageNumber * o.pageSize;

      if (this.pageTo > o.totalRows) {
        this.pageTo = o.totalRows;
      }

      if (this.options.pagination && this.options.sidePagination !== 'server') {
        this.options.totalNotFiltered = this.options.data.length;
      }

      if (!this.options.showExtendedPagination) {
        this.options.totalNotFiltered = undefined;
      }

      var paginationInfo = o.onlyInfoPagination ? o.formatDetailPagination(o.totalRows) : o.formatShowingRows(this.pageFrom, this.pageTo, o.totalRows, o.totalNotFiltered);
      html.push("<div class=\"".concat(this.constants.classes.pull, "-").concat(o.paginationDetailHAlign, " pagination-detail\">\n      <span class=\"pagination-info\">\n      ").concat(paginationInfo, "\n      </span>"));

      if (!o.onlyInfoPagination) {
        html.push('<span class="page-list">');
        var pageNumber = ["<span class=\"".concat(this.constants.classes.paginationDropdown, "\">\n        <button class=\"").concat(this.constants.buttonsClass, " dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">\n        <span class=\"page-size\">\n        ").concat($allSelected ? o.formatAllRows() : o.pageSize, "\n        </span>\n        ").concat(this.constants.html.dropdownCaret, "\n        </button>\n        ").concat(this.constants.html.pageDropdown[0])];

        if (typeof o.pageList === 'string') {
          var list = o.pageList.replace('[', '').replace(']', '').replace(/ /g, '').split(',');
          pageList = [];

          var _iterator = _createForOfIteratorHelper(list),
              _step;

          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var value = _step.value;
              pageList.push(value.toLowerCase() === o.formatAllRows().toLowerCase() || ['all', 'unlimited'].includes(value.toLowerCase()) ? o.formatAllRows() : +value);
            }
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }
        }

        pageList.forEach(function (page, i) {
          if (!o.smartDisplay || i === 0 || pageList[i - 1] < o.totalRows) {
            var active;

            if ($allSelected) {
              active = page === o.formatAllRows() ? _this6.constants.classes.dropdownActive : '';
            } else {
              active = page === o.pageSize ? _this6.constants.classes.dropdownActive : '';
            }

            pageNumber.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(_this6.constants.html.pageDropdownItem, active, page));
          }
        });
        pageNumber.push("".concat(this.constants.html.pageDropdown[1], "</span>"));
        html.push(o.formatRecordsPerPage(pageNumber.join('')));
        html.push('</span></div>');
        html.push("<div class=\"".concat(this.constants.classes.pull, "-").concat(o.paginationHAlign, " pagination\">"), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.pagination[0], _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' pagination-%s', o.iconSize)), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.paginationItem, ' page-pre', o.formatSRPaginationPreText(), o.paginationPreText));

        if (this.totalPages < o.paginationSuccessivelySize) {
          from = 1;
          to = this.totalPages;
        } else {
          from = o.pageNumber - o.paginationPagesBySide;
          to = from + o.paginationPagesBySide * 2;
        }

        if (o.pageNumber < o.paginationSuccessivelySize - 1) {
          to = o.paginationSuccessivelySize;
        }

        if (o.paginationSuccessivelySize > this.totalPages - from) {
          from = from - (o.paginationSuccessivelySize - (this.totalPages - from)) + 1;
        }

        if (from < 1) {
          from = 1;
        }

        if (to > this.totalPages) {
          to = this.totalPages;
        }

        var middleSize = Math.round(o.paginationPagesBySide / 2);

        var pageItem = function pageItem(i) {
          var classes = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
          return _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(_this6.constants.html.paginationItem, classes + (i === o.pageNumber ? " ".concat(_this6.constants.classes.paginationActive) : ''), o.formatSRPaginationPageText(i), i);
        };

        if (from > 1) {
          var max = o.paginationPagesBySide;
          if (max >= from) max = from - 1;

          for (i = 1; i <= max; i++) {
            html.push(pageItem(i));
          }

          if (from - 1 === max + 1) {
            i = from - 1;
            html.push(pageItem(i));
          } else {
            if (from - 1 > max) {
              if (from - o.paginationPagesBySide * 2 > o.paginationPagesBySide && o.paginationUseIntermediate) {
                i = Math.round((from - middleSize) / 2 + middleSize);
                html.push(pageItem(i, ' page-intermediate'));
              } else {
                html.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.paginationItem, ' page-first-separator disabled', '', '...'));
              }
            }
          }
        }

        for (i = from; i <= to; i++) {
          html.push(pageItem(i));
        }

        if (this.totalPages > to) {
          var min = this.totalPages - (o.paginationPagesBySide - 1);
          if (to >= min) min = to + 1;

          if (to + 1 === min - 1) {
            i = to + 1;
            html.push(pageItem(i));
          } else {
            if (min > to + 1) {
              if (this.totalPages - to > o.paginationPagesBySide * 2 && o.paginationUseIntermediate) {
                i = Math.round((this.totalPages - middleSize - to) / 2 + to);
                html.push(pageItem(i, ' page-intermediate'));
              } else {
                html.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.paginationItem, ' page-last-separator disabled', '', '...'));
              }
            }
          }

          for (i = min; i <= this.totalPages; i++) {
            html.push(pageItem(i));
          }
        }

        html.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.paginationItem, ' page-next', o.formatSRPaginationNextText(), o.paginationNextText));
        html.push(this.constants.html.pagination[1], '</div>');
      }

      this.$pagination.html(html.join(''));
      var dropupClass = ['bottom', 'both'].includes(o.paginationVAlign) ? " ".concat(this.constants.classes.dropup) : '';
      this.$pagination.last().find('.page-list > span').addClass(dropupClass);

      if (!o.onlyInfoPagination) {
        $pageList = this.$pagination.find('.page-list a');
        $pre = this.$pagination.find('.page-pre');
        $next = this.$pagination.find('.page-next');
        $number = this.$pagination.find('.page-item').not('.page-next, .page-pre, .page-last-separator, .page-first-separator');

        if (this.totalPages <= 1) {
          this.$pagination.find('div.pagination').hide();
        }

        if (o.smartDisplay) {
          if (pageList.length < 2 || o.totalRows <= pageList[0]) {
            this.$pagination.find('span.page-list').hide();
          }
        } // when data is empty, hide the pagination


        this.$pagination[this.getData().length ? 'show' : 'hide']();

        if (!o.paginationLoop) {
          if (o.pageNumber === 1) {
            $pre.addClass('disabled');
          }

          if (o.pageNumber === this.totalPages) {
            $next.addClass('disabled');
          }
        }

        if ($allSelected) {
          o.pageSize = o.formatAllRows();
        } // removed the events for last and first, onPageNumber executeds the same logic


        $pageList.off('click').on('click', function (e) {
          return _this6.onPageListChange(e);
        });
        $pre.off('click').on('click', function (e) {
          return _this6.onPagePre(e);
        });
        $next.off('click').on('click', function (e) {
          return _this6.onPageNext(e);
        });
        $number.off('click').on('click', function (e) {
          return _this6.onPageNumber(e);
        });
      }
    }
  }, {
    key: "updatePagination",
    value: function updatePagination(event) {
      // Fix #171: IE disabled button can be clicked bug.
      if (event && $(event.currentTarget).hasClass('disabled')) {
        return;
      }

      if (!this.options.maintainMetaData) {
        this.resetRows();
      }

      this.initPagination();

      if (this.options.sidePagination === 'server') {
        this.initServer();
      } else {
        this.initBody();
      }

      this.trigger('page-change', this.options.pageNumber, this.options.pageSize);
    }
  }, {
    key: "onPageListChange",
    value: function onPageListChange(event) {
      event.preventDefault();
      var $this = $(event.currentTarget);
      $this.parent().addClass(this.constants.classes.dropdownActive).siblings().removeClass(this.constants.classes.dropdownActive);
      this.options.pageSize = $this.text().toUpperCase() === this.options.formatAllRows().toUpperCase() ? this.options.formatAllRows() : +$this.text();
      this.$toolbar.find('.page-size').text(this.options.pageSize);
      this.updatePagination(event);
      return false;
    }
  }, {
    key: "onPagePre",
    value: function onPagePre(event) {
      event.preventDefault();

      if (this.options.pageNumber - 1 === 0) {
        this.options.pageNumber = this.options.totalPages;
      } else {
        this.options.pageNumber--;
      }

      this.updatePagination(event);
      return false;
    }
  }, {
    key: "onPageNext",
    value: function onPageNext(event) {
      event.preventDefault();

      if (this.options.pageNumber + 1 > this.options.totalPages) {
        this.options.pageNumber = 1;
      } else {
        this.options.pageNumber++;
      }

      this.updatePagination(event);
      return false;
    }
  }, {
    key: "onPageNumber",
    value: function onPageNumber(event) {
      event.preventDefault();

      if (this.options.pageNumber === +$(event.currentTarget).text()) {
        return;
      }

      this.options.pageNumber = +$(event.currentTarget).text();
      this.updatePagination(event);
      return false;
    }
  }, {
    key: "initRow",
    value: function initRow(item, i, data, trFragments) {
      var _this7 = this;

      var html = [];
      var style = {};
      var csses = [];
      var data_ = '';
      var attributes = {};
      var htmlAttributes = [];

      if (_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].findIndex(this.hiddenRows, item) > -1) {
        return;
      }

      style = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(this.options, this.options.rowStyle, [item, i], style);

      if (style && style.css) {
        for (var _i2 = 0, _Object$entries = Object.entries(style.css); _i2 < _Object$entries.length; _i2++) {
          var _ref8 = _Object$entries[_i2];

          var _ref7 = _slicedToArray(_ref8, 2);

          var key = _ref7[0];
          var value = _ref7[1];
          csses.push("".concat(key, ": ").concat(value));
        }
      }

      attributes = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(this.options, this.options.rowAttributes, [item, i], attributes);

      if (attributes) {
        for (var _i3 = 0, _Object$entries2 = Object.entries(attributes); _i3 < _Object$entries2.length; _i3++) {
          var _ref11 = _Object$entries2[_i3];

          var _ref10 = _slicedToArray(_ref11, 2);

          var _key2 = _ref10[0];
          var _value = _ref10[1];
          htmlAttributes.push("".concat(_key2, "=\"").concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].escapeHTML(_value), "\""));
        }
      }

      if (item._data && !_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isEmptyObject(item._data)) {
        for (var _i4 = 0, _Object$entries3 = Object.entries(item._data); _i4 < _Object$entries3.length; _i4++) {
          var _ref14 = _Object$entries3[_i4];

          var _ref13 = _slicedToArray(_ref14, 2);

          var k = _ref13[0];
          var v = _ref13[1];

          // ignore data-index
          if (k === 'index') {
            return;
          }

          data_ += " data-".concat(k, "='").concat(_typeof(v) === 'object' ? JSON.stringify(v) : v, "'");
        }
      }

      html.push('<tr', _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' %s', htmlAttributes.length ? htmlAttributes.join(' ') : undefined), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' id="%s"', Array.isArray(item) ? undefined : item._id), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' class="%s"', style.classes || (Array.isArray(item) ? undefined : item._class)), " data-index=\"".concat(i, "\""), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' data-uniqueid="%s"', _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].getItemField(item, this.options.uniqueId, false)), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' data-has-detail-view="%s"', !this.options.cardView && this.options.detailView && _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(null, this.options.detailFilter, [i, item]) ? 'true' : undefined), _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('%s', data_), '>');

      if (this.options.cardView) {
        html.push("<td colspan=\"".concat(this.header.fields.length, "\"><div class=\"card-views\">"));
      }

      if (!this.options.cardView && this.options.detailView && this.options.detailViewIcon) {
        html.push('<td>');

        if (_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(null, this.options.detailFilter, [i, item])) {
          html.push("\n          <a class=\"detail-icon\" href=\"#\">\n          ".concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, this.options.iconsPrefix, this.options.icons.detailOpen), "\n          </a>\n        "));
        }

        html.push('</td>');
      }

      this.header.fields.forEach(function (field, j) {
        var text = '';
        var value_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].getItemField(item, field, _this7.options.escape);
        var value = '';
        var type = '';
        var cellStyle = {};
        var id_ = '';
        var class_ = _this7.header.classes[j];
        var style_ = '';
        var data_ = '';
        var rowspan_ = '';
        var colspan_ = '';
        var title_ = '';
        var column = _this7.columns[j];

        if (_this7.fromHtml && typeof value_ === 'undefined') {
          if (!column.checkbox && !column.radio) {
            return;
          }
        }

        if (!column.visible) {
          return;
        }

        if (_this7.options.cardView && !column.cardVisible) {
          return;
        }

        if (column.escape) {
          value_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].escapeHTML(value_);
        }

        if (csses.concat([_this7.header.styles[j]]).length) {
          style_ = " style=\"".concat(csses.concat([_this7.header.styles[j]]).join('; '), "\"");
        } // handle td's id and class


        if (item["_".concat(field, "_id")]) {
          id_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' id="%s"', item["_".concat(field, "_id")]);
        }

        if (item["_".concat(field, "_class")]) {
          class_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' class="%s"', item["_".concat(field, "_class")]);
        }

        if (item["_".concat(field, "_rowspan")]) {
          rowspan_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' rowspan="%s"', item["_".concat(field, "_rowspan")]);
        }

        if (item["_".concat(field, "_colspan")]) {
          colspan_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' colspan="%s"', item["_".concat(field, "_colspan")]);
        }

        if (item["_".concat(field, "_title")]) {
          title_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' title="%s"', item["_".concat(field, "_title")]);
        }

        cellStyle = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(_this7.header, _this7.header.cellStyles[j], [value_, item, i, field], cellStyle);

        if (cellStyle.classes) {
          class_ = " class=\"".concat(cellStyle.classes, "\"");
        }

        if (cellStyle.css) {
          var csses_ = [];

          for (var _i5 = 0, _Object$entries4 = Object.entries(cellStyle.css); _i5 < _Object$entries4.length; _i5++) {
            var _ref17 = _Object$entries4[_i5];

            var _ref16 = _slicedToArray(_ref17, 2);

            var _key3 = _ref16[0];
            var _value2 = _ref16[1];
            csses_.push("".concat(_key3, ": ").concat(_value2));
          }

          style_ = " style=\"".concat(csses_.concat(_this7.header.styles[j]).join('; '), "\"");
        }

        value = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(column, _this7.header.formatters[j], [value_, item, i, field], value_);

        if (item["_".concat(field, "_data")] && !_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isEmptyObject(item["_".concat(field, "_data")])) {
          for (var _i6 = 0, _Object$entries5 = Object.entries(item["_".concat(field, "_data")]); _i6 < _Object$entries5.length; _i6++) {
            var _ref20 = _Object$entries5[_i6];

            var _ref19 = _slicedToArray(_ref20, 2);

            var _k = _ref19[0];
            var _v = _ref19[1];

            // ignore data-index
            if (_k === 'index') {
              return;
            }

            data_ += " data-".concat(_k, "=\"").concat(_v, "\"");
          }
        }

        if (column.checkbox || column.radio) {
          type = column.checkbox ? 'checkbox' : type;
          type = column.radio ? 'radio' : type;
          var c = column['class'] || '';
          var isChecked = (value === true || value_ || value && value.checked) && value !== false;
          var isDisabled = !column.checkboxEnabled || value && value.disabled;
          text = [_this7.options.cardView ? "<div class=\"card-view ".concat(c, "\">") : "<td class=\"bs-checkbox ".concat(c, "\"").concat(class_).concat(style_, ">"), "<label>\n            <input\n            data-index=\"".concat(i, "\"\n            name=\"").concat(_this7.options.selectItemName, "\"\n            type=\"").concat(type, "\"\n            ").concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('value="%s"', item[_this7.options.idField]), "\n            ").concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('checked="%s"', isChecked ? 'checked' : undefined), "\n            ").concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('disabled="%s"', isDisabled ? 'disabled' : undefined), " />\n            <span></span>\n            </label>"), _this7.header.formatters[j] && typeof value === 'string' ? value : '', _this7.options.cardView ? '</div>' : '</td>'].join('');
          item[_this7.header.stateField] = value === true || !!value_ || value && value.checked;
        } else {
          value = typeof value === 'undefined' || value === null ? _this7.options.undefinedText : value;

          if (_this7.options.cardView) {
            var cardTitle = _this7.options.showHeader ? "<span class=\"card-view-title\"".concat(style_, ">").concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].getFieldTitle(_this7.columns, field), "</span>") : '';
            text = "<div class=\"card-view\">".concat(cardTitle, "<span class=\"card-view-value\">").concat(value, "</span></div>");

            if (_this7.options.smartDisplay && value === '') {
              text = '<div class="card-view"></div>';
            }
          } else {
            text = "<td".concat(id_).concat(class_).concat(style_).concat(data_).concat(rowspan_).concat(colspan_).concat(title_, ">").concat(value, "</td>");
          }
        }

        html.push(text);
      });

      if (this.options.cardView) {
        html.push('</div></td>');
      }

      html.push('</tr>');
      return html.join('');
    }
  }, {
    key: "initBody",
    value: function initBody(fixedScroll) {
      var _this8 = this;

      var data = this.getData();
      this.trigger('pre-body', data);
      this.$body = this.$el.find('>tbody');

      if (!this.$body.length) {
        this.$body = $('<tbody></tbody>').appendTo(this.$el);
      } // Fix #389 Bootstrap-table-flatJSON is not working


      if (!this.options.pagination || this.options.sidePagination === 'server') {
        this.pageFrom = 1;
        this.pageTo = data.length;
      }

      var rows = [];
      var trFragments = $(document.createDocumentFragment());
      var hasTr = false;

      for (var i = this.pageFrom - 1; i < this.pageTo; i++) {
        var item = data[i];
        var tr = this.initRow(item, i, data, trFragments);
        hasTr = hasTr || !!tr;

        if (tr && typeof tr === 'string') {
          if (!this.options.virtualScroll) {
            trFragments.append(tr);
          } else {
            rows.push(tr);
          }
        }
      } // show no records


      if (!hasTr) {
        this.$body.html("<tr class=\"no-records-found\">".concat(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('<td colspan="%s">%s</td>', this.$header.find('th').length, this.options.formatNoMatches()), "</tr>"));
      } else {
        if (!this.options.virtualScroll) {
          this.$body.html(trFragments);
        } else {
          if (this.virtualScroll) {
            this.virtualScroll.destroy();
          }

          this.virtualScroll = new _virtual_scroll_index_js__WEBPACK_IMPORTED_MODULE_2__["default"]({
            rows: rows,
            fixedScroll: fixedScroll,
            scrollEl: this.$tableBody[0],
            contentEl: this.$body[0],
            itemHeight: this.options.virtualScrollItemHeight,
            callback: function callback() {
              _this8.fitHeader();

              _this8.initBodyEvent();
            }
          });
        }
      }

      if (!fixedScroll) {
        this.scrollTo(0);
      }

      this.initBodyEvent();
      this.updateSelected();
      this.initFooter();
      this.resetView();

      if (this.options.sidePagination !== 'server') {
        this.options.totalRows = data.length;
      }

      this.trigger('post-body', data);
    }
  }, {
    key: "initBodyEvent",
    value: function initBodyEvent() {
      var _this9 = this;

      // click to select by column
      this.$body.find('> tr[data-index] > td').off('click dblclick').on('click dblclick', function (e) {
        var $td = $(e.currentTarget);
        var $tr = $td.parent();
        var $cardViewArr = $(e.target).parents('.card-views').children();
        var $cardViewTarget = $(e.target).parents('.card-view');
        var rowIndex = $tr.data('index');
        var item = _this9.data[rowIndex];
        var index = _this9.options.cardView ? $cardViewArr.index($cardViewTarget) : $td[0].cellIndex;

        var fields = _this9.getVisibleFields();

        var field = fields[_this9.options.detailView && _this9.options.detailViewIcon && !_this9.options.cardView ? index - 1 : index];
        var column = _this9.columns[_this9.fieldsColumnsIndex[field]];
        var value = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].getItemField(item, field, _this9.options.escape);

        if ($td.find('.detail-icon').length) {
          return;
        }

        _this9.trigger(e.type === 'click' ? 'click-cell' : 'dbl-click-cell', field, value, item, $td);

        _this9.trigger(e.type === 'click' ? 'click-row' : 'dbl-click-row', item, $tr, field); // if click to select - then trigger the checkbox/radio click


        if (e.type === 'click' && _this9.options.clickToSelect && column.clickToSelect && !_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(_this9.options, _this9.options.ignoreClickToSelectOn, [e.target])) {
          var $selectItem = $tr.find(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('[name="%s"]', _this9.options.selectItemName));

          if ($selectItem.length) {
            $selectItem[0].click();
          }
        }

        if (e.type === 'click' && _this9.options.detailViewByClick) {
          _this9.toggleDetailView(rowIndex, _this9.header.detailFormatters[_this9.fieldsColumnsIndex[field]]);
        }
      }).off('mousedown').on('mousedown', function (e) {
        // https://github.com/jquery/jquery/issues/1741
        _this9.multipleSelectRowCtrlKey = e.ctrlKey || e.metaKey;
        _this9.multipleSelectRowShiftKey = e.shiftKey;
      });
      this.$body.find('> tr[data-index] > td > .detail-icon').off('click').on('click', function (e) {
        e.preventDefault();

        _this9.toggleDetailView($(e.currentTarget).parent().parent().data('index'));

        return false;
      });
      this.$selectItem = this.$body.find(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('[name="%s"]', this.options.selectItemName));
      this.$selectItem.off('click').on('click', function (e) {
        e.stopImmediatePropagation();
        var $this = $(e.currentTarget);

        _this9._toggleCheck($this.prop('checked'), $this.data('index'));
      });
      this.header.events.forEach(function (_events, i) {
        var events = _events;

        if (!events) {
          return;
        } // fix bug, if events is defined with namespace


        if (typeof events === 'string') {
          events = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(null, events);
        }

        var field = _this9.header.fields[i];

        var fieldIndex = _this9.getVisibleFields().indexOf(field);

        if (fieldIndex === -1) {
          return;
        }

        if (_this9.options.detailView && !_this9.options.cardView) {
          fieldIndex += 1;
        }

        var _loop = function _loop(key) {
          if (!events.hasOwnProperty(key)) {
            return "continue";
          }

          var event = events[key];

          _this9.$body.find('>tr:not(.no-records-found)').each(function (i, tr) {
            var $tr = $(tr);
            var $td = $tr.find(_this9.options.cardView ? '.card-views>.card-view' : '>td').eq(fieldIndex);
            var index = key.indexOf(' ');
            var name = key.substring(0, index);
            var el = key.substring(index + 1);
            $td.find(el).off(name).on(name, function (e) {
              var index = $tr.data('index');
              var row = _this9.data[index];
              var value = row[field];
              event.apply(_this9, [e, value, row, index]);
            });
          });
        };

        for (var key in events) {
          var _ret = _loop(key);

          if (_ret === "continue") continue;
        }
      });
    }
  }, {
    key: "initServer",
    value: function initServer(silent, query, url) {
      var _this10 = this;

      var data = {};
      var index = this.header.fields.indexOf(this.options.sortName);
      var params = {
        searchText: this.searchText,
        sortName: this.options.sortName,
        sortOrder: this.options.sortOrder
      };

      if (this.header.sortNames[index]) {
        params.sortName = this.header.sortNames[index];
      }

      if (this.options.pagination && this.options.sidePagination === 'server') {
        params.pageSize = this.options.pageSize === this.options.formatAllRows() ? this.options.totalRows : this.options.pageSize;
        params.pageNumber = this.options.pageNumber;
      }

      if (!(url || this.options.url) && !this.options.ajax) {
        return;
      }

      if (this.options.queryParamsType === 'limit') {
        params = {
          search: params.searchText,
          sort: params.sortName,
          order: params.sortOrder
        };

        if (this.options.pagination && this.options.sidePagination === 'server') {
          params.offset = this.options.pageSize === this.options.formatAllRows() ? 0 : this.options.pageSize * (this.options.pageNumber - 1);
          params.limit = this.options.pageSize === this.options.formatAllRows() ? this.options.totalRows : this.options.pageSize;

          if (params.limit === 0) {
            delete params.limit;
          }
        }
      }

      if (!_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isEmptyObject(this.filterColumnsPartial)) {
        params.filter = JSON.stringify(this.filterColumnsPartial, null);
      }

      $.extend(params, query || {});
      data = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(this.options, this.options.queryParams, [params], data); // false to stop request

      if (data === false) {
        return;
      }

      if (!silent) {
        this.showLoading();
      }

      var request = $.extend({}, _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(null, this.options.ajaxOptions), {
        type: this.options.method,
        url: url || this.options.url,
        data: this.options.contentType === 'application/json' && this.options.method === 'post' ? JSON.stringify(data) : data,
        cache: this.options.cache,
        contentType: this.options.contentType,
        dataType: this.options.dataType,
        success: function success(_res, textStatus, jqXHR) {
          var res = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(_this10.options, _this10.options.responseHandler, [_res, jqXHR], _res);

          _this10.load(res);

          _this10.trigger('load-success', res, jqXHR.status, jqXHR);

          if (!silent) {
            _this10.hideLoading();
          }
        },
        error: function error(jqXHR) {
          var data = [];

          if (_this10.options.sidePagination === 'server') {
            data = {};
            data[_this10.options.totalField] = 0;
            data[_this10.options.dataField] = [];
          }

          _this10.load(data);

          _this10.trigger('load-error', jqXHR.status, jqXHR);

          if (!silent) _this10.$tableLoading.hide();
        }
      });

      if (this.options.ajax) {
        _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(this, this.options.ajax, [request], null);
      } else {
        if (this._xhr && this._xhr.readyState !== 4) {
          this._xhr.abort();
        }

        this._xhr = $.ajax(request);
      }

      return data;
    }
  }, {
    key: "initSearchText",
    value: function initSearchText() {
      if (this.options.search) {
        this.searchText = '';

        if (this.options.searchText !== '') {
          var $search = this.$toolbar.find('.search input');
          $search.val(this.options.searchText);
          this.onSearch({
            currentTarget: $search,
            firedByInitSearchText: true
          });
        }
      }
    }
  }, {
    key: "getCaret",
    value: function getCaret() {
      var _this11 = this;

      this.$header.find('th').each(function (i, th) {
        $(th).find('.sortable').removeClass('desc asc').addClass($(th).data('field') === _this11.options.sortName ? _this11.options.sortOrder : 'both');
      });
    }
  }, {
    key: "updateSelected",
    value: function updateSelected() {
      var checkAll = this.$selectItem.filter(':enabled').length && this.$selectItem.filter(':enabled').length === this.$selectItem.filter(':enabled').filter(':checked').length;
      this.$selectAll.add(this.$selectAll_).prop('checked', checkAll);
      this.$selectItem.each(function (i, el) {
        $(el).closest('tr')[$(el).prop('checked') ? 'addClass' : 'removeClass']('selected');
      });
    }
  }, {
    key: "updateRows",
    value: function updateRows() {
      var _this12 = this;

      this.$selectItem.each(function (i, el) {
        _this12.data[$(el).data('index')][_this12.header.stateField] = $(el).prop('checked');
      });
    }
  }, {
    key: "resetRows",
    value: function resetRows() {
      var _iterator2 = _createForOfIteratorHelper(this.data),
          _step2;

      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          var row = _step2.value;
          this.$selectAll.prop('checked', false);
          this.$selectItem.prop('checked', false);

          if (this.header.stateField) {
            row[this.header.stateField] = false;
          }
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }

      this.initHiddenRows();
    }
  }, {
    key: "trigger",
    value: function trigger(_name) {
      var _this$options;

      var name = "".concat(_name, ".bs.table");

      for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key4 = 1; _key4 < _len; _key4++) {
        args[_key4 - 1] = arguments[_key4];
      }

      (_this$options = this.options)[BootstrapTable.EVENTS[name]].apply(_this$options, args);

      this.$el.trigger($.Event(name), args);
      this.options.onAll(name, args);
      this.$el.trigger($.Event('all.bs.table'), [name, args]);
    }
  }, {
    key: "resetHeader",
    value: function resetHeader() {
      var _this13 = this;

      // fix #61: the hidden table reset header bug.
      // fix bug: get $el.css('width') error sometime (height = 500)
      clearTimeout(this.timeoutId_);
      this.timeoutId_ = setTimeout(function () {
        return _this13.fitHeader();
      }, this.$el.is(':hidden') ? 100 : 0);
    }
  }, {
    key: "fitHeader",
    value: function fitHeader() {
      var _this14 = this;

      if (this.$el.is(':hidden')) {
        this.timeoutId_ = setTimeout(function () {
          return _this14.fitHeader();
        }, 100);
        return;
      }

      var fixedBody = this.$tableBody.get(0);
      var scrollWidth = fixedBody.scrollWidth > fixedBody.clientWidth && fixedBody.scrollHeight > fixedBody.clientHeight + this.$header.outerHeight() ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].getScrollBarWidth() : 0;
      this.$el.css('margin-top', -this.$header.outerHeight());
      var focused = $(':focus');

      if (focused.length > 0) {
        var $th = focused.parents('th');

        if ($th.length > 0) {
          var dataField = $th.attr('data-field');

          if (dataField !== undefined) {
            var $headerTh = this.$header.find("[data-field='".concat(dataField, "']"));

            if ($headerTh.length > 0) {
              $headerTh.find(':input').addClass('focus-temp');
            }
          }
        }
      }

      this.$header_ = this.$header.clone(true, true);
      this.$selectAll_ = this.$header_.find('[name="btSelectAll"]');
      this.$tableHeader.css('margin-right', scrollWidth).find('table').css('width', this.$el.outerWidth()).html('').attr('class', this.$el.attr('class')).append(this.$header_);
      this.$tableLoading.css('width', this.$el.outerWidth());
      var focusedTemp = $('.focus-temp:visible:eq(0)');

      if (focusedTemp.length > 0) {
        focusedTemp.focus();
        this.$header.find('.focus-temp').removeClass('focus-temp');
      } // fix bug: $.data() is not working as expected after $.append()


      this.$header.find('th[data-field]').each(function (i, el) {
        _this14.$header_.find(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('th[data-field="%s"]', $(el).data('field'))).data($(el).data());
      });
      var visibleFields = this.getVisibleFields();
      var $ths = this.$header_.find('th');
      var $tr = this.$body.find('>tr:not(.no-records-found,.virtual-scroll-top)').eq(0);

      while ($tr.length && $tr.find('>td[colspan]:not([colspan="1"])').length) {
        $tr = $tr.next();
      }

      $tr.find('> *').each(function (i, el) {
        var $this = $(el);
        var index = i;

        if (_this14.options.detailView && _this14.options.detailViewIcon && !_this14.options.cardView) {
          if (i === 0) {
            var $thDetail = $ths.filter('.detail');

            var _zoomWidth = $thDetail.innerWidth() - $thDetail.find('.fht-cell').width();

            $thDetail.find('.fht-cell').width($this.innerWidth() - _zoomWidth);
          }

          index = i - 1;
        }

        if (index === -1) {
          return;
        }

        var $th = _this14.$header_.find(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('th[data-field="%s"]', visibleFields[index]));

        if ($th.length > 1) {
          $th = $($ths[$this[0].cellIndex]);
        }

        var zoomWidth = $th.innerWidth() - $th.find('.fht-cell').width();
        $th.find('.fht-cell').width($this.innerWidth() - zoomWidth);
      });
      this.horizontalScroll();
      this.trigger('post-header');
    }
  }, {
    key: "initFooter",
    value: function initFooter() {
      if (!this.options.showFooter || this.options.cardView) {
        // do nothing
        return;
      }

      var data = this.getData();
      var html = [];

      if (!this.options.cardView && this.options.detailView && this.options.detailViewIcon) {
        html.push('<th class="detail"><div class="th-inner"></div><div class="fht-cell"></div></th>');
      }

      var _iterator3 = _createForOfIteratorHelper(this.columns),
          _step3;

      try {
        for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
          var column = _step3.value;
          var falign = '';
          var valign = '';
          var csses = [];
          var style = {};
          var class_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' class="%s"', column['class']);

          if (!column.visible) {
            continue;
          }

          if (this.options.cardView && !column.cardVisible) {
            return;
          }

          falign = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('text-align: %s; ', column.falign ? column.falign : column.align);
          valign = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('vertical-align: %s; ', column.valign);
          style = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(null, this.options.footerStyle, [column]);

          if (style && style.css) {
            for (var _i7 = 0, _Object$entries6 = Object.entries(style.css); _i7 < _Object$entries6.length; _i7++) {
              var _ref23 = _Object$entries6[_i7];

              var _ref22 = _slicedToArray(_ref23, 2);

              var key = _ref22[0];
              var value = _ref22[1];
              csses.push("".concat(key, ": ").concat(value));
            }
          }

          if (style && style.classes) {
            class_ = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' class="%s"', column['class'] ? [column['class'], style.classes].join(' ') : style.classes);
          }

          html.push('<th', class_, _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(' style="%s"', falign + valign + csses.concat().join('; ')), '>');
          html.push('<div class="th-inner">');
          html.push(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(column, column.footerFormatter, [data], this.footerData[0] && this.footerData[0][column.field] || ''));
          html.push('</div>');
          html.push('<div class="fht-cell"></div>');
          html.push('</div>');
          html.push('</th>');
        }
      } catch (err) {
        _iterator3.e(err);
      } finally {
        _iterator3.f();
      }

      this.$tableFooter.find('tr').html(html.join(''));
      this.trigger('post-footer', this.$tableFooter);
    }
  }, {
    key: "fitFooter",
    value: function fitFooter() {
      var _this15 = this;

      if (this.$el.is(':hidden')) {
        setTimeout(function () {
          return _this15.fitFooter();
        }, 100);
        return;
      }

      var fixedBody = this.$tableBody.get(0);
      var scrollWidth = fixedBody.scrollWidth > fixedBody.clientWidth && fixedBody.scrollHeight > fixedBody.clientHeight + this.$header.outerHeight() ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].getScrollBarWidth() : 0;
      this.$tableFooter.css('margin-right', scrollWidth).find('table').css('width', this.$el.outerWidth()).attr('class', this.$el.attr('class'));
      var visibleFields = this.getVisibleFields();
      var $ths = this.$tableFooter.find('th');
      var $tr = this.$body.find('>tr:first-child:not(.no-records-found)');

      while ($tr.length && $tr.find('>td[colspan]:not([colspan="1"])').length) {
        $tr = $tr.next();
      }

      $tr.find('> *').each(function (i, el) {
        var $this = $(el);
        var index = i;

        if (_this15.options.detailView && !_this15.options.cardView) {
          if (i === 0) {
            var $thDetail = $ths.filter('.detail');

            var _zoomWidth2 = $thDetail.innerWidth() - $thDetail.find('.fht-cell').width();

            $thDetail.find('.fht-cell').width($this.innerWidth() - _zoomWidth2);
          }

          index = i - 1;
        }

        if (index === -1) {
          return;
        }

        var $th = $ths.eq(i);
        var zoomWidth = $th.innerWidth() - $th.find('.fht-cell').width();
        $th.find('.fht-cell').width($this.innerWidth() - zoomWidth);
      });
      this.horizontalScroll();
    }
  }, {
    key: "horizontalScroll",
    value: function horizontalScroll() {
      var _this16 = this;

      // horizontal scroll event
      // TODO: it's probably better improving the layout than binding to scroll event
      this.$tableBody.off('scroll').on('scroll', function (_ref24) {
        var currentTarget = _ref24.currentTarget;

        if (_this16.options.showHeader && _this16.options.height) {
          _this16.$tableHeader.scrollLeft($(currentTarget).scrollLeft());
        }

        if (_this16.options.showFooter && !_this16.options.cardView) {
          _this16.$tableFooter.scrollLeft($(currentTarget).scrollLeft());
        }

        _this16.trigger('scroll-body', $(currentTarget));
      });
    }
  }, {
    key: "getVisibleFields",
    value: function getVisibleFields() {
      var visibleFields = [];

      var _iterator4 = _createForOfIteratorHelper(this.header.fields),
          _step4;

      try {
        for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
          var field = _step4.value;
          var column = this.columns[this.fieldsColumnsIndex[field]];

          if (!column || !column.visible) {
            continue;
          }

          visibleFields.push(field);
        }
      } catch (err) {
        _iterator4.e(err);
      } finally {
        _iterator4.f();
      }

      return visibleFields;
    }
  }, {
    key: "initHiddenRows",
    value: function initHiddenRows() {
      this.hiddenRows = [];
    } // PUBLIC FUNCTION DEFINITION
    // =======================

  }, {
    key: "getOptions",
    value: function getOptions() {
      // deep copy and remove data
      var options = $.extend({}, this.options);
      delete options.data;
      return $.extend(true, {}, options);
    }
  }, {
    key: "refreshOptions",
    value: function refreshOptions(options) {
      // If the objects are equivalent then avoid the call of destroy / init methods
      if (_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].compareObjects(this.options, options, true)) {
        return;
      }

      this.options = $.extend(this.options, options);
      this.trigger('refresh-options', this.options);
      this.destroy();
      this.init();
    }
  }, {
    key: "getData",
    value: function getData(params) {
      var data = this.options.data;

      if (this.searchText || this.options.sortName || !_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isEmptyObject(this.filterColumns) || !_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isEmptyObject(this.filterColumnsPartial)) {
        data = this.data;
      }

      if (params && params.useCurrentPage) {
        data = data.slice(this.pageFrom - 1, this.pageTo);
      }

      if (params && !params.includeHiddenRows) {
        var hiddenRows = this.getHiddenRows();
        data = data.filter(function (row) {
          return _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].findIndex(hiddenRows, row) === -1;
        });
      }

      return data;
    }
  }, {
    key: "getSelections",
    value: function getSelections() {
      var _this17 = this;

      // fix #2424: from html with checkbox
      return this.data.filter(function (row) {
        return row[_this17.header.stateField] === true;
      });
    }
  }, {
    key: "getAllSelections",
    value: function getAllSelections() {
      var _this18 = this;

      return this.options.data.filter(function (row) {
        return row[_this18.header.stateField] === true;
      });
    }
  }, {
    key: "load",
    value: function load(_data) {
      var fixedScroll = false;
      var data = _data; // #431: support pagination

      if (this.options.pagination && this.options.sidePagination === 'server') {
        this.options.totalRows = data[this.options.totalField];
      }

      if (this.options.pagination && this.options.sidePagination === 'server') {
        this.options.totalNotFiltered = data[this.options.totalNotFilteredField];
      }

      fixedScroll = data.fixedScroll;
      data = Array.isArray(data) ? data : data[this.options.dataField];
      this.initData(data);
      this.initSearch();
      this.initPagination();
      this.initBody(fixedScroll);
    }
  }, {
    key: "append",
    value: function append(data) {
      this.initData(data, 'append');
      this.initSearch();
      this.initPagination();
      this.initSort();
      this.initBody(true);
    }
  }, {
    key: "prepend",
    value: function prepend(data) {
      this.initData(data, 'prepend');
      this.initSearch();
      this.initPagination();
      this.initSort();
      this.initBody(true);
    }
  }, {
    key: "remove",
    value: function remove(params) {
      var len = this.options.data.length;
      var i;
      var row;

      if (!params.hasOwnProperty('field') || !params.hasOwnProperty('values')) {
        return;
      }

      for (i = len - 1; i >= 0; i--) {
        row = this.options.data[i];

        if (!row.hasOwnProperty(params.field)) {
          continue;
        }

        if (params.values.includes(row[params.field])) {
          this.options.data.splice(i, 1);

          if (this.options.sidePagination === 'server') {
            this.options.totalRows -= 1;
          }
        }
      }

      if (len === this.options.data.length) {
        return;
      }

      this.initSearch();
      this.initPagination();
      this.initSort();
      this.initBody(true);
    }
  }, {
    key: "removeAll",
    value: function removeAll() {
      if (this.options.data.length > 0) {
        this.options.data.splice(0, this.options.data.length);
        this.initSearch();
        this.initPagination();
        this.initBody(true);
      }
    }
  }, {
    key: "insertRow",
    value: function insertRow(params) {
      if (!params.hasOwnProperty('index') || !params.hasOwnProperty('row')) {
        return;
      }

      this.options.data.splice(params.index, 0, params.row);
      this.initSearch();
      this.initPagination();
      this.initSort();
      this.initBody(true);
    }
  }, {
    key: "updateRow",
    value: function updateRow(params) {
      var allParams = Array.isArray(params) ? params : [params];

      var _iterator5 = _createForOfIteratorHelper(allParams),
          _step5;

      try {
        for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
          var _params = _step5.value;

          if (!_params.hasOwnProperty('index') || !_params.hasOwnProperty('row')) {
            continue;
          }

          $.extend(this.options.data[_params.index], _params.row);

          if (_params.hasOwnProperty('replace') && _params.replace) {
            this.options.data[_params.index] = _params.row;
          } else {
            $.extend(this.options.data[_params.index], _params.row);
          }
        }
      } catch (err) {
        _iterator5.e(err);
      } finally {
        _iterator5.f();
      }

      this.initSearch();
      this.initPagination();
      this.initSort();
      this.initBody(true);
    }
  }, {
    key: "getRowByUniqueId",
    value: function getRowByUniqueId(_id) {
      var uniqueId = this.options.uniqueId;
      var len = this.options.data.length;
      var id = _id;
      var dataRow = null;
      var i;
      var row;
      var rowUniqueId;

      for (i = len - 1; i >= 0; i--) {
        row = this.options.data[i];

        if (row.hasOwnProperty(uniqueId)) {
          // uniqueId is a column
          rowUniqueId = row[uniqueId];
        } else if (row._data && row._data.hasOwnProperty(uniqueId)) {
          // uniqueId is a row data property
          rowUniqueId = row._data[uniqueId];
        } else {
          continue;
        }

        if (typeof rowUniqueId === 'string') {
          id = id.toString();
        } else if (typeof rowUniqueId === 'number') {
          if (Number(rowUniqueId) === rowUniqueId && rowUniqueId % 1 === 0) {
            id = parseInt(id);
          } else if (rowUniqueId === Number(rowUniqueId) && rowUniqueId !== 0) {
            id = parseFloat(id);
          }
        }

        if (rowUniqueId === id) {
          dataRow = row;
          break;
        }
      }

      return dataRow;
    }
  }, {
    key: "updateByUniqueId",
    value: function updateByUniqueId(params) {
      var allParams = Array.isArray(params) ? params : [params];

      var _iterator6 = _createForOfIteratorHelper(allParams),
          _step6;

      try {
        for (_iterator6.s(); !(_step6 = _iterator6.n()).done;) {
          var _params2 = _step6.value;

          if (!_params2.hasOwnProperty('id') || !_params2.hasOwnProperty('row')) {
            continue;
          }

          var rowId = this.options.data.indexOf(this.getRowByUniqueId(_params2.id));

          if (rowId === -1) {
            continue;
          }

          if (_params2.hasOwnProperty('replace') && _params2.replace) {
            this.options.data[rowId] = _params2.row;
          } else {
            $.extend(this.options.data[rowId], _params2.row);
          }
        }
      } catch (err) {
        _iterator6.e(err);
      } finally {
        _iterator6.f();
      }

      this.initSearch();
      this.initPagination();
      this.initSort();
      this.initBody(true);
    }
  }, {
    key: "removeByUniqueId",
    value: function removeByUniqueId(id) {
      var len = this.options.data.length;
      var row = this.getRowByUniqueId(id);

      if (row) {
        this.options.data.splice(this.options.data.indexOf(row), 1);
      }

      if (len === this.options.data.length) {
        return;
      }

      this.initSearch();
      this.initPagination();
      this.initBody(true);
    }
  }, {
    key: "updateCell",
    value: function updateCell(params) {
      if (!params.hasOwnProperty('index') || !params.hasOwnProperty('field') || !params.hasOwnProperty('value')) {
        return;
      }

      this.data[params.index][params.field] = params.value;

      if (params.reinit === false) {
        return;
      }

      this.initSort();
      this.initBody(true);
    }
  }, {
    key: "updateCellByUniqueId",
    value: function updateCellByUniqueId(params) {
      var _this19 = this;

      if (!params.hasOwnProperty('id') || !params.hasOwnProperty('field') || !params.hasOwnProperty('value')) {
        return;
      }

      var allParams = Array.isArray(params) ? params : [params];
      allParams.forEach(function (_ref25) {
        var id = _ref25.id,
            field = _ref25.field,
            value = _ref25.value;

        var rowId = _this19.options.data.indexOf(_this19.getRowByUniqueId(id));

        if (rowId === -1) {
          return;
        }

        _this19.options.data[rowId][field] = value;
      });

      if (params.reinit === false) {
        return;
      }

      this.initSort();
      this.initBody(true);
    }
  }, {
    key: "showRow",
    value: function showRow(params) {
      this._toggleRow(params, true);
    }
  }, {
    key: "hideRow",
    value: function hideRow(params) {
      this._toggleRow(params, false);
    }
  }, {
    key: "_toggleRow",
    value: function _toggleRow(params, visible) {
      var row;

      if (params.hasOwnProperty('index')) {
        row = this.getData()[params.index];
      } else if (params.hasOwnProperty('uniqueId')) {
        row = this.getRowByUniqueId(params.uniqueId);
      }

      if (!row) {
        return;
      }

      var index = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].findIndex(this.hiddenRows, row);

      if (!visible && index === -1) {
        this.hiddenRows.push(row);
      } else if (visible && index > -1) {
        this.hiddenRows.splice(index, 1);
      }

      if (visible) {
        this.updatePagination();
      } else {
        this.initBody(true);
        this.initPagination();
      }
    }
  }, {
    key: "getHiddenRows",
    value: function getHiddenRows(show) {
      if (show) {
        this.initHiddenRows();
        this.initBody(true);
        return;
      }

      var data = this.getData();
      var rows = [];

      var _iterator7 = _createForOfIteratorHelper(data),
          _step7;

      try {
        for (_iterator7.s(); !(_step7 = _iterator7.n()).done;) {
          var row = _step7.value;

          if (this.hiddenRows.includes(row)) {
            rows.push(row);
          }
        }
      } catch (err) {
        _iterator7.e(err);
      } finally {
        _iterator7.f();
      }

      this.hiddenRows = rows;
      return rows;
    }
  }, {
    key: "showColumn",
    value: function showColumn(field) {
      var _this20 = this;

      var fields = Array.isArray(field) ? field : [field];
      fields.forEach(function (field) {
        _this20._toggleColumn(_this20.fieldsColumnsIndex[field], true, true);
      });
    }
  }, {
    key: "hideColumn",
    value: function hideColumn(field) {
      var _this21 = this;

      var fields = Array.isArray(field) ? field : [field];
      fields.forEach(function (field) {
        _this21._toggleColumn(_this21.fieldsColumnsIndex[field], false, true);
      });
    }
  }, {
    key: "_toggleColumn",
    value: function _toggleColumn(index, checked, needUpdate) {
      if (index === -1 || this.columns[index].visible === checked) {
        return;
      }

      this.columns[index].visible = checked;
      this.initHeader();
      this.initSearch();
      this.initPagination();
      this.initBody();

      if (this.options.showColumns) {
        var $items = this.$toolbar.find('.keep-open input').prop('disabled', false);

        if (needUpdate) {
          $items.filter(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('[value="%s"]', index)).prop('checked', checked);
        }

        if ($items.filter(':checked').length <= this.options.minimumCountColumns) {
          $items.filter(':checked').prop('disabled', true);
        }
      }
    }
  }, {
    key: "getVisibleColumns",
    value: function getVisibleColumns() {
      return this.columns.filter(function (_ref26) {
        var visible = _ref26.visible;
        return visible;
      });
    }
  }, {
    key: "getHiddenColumns",
    value: function getHiddenColumns() {
      return this.columns.filter(function (_ref27) {
        var visible = _ref27.visible;
        return !visible;
      });
    }
  }, {
    key: "showAllColumns",
    value: function showAllColumns() {
      this._toggleAllColumns(true);
    }
  }, {
    key: "hideAllColumns",
    value: function hideAllColumns() {
      this._toggleAllColumns(false);
    }
  }, {
    key: "_toggleAllColumns",
    value: function _toggleAllColumns(visible) {
      var _this22 = this;

      var _iterator8 = _createForOfIteratorHelper(this.columns.slice().reverse()),
          _step8;

      try {
        for (_iterator8.s(); !(_step8 = _iterator8.n()).done;) {
          var column = _step8.value;

          if (column.switchable) {
            if (!visible && this.options.showColumns && this.getVisibleColumns().length === this.options.minimumCountColumns) {
              continue;
            }

            column.visible = visible;
          }
        }
      } catch (err) {
        _iterator8.e(err);
      } finally {
        _iterator8.f();
      }

      this.initHeader();
      this.initSearch();
      this.initPagination();
      this.initBody();

      if (this.options.showColumns) {
        var $items = this.$toolbar.find('.keep-open input:not(".toggle-all")').prop('disabled', false);

        if (visible) {
          $items.prop('checked', visible);
        } else {
          $items.get().reverse().forEach(function (item) {
            if ($items.filter(':checked').length > _this22.options.minimumCountColumns) {
              $(item).prop('checked', visible);
            }
          });
        }

        if ($items.filter(':checked').length <= this.options.minimumCountColumns) {
          $items.filter(':checked').prop('disabled', true);
        }
      }
    }
  }, {
    key: "mergeCells",
    value: function mergeCells(options) {
      var row = options.index;
      var col = this.getVisibleFields().indexOf(options.field);
      var rowspan = options.rowspan || 1;
      var colspan = options.colspan || 1;
      var i;
      var j;
      var $tr = this.$body.find('>tr');

      if (this.options.detailView && !this.options.cardView) {
        col += 1;
      }

      var $td = $tr.eq(row).find('>td').eq(col);

      if (row < 0 || col < 0 || row >= this.data.length) {
        return;
      }

      for (i = row; i < row + rowspan; i++) {
        for (j = col; j < col + colspan; j++) {
          $tr.eq(i).find('>td').eq(j).hide();
        }
      }

      $td.attr('rowspan', rowspan).attr('colspan', colspan).show();
    }
  }, {
    key: "checkAll",
    value: function checkAll() {
      this._toggleCheckAll(true);
    }
  }, {
    key: "uncheckAll",
    value: function uncheckAll() {
      this._toggleCheckAll(false);
    }
  }, {
    key: "_toggleCheckAll",
    value: function _toggleCheckAll(checked) {
      var rowsBefore = this.getSelections();
      this.$selectAll.add(this.$selectAll_).prop('checked', checked);
      this.$selectItem.filter(':enabled').prop('checked', checked);
      this.updateRows();
      var rowsAfter = this.getSelections();

      if (checked) {
        this.trigger('check-all', rowsAfter, rowsBefore);
        return;
      }

      this.trigger('uncheck-all', rowsAfter, rowsBefore);
    }
  }, {
    key: "checkInvert",
    value: function checkInvert() {
      var $items = this.$selectItem.filter(':enabled');
      var checked = $items.filter(':checked');
      $items.each(function (i, el) {
        $(el).prop('checked', !$(el).prop('checked'));
      });
      this.updateRows();
      this.updateSelected();
      this.trigger('uncheck-some', checked);
      checked = this.getSelections();
      this.trigger('check-some', checked);
    }
  }, {
    key: "check",
    value: function check(index) {
      this._toggleCheck(true, index);
    }
  }, {
    key: "uncheck",
    value: function uncheck(index) {
      this._toggleCheck(false, index);
    }
  }, {
    key: "_toggleCheck",
    value: function _toggleCheck(checked, index) {
      var $el = this.$selectItem.filter("[data-index=\"".concat(index, "\"]"));
      var row = this.data[index];

      if ($el.is(':radio') || this.options.singleSelect || this.options.multipleSelectRow && !this.multipleSelectRowCtrlKey && !this.multipleSelectRowShiftKey) {
        var _iterator9 = _createForOfIteratorHelper(this.options.data),
            _step9;

        try {
          for (_iterator9.s(); !(_step9 = _iterator9.n()).done;) {
            var r = _step9.value;
            r[this.header.stateField] = false;
          }
        } catch (err) {
          _iterator9.e(err);
        } finally {
          _iterator9.f();
        }

        this.$selectItem.filter(':checked').not($el).prop('checked', false);
      }

      row[this.header.stateField] = checked;

      if (this.options.multipleSelectRow) {
        if (this.multipleSelectRowShiftKey && this.multipleSelectRowLastSelectedIndex >= 0) {
          var indexes = [this.multipleSelectRowLastSelectedIndex, index].sort();

          for (var i = indexes[0] + 1; i < indexes[1]; i++) {
            this.data[i][this.header.stateField] = true;
            this.$selectItem.filter("[data-index=\"".concat(i, "\"]")).prop('checked', true);
          }
        }

        this.multipleSelectRowCtrlKey = false;
        this.multipleSelectRowShiftKey = false;
        this.multipleSelectRowLastSelectedIndex = checked ? index : -1;
      }

      $el.prop('checked', checked);
      this.updateSelected();
      this.trigger(checked ? 'check' : 'uncheck', this.data[index], $el);
    }
  }, {
    key: "checkBy",
    value: function checkBy(obj) {
      this._toggleCheckBy(true, obj);
    }
  }, {
    key: "uncheckBy",
    value: function uncheckBy(obj) {
      this._toggleCheckBy(false, obj);
    }
  }, {
    key: "_toggleCheckBy",
    value: function _toggleCheckBy(checked, obj) {
      var _this23 = this;

      if (!obj.hasOwnProperty('field') || !obj.hasOwnProperty('values')) {
        return;
      }

      var rows = [];
      this.data.forEach(function (row, i) {
        if (!row.hasOwnProperty(obj.field)) {
          return false;
        }

        if (obj.values.includes(row[obj.field])) {
          var $el = _this23.$selectItem.filter(':enabled').filter(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('[data-index="%s"]', i));

          $el = checked ? $el.not(':checked') : $el.filter(':checked');

          if (!$el.length) {
            return;
          }

          $el.prop('checked', checked);
          row[_this23.header.stateField] = checked;
          rows.push(row);

          _this23.trigger(checked ? 'check' : 'uncheck', row, $el);
        }
      });
      this.updateSelected();
      this.trigger(checked ? 'check-some' : 'uncheck-some', rows);
    }
  }, {
    key: "refresh",
    value: function refresh(params) {
      if (params && params.url) {
        this.options.url = params.url;
      }

      if (params && params.pageNumber) {
        this.options.pageNumber = params.pageNumber;
      }

      if (params && params.pageSize) {
        this.options.pageSize = params.pageSize;
      }

      this.trigger('refresh', this.initServer(params && params.silent, params && params.query, params && params.url));
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this.$el.insertBefore(this.$container);
      $(this.options.toolbar).insertBefore(this.$el);
      this.$container.next().remove();
      this.$container.remove();
      this.$el.html(this.$el_.html()).css('margin-top', '0').attr('class', this.$el_.attr('class') || ''); // reset the class
    }
  }, {
    key: "resetView",
    value: function resetView(params) {
      var padding = 0;

      if (params && params.height) {
        this.options.height = params.height;
      }

      this.$selectAll.prop('checked', this.$selectItem.length > 0 && this.$selectItem.length === this.$selectItem.filter(':checked').length);
      this.$tableContainer.toggleClass('has-card-view', this.options.cardView);

      if (!this.options.cardView && this.options.showHeader && this.options.height) {
        this.$tableHeader.show();
        this.resetHeader();
        padding += this.$header.outerHeight(true) + 1;
      } else {
        this.$tableHeader.hide();
        this.trigger('post-header');
      }

      if (!this.options.cardView && this.options.showFooter) {
        this.$tableFooter.show();
        this.fitFooter();

        if (this.options.height) {
          padding += this.$tableFooter.outerHeight(true);
        }
      }

      if (this.options.height) {
        var toolbarHeight = this.$toolbar.outerHeight(true);
        var paginationHeight = this.$pagination.outerHeight(true);
        var height = this.options.height - toolbarHeight - paginationHeight;
        var tableHeight = this.$tableBody.find('table').outerHeight(true);
        this.$tableContainer.css('height', "".concat(height, "px"));
        this.$tableBorder && this.$tableBorder.css('height', "".concat(height - tableHeight - padding - 1, "px"));
      }

      if (this.options.cardView) {
        // remove the element css
        this.$el.css('margin-top', '0');
        this.$tableContainer.css('padding-bottom', '0');
        this.$tableFooter.hide();
      } else {
        // Assign the correct sortable arrow
        this.getCaret();
        this.$tableContainer.css('padding-bottom', "".concat(padding, "px"));
      }

      this.trigger('reset-view');
    }
  }, {
    key: "resetWidth",
    value: function resetWidth() {
      if (this.options.showHeader && this.options.height) {
        this.fitHeader();
      }

      if (this.options.showFooter && !this.options.cardView) {
        this.fitFooter();
      }
    }
  }, {
    key: "showLoading",
    value: function showLoading() {
      this.$tableLoading.css('display', 'flex');
    }
  }, {
    key: "hideLoading",
    value: function hideLoading() {
      this.$tableLoading.css('display', 'none');
    }
  }, {
    key: "togglePagination",
    value: function togglePagination() {
      this.options.pagination = !this.options.pagination;
      var icon = this.options.showButtonIcons ? this.options.pagination ? this.options.icons.paginationSwitchDown : this.options.icons.paginationSwitchUp : '';
      var text = this.options.showButtonText ? this.options.pagination ? this.options.formatPaginationSwitchUp() : this.options.formatPaginationSwitchDown() : '';
      this.$toolbar.find('button[name="paginationSwitch"]').html(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, this.options.iconsPrefix, icon) + ' ' + text);
      this.updatePagination();
    }
  }, {
    key: "toggleFullscreen",
    value: function toggleFullscreen() {
      this.$el.closest('.bootstrap-table').toggleClass('fullscreen');
      this.resetView();
    }
  }, {
    key: "toggleView",
    value: function toggleView() {
      this.options.cardView = !this.options.cardView;
      this.initHeader();
      var icon = this.options.showButtonIcons ? this.options.cardView ? this.options.icons.toggleOn : this.options.icons.toggleOff : '';
      var text = this.options.showButtonText ? this.options.cardView ? this.options.formatToggleOff() : this.options.formatToggleOn() : '';
      this.$toolbar.find('button[name="toggle"]').html(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, this.options.iconsPrefix, icon) + ' ' + text);
      this.initBody();
      this.trigger('toggle', this.options.cardView);
    }
  }, {
    key: "resetSearch",
    value: function resetSearch(text) {
      var $search = this.$toolbar.find('.search input');
      $search.val(text || '');
      this.onSearch({
        currentTarget: $search
      });
    }
  }, {
    key: "filterBy",
    value: function filterBy(columns, options) {
      this.filterOptions = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isEmptyObject(options) ? this.options.filterOptions : $.extend(this.options.filterOptions, options);
      this.filterColumns = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].isEmptyObject(columns) ? {} : columns;
      this.options.pageNumber = 1;
      this.initSearch();
      this.updatePagination();
    }
  }, {
    key: "scrollTo",
    value: function scrollTo(params) {
      if (typeof params === 'undefined') {
        return this.$tableBody.scrollTop();
      }

      var options = {
        unit: 'px',
        value: 0
      };

      if (_typeof(params) === 'object') {
        options = Object.assign(options, params);
      } else if (typeof params === 'string' && params === 'bottom') {
        options.value = this.$tableBody[0].scrollHeight;
      } else if (typeof params === 'string') {
        options.value = params;
      }

      var scrollTo = options.value;

      if (options.unit === 'rows') {
        scrollTo = 0;
        this.$body.find("> tr:lt(".concat(options.value, ")")).each(function (i, el) {
          scrollTo += $(el).outerHeight(true);
        });
      }

      this.$tableBody.scrollTop(scrollTo);
    }
  }, {
    key: "getScrollPosition",
    value: function getScrollPosition() {
      return this.scrollTo();
    }
  }, {
    key: "selectPage",
    value: function selectPage(page) {
      if (page > 0 && page <= this.options.totalPages) {
        this.options.pageNumber = page;
        this.updatePagination();
      }
    }
  }, {
    key: "prevPage",
    value: function prevPage() {
      if (this.options.pageNumber > 1) {
        this.options.pageNumber--;
        this.updatePagination();
      }
    }
  }, {
    key: "nextPage",
    value: function nextPage() {
      if (this.options.pageNumber < this.options.totalPages) {
        this.options.pageNumber++;
        this.updatePagination();
      }
    }
  }, {
    key: "toggleDetailView",
    value: function toggleDetailView(index, _columnDetailFormatter) {
      var $tr = this.$body.find(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('> tr[data-index="%s"]', index));

      if ($tr.next().is('tr.detail-view')) {
        this.collapseRow(index);
      } else {
        this.expandRow(index, _columnDetailFormatter);
      }

      this.resetView();
    }
  }, {
    key: "expandRow",
    value: function expandRow(index, _columnDetailFormatter) {
      var row = this.data[index];
      var $tr = this.$body.find(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('> tr[data-index="%s"][data-has-detail-view]', index));

      if ($tr.next().is('tr.detail-view')) {
        return;
      }

      if (this.options.detailViewIcon) {
        $tr.find('a.detail-icon').html(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, this.options.iconsPrefix, this.options.icons.detailClose));
      }

      $tr.after(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('<tr class="detail-view"><td colspan="%s"></td></tr>', $tr.children('td').length));
      var $element = $tr.next().find('td');
      var detailFormatter = _columnDetailFormatter || this.options.detailFormatter;
      var content = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].calculateObjectValue(this.options, detailFormatter, [index, row, $element], '');

      if ($element.length === 1) {
        $element.append(content);
      }

      this.trigger('expand-row', index, row, $element);
    }
  }, {
    key: "collapseRow",
    value: function collapseRow(index) {
      var row = this.data[index];
      var $tr = this.$body.find(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf('> tr[data-index="%s"][data-has-detail-view]', index));

      if (!$tr.next().is('tr.detail-view')) {
        return;
      }

      if (this.options.detailViewIcon) {
        $tr.find('a.detail-icon').html(_utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].sprintf(this.constants.html.icon, this.options.iconsPrefix, this.options.icons.detailOpen));
      }

      this.trigger('collapse-row', index, row, $tr.next());
      $tr.next().remove();
    }
  }, {
    key: "expandAllRows",
    value: function expandAllRows() {
      var trs = this.$body.find('> tr[data-index][data-has-detail-view]');

      for (var i = 0; i < trs.length; i++) {
        this.expandRow($(trs[i]).data('index'));
      }
    }
  }, {
    key: "collapseAllRows",
    value: function collapseAllRows() {
      var trs = this.$body.find('> tr[data-index][data-has-detail-view]');

      for (var i = 0; i < trs.length; i++) {
        this.collapseRow($(trs[i]).data('index'));
      }
    }
  }, {
    key: "updateColumnTitle",
    value: function updateColumnTitle(params) {
      if (!params.hasOwnProperty('field') || !params.hasOwnProperty('title')) {
        return;
      }

      this.columns[this.fieldsColumnsIndex[params.field]].title = this.options.escape ? _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"].escapeHTML(params.title) : params.title;

      if (this.columns[this.fieldsColumnsIndex[params.field]].visible) {
        var header = this.options.height !== undefined ? this.$tableHeader : this.$header;
        header.find('th[data-field]').each(function (i, el) {
          if ($(el).data('field') === params.field) {
            $($(el).find('.th-inner')[0]).text(params.title);
            return false;
          }
        });
      }
    }
  }, {
    key: "updateFormatText",
    value: function updateFormatText(formatName, text) {
      if (!/^format/.test(formatName) || !this.options[formatName]) {
        return;
      }

      if (typeof text === 'string') {
        this.options[formatName] = function () {
          return text;
        };
      } else if (typeof text === 'function') {
        this.options[formatName] = text;
      }

      this.initToolbar();
      this.initPagination();
      this.initBody();
    }
  }]);

  return BootstrapTable;
}();

BootstrapTable.VERSION = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].VERSION;
BootstrapTable.DEFAULTS = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].DEFAULTS;
BootstrapTable.LOCALES = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].LOCALES;
BootstrapTable.COLUMN_DEFAULTS = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].COLUMN_DEFAULTS;
BootstrapTable.METHODS = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].METHODS;
BootstrapTable.EVENTS = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].EVENTS; // BOOTSTRAP TABLE PLUGIN DEFINITION
// =======================

$.BootstrapTable = BootstrapTable;

$.fn.bootstrapTable = function (option) {
  for (var _len2 = arguments.length, args = new Array(_len2 > 1 ? _len2 - 1 : 0), _key5 = 1; _key5 < _len2; _key5++) {
    args[_key5 - 1] = arguments[_key5];
  }

  var value;
  this.each(function (i, el) {
    var data = $(el).data('bootstrap.table');
    var options = $.extend({}, BootstrapTable.DEFAULTS, $(el).data(), _typeof(option) === 'object' && option);

    if (typeof option === 'string') {
      var _data2;

      if (!_constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].METHODS.includes(option)) {
        throw new Error("Unknown method: ".concat(option));
      }

      if (!data) {
        return;
      }

      value = (_data2 = data)[option].apply(_data2, args);

      if (option === 'destroy') {
        $(el).removeData('bootstrap.table');
      }
    }

    if (!data) {
      $(el).data('bootstrap.table', data = new $.BootstrapTable(el, options));
    }
  });
  return typeof value === 'undefined' ? this : value;
};

$.fn.bootstrapTable.Constructor = BootstrapTable;
$.fn.bootstrapTable.theme = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].THEME;
$.fn.bootstrapTable.VERSION = _constants_index_js__WEBPACK_IMPORTED_MODULE_0__["default"].VERSION;
$.fn.bootstrapTable.defaults = BootstrapTable.DEFAULTS;
$.fn.bootstrapTable.columnDefaults = BootstrapTable.COLUMN_DEFAULTS;
$.fn.bootstrapTable.events = BootstrapTable.EVENTS;
$.fn.bootstrapTable.locales = BootstrapTable.LOCALES;
$.fn.bootstrapTable.methods = BootstrapTable.METHODS;
$.fn.bootstrapTable.utils = _utils_index_js__WEBPACK_IMPORTED_MODULE_1__["default"]; // BOOTSTRAP TABLE INIT
// =======================

$(function () {
  $('[data-toggle="table"]').bootstrapTable();
});
/* harmony default export */ __webpack_exports__["default"] = (BootstrapTable);

/***/ }),

/***/ "./node_modules/bootstrap-table/src/constants/index.js":
/*!*************************************************************!*\
  !*** ./node_modules/bootstrap-table/src/constants/index.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var VERSION = '1.15.5';
var bootstrapVersion = 4;

try {
  var rawVersion = $.fn.dropdown.Constructor.VERSION; // Only try to parse VERSION if it is defined.
  // It is undefined in older versions of Bootstrap (tested with 3.1.1).

  if (rawVersion !== undefined) {
    bootstrapVersion = parseInt(rawVersion, 10);
  }
} catch (e) {// ignore
}

var CONSTANTS = {
  3: {
    iconsPrefix: 'glyphicon',
    icons: {
      paginationSwitchDown: 'glyphicon-collapse-down icon-chevron-down',
      paginationSwitchUp: 'glyphicon-collapse-up icon-chevron-up',
      refresh: 'glyphicon-refresh icon-refresh',
      toggleOff: 'glyphicon-list-alt icon-list-alt',
      toggleOn: 'glyphicon-list-alt icon-list-alt',
      columns: 'glyphicon-th icon-th',
      detailOpen: 'glyphicon-plus icon-plus',
      detailClose: 'glyphicon-minus icon-minus',
      fullscreen: 'glyphicon-fullscreen',
      search: 'glyphicon-search',
      clearSearch: 'glyphicon-trash'
    },
    classes: {
      buttonsPrefix: 'btn',
      buttons: 'default',
      buttonsGroup: 'btn-group',
      buttonsDropdown: 'btn-group',
      pull: 'pull',
      inputGroup: 'input-group',
      inputPrefix: 'input-',
      input: 'form-control',
      paginationDropdown: 'btn-group dropdown',
      dropup: 'dropup',
      dropdownActive: 'active',
      paginationActive: 'active',
      buttonActive: 'active'
    },
    html: {
      toolbarDropdown: ['<ul class="dropdown-menu" role="menu">', '</ul>'],
      toolbarDropdownItem: '<li role="menuitem"><label>%s</label></li>',
      toolbarDropdownSeparator: '<li class="divider"></li>',
      pageDropdown: ['<ul class="dropdown-menu" role="menu">', '</ul>'],
      pageDropdownItem: '<li role="menuitem" class="%s"><a href="#">%s</a></li>',
      dropdownCaret: '<span class="caret"></span>',
      pagination: ['<ul class="pagination%s">', '</ul>'],
      paginationItem: '<li class="page-item%s"><a class="page-link" aria-label="%s" href="javascript:void(0)">%s</a></li>',
      icon: '<i class="%s %s"></i>',
      inputGroup: '<div class="input-group">%s<span class="input-group-btn">%s</span></div>',
      searchInput: '<input class="%s%s" type="text" placeholder="%s">',
      searchButton: '<button class="%s" type="button" name="search" title="%s">%s %s</button>',
      searchClearButton: '<button class="%s" type="button" name="clearSearch" title="%s">%s %s</button>'
    }
  },
  4: {
    iconsPrefix: 'fa',
    icons: {
      paginationSwitchDown: 'fa-caret-square-down',
      paginationSwitchUp: 'fa-caret-square-up',
      refresh: 'fa-sync',
      toggleOff: 'fa-toggle-off',
      toggleOn: 'fa-toggle-on',
      columns: 'fa-th-list',
      detailOpen: 'fa-plus',
      detailClose: 'fa-minus',
      fullscreen: 'fa-arrows-alt',
      search: 'fa-search',
      clearSearch: 'fa-trash'
    },
    classes: {
      buttonsPrefix: 'btn',
      buttons: 'secondary',
      buttonsGroup: 'btn-group',
      buttonsDropdown: 'btn-group',
      pull: 'float',
      inputGroup: 'btn-group',
      inputPrefix: 'form-control-',
      input: 'form-control',
      paginationDropdown: 'btn-group dropdown',
      dropup: 'dropup',
      dropdownActive: 'active',
      paginationActive: 'active',
      buttonActive: 'active'
    },
    html: {
      toolbarDropdown: ['<div class="dropdown-menu dropdown-menu-right">', '</div>'],
      toolbarDropdownItem: '<label class="dropdown-item">%s</label>',
      pageDropdown: ['<div class="dropdown-menu">', '</div>'],
      pageDropdownItem: '<a class="dropdown-item %s" href="#">%s</a>',
      toolbarDropdownSeparator: '<div class="dropdown-divider"></div>',
      dropdownCaret: '<span class="caret"></span>',
      pagination: ['<ul class="pagination%s">', '</ul>'],
      paginationItem: '<li class="page-item%s"><a class="page-link" aria-label="%s" href="javascript:void(0)">%s</a></li>',
      icon: '<i class="%s %s"></i>',
      inputGroup: '<div class="input-group">%s<div class="input-group-append">%s</div></div>',
      searchInput: '<input class="%s%s" type="text" placeholder="%s">',
      searchButton: '<button class="%s" type="button" name="search" title="%s">%s %s</button>',
      searchClearButton: '<button class="%s" type="button" name="clearSearch" title="%s">%s %s</button>'
    }
  }
}[bootstrapVersion];
var DEFAULTS = {
  height: undefined,
  classes: 'table table-bordered table-hover',
  theadClasses: '',
  rowStyle: function rowStyle(row, index) {
    return {};
  },
  rowAttributes: function rowAttributes(row, index) {
    return {};
  },
  undefinedText: '-',
  locale: undefined,
  virtualScroll: false,
  virtualScrollItemHeight: undefined,
  sortable: true,
  sortClass: undefined,
  silentSort: true,
  sortName: undefined,
  sortOrder: 'asc',
  sortStable: false,
  rememberOrder: false,
  customSort: undefined,
  columns: [[]],
  data: [],
  url: undefined,
  method: 'get',
  cache: true,
  contentType: 'application/json',
  dataType: 'json',
  ajax: undefined,
  ajaxOptions: {},
  queryParams: function queryParams(params) {
    return params;
  },
  queryParamsType: 'limit',
  // 'limit', undefined
  responseHandler: function responseHandler(res) {
    return res;
  },
  totalField: 'total',
  totalNotFilteredField: 'totalNotFiltered',
  dataField: 'rows',
  pagination: false,
  onlyInfoPagination: false,
  showExtendedPagination: false,
  paginationLoop: true,
  sidePagination: 'client',
  // client or server
  totalRows: 0,
  totalNotFiltered: 0,
  pageNumber: 1,
  pageSize: 10,
  pageList: [10, 25, 50, 100],
  paginationHAlign: 'right',
  // right, left
  paginationVAlign: 'bottom',
  // bottom, top, both
  paginationDetailHAlign: 'left',
  // right, left
  paginationPreText: '&lsaquo;',
  paginationNextText: '&rsaquo;',
  paginationSuccessivelySize: 5,
  // Maximum successively number of pages in a row
  paginationPagesBySide: 1,
  // Number of pages on each side (right, left) of the current page.
  paginationUseIntermediate: false,
  // Calculate intermediate pages for quick access
  search: false,
  searchOnEnterKey: false,
  strictSearch: false,
  visibleSearch: false,
  showButtonIcons: true,
  showButtonText: false,
  showSearchButton: false,
  showSearchClearButton: false,
  trimOnSearch: true,
  searchAlign: 'right',
  searchTimeOut: 500,
  searchText: '',
  customSearch: undefined,
  showHeader: true,
  showFooter: false,
  footerStyle: function footerStyle(row, index) {
    return {};
  },
  showColumns: false,
  showColumnsToggleAll: false,
  minimumCountColumns: 1,
  showPaginationSwitch: false,
  showRefresh: false,
  showToggle: false,
  showFullscreen: false,
  smartDisplay: true,
  escape: false,
  filterOptions: {
    filterAlgorithm: 'and'
  },
  idField: undefined,
  selectItemName: 'btSelectItem',
  clickToSelect: false,
  ignoreClickToSelectOn: function ignoreClickToSelectOn(_ref) {
    var tagName = _ref.tagName;
    return ['A', 'BUTTON'].includes(tagName);
  },
  singleSelect: false,
  checkboxHeader: true,
  maintainMetaData: false,
  multipleSelectRow: false,
  uniqueId: undefined,
  cardView: false,
  detailView: false,
  detailViewIcon: true,
  detailViewByClick: false,
  detailFormatter: function detailFormatter(index, row) {
    return '';
  },
  detailFilter: function detailFilter(index, row) {
    return true;
  },
  toolbar: undefined,
  toolbarAlign: 'left',
  buttonsToolbar: undefined,
  buttonsAlign: 'right',
  buttonsPrefix: CONSTANTS.classes.buttonsPrefix,
  buttonsClass: CONSTANTS.classes.buttons,
  icons: CONSTANTS.icons,
  html: CONSTANTS.html,
  iconSize: undefined,
  iconsPrefix: CONSTANTS.iconsPrefix,
  // glyphicon or fa(font-awesome)
  onAll: function onAll(name, args) {
    return false;
  },
  onClickCell: function onClickCell(field, value, row, $element) {
    return false;
  },
  onDblClickCell: function onDblClickCell(field, value, row, $element) {
    return false;
  },
  onClickRow: function onClickRow(item, $element) {
    return false;
  },
  onDblClickRow: function onDblClickRow(item, $element) {
    return false;
  },
  onSort: function onSort(name, order) {
    return false;
  },
  onCheck: function onCheck(row) {
    return false;
  },
  onUncheck: function onUncheck(row) {
    return false;
  },
  onCheckAll: function onCheckAll(rows) {
    return false;
  },
  onUncheckAll: function onUncheckAll(rows) {
    return false;
  },
  onCheckSome: function onCheckSome(rows) {
    return false;
  },
  onUncheckSome: function onUncheckSome(rows) {
    return false;
  },
  onLoadSuccess: function onLoadSuccess(data) {
    return false;
  },
  onLoadError: function onLoadError(status) {
    return false;
  },
  onColumnSwitch: function onColumnSwitch(field, checked) {
    return false;
  },
  onPageChange: function onPageChange(number, size) {
    return false;
  },
  onSearch: function onSearch(text) {
    return false;
  },
  onToggle: function onToggle(cardView) {
    return false;
  },
  onPreBody: function onPreBody(data) {
    return false;
  },
  onPostBody: function onPostBody() {
    return false;
  },
  onPostHeader: function onPostHeader() {
    return false;
  },
  onPostFooter: function onPostFooter() {
    return false;
  },
  onExpandRow: function onExpandRow(index, row, $detail) {
    return false;
  },
  onCollapseRow: function onCollapseRow(index, row) {
    return false;
  },
  onRefreshOptions: function onRefreshOptions(options) {
    return false;
  },
  onRefresh: function onRefresh(params) {
    return false;
  },
  onResetView: function onResetView() {
    return false;
  },
  onScrollBody: function onScrollBody() {
    return false;
  }
};
var EN = {
  formatLoadingMessage: function formatLoadingMessage() {
    return 'Loading, please wait';
  },
  formatRecordsPerPage: function formatRecordsPerPage(pageNumber) {
    return "".concat(pageNumber, " rows per page");
  },
  formatShowingRows: function formatShowingRows(pageFrom, pageTo, totalRows, totalNotFiltered) {
    if (totalNotFiltered !== undefined && totalNotFiltered > 0 && totalNotFiltered > totalRows) {
      return "Showing ".concat(pageFrom, " to ").concat(pageTo, " of ").concat(totalRows, " rows (filtered from ").concat(totalNotFiltered, " total rows)");
    }

    return "Showing ".concat(pageFrom, " to ").concat(pageTo, " of ").concat(totalRows, " rows");
  },
  formatSRPaginationPreText: function formatSRPaginationPreText() {
    return 'previous page';
  },
  formatSRPaginationPageText: function formatSRPaginationPageText(page) {
    return "to page ".concat(page);
  },
  formatSRPaginationNextText: function formatSRPaginationNextText() {
    return 'next page';
  },
  formatDetailPagination: function formatDetailPagination(totalRows) {
    return "Showing ".concat(totalRows, " rows");
  },
  formatSearch: function formatSearch() {
    return 'Search';
  },
  formatClearSearch: function formatClearSearch() {
    return 'Clear Search';
  },
  formatNoMatches: function formatNoMatches() {
    return 'No matching records found';
  },
  formatPaginationSwitch: function formatPaginationSwitch() {
    return 'Hide/Show pagination';
  },
  formatPaginationSwitchDown: function formatPaginationSwitchDown() {
    return 'Show pagination';
  },
  formatPaginationSwitchUp: function formatPaginationSwitchUp() {
    return 'Hide pagination';
  },
  formatRefresh: function formatRefresh() {
    return 'Refresh';
  },
  formatToggle: function formatToggle() {
    return 'Toggle';
  },
  formatToggleOn: function formatToggleOn() {
    return 'Show card view';
  },
  formatToggleOff: function formatToggleOff() {
    return 'Hide card view';
  },
  formatColumns: function formatColumns() {
    return 'Columns';
  },
  formatColumnsToggleAll: function formatColumnsToggleAll() {
    return 'Toggle all';
  },
  formatFullscreen: function formatFullscreen() {
    return 'Fullscreen';
  },
  formatAllRows: function formatAllRows() {
    return 'All';
  }
};
var COLUMN_DEFAULTS = {
  field: undefined,
  title: undefined,
  titleTooltip: undefined,
  'class': undefined,
  width: undefined,
  widthUnit: 'px',
  rowspan: undefined,
  colspan: undefined,
  align: undefined,
  // left, right, center
  halign: undefined,
  // left, right, center
  falign: undefined,
  // left, right, center
  valign: undefined,
  // top, middle, bottom
  cellStyle: undefined,
  radio: false,
  checkbox: false,
  checkboxEnabled: true,
  clickToSelect: true,
  showSelectTitle: false,
  sortable: false,
  sortName: undefined,
  order: 'asc',
  // asc, desc
  sorter: undefined,
  visible: true,
  switchable: true,
  cardVisible: true,
  searchable: true,
  formatter: undefined,
  footerFormatter: undefined,
  detailFormatter: undefined,
  searchFormatter: true,
  escape: false,
  events: undefined
};
var METHODS = ['getOptions', 'refreshOptions', 'getData', 'getSelections', 'getAllSelections', 'load', 'append', 'prepend', 'remove', 'removeAll', 'insertRow', 'updateRow', 'getRowByUniqueId', 'updateByUniqueId', 'removeByUniqueId', 'updateCell', 'updateCellByUniqueId', 'showRow', 'hideRow', 'getHiddenRows', 'showColumn', 'hideColumn', 'getVisibleColumns', 'getHiddenColumns', 'showAllColumns', 'hideAllColumns', 'mergeCells', 'checkAll', 'uncheckAll', 'checkInvert', 'check', 'uncheck', 'checkBy', 'uncheckBy', 'refresh', 'destroy', 'resetView', 'resetWidth', 'showLoading', 'hideLoading', 'togglePagination', 'toggleFullscreen', 'toggleView', 'resetSearch', 'filterBy', 'scrollTo', 'getScrollPosition', 'selectPage', 'prevPage', 'nextPage', 'toggleDetailView', 'expandRow', 'collapseRow', 'expandAllRows', 'collapseAllRows', 'updateColumnTitle', 'updateFormatText'];
var EVENTS = {
  'all.bs.table': 'onAll',
  'click-row.bs.table': 'onClickRow',
  'dbl-click-row.bs.table': 'onDblClickRow',
  'click-cell.bs.table': 'onClickCell',
  'dbl-click-cell.bs.table': 'onDblClickCell',
  'sort.bs.table': 'onSort',
  'check.bs.table': 'onCheck',
  'uncheck.bs.table': 'onUncheck',
  'check-all.bs.table': 'onCheckAll',
  'uncheck-all.bs.table': 'onUncheckAll',
  'check-some.bs.table': 'onCheckSome',
  'uncheck-some.bs.table': 'onUncheckSome',
  'load-success.bs.table': 'onLoadSuccess',
  'load-error.bs.table': 'onLoadError',
  'column-switch.bs.table': 'onColumnSwitch',
  'page-change.bs.table': 'onPageChange',
  'search.bs.table': 'onSearch',
  'toggle.bs.table': 'onToggle',
  'pre-body.bs.table': 'onPreBody',
  'post-body.bs.table': 'onPostBody',
  'post-header.bs.table': 'onPostHeader',
  'post-footer.bs.table': 'onPostFooter',
  'expand-row.bs.table': 'onExpandRow',
  'collapse-row.bs.table': 'onCollapseRow',
  'refresh-options.bs.table': 'onRefreshOptions',
  'reset-view.bs.table': 'onResetView',
  'refresh.bs.table': 'onRefresh',
  'scroll-body.bs.table': 'onScrollBody'
};
Object.assign(DEFAULTS, EN);
/* harmony default export */ __webpack_exports__["default"] = ({
  VERSION: VERSION,
  THEME: "bootstrap".concat(bootstrapVersion),
  CONSTANTS: CONSTANTS,
  DEFAULTS: DEFAULTS,
  COLUMN_DEFAULTS: COLUMN_DEFAULTS,
  METHODS: METHODS,
  EVENTS: EVENTS,
  LOCALES: {
    en: EN,
    'en-US': EN
  }
});

/***/ }),

/***/ "./node_modules/bootstrap-table/src/utils/index.js":
/*!*********************************************************!*\
  !*** ./node_modules/bootstrap-table/src/utils/index.js ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e2) { throw _e2; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e3) { didErr = true; err = _e3; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(n); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

/* harmony default export */ __webpack_exports__["default"] = ({
  // it only does '%s', and return '' when arguments are undefined
  sprintf: function sprintf(_str) {
    for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      args[_key - 1] = arguments[_key];
    }

    var flag = true;
    var i = 0;

    var str = _str.replace(/%s/g, function () {
      var arg = args[i++];

      if (typeof arg === 'undefined') {
        flag = false;
        return '';
      }

      return arg;
    });

    return flag ? str : '';
  },
  isEmptyObject: function isEmptyObject() {
    var obj = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    return Object.entries(obj).length === 0 && obj.constructor === Object;
  },
  isNumeric: function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
  },
  getFieldTitle: function getFieldTitle(list, value) {
    var _iterator = _createForOfIteratorHelper(list),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var item = _step.value;

        if (item.field === value) {
          return item.title;
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }

    return '';
  },
  setFieldIndex: function setFieldIndex(columns) {
    var totalCol = 0;
    var flag = [];

    var _iterator2 = _createForOfIteratorHelper(columns[0]),
        _step2;

    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var column = _step2.value;
        totalCol += column.colspan || 1;
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }

    for (var i = 0; i < columns.length; i++) {
      flag[i] = [];

      for (var j = 0; j < totalCol; j++) {
        flag[i][j] = false;
      }
    }

    for (var _i = 0; _i < columns.length; _i++) {
      var _iterator3 = _createForOfIteratorHelper(columns[_i]),
          _step3;

      try {
        for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
          var r = _step3.value;
          var rowspan = r.rowspan || 1;
          var colspan = r.colspan || 1;

          var index = flag[_i].indexOf(false);

          r.colspanIndex = index;

          if (colspan === 1) {
            r.fieldIndex = index; // when field is undefined, use index instead

            if (typeof r.field === 'undefined') {
              r.field = index;
            }
          } else {
            r.colspanGroup = r.colspan;
          }

          for (var k = 0; k < rowspan; k++) {
            flag[_i + k][index] = true;
          }

          for (var _k = 0; _k < colspan; _k++) {
            flag[_i][index + _k] = true;
          }
        }
      } catch (err) {
        _iterator3.e(err);
      } finally {
        _iterator3.f();
      }
    }
  },
  updateFieldGroup: function updateFieldGroup(columns) {
    var allColumns = columns.flat();

    var _iterator4 = _createForOfIteratorHelper(columns),
        _step4;

    try {
      for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
        var c = _step4.value;

        var _iterator5 = _createForOfIteratorHelper(c),
            _step5;

        try {
          for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
            var r = _step5.value;

            if (r.colspanGroup > 1) {
              var colspan = 0;

              var _loop = function _loop(i) {
                var column = allColumns.find(function (col) {
                  return col.fieldIndex === i;
                });

                if (column.visible) {
                  colspan++;
                }
              };

              for (var i = r.colspanIndex; i < r.colspanIndex + r.colspanGroup; i++) {
                _loop(i);
              }

              r.colspan = colspan;
              r.visible = colspan > 0;
            }
          }
        } catch (err) {
          _iterator5.e(err);
        } finally {
          _iterator5.f();
        }
      }
    } catch (err) {
      _iterator4.e(err);
    } finally {
      _iterator4.f();
    }
  },
  getScrollBarWidth: function getScrollBarWidth() {
    if (this.cachedWidth === undefined) {
      var $inner = $('<div/>').addClass('fixed-table-scroll-inner');
      var $outer = $('<div/>').addClass('fixed-table-scroll-outer');
      $outer.append($inner);
      $('body').append($outer);
      var w1 = $inner[0].offsetWidth;
      $outer.css('overflow', 'scroll');
      var w2 = $inner[0].offsetWidth;

      if (w1 === w2) {
        w2 = $outer[0].clientWidth;
      }

      $outer.remove();
      this.cachedWidth = w1 - w2;
    }

    return this.cachedWidth;
  },
  calculateObjectValue: function calculateObjectValue(self, name, args, defaultValue) {
    var func = name;

    if (typeof name === 'string') {
      // support obj.func1.func2
      var names = name.split('.');

      if (names.length > 1) {
        func = window;

        var _iterator6 = _createForOfIteratorHelper(names),
            _step6;

        try {
          for (_iterator6.s(); !(_step6 = _iterator6.n()).done;) {
            var f = _step6.value;
            func = func[f];
          }
        } catch (err) {
          _iterator6.e(err);
        } finally {
          _iterator6.f();
        }
      } else {
        func = window[name];
      }
    }

    if (func !== null && _typeof(func) === 'object') {
      return func;
    }

    if (typeof func === 'function') {
      return func.apply(self, args || []);
    }

    if (!func && typeof name === 'string' && this.sprintf.apply(this, [name].concat(_toConsumableArray(args)))) {
      return this.sprintf.apply(this, [name].concat(_toConsumableArray(args)));
    }

    return defaultValue;
  },
  compareObjects: function compareObjects(objectA, objectB, compareLength) {
    var aKeys = Object.keys(objectA);
    var bKeys = Object.keys(objectB);

    if (compareLength && aKeys.length !== bKeys.length) {
      return false;
    }

    for (var _i2 = 0, _aKeys = aKeys; _i2 < _aKeys.length; _i2++) {
      var key = _aKeys[_i2];

      if (bKeys.includes(key) && objectA[key] !== objectB[key]) {
        return false;
      }
    }

    return true;
  },
  escapeHTML: function escapeHTML(text) {
    if (typeof text === 'string') {
      return text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;').replace(/`/g, '&#x60;');
    }

    return text;
  },
  getRealDataAttr: function getRealDataAttr(dataAttr) {
    for (var _i3 = 0, _Object$entries = Object.entries(dataAttr); _i3 < _Object$entries.length; _i3++) {
      var _ref3 = _Object$entries[_i3];

      var _ref2 = _slicedToArray(_ref3, 2);

      var attr = _ref2[0];
      var value = _ref2[1];
      var auxAttr = attr.split(/(?=[A-Z])/).join('-').toLowerCase();

      if (auxAttr !== attr) {
        dataAttr[auxAttr] = value;
        delete dataAttr[attr];
      }
    }

    return dataAttr;
  },
  getItemField: function getItemField(item, field, escape) {
    var value = item;

    if (typeof field !== 'string' || item.hasOwnProperty(field)) {
      return escape ? this.escapeHTML(item[field]) : item[field];
    }

    var props = field.split('.');

    var _iterator7 = _createForOfIteratorHelper(props),
        _step7;

    try {
      for (_iterator7.s(); !(_step7 = _iterator7.n()).done;) {
        var p = _step7.value;
        value = value && value[p];
      }
    } catch (err) {
      _iterator7.e(err);
    } finally {
      _iterator7.f();
    }

    return escape ? this.escapeHTML(value) : value;
  },
  isIEBrowser: function isIEBrowser() {
    return navigator.userAgent.includes('MSIE ') || /Trident.*rv:11\./.test(navigator.userAgent);
  },
  findIndex: function findIndex(items, item) {
    var _iterator8 = _createForOfIteratorHelper(items),
        _step8;

    try {
      for (_iterator8.s(); !(_step8 = _iterator8.n()).done;) {
        var it = _step8.value;

        if (JSON.stringify(it) === JSON.stringify(item)) {
          return items.indexOf(it);
        }
      }
    } catch (err) {
      _iterator8.e(err);
    } finally {
      _iterator8.f();
    }

    return -1;
  },
  trToData: function trToData(columns, $els) {
    var _this = this;

    var data = [];
    var m = [];
    $els.each(function (y, el) {
      var row = {}; // save tr's id, class and data-* attributes

      row._id = $(el).attr('id');
      row._class = $(el).attr('class');
      row._data = _this.getRealDataAttr($(el).data());
      $(el).find('>td,>th').each(function (_x, el) {
        var cspan = +$(el).attr('colspan') || 1;
        var rspan = +$(el).attr('rowspan') || 1;
        var x = _x; // skip already occupied cells in current row

        for (; m[y] && m[y][x]; x++) {} // ignore
        // mark matrix elements occupied by current cell with true


        for (var tx = x; tx < x + cspan; tx++) {
          for (var ty = y; ty < y + rspan; ty++) {
            if (!m[ty]) {
              // fill missing rows
              m[ty] = [];
            }

            m[ty][tx] = true;
          }
        }

        var field = columns[x].field;
        row[field] = $(el).html().trim(); // save td's id, class and data-* attributes

        row["_".concat(field, "_id")] = $(el).attr('id');
        row["_".concat(field, "_class")] = $(el).attr('class');
        row["_".concat(field, "_rowspan")] = $(el).attr('rowspan');
        row["_".concat(field, "_colspan")] = $(el).attr('colspan');
        row["_".concat(field, "_title")] = $(el).attr('title');
        row["_".concat(field, "_data")] = _this.getRealDataAttr($(el).data());
      });
      data.push(row);
    });
    return data;
  },
  sort: function sort(a, b, order, sortStable) {
    if (a === undefined || a === null) {
      a = '';
    }

    if (b === undefined || b === null) {
      b = '';
    }

    if (sortStable && a === b) {
      a = a._position;
      b = b._position;
    } // If both values are numeric, do a numeric comparison


    if (this.isNumeric(a) && this.isNumeric(b)) {
      // Convert numerical values form string to float.
      a = parseFloat(a);
      b = parseFloat(b);

      if (a < b) {
        return order * -1;
      }

      if (a > b) {
        return order;
      }

      return 0;
    }

    if (a === b) {
      return 0;
    } // If value is not a string, convert to string


    if (typeof a !== 'string') {
      a = a.toString();
    }

    if (a.localeCompare(b) === -1) {
      return order * -1;
    }

    return order;
  }
});

/***/ }),

/***/ "./node_modules/bootstrap-table/src/virtual-scroll/index.js":
/*!******************************************************************!*\
  !*** ./node_modules/bootstrap-table/src/virtual-scroll/index.js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var BLOCK_ROWS = 50;
var CLUSTER_BLOCKS = 4;

var VirtualScroll = /*#__PURE__*/function () {
  function VirtualScroll(options) {
    var _this = this;

    _classCallCheck(this, VirtualScroll);

    this.rows = options.rows;
    this.scrollEl = options.scrollEl;
    this.contentEl = options.contentEl;
    this.callback = options.callback;
    this.itemHeight = options.itemHeight;
    this.cache = {};
    this.scrollTop = this.scrollEl.scrollTop;
    this.initDOM(this.rows, options.fixedScroll);
    this.scrollEl.scrollTop = this.scrollTop;
    this.lastCluster = 0;

    var onScroll = function onScroll() {
      if (_this.lastCluster !== (_this.lastCluster = _this.getNum())) {
        _this.initDOM(_this.rows);

        _this.callback();
      }
    };

    this.scrollEl.addEventListener('scroll', onScroll, false);

    this.destroy = function () {
      _this.contentEl.innerHtml = '';

      _this.scrollEl.removeEventListener('scroll', onScroll, false);
    };
  }

  _createClass(VirtualScroll, [{
    key: "initDOM",
    value: function initDOM(rows, fixedScroll) {
      if (typeof this.clusterHeight === 'undefined') {
        this.cache.scrollTop = this.scrollEl.scrollTop;
        this.cache.data = this.contentEl.innerHTML = rows[0] + rows[0] + rows[0];
        this.getRowsHeight(rows);
      }

      var data = this.initData(rows, this.getNum(fixedScroll));
      var thisRows = data.rows.join('');
      var dataChanged = this.checkChanges('data', thisRows);
      var topOffsetChanged = this.checkChanges('top', data.topOffset);
      var bottomOffsetChanged = this.checkChanges('bottom', data.bottomOffset);
      var html = [];

      if (dataChanged && topOffsetChanged) {
        if (data.topOffset) {
          html.push(this.getExtra('top', data.topOffset));
        }

        html.push(thisRows);

        if (data.bottomOffset) {
          html.push(this.getExtra('bottom', data.bottomOffset));
        }

        this.contentEl.innerHTML = html.join('');

        if (fixedScroll) {
          this.contentEl.scrollTop = this.cache.scrollTop;
        }
      } else if (bottomOffsetChanged) {
        this.contentEl.lastChild.style.height = "".concat(data.bottomOffset, "px");
      }
    }
  }, {
    key: "getRowsHeight",
    value: function getRowsHeight() {
      if (typeof this.itemHeight === 'undefined') {
        var nodes = this.contentEl.children;
        var node = nodes[Math.floor(nodes.length / 2)];
        this.itemHeight = node.offsetHeight;
      }

      this.blockHeight = this.itemHeight * BLOCK_ROWS;
      this.clusterRows = BLOCK_ROWS * CLUSTER_BLOCKS;
      this.clusterHeight = this.blockHeight * CLUSTER_BLOCKS;
    }
  }, {
    key: "getNum",
    value: function getNum(fixedScroll) {
      this.scrollTop = fixedScroll ? this.cache.scrollTop : this.scrollEl.scrollTop;
      return Math.floor(this.scrollTop / (this.clusterHeight - this.blockHeight)) || 0;
    }
  }, {
    key: "initData",
    value: function initData(rows, num) {
      if (rows.length < BLOCK_ROWS) {
        return {
          topOffset: 0,
          bottomOffset: 0,
          rowsAbove: 0,
          rows: rows
        };
      }

      var start = Math.max((this.clusterRows - BLOCK_ROWS) * num, 0);
      var end = start + this.clusterRows;
      var topOffset = Math.max(start * this.itemHeight, 0);
      var bottomOffset = Math.max((rows.length - end) * this.itemHeight, 0);
      var thisRows = [];
      var rowsAbove = start;

      if (topOffset < 1) {
        rowsAbove++;
      }

      for (var i = start; i < end; i++) {
        rows[i] && thisRows.push(rows[i]);
      }

      return {
        topOffset: topOffset,
        bottomOffset: bottomOffset,
        rowsAbove: rowsAbove,
        rows: thisRows
      };
    }
  }, {
    key: "checkChanges",
    value: function checkChanges(type, value) {
      var changed = value !== this.cache[type];
      this.cache[type] = value;
      return changed;
    }
  }, {
    key: "getExtra",
    value: function getExtra(className, height) {
      var tag = document.createElement('tr');
      tag.className = "virtual-scroll-".concat(className);

      if (height) {
        tag.style.height = "".concat(height, "px");
      }

      return tag.outerHTML;
    }
  }]);

  return VirtualScroll;
}();

/* harmony default export */ __webpack_exports__["default"] = (VirtualScroll);

/***/ }),

/***/ "./resources/assets/vendor/libs/bootstrap-table/bootstrap-table.js":
/*!*************************************************************************!*\
  !*** ./resources/assets/vendor/libs/bootstrap-table/bootstrap-table.js ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! bootstrap-table/src/bootstrap-table.js */ "./node_modules/bootstrap-table/src/bootstrap-table.js");

/***/ }),

/***/ 30:
/*!*******************************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/bootstrap-table/bootstrap-table.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\bootstrap-table\bootstrap-table.js */"./resources/assets/vendor/libs/bootstrap-table/bootstrap-table.js");


/***/ })

/******/ })));