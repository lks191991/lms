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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/css-loader/index.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./resources/assets/vendor/js/_theme-settings/_theme-settings.scss":
/*!****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/postcss-loader/src??ref--129-2!./node_modules/sass-loader/dist/cjs.js??ref--129-3!./resources/assets/vendor/js/_theme-settings/_theme-settings.scss ***!
  \****************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "#theme-settings {\n  font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\" !important;\n  font-size: 13px !important;\n  position: fixed;\n  top: 0;\n  right: 0;\n  height: 100%;\n  z-index: 99999999;\n  display: -ms-flexbox;\n  display: flex;\n  -ms-flex-direction: column;\n  flex-direction: column;\n  width: 230px;\n  background: #fff;\n  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2);\n  transition: all 0.2s ease-in;\n  -webkit-transform: translateX(250px);\n  transform: translateX(250px);\n}\n#theme-settings h5 {\n  position: relative;\n  font-size: 11px;\n  font-weight: 600;\n}\n#theme-settings .theme-settings-header {\n  font-size: 11px;\n}\n#theme-settings .disabled {\n  color: #d1d2d3 !important;\n}\n#theme-settings.theme-settings-open {\n  transition-delay: 0.1s;\n  -webkit-transform: none !important;\n  transform: none !important;\n}\n#theme-settings .theme-settings-open-btn {\n  position: absolute;\n  top: 90px;\n  left: 0;\n  z-index: -1;\n  display: block;\n  width: 40px;\n  height: 40px;\n  border-top-left-radius: 50%;\n  border-bottom-left-radius: 50%;\n  background: #444;\n  color: #fff !important;\n  text-align: center;\n  font-size: 20px !important;\n  line-height: 40px;\n  opacity: 1;\n  transition: all 0.1s linear 0.2s;\n  -webkit-transform: translateX(-60px);\n  transform: translateX(-60px);\n}\n#theme-settings .theme-settings-open-btn::before {\n  content: \"\";\n  width: 18px;\n  height: 18px;\n  display: block;\n  background-size: 100% 100%;\n  position: absolute;\n  background-image: url(\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3BJREFUeNrUml1IFFEUx8fNh6jMkkjY2pDAaokksVrItGLXhQiUPiDIjOg58CmISPt4EyIK3yKQEKIPhKJeCnM/lMyHonop6CUKE01Eow+Mxe1/6AytSzvec+fOpH/4gei952NmnHvuuVOUzWYtF1oHDoGDIAHaFeddAntBD/NJOwJKQIM4GMjO1k8QVpgb5rG2ZkAaxHRikU6oY2eFNApqHObT38Yc5idArZcJOAVvKwO6QQNYyzTw7zIK8/skMRULn7gnoG6OMYvAMUZHvZLBAaHxKct7ffUygVIfEij1MoH9PiSwTzK4SLAORMBzHxKggLaDFyYTWMEG11v+6D0nMWXiEaJb+sbH4EmV4DWIS+7AHnAW9IExsBrEQNT6v+plvoByjuci6M9PgH6xy1oYSoPduY9QfAEFT6oHDbkJnDNkeAY8BCfABrAMLAYVoAl0gW+GfLXb1WiIK0K36gVbFOqXcnA9a0YhMthqwFAHCAgLw+a8slpHraoVppOuaO4piCMufafpf2AATGs+h8/AaRfP8R1wTXMuxZyyr8TmOTYahRRxcfVtVoIJod9RjtnK3y1lBEb6DQRvc1ngl2Lcas/NLSWo1rktuIUPDL7XJbZugVeFaqGbAkMvDSYgsdXtVMy9Exj6bDCB74Ld3lunBGYkewnD5UHAxKSwYG7QYPBLQYni2E1OCbQInG4zmIDE1vFCCVSBowJDTQYTkNiiGKvzW4sbwYjGQrbTwBpQBiY1FrKwvZC1gR+atcggKHaZQKemb4q5jQwkXRZUnS6Cb3HpOxHg9rYbnQJXuaUo0Ulww6XvHroKawxtaOhOVitc9SDoMuCPYg7am/qkvUk20JR6DO5zqT0CfvGaQW+5RnAALDHgK0WdFDuBqLQrPA9EMffltlVM3QU/lOQjqll9Ier7n+dbM86NrajCeYDXon7VU262reKLfIF3kkonNI1gOOu/htm3Y3yqzd0y3vBU+HTVP4AaMGGqhJ0Q1klu1awSvLQGHwRDPgQ/xK9gTzYRj3xIQORjPh7yTXqZQIkPCSz3MoGYYof6LpcNlQz9fE9xzy07UBGWv/Ug5fDuHgc7HOZHeEwhpdiHZ58a2ES5+sytYqdBlcLcKh47q0mr+7GH5Jj1XwpZfz63OcxL+xnFeR2g1vr7uc1H3QB+CzAA7A9pvcD5g+8AAAAASUVORK5CYII=\");\n  left: 50%;\n  top: 50%;\n  -webkit-transform: translate(-50%, -50%);\n          transform: translate(-50%, -50%);\n  margin-left: 2px;\n}\n[dir=rtl] #theme-settings .theme-settings-open-btn {\n  border-radius: 0;\n  border-top-right-radius: 50%;\n  border-bottom-right-radius: 50%;\n}\n[dir=rtl] #theme-settings .theme-settings-open-btn::before {\n  margin-left: -2px;\n}\n#theme-settings.theme-settings-open .theme-settings-open-btn {\n  opacity: 0;\n  transition-delay: 0s;\n  -webkit-transform: none !important;\n  transform: none !important;\n}\n#theme-settings .theme-settings-close-btn {\n  position: absolute;\n  top: 50%;\n  right: 0;\n  display: block;\n  font-size: 20px;\n  -webkit-transform: translateY(-50%);\n  transform: translateY(-50%);\n}\n#theme-settings > h5 {\n  -ms-flex: 0 0 auto;\n      flex: 0 0 auto;\n}\n#theme-settings .theme-settings-inner {\n  position: relative;\n  overflow: auto;\n  -ms-flex: 0 1 auto;\n  flex: 0 1 auto;\n  opacity: 1;\n  transition: opacity 0.2s;\n}\n#theme-settings .theme-settings-inner > div:first-child > hr:first-of-type {\n  display: none !important;\n}\n#theme-settings .theme-settings-inner > div:first-child > h5:first-of-type {\n  padding-top: 0 !important;\n}\n#theme-settings .theme-settings-themes-inner {\n  position: relative;\n  opacity: 1;\n  transition: opacity 0.2s;\n}\n#theme-settings .theme-settings-theme-item {\n  display: -ms-flexbox;\n  display: flex;\n  align-items: center;\n  -ms-flex-align: center;\n  -ms-flex: 1 1 100%;\n  flex: 1 1 100%;\n  -ms-flex-pack: justify;\n  justify-content: space-between;\n  margin-bottom: 10px;\n  padding: 0 24px;\n  width: 100%;\n  cursor: pointer;\n}\n#theme-settings .theme-settings-theme-item input {\n  position: absolute;\n  z-index: -1;\n  opacity: 0;\n}\n#theme-settings .theme-settings-theme-item input ~ span {\n  opacity: 0.25;\n  transition: all 0.2s;\n}\n#theme-settings .theme-settings-theme-item .theme-settings-theme-checkmark {\n  display: inline-block;\n  width: 6px;\n  height: 12px;\n  border-right: 1px solid;\n  border-bottom: 1px solid;\n  opacity: 0;\n  transition: all 0.2s;\n  -webkit-transform: rotate(45deg);\n  transform: rotate(45deg);\n}\n[dir=rtl] #theme-settings .theme-settings-theme-item .theme-settings-theme-checkmark {\n  border-right: none;\n  border-left: 1px solid;\n  -webkit-transform: rotate(-45deg);\n  transform: rotate(-45deg);\n}\n#theme-settings .theme-settings-theme-item input:checked:not([disabled]) ~ span, #theme-settings .theme-settings-theme-item:hover input:not([disabled]) ~ span {\n  opacity: 1;\n}\n#theme-settings .theme-settings-theme-item input:checked:not([disabled]) ~ span .theme-settings-theme-checkmark {\n  opacity: 1;\n}\n#theme-settings .theme-settings-theme-colors span {\n  display: block;\n  margin: 0 1px;\n  width: 10px;\n  height: 10px;\n  border-radius: 50%;\n  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1) inset;\n}\n#theme-settings.theme-settings-loading .theme-settings-inner, #theme-settings.theme-settings-loading-theme .theme-settings-themes-inner {\n  opacity: 0.2;\n}\n#theme-settings.theme-settings-loading .theme-settings-inner::after, #theme-settings.theme-settings-loading-theme .theme-settings-themes-inner::after {\n  content: \"\";\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  z-index: 999;\n  display: block;\n}\n#theme-settings .theme-settings-navbarBg-inner[disabled] .theme-settings-bg-item,\n#theme-settings .theme-settings-sidenavBg-inner[disabled] .theme-settings-bg-item,\n#theme-settings .theme-settings-bg-item.disabled {\n  opacity: 0.2;\n  cursor: default;\n}\n#theme-settings .theme-settings-bg-item {\n  display: block;\n  float: left;\n  margin: 3px;\n  width: 16px;\n  height: 16px;\n  border-radius: 2px;\n  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1) inset;\n  cursor: pointer;\n}\n#theme-settings .theme-settings-bg-item.active {\n  box-shadow: 0 0 0 2px #000;\n}\n#theme-settings .theme-settings-bg-item input {\n  position: absolute;\n  visibility: hidden;\n  clip: rect(0, 0, 0, 0);\n  pointer-events: none;\n}\n\n.layout-sidenav-100vh #theme-settings {\n  height: 100vh;\n}\n\n[dir=rtl] #theme-settings {\n  right: auto;\n  left: 0;\n  -webkit-transform: translateX(-250px);\n  transform: translateX(-250px);\n}\n[dir=rtl] #theme-settings .theme-settings-open-btn {\n  right: 0;\n  left: auto;\n  -webkit-transform: translateX(60px);\n  transform: translateX(60px);\n}\n[dir=rtl] #theme-settings .theme-settings-close-btn {\n  right: auto;\n  left: 0;\n}\n[dir=rtl] #theme-settings .theme-settings-bg-item {\n  float: right;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/lib/css-base.js":
/*!*************************************************!*\
  !*** ./node_modules/css-loader/lib/css-base.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),

/***/ "./node_modules/style-loader/lib/addStyles.js":
/*!****************************************************!*\
  !*** ./node_modules/style-loader/lib/addStyles.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/

var stylesInDom = {};

var	memoize = function (fn) {
	var memo;

	return function () {
		if (typeof memo === "undefined") memo = fn.apply(this, arguments);
		return memo;
	};
};

var isOldIE = memoize(function () {
	// Test for IE <= 9 as proposed by Browserhacks
	// @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
	// Tests for existence of standard globals is to allow style-loader
	// to operate correctly into non-standard environments
	// @see https://github.com/webpack-contrib/style-loader/issues/177
	return window && document && document.all && !window.atob;
});

var getTarget = function (target, parent) {
  if (parent){
    return parent.querySelector(target);
  }
  return document.querySelector(target);
};

var getElement = (function (fn) {
	var memo = {};

	return function(target, parent) {
                // If passing function in options, then use it for resolve "head" element.
                // Useful for Shadow Root style i.e
                // {
                //   insertInto: function () { return document.querySelector("#foo").shadowRoot }
                // }
                if (typeof target === 'function') {
                        return target();
                }
                if (typeof memo[target] === "undefined") {
			var styleTarget = getTarget.call(this, target, parent);
			// Special case to return head of iframe instead of iframe itself
			if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
				try {
					// This will throw an exception if access to iframe is blocked
					// due to cross-origin restrictions
					styleTarget = styleTarget.contentDocument.head;
				} catch(e) {
					styleTarget = null;
				}
			}
			memo[target] = styleTarget;
		}
		return memo[target]
	};
})();

var singleton = null;
var	singletonCounter = 0;
var	stylesInsertedAtTop = [];

var	fixUrls = __webpack_require__(/*! ./urls */ "./node_modules/style-loader/lib/urls.js");

module.exports = function(list, options) {
	if (typeof DEBUG !== "undefined" && DEBUG) {
		if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};

	options.attrs = typeof options.attrs === "object" ? options.attrs : {};

	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (!options.singleton && typeof options.singleton !== "boolean") options.singleton = isOldIE();

	// By default, add <style> tags to the <head> element
        if (!options.insertInto) options.insertInto = "head";

	// By default, add <style> tags to the bottom of the target
	if (!options.insertAt) options.insertAt = "bottom";

	var styles = listToStyles(list, options);

	addStylesToDom(styles, options);

	return function update (newList) {
		var mayRemove = [];

		for (var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];

			domStyle.refs--;
			mayRemove.push(domStyle);
		}

		if(newList) {
			var newStyles = listToStyles(newList, options);
			addStylesToDom(newStyles, options);
		}

		for (var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];

			if(domStyle.refs === 0) {
				for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();

				delete stylesInDom[domStyle.id];
			}
		}
	};
};

function addStylesToDom (styles, options) {
	for (var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];

		if(domStyle) {
			domStyle.refs++;

			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}

			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];

			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}

			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles (list, options) {
	var styles = [];
	var newStyles = {};

	for (var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = options.base ? item[0] + options.base : item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};

		if(!newStyles[id]) styles.push(newStyles[id] = {id: id, parts: [part]});
		else newStyles[id].parts.push(part);
	}

	return styles;
}

function insertStyleElement (options, style) {
	var target = getElement(options.insertInto)

	if (!target) {
		throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
	}

	var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];

	if (options.insertAt === "top") {
		if (!lastStyleElementInsertedAtTop) {
			target.insertBefore(style, target.firstChild);
		} else if (lastStyleElementInsertedAtTop.nextSibling) {
			target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			target.appendChild(style);
		}
		stylesInsertedAtTop.push(style);
	} else if (options.insertAt === "bottom") {
		target.appendChild(style);
	} else if (typeof options.insertAt === "object" && options.insertAt.before) {
		var nextSibling = getElement(options.insertAt.before, target);
		target.insertBefore(style, nextSibling);
	} else {
		throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");
	}
}

function removeStyleElement (style) {
	if (style.parentNode === null) return false;
	style.parentNode.removeChild(style);

	var idx = stylesInsertedAtTop.indexOf(style);
	if(idx >= 0) {
		stylesInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement (options) {
	var style = document.createElement("style");

	if(options.attrs.type === undefined) {
		options.attrs.type = "text/css";
	}

	if(options.attrs.nonce === undefined) {
		var nonce = getNonce();
		if (nonce) {
			options.attrs.nonce = nonce;
		}
	}

	addAttrs(style, options.attrs);
	insertStyleElement(options, style);

	return style;
}

function createLinkElement (options) {
	var link = document.createElement("link");

	if(options.attrs.type === undefined) {
		options.attrs.type = "text/css";
	}
	options.attrs.rel = "stylesheet";

	addAttrs(link, options.attrs);
	insertStyleElement(options, link);

	return link;
}

function addAttrs (el, attrs) {
	Object.keys(attrs).forEach(function (key) {
		el.setAttribute(key, attrs[key]);
	});
}

function getNonce() {
	if (false) {}

	return __webpack_require__.nc;
}

function addStyle (obj, options) {
	var style, update, remove, result;

	// If a transform function was defined, run it on the css
	if (options.transform && obj.css) {
	    result = typeof options.transform === 'function'
		 ? options.transform(obj.css) 
		 : options.transform.default(obj.css);

	    if (result) {
	    	// If transform returns a value, use that instead of the original css.
	    	// This allows running runtime transformations on the css.
	    	obj.css = result;
	    } else {
	    	// If the transform function returns a falsy value, don't add this css.
	    	// This allows conditional loading of css
	    	return function() {
	    		// noop
	    	};
	    }
	}

	if (options.singleton) {
		var styleIndex = singletonCounter++;

		style = singleton || (singleton = createStyleElement(options));

		update = applyToSingletonTag.bind(null, style, styleIndex, false);
		remove = applyToSingletonTag.bind(null, style, styleIndex, true);

	} else if (
		obj.sourceMap &&
		typeof URL === "function" &&
		typeof URL.createObjectURL === "function" &&
		typeof URL.revokeObjectURL === "function" &&
		typeof Blob === "function" &&
		typeof btoa === "function"
	) {
		style = createLinkElement(options);
		update = updateLink.bind(null, style, options);
		remove = function () {
			removeStyleElement(style);

			if(style.href) URL.revokeObjectURL(style.href);
		};
	} else {
		style = createStyleElement(options);
		update = applyToTag.bind(null, style);
		remove = function () {
			removeStyleElement(style);
		};
	}

	update(obj);

	return function updateStyle (newObj) {
		if (newObj) {
			if (
				newObj.css === obj.css &&
				newObj.media === obj.media &&
				newObj.sourceMap === obj.sourceMap
			) {
				return;
			}

			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;

		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag (style, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (style.styleSheet) {
		style.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = style.childNodes;

		if (childNodes[index]) style.removeChild(childNodes[index]);

		if (childNodes.length) {
			style.insertBefore(cssNode, childNodes[index]);
		} else {
			style.appendChild(cssNode);
		}
	}
}

function applyToTag (style, obj) {
	var css = obj.css;
	var media = obj.media;

	if(media) {
		style.setAttribute("media", media)
	}

	if(style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		while(style.firstChild) {
			style.removeChild(style.firstChild);
		}

		style.appendChild(document.createTextNode(css));
	}
}

function updateLink (link, options, obj) {
	var css = obj.css;
	var sourceMap = obj.sourceMap;

	/*
		If convertToAbsoluteUrls isn't defined, but sourcemaps are enabled
		and there is no publicPath defined then lets turn convertToAbsoluteUrls
		on by default.  Otherwise default to the convertToAbsoluteUrls option
		directly
	*/
	var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;

	if (options.convertToAbsoluteUrls || autoFixUrls) {
		css = fixUrls(css);
	}

	if (sourceMap) {
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	var blob = new Blob([css], { type: "text/css" });

	var oldSrc = link.href;

	link.href = URL.createObjectURL(blob);

	if(oldSrc) URL.revokeObjectURL(oldSrc);
}


/***/ }),

/***/ "./node_modules/style-loader/lib/urls.js":
/*!***********************************************!*\
  !*** ./node_modules/style-loader/lib/urls.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {


/**
 * When source maps are enabled, `style-loader` uses a link element with a data-uri to
 * embed the css on the page. This breaks all relative urls because now they are relative to a
 * bundle instead of the current page.
 *
 * One solution is to only use full urls, but that may be impossible.
 *
 * Instead, this function "fixes" the relative urls to be absolute according to the current page location.
 *
 * A rudimentary test suite is located at `test/fixUrls.js` and can be run via the `npm test` command.
 *
 */

module.exports = function (css) {
  // get current location
  var location = typeof window !== "undefined" && window.location;

  if (!location) {
    throw new Error("fixUrls requires window.location");
  }

	// blank or null?
	if (!css || typeof css !== "string") {
	  return css;
  }

  var baseUrl = location.protocol + "//" + location.host;
  var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");

	// convert each url(...)
	/*
	This regular expression is just a way to recursively match brackets within
	a string.

	 /url\s*\(  = Match on the word "url" with any whitespace after it and then a parens
	   (  = Start a capturing group
	     (?:  = Start a non-capturing group
	         [^)(]  = Match anything that isn't a parentheses
	         |  = OR
	         \(  = Match a start parentheses
	             (?:  = Start another non-capturing groups
	                 [^)(]+  = Match anything that isn't a parentheses
	                 |  = OR
	                 \(  = Match a start parentheses
	                     [^)(]*  = Match anything that isn't a parentheses
	                 \)  = Match a end parentheses
	             )  = End Group
              *\) = Match anything and then a close parens
          )  = Close non-capturing group
          *  = Match anything
       )  = Close capturing group
	 \)  = Match a close parens

	 /gi  = Get all matches, not the first.  Be case insensitive.
	 */
	var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
		// strip quotes (if they exist)
		var unquotedOrigUrl = origUrl
			.trim()
			.replace(/^"(.*)"$/, function(o, $1){ return $1; })
			.replace(/^'(.*)'$/, function(o, $1){ return $1; });

		// already a full url? no change
		if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(unquotedOrigUrl)) {
		  return fullMatch;
		}

		// convert the url to a full url
		var newUrl;

		if (unquotedOrigUrl.indexOf("//") === 0) {
		  	//TODO: should we add protocol?
			newUrl = unquotedOrigUrl;
		} else if (unquotedOrigUrl.indexOf("/") === 0) {
			// path should be relative to the base url
			newUrl = baseUrl + unquotedOrigUrl; // already starts with '/'
		} else {
			// path should be relative to current directory
			newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, ""); // Strip leading './'
		}

		// send back the fixed url(...)
		return "url(" + JSON.stringify(newUrl) + ")";
	});

	// send back the fixed css
	return fixedCss;
};


/***/ }),

/***/ "./resources/assets/vendor/js/_theme-settings/_theme-settings-bg-item.html":
/*!*********************************************************************************!*\
  !*** ./resources/assets/vendor/js/_theme-settings/_theme-settings-bg-item.html ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<label class=\"theme-settings-bg-item\">\n  <input type=\"radio\">\n  <span class=\"theme-settings-bg-name\"></span>\n</label>\n";

/***/ }),

/***/ "./resources/assets/vendor/js/_theme-settings/_theme-settings-theme-item.html":
/*!************************************************************************************!*\
  !*** ./resources/assets/vendor/js/_theme-settings/_theme-settings-theme-item.html ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<label class=\"theme-settings-theme-item custom-controls-stacked\">\n  <input type=\"radio\" name=\"theme-settings-current-theme\">\n  <span class=\"d-block mr-auto\">\n    <span class=\"theme-settings-theme-checkmark\"></span> &nbsp;&nbsp;\n    <span class=\"theme-settings-theme-name\"></span>\n  </span>\n  <span class=\"theme-settings-theme-colors d-flex\"></span>\n</label>\n";

/***/ }),

/***/ "./resources/assets/vendor/js/_theme-settings/_theme-settings.html":
/*!*************************************************************************!*\
  !*** ./resources/assets/vendor/js/_theme-settings/_theme-settings.html ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div id=\"theme-settings\">\n  <a href=\"javascript:void(0)\" class=\"theme-settings-open-btn\" tabindex=\"-1\"></a>\n\n  <h5 class=\"p-4 m-0 line-height-1 font-weight-bolder bg-light theme-settings-header\">\n    <span class=\"theme-settings-t-panel_header\"></span>\n    <a href=\"javascript:void(0)\" class=\"theme-settings-close-btn font-weight-light px-4 py-2 text-dark\" tabindex=\"-1\">&times;</a>\n  </h5>\n\n  <div class=\"theme-settings-inner pt-4\">\n\n    <label class=\"m-0 px-4 pb-3 d-flex media align-items-middle theme-settings-rtl\">\n      <div class=\"media-body\"><span class=\"theme-settings-t-rtl_switcher\"></span></div>\n      <div class=\"switcher switcher-sm d-block m-0\">\n        <input class=\"switcher-input\" type=\"checkbox\">\n        <span class=\"switcher-indicator\">\n          <span class=\"switcher-yes\"></span>\n          <span class=\"switcher-no\"></span>\n        </span>\n      </div>\n    </label>\n\n    <label class=\"m-0 px-4 pb-3 d-flex media align-items-middle theme-settings-material\">\n      <div class=\"media-body\"><span class=\"theme-settings-t-material_switcher\"></span></div>\n      <div class=\"switcher switcher-sm d-block m-0\">\n        <input class=\"switcher-input\" type=\"checkbox\">\n        <span class=\"switcher-indicator\">\n          <span class=\"switcher-yes\"></span>\n          <span class=\"switcher-no\"></span>\n        </span>\n      </div>\n    </label>\n\n    <div class=\"theme-settings-layout\">\n      <hr class=\"m-0 border-light\">\n\n      <h5 class=\"m-0 px-4 py-3 line-height-1 text-light d-block\">\n        <span class=\"theme-settings-t-layout_header\"></span>\n      </h5>\n\n      <label class=\"m-0 px-4 pb-3 d-block theme-settings-layoutPosition\">\n        <select class=\"custom-select custom-select-sm d-block w-100\">\n          <option value=\"static\" class=\"theme-settings-t-layout_static\"></option>\n          <option value=\"static-offcanvas\" class=\"theme-settings-t-layout_offcanvas\"></option>\n          <option value=\"fixed\" class=\"theme-settings-t-layout_fixed\"></option>\n          <option value=\"fixed-offcanvas\" class=\"theme-settings-t-layout_fixed_offcanvas\"></option>\n        </select>\n      </label>\n\n      <label class=\"m-0 px-4 pb-3 d-flex media align-items-middle theme-settings-layoutNavbarFixed\">\n        <div class=\"media-body\"><span class=\"theme-settings-t-layout_navbar_swicher\"></span></div>\n        <div class=\"switcher switcher-sm d-block m-0\">\n          <input class=\"switcher-input\" type=\"checkbox\">\n          <span class=\"switcher-indicator\">\n            <span class=\"switcher-yes\"></span>\n            <span class=\"switcher-no\"></span>\n          </span>\n        </div>\n      </label>\n\n      <label class=\"m-0 px-4 pb-3 d-flex media align-items-middle theme-settings-layoutFooterFixed\">\n        <div class=\"media-body\"><span class=\"theme-settings-t-layout_footer_swicher\"></span></div>\n        <div class=\"switcher switcher-sm d-block m-0\">\n          <input class=\"switcher-input\" type=\"checkbox\">\n          <span class=\"switcher-indicator\">\n            <span class=\"switcher-yes\"></span>\n            <span class=\"switcher-no\"></span>\n          </span>\n        </div>\n      </label>\n\n      <label class=\"m-0 px-4 pb-3 d-flex media align-items-middle theme-settings-layoutReversed\">\n        <div class=\"media-body\"><span class=\"theme-settings-t-layout_reversed_swicher\"></span></div>\n        <div class=\"switcher switcher-sm d-block m-0\">\n          <input class=\"switcher-input\" type=\"checkbox\">\n          <span class=\"switcher-indicator\">\n            <span class=\"switcher-yes\"></span>\n            <span class=\"switcher-no\"></span>\n          </span>\n        </div>\n      </label>\n    </div>\n\n    <div class=\"theme-settings-navbarBg\">\n      <hr class=\"m-0 border-light\">\n\n      <h5 class=\"m-0 px-4 py-3 line-height-1 text-light d-block \">\n        <span class=\"theme-settings-t-navbar_bg_header\"></span>\n      </h5>\n\n      <fieldset class=\"m-0 px-4 pb-3 d-block clearfix theme-settings-navbarBg-inner\"></fieldset>\n    </div>\n\n    <div class=\"theme-settings-sidenavBg\">\n      <hr class=\"m-0 border-light\">\n\n      <h5 class=\"m-0 px-4 py-3 line-height-1 text-light d-block\">\n        <span class=\"theme-settings-t-sidenav_bg_header\"></span>\n      </h5>\n\n      <fieldset class=\"m-0 px-4 pb-3 d-block clearfix theme-settings-sidenavBg-inner\"></fieldset>\n    </div>\n\n    <div class=\"theme-settings-footerBg\">\n      <hr class=\"m-0 border-light\">\n\n      <h5 class=\"m-0 px-4 py-3 line-height-1 text-light d-block\">\n        <span class=\"theme-settings-t-footer_bg_header\"></span>\n      </h5>\n\n      <fieldset class=\"m-0 px-4 pb-3 d-block clearfix theme-settings-footerBg-inner\"></fieldset>\n    </div>\n\n    <div class=\"theme-settings-themes\">\n      <hr class=\"m-0 border-light\">\n\n      <h5 class=\"m-0 px-4 py-3 line-height-1 text-light d-block\">\n        <span class=\"theme-settings-t-theme_header\"></span>\n      </h5>\n\n      <div class=\"theme-settings-themes-inner\"></div>\n    </div>\n\n  </div>\n</div>\n";

/***/ }),

/***/ "./resources/assets/vendor/js/_theme-settings/_theme-settings.scss":
/*!*************************************************************************!*\
  !*** ./resources/assets/vendor/js/_theme-settings/_theme-settings.scss ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/postcss-loader/src??ref--129-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--129-3!./_theme-settings.scss */ "./node_modules/css-loader/index.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./resources/assets/vendor/js/_theme-settings/_theme-settings.scss");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./resources/assets/vendor/js/theme-settings.js":
/*!******************************************************!*\
  !*** ./resources/assets/vendor/js/theme-settings.js ***!
  \******************************************************/
/*! exports provided: ThemeSettings */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ThemeSettings", function() { return ThemeSettings; });
/* harmony import */ var _theme_settings_theme_settings_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_theme-settings/_theme-settings.scss */ "./resources/assets/vendor/js/_theme-settings/_theme-settings.scss");
/* harmony import */ var _theme_settings_theme_settings_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_theme_settings_theme_settings_scss__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _theme_settings_theme_settings_html__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_theme-settings/_theme-settings.html */ "./resources/assets/vendor/js/_theme-settings/_theme-settings.html");
/* harmony import */ var _theme_settings_theme_settings_html__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_theme_settings_theme_settings_html__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _theme_settings_theme_settings_theme_item_html__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./_theme-settings/_theme-settings-theme-item.html */ "./resources/assets/vendor/js/_theme-settings/_theme-settings-theme-item.html");
/* harmony import */ var _theme_settings_theme_settings_theme_item_html__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_theme_settings_theme_settings_theme_item_html__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _theme_settings_theme_settings_bg_item_html__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./_theme-settings/_theme-settings-bg-item.html */ "./resources/assets/vendor/js/_theme-settings/_theme-settings-bg-item.html");
/* harmony import */ var _theme_settings_theme_settings_bg_item_html__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_theme_settings_theme_settings_bg_item_html__WEBPACK_IMPORTED_MODULE_3__);
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }





var DEFAULT_THEME = 1;
var CSS_FILENAME_PATTERN = '%name%.css';
var CONTROLS = ['rtl', 'material', 'layoutPosition', 'layoutNavbarFixed', 'layoutFooterFixed', 'layoutReversed', 'navbarBg', 'sidenavBg', 'footerBg', 'themes'];
var DEFAULT_NAVBAR_BG = 'navbar-theme';
var DEFAULT_SIDENAV_BG = 'sidenav-theme';
var DEFAULT_FOOTER_BG = 'footer-theme';

var ThemeSettings = /*#__PURE__*/function () {
  function ThemeSettings(_ref) {
    var cssPath = _ref.cssPath,
        themesPath = _ref.themesPath,
        cssFilenamePattern = _ref.cssFilenamePattern,
        controls = _ref.controls,
        sidenavBgs = _ref.sidenavBgs,
        defaultSidenavBg = _ref.defaultSidenavBg,
        navbarBgs = _ref.navbarBgs,
        defaultNavbarBg = _ref.defaultNavbarBg,
        footerBgs = _ref.footerBgs,
        defaultFooterBg = _ref.defaultFooterBg,
        availableThemes = _ref.availableThemes,
        defaultTheme = _ref.defaultTheme,
        pathResolver = _ref.pathResolver,
        onSettingsChange = _ref.onSettingsChange,
        lang = _ref.lang;

    _classCallCheck(this, ThemeSettings);

    if (this._ssr) return;
    if (!window.layoutHelpers) throw new Error('window.layoutHelpers required.');
    this.settings = {};
    this.settings.cssPath = cssPath;
    this.settings.themesPath = themesPath;
    this.settings.cssFilenamePattern = cssFilenamePattern || CSS_FILENAME_PATTERN;
    this.settings.navbarBgs = navbarBgs || ThemeSettings.NAVBAR_BGS;
    this.settings.defaultNavbarBg = defaultNavbarBg || DEFAULT_NAVBAR_BG;
    this.settings.sidenavBgs = sidenavBgs || ThemeSettings.SIDENAV_BGS;
    this.settings.defaultSidenavBg = defaultSidenavBg || DEFAULT_SIDENAV_BG;
    this.settings.footerBgs = footerBgs || ThemeSettings.FOOTER_BGS;
    this.settings.defaultFooterBg = defaultFooterBg || DEFAULT_FOOTER_BG;
    this.settings.availableThemes = availableThemes || ThemeSettings.AVAILABLE_THEMES;
    this.settings.defaultTheme = this._getDefaultTheme(typeof defaultTheme !== 'undefined' ? defaultTheme : DEFAULT_THEME);
    this.settings.controls = controls || CONTROLS;
    this.settings.lang = lang || 'en';

    this.pathResolver = pathResolver || function (p) {
      return p;
    };

    this.settings.onSettingsChange = typeof onSettingsChange === 'function' ? onSettingsChange : function () {};

    this._loadSettings();

    this._listeners = [];
    this._controls = {};

    this._initDirection();

    this._initStyle();

    this._initTheme();

    this.setLayoutPosition(this.settings.layoutPosition, false);
    this.setLayoutNavbarFixed(this.settings.layoutNavbarFixed, false);
    this.setLayoutFooterFixed(this.settings.layoutFooterFixed, false);
    this.setLayoutReversed(this.settings.layoutReversed, false);

    this._setup();

    this._waitForNavs();
  }

  _createClass(ThemeSettings, [{
    key: "setRtl",
    value: function setRtl(rtl) {
      if (!this._hasControls('rtl')) return;

      this._setSetting('Rtl', String(rtl));

      window.location.reload();
    }
  }, {
    key: "setMaterial",
    value: function setMaterial(material) {
      if (!this._hasControls('material')) return;

      this._setSetting('Material', String(material));

      window.location.reload();
    }
  }, {
    key: "setTheme",
    value: function setTheme(themeName) {
      var updateStorage = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      var cb = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
      if (!this._hasControls('themes')) return;

      var theme = this._getThemeByName(themeName);

      if (!theme) return;
      this.settings.theme = theme;
      if (updateStorage) this._setSetting('Theme', themeName);
      var themeUrl = this.pathResolver(this.settings.themesPath + this.settings.cssFilenamePattern.replace('%name%', themeName + (this.settings.material ? '-material' : '')));

      this._loadStylesheets(_defineProperty({}, themeUrl, document.querySelector('.theme-settings-theme-css')), cb || function () {});

      if (updateStorage) this.settings.onSettingsChange.call(this, this.settings);
    }
  }, {
    key: "setLayoutPosition",
    value: function setLayoutPosition(pos) {
      var updateStorage = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      if (!this._hasControls('layoutPosition')) return;
      if (pos !== 'static' && pos !== 'static-offcanvas' && pos !== 'fixed' && pos !== 'fixed-offcanvas') return;
      this.settings.layoutPosition = pos;
      if (updateStorage) this._setSetting('LayoutPosition', pos);
      window.layoutHelpers.setPosition(pos === 'fixed' || pos === 'fixed-offcanvas', pos === 'static-offcanvas' || pos === 'fixed-offcanvas');
      if (updateStorage) this.settings.onSettingsChange.call(this, this.settings);
    }
  }, {
    key: "setLayoutNavbarFixed",
    value: function setLayoutNavbarFixed(fixed) {
      var updateStorage = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      if (!this._hasControls('layoutNavbarFixed')) return;
      this.settings.layoutNavbarFixed = fixed;
      if (updateStorage) this._setSetting('FixedNavbar', fixed);
      window.layoutHelpers.setNavbarFixed(fixed);
      if (updateStorage) this.settings.onSettingsChange.call(this, this.settings);
    }
  }, {
    key: "setLayoutFooterFixed",
    value: function setLayoutFooterFixed(fixed) {
      var updateStorage = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      if (!this._hasControls('layoutFooterFixed')) return;
      this.settings.layoutFooterFixed = fixed;
      if (updateStorage) this._setSetting('FixedFooter', fixed);
      window.layoutHelpers.setFooterFixed(fixed);
      if (updateStorage) this.settings.onSettingsChange.call(this, this.settings);
    }
  }, {
    key: "setLayoutReversed",
    value: function setLayoutReversed(reversed) {
      var updateStorage = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      if (!this._hasControls('layoutReversed')) return;
      this.settings.layoutReversed = reversed;
      if (updateStorage) this._setSetting('LayoutReversed', reversed);
      window.layoutHelpers.setReversed(reversed);
      if (updateStorage) this.settings.onSettingsChange.call(this, this.settings);
    }
  }, {
    key: "setNavbarBg",
    value: function setNavbarBg(bg) {
      var updateStorage = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

      var _container = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : document;

      if (!this._hasControls('navbarBg')) return;
      if (this.settings.navbarBgs.indexOf(bg) === -1) return;
      this.settings.navbarBg = bg;
      if (updateStorage) this._setSetting('NavbarBg', bg);

      var navbar = _container.querySelector('.layout-navbar.navbar, .layout-navbar .navbar');

      if (!navbar) return;
      navbar.className = navbar.className.replace(/^bg\-[^ ]+| bg\-[^ ]+/ig, '');
      navbar.classList.remove('navbar-light');
      navbar.classList.remove('navbar-dark');
      var classes = bg.split(' ');
      navbar.classList.add("bg-".concat(classes[0]));

      for (var i = 1, l = classes.length; i < l; i++) {
        navbar.classList.add(classes[i]);
      }

      if (updateStorage) this.settings.onSettingsChange.call(this, this.settings);
    }
  }, {
    key: "setSidenavBg",
    value: function setSidenavBg(bg) {
      var updateStorage = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

      var _container = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : document;

      if (!this._hasControls('sidenavBg')) return;
      if (this.settings.sidenavBgs.indexOf(bg) === -1) return;
      this.settings.sidenavBg = bg;
      if (updateStorage) this._setSetting('SidenavBg', bg);

      var sidenav = _container.querySelector('.layout-sidenav.sidenav, .layout-sidenav .sidenav, .layout-sidenav-horizontal.sidenav, .layout-sidenav-horizontal .sidenav');

      if (!sidenav) return;
      sidenav.className = sidenav.className.replace(/^bg\-[^ ]+| bg\-[^ ]+/ig, '');
      sidenav.classList.remove('sidenav-light');
      sidenav.classList.remove('sidenav-dark');
      var classes = bg.split(' ');

      if (sidenav.classList.contains('sidenav-horizontal')) {
        classes = classes.join(' ').replace(' sidenav-dark', '').replace(' sidenav-light', '').split(' ');
        classes[0] = classes[0].replace(/-darke?r?$/, '');
      }

      sidenav.classList.add("bg-".concat(classes[0]));

      for (var i = 1, l = classes.length; i < l; i++) {
        sidenav.classList.add(classes[i]);
      }

      if (updateStorage) this.settings.onSettingsChange.call(this, this.settings);
    }
  }, {
    key: "setFooterBg",
    value: function setFooterBg(bg) {
      var updateStorage = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

      var _container = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : document;

      if (!this._hasControls('footerBg')) return;
      if (this.settings.footerBgs.indexOf(bg) === -1) return;
      this.settings.footerBg = bg;
      if (updateStorage) this._setSetting('FooterBg', bg);

      var footer = _container.querySelector('.layout-footer.footer, .layout-footer .footer');

      if (!footer) return;
      footer.className = footer.className.replace(/^bg\-[^ ]+| bg\-[^ ]+/ig, '');
      footer.classList.remove('footer-light');
      footer.classList.remove('footer-dark');
      var classes = bg.split(' ');
      footer.classList.add("bg-".concat(classes[0]));

      for (var i = 1, l = classes.length; i < l; i++) {
        footer.classList.add(classes[i]);
      }

      if (updateStorage) this.settings.onSettingsChange.call(this, this.settings);
    }
  }, {
    key: "setLang",
    value: function setLang(lang) {
      var _this = this;

      var force = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      if (lang === this.settings.lang && !force) return;
      if (!ThemeSettings.LANGUAGES[lang]) throw new Error("Language \"".concat(lang, "\" not found!"));
      var t = ThemeSettings.LANGUAGES[lang];
      ['panel_header', 'rtl_switcher', 'material_switcher', 'layout_header', 'layout_static', 'layout_offcanvas', 'layout_fixed', 'layout_fixed_offcanvas', 'layout_navbar_swicher', 'layout_footer_swicher', 'layout_reversed_swicher', 'navbar_bg_header', 'sidenav_bg_header', 'footer_bg_header', 'theme_header'].forEach(function (key) {
        var el = _this.container.querySelector(".theme-settings-t-".concat(key));

        el && (el.textContent = t[key]);
      });
      var tt = t.themes || {};
      var themes = this.container.querySelectorAll('.theme-settings-theme-item') || [];

      for (var i = 0, l = themes.length; i < l; i++) {
        var themeName = themes[i].querySelector('input[type="radio"]').value;
        themes[i].querySelector('.theme-settings-theme-name').textContent = tt[themeName] || this._getThemeByName(themeName).title;
      }

      this.settings.lang = lang;
    }
  }, {
    key: "update",
    value: function update() {
      if (this._ssr) return;
      var hasNavbar = !!document.querySelector('.layout-navbar');
      var hasSidenav = !!document.querySelector('.layout-sidenav');
      var hasHorizontalSidenav = !!document.querySelector('.layout-sidenav-horizontal.sidenav, .layout-sidenav-horizontal .sidenav');
      var isLayout1 = !!document.querySelector('.layout-wrapper.layout-1');
      var hasFooter = !!document.querySelector('.layout-footer');

      if (this._controls.layoutReversed) {
        if (!hasSidenav) {
          this._controls.layoutReversed.setAttribute('disabled', 'disabled');

          this._controls.layoutReversedW.classList.add('disabled');
        } else {
          this._controls.layoutReversed.removeAttribute('disabled');

          this._controls.layoutReversedW.classList.remove('disabled');
        }
      }

      if (this._controls.layoutNavbarFixed) {
        if (!hasNavbar) {
          this._controls.layoutNavbarFixed.setAttribute('disabled', 'disabled');

          this._controls.layoutNavbarFixedW.classList.add('disabled');
        } else {
          this._controls.layoutNavbarFixed.removeAttribute('disabled');

          this._controls.layoutNavbarFixedW.classList.remove('disabled');
        }
      }

      if (this._controls.layoutFooterFixed) {
        if (!hasFooter) {
          this._controls.layoutFooterFixed.setAttribute('disabled', 'disabled');

          this._controls.layoutFooterFixedW.classList.add('disabled');
        } else {
          this._controls.layoutFooterFixed.removeAttribute('disabled');

          this._controls.layoutFooterFixedW.classList.remove('disabled');
        }
      }

      if (this._controls.layoutPosition) {
        if (!hasSidenav) {
          this._controls.layoutPosition.querySelector('[value="static-offcanvas"]').setAttribute('disabled', 'disabled');

          this._controls.layoutPosition.querySelector('[value="fixed-offcanvas"]').setAttribute('disabled', 'disabled');
        } else {
          this._controls.layoutPosition.querySelector('[value="static-offcanvas"]').removeAttribute('disabled');

          this._controls.layoutPosition.querySelector('[value="fixed-offcanvas"]').removeAttribute('disabled');
        }

        if (!hasNavbar && !hasSidenav || !hasSidenav && !isLayout1) {
          this._controls.layoutPosition.setAttribute('disabled', 'disabled');
        } else {
          this._controls.layoutPosition.removeAttribute('disabled');
        }
      }

      if (this._controls.navbarBgWInner) {
        if (!hasNavbar) {
          this._controls.navbarBgWInner.setAttribute('disabled', 'disabled');
        } else {
          this._controls.navbarBgWInner.removeAttribute('disabled');
        }
      }

      if (this._controls.sidenavBgWInner) {
        var items = Array.prototype.slice.call(document.querySelectorAll('.theme-settings-sidenavBg-inner .theme-settings-bg-item'));

        if (!hasSidenav && !hasHorizontalSidenav) {
          items.forEach(function (item) {
            item.classList.add('disabled');
            item.querySelector('input').setAttribute('disabled', 'disabled');
          });
        } else {
          items.forEach(function (item) {
            item.classList.remove('disabled');
            item.querySelector('input').removeAttribute('disabled');
          });
          if (hasHorizontalSidenav) items.forEach(function (item) {
            if (!/-darke?r?/.test(item.className) || /bg-dark/.test(item.className)) return;
            item.classList.add('disabled');
            item.querySelector('input').setAttribute('disabled', 'disabled');
          });
        }
      }

      if (this._controls.footerBgWInner) {
        if (!hasFooter) {
          this._controls.footerBgWInner.setAttribute('disabled', 'disabled');
        } else {
          this._controls.footerBgWInner.removeAttribute('disabled');
        }
      }
    }
  }, {
    key: "updateNavbarBg",
    value: function updateNavbarBg() {
      var _container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;

      this.setNavbarBg(this.settings.navbarBg, false, _container);
    }
  }, {
    key: "updateSidenavBg",
    value: function updateSidenavBg() {
      var _container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;

      this.setSidenavBg(this.settings.sidenavBg, false, _container);
    }
  }, {
    key: "updateFooterBg",
    value: function updateFooterBg() {
      var _container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;

      this.setFooterBg(this.settings.footerBg, false, _container);
    }
  }, {
    key: "clearLocalStorage",
    value: function clearLocalStorage() {
      if (this._ssr) return;

      this._setSetting('Theme', '');

      this._setSetting('Rtl', '');

      this._setSetting('Material', '');

      this._setSetting('LayoutReversed', '');

      this._setSetting('FixedNavbar', '');

      this._setSetting('FixedFooter', '');

      this._setSetting('LayoutPosition', '');

      this._setSetting('NavbarBg', '');

      this._setSetting('SidenavBg', '');

      this._setSetting('FooterBg', '');
    }
  }, {
    key: "destroy",
    value: function destroy() {
      if (this._ssr) return;

      this._cleanup();

      this.settings = null;
      this.container.parentNode.removeChild(this.container);
      this.container = null;
    }
  }, {
    key: "_loadSettings",
    value: function _loadSettings() {
      var cl = document.documentElement.classList;

      var rtl = this._getSetting('Rtl');

      var material = this._getSetting('Material');

      var reversed = this._getSetting('LayoutReversed');

      var fixedNavbar = this._getSetting('FixedNavbar');

      var fixedFooter = this._getSetting('FixedFooter');

      var navbarBg = this._getSetting('NavbarBg');

      var sidenavBg = this._getSetting('SidenavBg');

      var footerBg = this._getSetting('FooterBg');

      var lPosition = this._getSetting('LayoutPosition');

      var position;

      if (lPosition !== '' && ['static', 'static-offcanvas', 'fixed', 'fixed-offcanvas'].indexOf(lPosition) !== -1) {
        position = lPosition;
      } else if (cl.contains('layout-offcanvas')) {
        position = 'static-offcanvas';
      } else if (cl.contains('layout-fixed')) {
        position = 'fixed';
      } else if (cl.contains('layout-fixed-offcanvas')) {
        position = 'fixed-offcanvas';
      } else {
        position = 'static';
      } // Set settings


      this.settings.rtl = rtl !== '' ? rtl === 'true' : document.documentElement.getAttribute('dir') === 'rtl';
      this.settings.material = material !== '' ? material === 'true' : cl.contains('material-style');
      this.settings.layoutPosition = position;
      this.settings.layoutReversed = reversed !== '' ? reversed === 'true' : cl.contains('layout-reversed');
      this.settings.layoutNavbarFixed = fixedNavbar !== '' ? fixedNavbar === 'true' : cl.contains('layout-navbar-fixed');
      this.settings.layoutFooterFixed = fixedFooter !== '' ? fixedFooter === 'true' : cl.contains('layout-footer-fixed');
      this.settings.navbarBg = this.settings.navbarBgs.indexOf(navbarBg) !== -1 ? navbarBg : this.settings.defaultNavbarBg;
      this.settings.sidenavBg = this.settings.sidenavBgs.indexOf(sidenavBg) !== -1 ? sidenavBg : this.settings.defaultSidenavBg;
      this.settings.footerBg = this.settings.footerBgs.indexOf(footerBg) !== -1 ? footerBg : this.settings.defaultFooterBg;
      this.settings.theme = this._getThemeByName(this._getSetting('Theme'), true); // Filter options depending on available controls

      if (!this._hasControls('rtl')) this.settings.rtl = document.documentElement.getAttribute('dir') === 'rtl';
      if (!this._hasControls('material')) this.settings.material = cl.contains('material-style');
      if (!this._hasControls('layoutPosition')) this.settings.layoutPosition = null;
      if (!this._hasControls('layoutReversed')) this.settings.layoutReversed = null;
      if (!this._hasControls('layoutNavbarFixed')) this.settings.layoutNavbarFixed = null;
      if (!this._hasControls('layoutFooterFixed')) this.settings.layoutFooterFixed = null;
      if (!this._hasControls('navbarBg')) this.settings.navbarBg = null;
      if (!this._hasControls('sidenavBg')) this.settings.sidenavBg = null;
      if (!this._hasControls('footerBg')) this.settings.footerBg = null;
      if (!this._hasControls('themes')) this.settings.theme = null;
    }
  }, {
    key: "_setup",
    value: function _setup() {
      var _this2 = this;

      var _container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;

      this._cleanup();

      this.container = this._getElementFromString(_theme_settings_theme_settings_html__WEBPACK_IMPORTED_MODULE_1___default.a); // Open btn
      //

      var openBtn = this.container.querySelector('.theme-settings-open-btn');

      var openBtnCb = function openBtnCb() {
        _this2.container.classList.add('theme-settings-open');

        _this2.update();

        if (_this2._updateInterval) clearInterval(_this2._updateInterval);
        _this2._updateInterval = setInterval(function () {
          _this2.update();
        }, 1000);
      };

      openBtn.addEventListener('click', openBtnCb);

      this._listeners.push([openBtn, 'click', openBtnCb]); // Close btn
      //


      var closeBtn = this.container.querySelector('.theme-settings-close-btn');

      var closeBtnCb = function closeBtnCb() {
        _this2.container.classList.remove('theme-settings-open');

        if (_this2._updateInterval) {
          clearInterval(_this2._updateInterval);
          _this2._updateInterval = null;
        }
      };

      closeBtn.addEventListener('click', closeBtnCb);

      this._listeners.push([closeBtn, 'click', closeBtnCb]); // RTL
      //


      var rtlW = this.container.querySelector('.theme-settings-rtl');

      if (!this._hasControls('rtl')) {
        rtlW.parentNode.removeChild(rtlW);
      } else {
        var rtl = rtlW.querySelector('input');
        if (this.settings.rtl) rtl.setAttribute('checked', 'checked');

        var rtlCb = function rtlCb(e) {
          _this2._loadingState(true);

          _this2.setRtl(e.target.checked);
        };

        rtl.addEventListener('change', rtlCb);

        this._listeners.push([rtl, 'change', rtlCb]);
      } // Material
      //


      var materialW = this.container.querySelector('.theme-settings-material');

      if (!this._hasControls('material')) {
        materialW.parentNode.removeChild(materialW);
      } else {
        var material = materialW.querySelector('input');
        if (this.settings.material) material.setAttribute('checked', 'checked');

        var materialCb = function materialCb(e) {
          _this2._loadingState(true);

          _this2.setMaterial(e.target.checked);
        };

        material.addEventListener('change', materialCb);

        this._listeners.push([material, 'change', materialCb]);
      } // Layout wrapper
      //


      var layoutW = this.container.querySelector('.theme-settings-layout');

      if (!this._hasControls('layoutPosition layoutNavbarFixed layoutFooterFixed layoutReversed', true)) {
        layoutW.parentNode.removeChild(layoutW);
      } else {
        // Position
        //
        var layoutPositionW = this.container.querySelector('.theme-settings-layoutPosition');

        if (!this._hasControls('layoutPosition')) {
          layoutPositionW.parentNode.removeChild(layoutPositionW);
        } else {
          this._controls.layoutPosition = layoutPositionW.querySelector('select');
          this._controls.layoutPosition.value = this.settings.layoutPosition;

          var layoutPositionCb = function layoutPositionCb(e) {
            return _this2.setLayoutPosition(e.target.value);
          };

          this._controls.layoutPosition.addEventListener('change', layoutPositionCb);

          this._listeners.push([this._controls.layoutPosition, 'change', layoutPositionCb]);
        } // Navbar
        //


        this._controls.layoutNavbarFixedW = this.container.querySelector('.theme-settings-layoutNavbarFixed');

        if (!this._hasControls('layoutNavbarFixed')) {
          this._controls.layoutNavbarFixedW.parentNode.removeChild(this._controls.layoutNavbarFixedW);
        } else {
          this._controls.layoutNavbarFixed = this._controls.layoutNavbarFixedW.querySelector('input');
          if (this.settings.layoutNavbarFixed) this._controls.layoutNavbarFixed.setAttribute('checked', 'checked');

          var layoutNavbarFixedCb = function layoutNavbarFixedCb(e) {
            return _this2.setLayoutNavbarFixed(e.target.checked);
          };

          this._controls.layoutNavbarFixed.addEventListener('change', layoutNavbarFixedCb);

          this._listeners.push([this._controls.layoutNavbarFixed, 'change', layoutNavbarFixedCb]);
        } // Footer
        //


        this._controls.layoutFooterFixedW = this.container.querySelector('.theme-settings-layoutFooterFixed');

        if (!this._hasControls('layoutFooterFixed')) {
          this._controls.layoutFooterFixedW.parentNode.removeChild(this._controls.layoutFooterFixedW);
        } else {
          this._controls.layoutFooterFixed = this._controls.layoutFooterFixedW.querySelector('input');
          if (this.settings.layoutFooterFixed) this._controls.layoutFooterFixed.setAttribute('checked', 'checked');

          var layoutFooterFixedCb = function layoutFooterFixedCb(e) {
            return _this2.setLayoutFooterFixed(e.target.checked);
          };

          this._controls.layoutFooterFixed.addEventListener('change', layoutFooterFixedCb);

          this._listeners.push([this._controls.layoutFooterFixed, 'change', layoutFooterFixedCb]);
        } // Reversed
        //


        this._controls.layoutReversedW = this.container.querySelector('.theme-settings-layoutReversed');

        if (!this._hasControls('layoutReversed')) {
          this._controls.layoutReversedW.parentNode.removeChild(this._controls.layoutReversedW);
        } else {
          this._controls.layoutReversed = this._controls.layoutReversedW.querySelector('input');
          if (this.settings.layoutReversed) this._controls.layoutReversed.setAttribute('checked', 'checked');

          var layoutReversedCb = function layoutReversedCb(e) {
            return _this2.setLayoutReversed(e.target.checked);
          };

          this._controls.layoutReversed.addEventListener('change', layoutReversedCb);

          this._listeners.push([this._controls.layoutReversed, 'change', layoutReversedCb]);
        }
      } // Navbar Bg
      //


      var navbarBgW = this.container.querySelector('.theme-settings-navbarBg');

      if (!this._hasControls('navbarBg')) {
        navbarBgW.parentNode.removeChild(navbarBgW);
      } else {
        this._controls.navbarBgWInner = navbarBgW.querySelector('.theme-settings-navbarBg-inner');
        this.settings.navbarBgs.forEach(function (bg) {
          var bgItem = _this2._getElementFromString(_theme_settings_theme_settings_bg_item_html__WEBPACK_IMPORTED_MODULE_3___default.a);

          var control = bgItem.querySelector('input');
          bgItem.classList.add("bg-".concat(bg.split(' ')[0]));
          control.name = 'theme-settings-navbarBg-input';
          control.value = bg;

          if (_this2.settings.navbarBg === bg) {
            control.setAttribute('checked', 'checked');
            bgItem.classList.add('active');
          }

          var cb = function cb(e) {
            var items = _this2._controls.navbarBgWInner.querySelectorAll('.theme-settings-bg-item');

            for (var i = 0, l = items.length; i < l; i++) {
              items[i].classList.remove('active');
            }

            e.target.parentNode.classList.add('active');

            _this2.setNavbarBg(e.target.value);
          };

          control.addEventListener('change', cb);

          _this2._listeners.push([control, 'change', cb]);

          _this2._controls.navbarBgWInner.appendChild(bgItem);
        });
      } // Sidenav Bg
      //


      var sidenavBgW = this.container.querySelector('.theme-settings-sidenavBg');

      if (!this._hasControls('sidenavBg')) {
        sidenavBgW.parentNode.removeChild(sidenavBgW);
      } else {
        this._controls.sidenavBgWInner = sidenavBgW.querySelector('.theme-settings-sidenavBg-inner');
        this.settings.sidenavBgs.forEach(function (bg) {
          var bgItem = _this2._getElementFromString(_theme_settings_theme_settings_bg_item_html__WEBPACK_IMPORTED_MODULE_3___default.a);

          var control = bgItem.querySelector('input');
          bgItem.classList.add("bg-".concat(bg.split(' ')[0]));
          control.name = 'theme-settings-sidenavBg-input';
          control.value = bg;

          if (_this2.settings.sidenavBg === bg) {
            control.setAttribute('checked', 'checked');
            bgItem.classList.add('active');
          }

          var cb = function cb(e) {
            var items = _this2._controls.sidenavBgWInner.querySelectorAll('.theme-settings-bg-item');

            for (var i = 0, l = items.length; i < l; i++) {
              items[i].classList.remove('active');
            }

            e.target.parentNode.classList.add('active');

            _this2.setSidenavBg(e.target.value);
          };

          control.addEventListener('change', cb);

          _this2._listeners.push([control, 'change', cb]);

          _this2._controls.sidenavBgWInner.appendChild(bgItem);
        });
      } // Footer Bg
      //


      var footerBgW = this.container.querySelector('.theme-settings-footerBg');

      if (!this._hasControls('footerBg')) {
        footerBgW.parentNode.removeChild(footerBgW);
      } else {
        this._controls.footerBgWInner = footerBgW.querySelector('.theme-settings-footerBg-inner');
        this.settings.footerBgs.forEach(function (bg) {
          var bgItem = _this2._getElementFromString(_theme_settings_theme_settings_bg_item_html__WEBPACK_IMPORTED_MODULE_3___default.a);

          var control = bgItem.querySelector('input');
          bgItem.classList.add("bg-".concat(bg.split(' ')[0]));
          control.name = 'theme-settings-footerBg-input';
          control.value = bg;

          if (_this2.settings.footerBg === bg) {
            control.setAttribute('checked', 'checked');
            bgItem.classList.add('active');
          }

          var cb = function cb(e) {
            var items = _this2._controls.footerBgWInner.querySelectorAll('.theme-settings-bg-item');

            for (var i = 0, l = items.length; i < l; i++) {
              items[i].classList.remove('active');
            }

            e.target.parentNode.classList.add('active');

            _this2.setFooterBg(e.target.value);
          };

          control.addEventListener('change', cb);

          _this2._listeners.push([control, 'change', cb]);

          _this2._controls.footerBgWInner.appendChild(bgItem);
        });
      } // Themes
      //


      var themesW = this.container.querySelector('.theme-settings-themes');

      if (!this._hasControls('themes')) {
        themesW.parentNode.removeChild(themesW);
      } else {
        var themesWInner = this.container.querySelector('.theme-settings-themes-inner'); // SETUP THEMES

        this.settings.availableThemes.forEach(function (theme) {
          var themeItem = _this2._getElementFromString(_theme_settings_theme_settings_theme_item_html__WEBPACK_IMPORTED_MODULE_2___default.a);

          var control = themeItem.querySelector('input');
          control.value = theme.name;

          if (_this2.settings.theme.name === theme.name) {
            control.setAttribute('checked', 'checked');
          }

          themeItem.querySelector('.theme-settings-theme-colors').innerHTML = "\n          <span style=\"background: ".concat(theme.colors.primary, "\"></span>\n          <span style=\"background: ").concat(theme.colors.navbar, "\"></span>\n          <span style=\"background: ").concat(theme.colors.sidenav, "\"></span>\n        ");

          var cb = function cb(e) {
            if (_this2._loading) return;
            _this2._loading = true;

            _this2._loadingState(true, true);

            _this2.setTheme(e.target.value, true, function () {
              _this2._loading = false;

              _this2._loadingState(false, true);
            });
          };

          control.addEventListener('change', cb);

          _this2._listeners.push([control, 'change', cb]);

          themesWInner.appendChild(themeItem);
        });
      } // Set language


      this.setLang(this.settings.lang, true); // Append container

      if (_container === document) {
        if (_container.body) {
          _container.body.appendChild(this.container);
        } else {
          window.addEventListener('DOMContentLoaded', function () {
            return _container.body.appendChild(_this2.container);
          });
        }
      } else {
        _container.appendChild(this.container);
      }
    }
  }, {
    key: "_initDirection",
    value: function _initDirection() {
      if (this._hasControls('rtl')) document.documentElement.setAttribute('dir', this.settings.rtl ? 'rtl' : 'ltr');
    }
  }, {
    key: "_initStyle",
    value: function _initStyle() {
      if (!this._hasControls('material')) return;
      var material = this.settings.material;

      this._insertStylesheet('theme-settings-bootstrap-css', this.pathResolver(this.settings.cssPath + this.settings.cssFilenamePattern.replace('%name%', 'bootstrap' + (material ? '-material' : ''))));

      this._insertStylesheet('theme-settings-appwork-css', this.pathResolver(this.settings.cssPath + this.settings.cssFilenamePattern.replace('%name%', 'appwork' + (material ? '-material' : ''))));

      this._insertStylesheet('theme-settings-colors-css', this.pathResolver(this.settings.cssPath + this.settings.cssFilenamePattern.replace('%name%', 'colors' + (material ? '-material' : ''))));

      document.documentElement.classList.remove(material ? 'default-style' : 'material-style');
      document.documentElement.classList.add(material ? 'material-style' : 'default-style');

      if (material && window.attachMaterialRipple) {
        if (document.body) {
          window.attachMaterialRipple();
        } else {
          window.addEventListener('DOMContentLoaded', function () {
            return window.attachMaterialRipple();
          });
        }
      }
    }
  }, {
    key: "_initTheme",
    value: function _initTheme() {
      if (this._hasControls('themes')) {
        this._insertStylesheet('theme-settings-theme-css', this.pathResolver(this.settings.themesPath + this.settings.cssFilenamePattern.replace('%name%', this.settings.theme.name + (this.settings.material ? '-material' : ''))));
      }
    }
  }, {
    key: "_insertStylesheet",
    value: function _insertStylesheet(className, href) {
      var curLink = document.querySelector(".".concat(className));

      if (typeof document.documentMode === 'number' && document.documentMode < 11) {
        if (!curLink) return;
        if (href === curLink.getAttribute('href')) return;
        var link = document.createElement('link');
        link.setAttribute('rel', 'stylesheet');
        link.setAttribute('type', 'text/css');
        link.className = className;
        link.setAttribute('href', href);
        curLink.parentNode.insertBefore(link, curLink.nextSibling);
      } else {
        document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"".concat(href, "\" class=\"").concat(className, "\">"));
      }

      curLink.parentNode.removeChild(curLink);
    }
  }, {
    key: "_loadStylesheets",
    value: function _loadStylesheets(stylesheets, cb) {
      var paths = Object.keys(stylesheets);
      var count = paths.length;
      var loaded = 0;

      function loadStylesheet(path, curLink, _cb) {
        var link = document.createElement('link');
        link.setAttribute('href', path);
        link.setAttribute('rel', 'stylesheet');
        link.setAttribute('type', 'text/css');
        link.className = curLink.className;
        var sheet = 'sheet' in link ? 'sheet' : 'styleSheet';
        var cssRules = 'sheet' in link ? 'cssRules' : 'rules';
        var timeoutId, intervalId;
        timeoutId = setTimeout(function () {
          clearInterval(intervalId);
          clearTimeout(timeoutId);
          curLink.parentNode.removeChild(link);

          _cb(false, path);
        }, 15000);
        intervalId = setInterval(function () {
          try {
            if (link[sheet] && link[sheet][cssRules].length) {
              clearInterval(intervalId);
              clearTimeout(timeoutId);
              curLink.parentNode.removeChild(curLink);

              _cb(true);
            }
          } catch (e) {
            console.error(e);
          } finally {}
        }, 10);
        curLink.parentNode.insertBefore(link, curLink.nextSibling);
      }

      for (var i = 0; i < paths.length; i++) {
        loadStylesheet(paths[i], stylesheets[paths[i]], function (success, errPath) {
          if (!success) {
            if (console && typeof console.error === 'function') {
              console.error('Error occured while loading stylesheets!');
            }

            alert('Error occured while loading stylesheets!');
            console.log(errPath);
          }

          if (++loaded >= count) {
            cb();
          }
        });
      }
    }
  }, {
    key: "_loadingState",
    value: function _loadingState(enable, themes) {
      this.container.classList[enable ? 'add' : 'remove']("theme-settings-loading".concat(themes ? '-theme' : ''));
    }
  }, {
    key: "_waitForNavs",
    value: function _waitForNavs() {
      var _this3 = this;

      this._addObserver('.layout-navbar.navbar, .layout-navbar .navbar', function (node) {
        return node && node.classList && node.classList.contains('layout-navbar') && (node.classList.contains('navbar') || node.querySelector('.navbar'));
      }, function () {
        return _this3.setNavbarBg(_this3.settings.navbarBg, false);
      });

      this._addObserver('.layout-sidenav.sidenav, .layout-sidenav .sidenav, .layout-sidenav-horizontal.sidenav, .layout-sidenav-horizontal .sidenav', function (node) {
        return node && node.classList && (node.classList.contains('layout-sidenav') || node.classList.contains('layout-sidenav-horizontal')) && (node.classList.contains('sidenav') || node.querySelector('.sidenav'));
      }, function () {
        return _this3.setSidenavBg(_this3.settings.sidenavBg, false);
      });

      this._addObserver('.layout-footer.footer, .layout-footer .footer', function (node) {
        return node && node.classList && node.classList.contains('layout-footer') && (node.classList.contains('footer') || node.querySelector('.footer'));
      }, function () {
        return _this3.setFooterBg(_this3.settings.footerBg, false);
      });

      if (!document.body && (this._observers && this._observers.length || this._intervals && this._intervals.length)) {
        var loadCb = function loadCb() {
          _this3._clearObservers();

          _this3.setNavbarBg(_this3.settings.navbarBg, false);

          _this3.setSidenavBg(_this3.settings.sidenavBg, false);

          _this3.setFooterBg(_this3.settings.footerBg, false);

          window.removeEventListener('load', loadCb);
        };

        window.addEventListener('load', loadCb);
      }
    }
  }, {
    key: "_addObserver",
    value: function _addObserver(selector, condition, cb) {
      var _this4 = this;

      if (!this._observers) this._observers = [];
      if (!this._intervals) this._intervals = [];

      var _observer;

      var _interval;

      if (document.querySelector(selector)) {
        cb.call(this);
      } else if (!document.body) {
        if (typeof MutationObserver !== 'undefined') {
          _observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
              if (!mutation.addedNodes) return;

              for (var i = 0; i < mutation.addedNodes.length; i++) {
                var node = mutation.addedNodes[i];

                if (condition.call(_this4, node)) {
                  _observer.disconnect();

                  _this4._observers.splice(_this4._observers.indexOf(_observer), 1);

                  _observer = null;
                  cb.call(_this4);
                  break;
                }
              }
            });
          });

          this._observers.push(_observer);

          _observer.observe(document.documentElement, {
            childList: true,
            subtree: true,
            attributes: false,
            characterData: false
          });
        } else {
          _interval = setInterval(function () {
            if (document.querySelector(selector)) {
              clearInterval(_interval);

              _this4._intervals.splice(_this4._intervals.indexOf(_interval), 1);

              _interval = null;
              cb.call(_this4);
            }
          }, 10);

          this._intervals.push(_interval);
        }
      }
    }
  }, {
    key: "_clearObservers",
    value: function _clearObservers() {
      if (this._observers && this._observers.length) {
        for (var i = 0, l = this._observers.length; i < l; i++) {
          this._observers[i].disconnect();
        }
      }

      if (this._intervals && this._intervals.length) {
        for (var j = 0, k = this._intervals.length; j < k; j++) {
          clearInterval(this._intervals[j]);
        }
      }

      this._observers = null;
      this._intervals = null;
    }
  }, {
    key: "_getElementFromString",
    value: function _getElementFromString(str) {
      var wrapper = document.createElement('div');
      wrapper.innerHTML = str;
      return wrapper.firstChild;
    }
  }, {
    key: "_getSetting",
    value: function _getSetting(key) {
      var result = null;

      try {
        result = localStorage.getItem("themeSettings".concat(key));
      } catch (e) {}

      return String(result || '');
    }
  }, {
    key: "_setSetting",
    value: function _setSetting(key, val) {
      try {
        localStorage.setItem("themeSettings".concat(key), String(val));
      } catch (e) {}
    }
  }, {
    key: "_removeListeners",
    value: function _removeListeners() {
      for (var i = 0, l = this._listeners.length; i < l; i++) {
        this._listeners[i][0].removeEventListener(this._listeners[i][1], this._listeners[i][2]);
      }
    }
  }, {
    key: "_cleanup",
    value: function _cleanup() {
      this._removeListeners();

      this._listeners = [];
      this._controls = {};

      this._clearObservers();

      if (this._updateInterval) {
        clearInterval(this._updateInterval);
        this._updateInterval = null;
      }
    }
  }, {
    key: "_hasControls",
    value: function _hasControls(controls) {
      var _this5 = this;

      var oneOf = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      return controls.split(' ').reduce(function (result, control) {
        if (_this5.settings.controls.indexOf(control) !== -1) {
          if (oneOf || result !== false) result = true;
        } else {
          if (!oneOf || result !== true) result = false;
        }

        return result;
      }, null);
    }
  }, {
    key: "_getDefaultTheme",
    value: function _getDefaultTheme(themeId) {
      var theme;

      if (typeof themeId === 'string') {
        theme = this._getThemeByName(themeId, false);
      } else {
        theme = this.settings.availableThemes[themeId];
      }

      if (!theme) {
        throw new Error("Theme ID \"".concat(themeId, "\" not found!"));
      }

      return theme;
    }
  }, {
    key: "_getThemeByName",
    value: function _getThemeByName(themeName) {
      var returnDefault = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      var themes = this.settings.availableThemes;

      for (var i = 0, l = themes.length; i < l; i++) {
        if (themes[i].name === themeName) return themes[i];
      }

      return returnDefault ? this.settings.defaultTheme : null;
    }
  }, {
    key: "_ssr",
    get: function get() {
      return typeof window === 'undefined';
    }
  }]);

  return ThemeSettings;
}();

ThemeSettings.AVAILABLE_THEMES = [{
  name: 'theme-air',
  title: 'Air',
  colors: {
    primary: '#3c97fe',
    navbar: '#f8f8f8',
    sidenav: '#f8f8f8'
  }
}, {
  name: 'theme-corporate',
  title: 'Corporate',
  colors: {
    primary: '#26B4FF',
    navbar: '#fff',
    sidenav: '#2e323a'
  }
}, {
  name: 'theme-cotton',
  title: 'Сotton',
  colors: {
    primary: '#e84c64',
    navbar: '#ffffff',
    sidenav: '#ffffff'
  }
}, {
  name: 'theme-gradient',
  title: 'Gradient',
  colors: {
    primary: '#775cdc',
    navbar: '#ffffff',
    sidenav: 'linear-gradient(to top, #4e54c8, #8c55e4)'
  }
}, {
  name: 'theme-paper',
  title: 'Paper',
  colors: {
    primary: '#17b3a3',
    navbar: '#ffffff',
    sidenav: '#ffffff'
  }
}, {
  name: 'theme-shadow',
  title: 'Shadow',
  colors: {
    primary: '#7b83ff',
    navbar: '#f8f8f8',
    sidenav: '#ececf9'
  }
}, {
  name: 'theme-soft',
  title: 'Soft',
  colors: {
    primary: '#1cbb84',
    navbar: '#39517b',
    sidenav: '#ffffff'
  }
}, {
  name: 'theme-sunrise',
  title: 'Sunrise',
  colors: {
    primary: '#fc5a5c',
    navbar: '#222222',
    sidenav: '#ffffff'
  }
}, {
  name: 'theme-twitlight',
  title: 'Twitlight',
  colors: {
    primary: '#4c84ff',
    navbar: '#343c44',
    sidenav: '#3f4853'
  }
}, {
  name: 'theme-vibrant',
  title: 'Vibrant',
  colors: {
    primary: '#fc5a5c',
    navbar: '#f8f8f8',
    sidenav: '#222222'
  }
}];
ThemeSettings.NAVBAR_BGS = ['navbar-theme', 'primary', 'primary-dark navbar-dark', 'primary-darker navbar-dark', 'secondary', 'secondary-dark navbar-dark', 'secondary-darker navbar-dark', 'success', 'success-dark navbar-dark', 'success-darker navbar-dark', 'info', 'info-dark navbar-dark', 'info-darker navbar-dark', 'warning', 'warning-dark navbar-light', 'warning-darker navbar-light', 'danger', 'danger-dark navbar-dark', 'danger-darker navbar-dark', 'dark', 'white', 'light', 'lighter'];
ThemeSettings.SIDENAV_BGS = ['sidenav-theme', 'primary', 'primary-dark sidenav-dark', 'primary-darker sidenav-dark', 'secondary', 'secondary-dark sidenav-dark', 'secondary-darker sidenav-dark', 'success', 'success-dark sidenav-dark', 'success-darker sidenav-dark', 'info', 'info-dark sidenav-dark', 'info-darker sidenav-dark', 'warning', 'warning-dark sidenav-light', 'warning-darker sidenav-light', 'danger', 'danger-dark sidenav-dark', 'danger-darker sidenav-dark', 'dark', 'white', 'light', 'lighter'];
ThemeSettings.FOOTER_BGS = ['footer-theme', 'primary', 'primary-dark footer-dark', 'primary-darker footer-dark', 'secondary', 'secondary-dark footer-dark', 'secondary-darker footer-dark', 'success', 'success-dark footer-dark', 'success-darker footer-dark', 'info', 'info-dark footer-dark', 'info-darker footer-dark', 'warning', 'warning-dark footer-light', 'warning-darker footer-light', 'danger', 'danger-dark footer-dark', 'danger-darker footer-dark', 'dark', 'white', 'light', 'lighter'];
ThemeSettings.LANGUAGES = {
  en: {
    panel_header: 'SETTINGS',
    rtl_switcher: 'RTL direction',
    material_switcher: 'Material style',
    layout_header: 'LAYOUT',
    layout_static: 'Static',
    layout_offcanvas: 'Offcanvas',
    layout_fixed: 'Fixed',
    layout_fixed_offcanvas: 'Fixed offcanvas',
    layout_navbar_swicher: 'Fixed navbar',
    layout_footer_swicher: 'Fixed footer',
    layout_reversed_swicher: 'Reversed',
    navbar_bg_header: 'NAVBAR BACKGROUND',
    sidenav_bg_header: 'SIDENAV BACKGROUND',
    footer_bg_header: 'FOOTER BACKGROUND',
    theme_header: 'THEME'
  }
};


/***/ }),

/***/ 8:
/*!************************************************************!*\
  !*** multi ./resources/assets/vendor/js/theme-settings.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\js\theme-settings.js */"./resources/assets/vendor/js/theme-settings.js");


/***/ })

/******/ })));