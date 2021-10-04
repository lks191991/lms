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
/******/ 	return __webpack_require__(__webpack_require__.s = 14);
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

/***/ "./node_modules/blueimp-gallery/js/blueimp-gallery-vimeo.js":
/*!******************************************************************!*\
  !*** ./node_modules/blueimp-gallery/js/blueimp-gallery-vimeo.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*
 * blueimp Gallery Vimeo Video Factory JS
 * https://github.com/blueimp/Gallery
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global define, $f */

;(function(factory) {
  'use strict'
  if (true) {
    // Register as an anonymous AMD module:
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! ./blueimp-helper */ "jquery"), __webpack_require__(/*! ./blueimp-gallery-video */ "./blueimp-gallery")], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__))
  } else {}
})(function($, Gallery) {
  'use strict'

  if (!window.postMessage) {
    return Gallery
  }

  $.extend(Gallery.prototype.options, {
    // The list object property (or data attribute) with the Vimeo video id:
    vimeoVideoIdProperty: 'vimeo',
    // The URL for the Vimeo video player, can be extended with custom parameters:
    // https://developer.vimeo.com/player/embedding
    vimeoPlayerUrl:
      '//player.vimeo.com/video/VIDEO_ID?api=1&player_id=PLAYER_ID',
    // The prefix for the Vimeo video player ID:
    vimeoPlayerIdPrefix: 'vimeo-player-',
    // Require a click on the native Vimeo player for the initial playback:
    vimeoClickToPlay: true
  })

  var textFactory =
    Gallery.prototype.textFactory || Gallery.prototype.imageFactory
  var VimeoPlayer = function(url, videoId, playerId, clickToPlay) {
    this.url = url
    this.videoId = videoId
    this.playerId = playerId
    this.clickToPlay = clickToPlay
    this.element = document.createElement('div')
    this.listeners = {}
  }
  var counter = 0

  $.extend(VimeoPlayer.prototype, {
    canPlayType: function() {
      return true
    },

    on: function(type, func) {
      this.listeners[type] = func
      return this
    },

    loadAPI: function() {
      var that = this
      var apiUrl = '//f.vimeocdn.com/js/froogaloop2.min.js'
      var scriptTags = document.getElementsByTagName('script')
      var i = scriptTags.length
      var scriptTag
      var called
      /**
       * Callback function
       */
      function callback() {
        if (!called && that.playOnReady) {
          that.play()
        }
        called = true
      }
      while (i) {
        i -= 1
        if (scriptTags[i].src === apiUrl) {
          scriptTag = scriptTags[i]
          break
        }
      }
      if (!scriptTag) {
        scriptTag = document.createElement('script')
        scriptTag.src = apiUrl
      }
      $(scriptTag).on('load', callback)
      scriptTags[0].parentNode.insertBefore(scriptTag, scriptTags[0])
      // Fix for cached scripts on IE 8:
      if (/loaded|complete/.test(scriptTag.readyState)) {
        callback()
      }
    },

    onReady: function() {
      var that = this
      this.ready = true
      this.player.addEvent('play', function() {
        that.hasPlayed = true
        that.onPlaying()
      })
      this.player.addEvent('pause', function() {
        that.onPause()
      })
      this.player.addEvent('finish', function() {
        that.onPause()
      })
      if (this.playOnReady) {
        this.play()
      }
    },

    onPlaying: function() {
      if (this.playStatus < 2) {
        this.listeners.playing()
        this.playStatus = 2
      }
    },

    onPause: function() {
      this.listeners.pause()
      delete this.playStatus
    },

    insertIframe: function() {
      var iframe = document.createElement('iframe')
      iframe.src = this.url
        .replace('VIDEO_ID', this.videoId)
        .replace('PLAYER_ID', this.playerId)
      iframe.id = this.playerId
      this.element.parentNode.replaceChild(iframe, this.element)
      this.element = iframe
    },

    play: function() {
      var that = this
      if (!this.playStatus) {
        this.listeners.play()
        this.playStatus = 1
      }
      if (this.ready) {
        if (
          !this.hasPlayed &&
          (this.clickToPlay ||
            (window.navigator &&
              /iP(hone|od|ad)/.test(window.navigator.platform)))
        ) {
          // Manually trigger the playing callback if clickToPlay
          // is enabled and to workaround a limitation in iOS,
          // which requires synchronous user interaction to start
          // the video playback:
          this.onPlaying()
        } else {
          this.player.api('play')
        }
      } else {
        this.playOnReady = true
        if (!window.$f) {
          this.loadAPI()
        } else if (!this.player) {
          this.insertIframe()
          this.player = $f(this.element)
          this.player.addEvent('ready', function() {
            that.onReady()
          })
        }
      }
    },

    pause: function() {
      if (this.ready) {
        this.player.api('pause')
      } else if (this.playStatus) {
        delete this.playOnReady
        this.listeners.pause()
        delete this.playStatus
      }
    }
  })

  $.extend(Gallery.prototype, {
    VimeoPlayer: VimeoPlayer,

    textFactory: function(obj, callback) {
      var options = this.options
      var videoId = this.getItemProperty(obj, options.vimeoVideoIdProperty)
      if (videoId) {
        if (this.getItemProperty(obj, options.urlProperty) === undefined) {
          obj[options.urlProperty] = '//vimeo.com/' + videoId
        }
        counter += 1
        return this.videoFactory(
          obj,
          callback,
          new VimeoPlayer(
            options.vimeoPlayerUrl,
            videoId,
            options.vimeoPlayerIdPrefix + counter,
            options.vimeoClickToPlay
          )
        )
      }
      return textFactory.call(this, obj, callback)
    }
  })

  return Gallery
})


/***/ }),

/***/ "./resources/assets/vendor/libs/blueimp-gallery/gallery-vimeo.js":
/*!***********************************************************************!*\
  !*** ./resources/assets/vendor/libs/blueimp-gallery/gallery-vimeo.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! blueimp-gallery/js/blueimp-gallery-vimeo.js */ "./node_modules/blueimp-gallery/js/blueimp-gallery-vimeo.js");

/***/ }),

/***/ 14:
/*!*****************************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/blueimp-gallery/gallery-vimeo.js ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\blueimp-gallery\gallery-vimeo.js */"./resources/assets/vendor/libs/blueimp-gallery/gallery-vimeo.js");


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