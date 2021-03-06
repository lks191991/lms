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
/******/ 	return __webpack_require__(__webpack_require__.s = 74);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@fullcalendar/core/locales-all.js":
/*!********************************************************!*\
  !*** ./node_modules/@fullcalendar/core/locales-all.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

(function (global, factory) {
     true ? module.exports = factory() :
    undefined;
}(this, function () { 'use strict';

    var _m0 = {
        code: "af",
        week: {
            dow: 1,
            doy: 4 // Die week wat die 4de Januarie bevat is die eerste week van die jaar.
        },
        buttonText: {
            prev: "Vorige",
            next: "Volgende",
            today: "Vandag",
            year: "Jaar",
            month: "Maand",
            week: "Week",
            day: "Dag",
            list: "Agenda"
        },
        allDayHtml: "Heeldag",
        eventLimitText: "Addisionele",
        noEventsMessage: "Daar is geen gebeurtenisse nie"
    };

    var _m1 = {
        code: "ar-dz",
        week: {
            dow: 0,
            doy: 4 // The week that contains Jan 1st is the first week of the year.
        },
        dir: 'rtl',
        buttonText: {
            prev: "????????????",
            next: "????????????",
            today: "??????????",
            month: "??????",
            week: "??????????",
            day: "??????",
            list: "??????????"
        },
        weekLabel: "??????????",
        allDayText: "?????????? ??????",
        eventLimitText: "????????",
        noEventsMessage: "???? ?????????? ????????"
    };

    var _m2 = {
        code: "ar-kw",
        week: {
            dow: 0,
            doy: 12 // The week that contains Jan 1st is the first week of the year.
        },
        dir: 'rtl',
        buttonText: {
            prev: "????????????",
            next: "????????????",
            today: "??????????",
            month: "??????",
            week: "??????????",
            day: "??????",
            list: "??????????"
        },
        weekLabel: "??????????",
        allDayText: "?????????? ??????",
        eventLimitText: "????????",
        noEventsMessage: "???? ?????????? ????????"
    };

    var _m3 = {
        code: "ar-ly",
        week: {
            dow: 6,
            doy: 12 // The week that contains Jan 1st is the first week of the year.
        },
        dir: 'rtl',
        buttonText: {
            prev: "????????????",
            next: "????????????",
            today: "??????????",
            month: "??????",
            week: "??????????",
            day: "??????",
            list: "??????????"
        },
        weekLabel: "??????????",
        allDayText: "?????????? ??????",
        eventLimitText: "????????",
        noEventsMessage: "???? ?????????? ????????"
    };

    var _m4 = {
        code: "ar-ma",
        week: {
            dow: 6,
            doy: 12 // The week that contains Jan 1st is the first week of the year.
        },
        dir: 'rtl',
        buttonText: {
            prev: "????????????",
            next: "????????????",
            today: "??????????",
            month: "??????",
            week: "??????????",
            day: "??????",
            list: "??????????"
        },
        weekLabel: "??????????",
        allDayText: "?????????? ??????",
        eventLimitText: "????????",
        noEventsMessage: "???? ?????????? ????????"
    };

    var _m5 = {
        code: "ar-sa",
        week: {
            dow: 0,
            doy: 6 // The week that contains Jan 1st is the first week of the year.
        },
        dir: 'rtl',
        buttonText: {
            prev: "????????????",
            next: "????????????",
            today: "??????????",
            month: "??????",
            week: "??????????",
            day: "??????",
            list: "??????????"
        },
        weekLabel: "??????????",
        allDayText: "?????????? ??????",
        eventLimitText: "????????",
        noEventsMessage: "???? ?????????? ????????"
    };

    var _m6 = {
        code: "ar-tn",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        dir: 'rtl',
        buttonText: {
            prev: "????????????",
            next: "????????????",
            today: "??????????",
            month: "??????",
            week: "??????????",
            day: "??????",
            list: "??????????"
        },
        weekLabel: "??????????",
        allDayText: "?????????? ??????",
        eventLimitText: "????????",
        noEventsMessage: "???? ?????????? ????????"
    };

    var _m7 = {
        code: "ar",
        week: {
            dow: 6,
            doy: 12 // The week that contains Jan 1st is the first week of the year.
        },
        dir: 'rtl',
        buttonText: {
            prev: "????????????",
            next: "????????????",
            today: "??????????",
            month: "??????",
            week: "??????????",
            day: "??????",
            list: "??????????"
        },
        weekLabel: "??????????",
        allDayText: "?????????? ??????",
        eventLimitText: "????????",
        noEventsMessage: "???? ?????????? ????????"
    };

    var _m8 = {
        code: "bg",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "??????????",
            next: "????????????",
            today: "????????",
            month: "??????????",
            week: "??????????????",
            day: "??????",
            list: "????????????"
        },
        allDayText: "?????? ??????",
        eventLimitText: function (n) {
            return "+?????? " + n;
        },
        noEventsMessage: "???????? ?????????????? ???? ??????????????????"
    };

    var _m9 = {
        code: "bs",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "Pro??li",
            next: "Sljede??i",
            today: "Danas",
            month: "Mjesec",
            week: "Sedmica",
            day: "Dan",
            list: "Raspored"
        },
        weekLabel: "Sed",
        allDayText: "Cijeli dan",
        eventLimitText: function (n) {
            return "+ jo?? " + n;
        },
        noEventsMessage: "Nema doga??aja za prikazivanje"
    };

    var _m10 = {
        code: "ca",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Anterior",
            next: "Seg??ent",
            today: "Avui",
            month: "Mes",
            week: "Setmana",
            day: "Dia",
            list: "Agenda"
        },
        weekLabel: "Set",
        allDayText: "Tot el dia",
        eventLimitText: "m??s",
        noEventsMessage: "No hi ha esdeveniments per mostrar"
    };

    var _m11 = {
        code: "cs",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "D????ve",
            next: "Pozd??ji",
            today: "Nyn??",
            month: "M??s??c",
            week: "T??den",
            day: "Den",
            list: "Agenda"
        },
        weekLabel: "T??d",
        allDayText: "Cel?? den",
        eventLimitText: function (n) {
            return "+dal????: " + n;
        },
        noEventsMessage: "????dn?? akce k zobrazen??"
    };

    var _m12 = {
        code: "da",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Forrige",
            next: "N??ste",
            today: "I dag",
            month: "M??ned",
            week: "Uge",
            day: "Dag",
            list: "Agenda"
        },
        weekLabel: "Uge",
        allDayText: "Hele dagen",
        eventLimitText: "flere",
        noEventsMessage: "Ingen arrangementer at vise"
    };

    var _m13 = {
        code: "de",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Zur??ck",
            next: "Vor",
            today: "Heute",
            year: "Jahr",
            month: "Monat",
            week: "Woche",
            day: "Tag",
            list: "Termin??bersicht"
        },
        weekLabel: "KW",
        allDayText: "Ganzt??gig",
        eventLimitText: function (n) {
            return "+ weitere " + n;
        },
        noEventsMessage: "Keine Ereignisse anzuzeigen"
    };

    var _m14 = {
        code: "el",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4st is the first week of the year.
        },
        buttonText: {
            prev: "????????????????????????",
            next: "????????????????",
            today: "????????????",
            month: "??????????",
            week: "????????????????",
            day: "??????????",
            list: "??????????????"
        },
        weekLabel: "??????",
        allDayText: "????????????????",
        eventLimitText: "??????????????????????",
        noEventsMessage: "?????? ???????????????? ???????????????? ?????? ???? ????????????????????"
    };

    var _m15 = {
        code: "en-au",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        }
    };

    var _m16 = {
        code: "en-gb",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        }
    };

    var _m17 = {
        code: "en-nz",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        }
    };

    var _m18 = {
        code: "es",
        week: {
            dow: 0,
            doy: 6 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "Ant",
            next: "Sig",
            today: "Hoy",
            month: "Mes",
            week: "Semana",
            day: "D??a",
            list: "Agenda"
        },
        weekLabel: "Sm",
        allDayHtml: "Todo<br/>el d??a",
        eventLimitText: "m??s",
        noEventsMessage: "No hay eventos para mostrar"
    };

    var _m19 = {
        code: "es",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Ant",
            next: "Sig",
            today: "Hoy",
            month: "Mes",
            week: "Semana",
            day: "D??a",
            list: "Agenda"
        },
        weekLabel: "Sm",
        allDayHtml: "Todo<br/>el d??a",
        eventLimitText: "m??s",
        noEventsMessage: "No hay eventos para mostrar"
    };

    var _m20 = {
        code: "et",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Eelnev",
            next: "J??rgnev",
            today: "T??na",
            month: "Kuu",
            week: "N??dal",
            day: "P??ev",
            list: "P??evakord"
        },
        weekLabel: "n??d",
        allDayText: "Kogu p??ev",
        eventLimitText: function (n) {
            return "+ veel " + n;
        },
        noEventsMessage: "Kuvamiseks puuduvad s??ndmused"
    };

    var _m21 = {
        code: "eu",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "Aur",
            next: "Hur",
            today: "Gaur",
            month: "Hilabetea",
            week: "Astea",
            day: "Eguna",
            list: "Agenda"
        },
        weekLabel: "As",
        allDayHtml: "Egun<br/>osoa",
        eventLimitText: "gehiago",
        noEventsMessage: "Ez dago ekitaldirik erakusteko"
    };

    var _m22 = {
        code: "fa",
        week: {
            dow: 6,
            doy: 12 // The week that contains Jan 1st is the first week of the year.
        },
        dir: 'rtl',
        buttonText: {
            prev: "????????",
            next: "????????",
            today: "??????????",
            month: "??????",
            week: "????????",
            day: "??????",
            list: "????????????"
        },
        weekLabel: "????",
        allDayText: "???????? ??????",
        eventLimitText: function (n) {
            return "?????? ???? " + n;
        },
        noEventsMessage: "?????? ?????????????? ???? ??????????"
    };

    var _m23 = {
        code: "fi",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Edellinen",
            next: "Seuraava",
            today: "T??n????n",
            month: "Kuukausi",
            week: "Viikko",
            day: "P??iv??",
            list: "Tapahtumat"
        },
        weekLabel: "Vk",
        allDayText: "Koko p??iv??",
        eventLimitText: "lis????",
        noEventsMessage: "Ei n??ytett??vi?? tapahtumia"
    };

    var _m24 = {
        code: "fr",
        buttonText: {
            prev: "Pr??c??dent",
            next: "Suivant",
            today: "Aujourd'hui",
            year: "Ann??e",
            month: "Mois",
            week: "Semaine",
            day: "Jour",
            list: "Mon planning"
        },
        weekLabel: "Sem.",
        allDayHtml: "Toute la<br/>journ??e",
        eventLimitText: "en plus",
        noEventsMessage: "Aucun ??v??nement ?? afficher"
    };

    var _m25 = {
        code: "fr-ch",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Pr??c??dent",
            next: "Suivant",
            today: "Courant",
            year: "Ann??e",
            month: "Mois",
            week: "Semaine",
            day: "Jour",
            list: "Mon planning"
        },
        weekLabel: "Sm",
        allDayHtml: "Toute la<br/>journ??e",
        eventLimitText: "en plus",
        noEventsMessage: "Aucun ??v??nement ?? afficher"
    };

    var _m26 = {
        code: "fr",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Pr??c??dent",
            next: "Suivant",
            today: "Aujourd'hui",
            year: "Ann??e",
            month: "Mois",
            week: "Semaine",
            day: "Jour",
            list: "Mon planning"
        },
        weekLabel: "Sem.",
        allDayHtml: "Toute la<br/>journ??e",
        eventLimitText: "en plus",
        noEventsMessage: "Aucun ??v??nement ?? afficher"
    };

    var _m27 = {
        code: "gl",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Ant",
            next: "Seg",
            today: "Hoxe",
            month: "Mes",
            week: "Semana",
            day: "D??a",
            list: "Axenda"
        },
        weekLabel: "Sm",
        allDayHtml: "Todo<br/>o d??a",
        eventLimitText: "m??is",
        noEventsMessage: "Non hai eventos para amosar"
    };

    var _m28 = {
        code: "he",
        dir: 'rtl',
        buttonText: {
            prev: "??????????",
            next: "??????",
            today: "????????",
            month: "????????",
            week: "????????",
            day: "??????",
            list: "?????? ??????"
        },
        allDayText: "???? ????????",
        eventLimitText: "??????",
        noEventsMessage: "?????? ?????????????? ??????????",
        weekLabel: "????????"
    };

    var _m29 = {
        code: "hi",
        week: {
            dow: 0,
            doy: 6 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "???????????????",
            next: "????????????",
            today: "??????",
            month: "???????????????",
            week: "??????????????????",
            day: "?????????",
            list: "???????????????????????????"
        },
        weekLabel: "???????????????",
        allDayText: "????????? ?????????",
        eventLimitText: function (n) {
            return "+???????????? " + n;
        },
        noEventsMessage: "????????? ?????????????????? ?????? ??????????????????????????? ???????????? ?????? ?????????"
    };

    var _m30 = {
        code: "hr",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "Prija??nji",
            next: "Sljede??i",
            today: "Danas",
            month: "Mjesec",
            week: "Tjedan",
            day: "Dan",
            list: "Raspored"
        },
        weekLabel: "Tje",
        allDayText: "Cijeli dan",
        eventLimitText: function (n) {
            return "+ jo?? " + n;
        },
        noEventsMessage: "Nema doga??aja za prikaz"
    };

    var _m31 = {
        code: "hu",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "vissza",
            next: "el??re",
            today: "ma",
            month: "H??nap",
            week: "H??t",
            day: "Nap",
            list: "Napl??"
        },
        weekLabel: "H??t",
        allDayText: "Eg??sz nap",
        eventLimitText: "tov??bbi",
        noEventsMessage: "Nincs megjelen??thet?? esem??ny"
    };

    var _m32 = {
        code: "id",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "mundur",
            next: "maju",
            today: "hari ini",
            month: "Bulan",
            week: "Minggu",
            day: "Hari",
            list: "Agenda"
        },
        weekLabel: "Mg",
        allDayHtml: "Sehari<br/>penuh",
        eventLimitText: "lebih",
        noEventsMessage: "Tidak ada acara untuk ditampilkan"
    };

    var _m33 = {
        code: "is",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Fyrri",
            next: "N??sti",
            today: "?? dag",
            month: "M??nu??ur",
            week: "Vika",
            day: "Dagur",
            list: "Dagskr??"
        },
        weekLabel: "Vika",
        allDayHtml: "Allan<br/>daginn",
        eventLimitText: "meira",
        noEventsMessage: "Engir vi??bur??ir til a?? s??na"
    };

    var _m34 = {
        code: "it",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Prec",
            next: "Succ",
            today: "Oggi",
            month: "Mese",
            week: "Settimana",
            day: "Giorno",
            list: "Agenda"
        },
        weekLabel: "Sm",
        allDayHtml: "Tutto il<br/>giorno",
        eventLimitText: function (n) {
            return "+altri " + n;
        },
        noEventsMessage: "Non ci sono eventi da visualizzare"
    };

    var _m35 = {
        code: "ja",
        buttonText: {
            prev: "???",
            next: "???",
            today: "??????",
            month: "???",
            week: "???",
            day: "???",
            list: "???????????????"
        },
        weekLabel: "???",
        allDayText: "??????",
        eventLimitText: function (n) {
            return "??? " + n + " ???";
        },
        noEventsMessage: "????????????????????????????????????"
    };

    var _m36 = {
        code: "ka",
        week: {
            dow: 1,
            doy: 7
        },
        buttonText: {
            prev: "????????????",
            next: "?????????????????????",
            today: "????????????",
            month: "?????????",
            week: "???????????????",
            day: "?????????",
            list: "???????????? ?????????????????????"
        },
        weekLabel: "??????",
        allDayText: "??????????????? ?????????",
        eventLimitText: function (n) {
            return "+ ??????????????? " + n;
        },
        noEventsMessage: "???????????????????????????????????? ?????? ????????????"
    };

    var _m37 = {
        code: "kk",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "??????????????",
            next: "????????????",
            today: "??????????",
            month: "????",
            week: "????????",
            day: "??????",
            list: "?????? ??????????????"
        },
        weekLabel: "????",
        allDayText: "???????? ????????",
        eventLimitText: function (n) {
            return "+ ???????? " + n;
        },
        noEventsMessage: "?????????????? ???????? ???????????????? ??????"
    };

    var _m38 = {
        code: "ko",
        buttonText: {
            prev: "?????????",
            next: "?????????",
            today: "??????",
            month: "???",
            week: "???",
            day: "???",
            list: "????????????"
        },
        weekLabel: "???",
        allDayText: "??????",
        eventLimitText: "???",
        noEventsMessage: "????????? ????????????"
    };

    var _m39 = {
        code: "lb",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Zr??ck",
            next: "Weider",
            today: "Haut",
            month: "Mount",
            week: "Woch",
            day: "Dag",
            list: "Terminiwwersiicht"
        },
        weekLabel: "W",
        allDayText: "Ganzen Dag",
        eventLimitText: "m??i",
        noEventsMessage: "Nee Evenementer ze affich??ieren"
    };

    var _m40 = {
        code: "lt",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Atgal",
            next: "Pirmyn",
            today: "??iandien",
            month: "M??nuo",
            week: "Savait??",
            day: "Diena",
            list: "Darbotvark??"
        },
        weekLabel: "SAV",
        allDayText: "Vis?? dien??",
        eventLimitText: "daugiau",
        noEventsMessage: "N??ra ??vyki?? rodyti"
    };

    var _m41 = {
        code: "lv",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Iepr.",
            next: "N??k.",
            today: "??odien",
            month: "M??nesis",
            week: "Ned????a",
            day: "Diena",
            list: "Dienas k??rt??ba"
        },
        weekLabel: "Ned.",
        allDayText: "Visu dienu",
        eventLimitText: function (n) {
            return "+v??l " + n;
        },
        noEventsMessage: "Nav notikumu"
    };

    var _m42 = {
        code: "mk",
        buttonText: {
            prev: "??????????????????",
            next: "????????????",
            today: "??????????",
            month: "??????????",
            week: "????????????",
            day: "??????",
            list: "????????????"
        },
        weekLabel: "??????",
        allDayText: "?????? ??????",
        eventLimitText: function (n) {
            return "+???????????? " + n;
        },
        noEventsMessage: "???????? ?????????????? ???? ??????????????????????"
    };

    var _m43 = {
        code: "ms",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "Sebelum",
            next: "Selepas",
            today: "hari ini",
            month: "Bulan",
            week: "Minggu",
            day: "Hari",
            list: "Agenda"
        },
        weekLabel: "Mg",
        allDayText: "Sepanjang hari",
        eventLimitText: function (n) {
            return "masih ada " + n + " acara";
        },
        noEventsMessage: "Tiada peristiwa untuk dipaparkan"
    };

    var _m44 = {
        code: "nb",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Forrige",
            next: "Neste",
            today: "I dag",
            month: "M??ned",
            week: "Uke",
            day: "Dag",
            list: "Agenda"
        },
        weekLabel: "Uke",
        allDayText: "Hele dagen",
        eventLimitText: "til",
        noEventsMessage: "Ingen hendelser ?? vise"
    };

    var _m45 = {
        code: "nl",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Voorgaand",
            next: "Volgende",
            today: "Vandaag",
            year: "Jaar",
            month: "Maand",
            week: "Week",
            day: "Dag",
            list: "Agenda"
        },
        allDayText: "Hele dag",
        eventLimitText: "extra",
        noEventsMessage: "Geen evenementen om te laten zien"
    };

    var _m46 = {
        code: "nn",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "F??rre",
            next: "Neste",
            today: "I dag",
            month: "M??nad",
            week: "Veke",
            day: "Dag",
            list: "Agenda"
        },
        weekLabel: "Veke",
        allDayText: "Heile dagen",
        eventLimitText: "til",
        noEventsMessage: "Ingen hendelser ?? vise"
    };

    var _m47 = {
        code: "pl",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Poprzedni",
            next: "Nast??pny",
            today: "Dzi??",
            month: "Miesi??c",
            week: "Tydzie??",
            day: "Dzie??",
            list: "Plan dnia"
        },
        weekLabel: "Tydz",
        allDayText: "Ca??y dzie??",
        eventLimitText: "wi??cej",
        noEventsMessage: "Brak wydarze?? do wy??wietlenia"
    };

    var _m48 = {
        code: "pt-br",
        buttonText: {
            prev: "Anterior",
            next: "Pr??ximo",
            today: "Hoje",
            month: "M??s",
            week: "Semana",
            day: "Dia",
            list: "Compromissos"
        },
        weekLabel: "Sm",
        allDayText: "dia inteiro",
        eventLimitText: function (n) {
            return "mais +" + n;
        },
        noEventsMessage: "N??o h?? eventos para mostrar"
    };

    var _m49 = {
        code: "pt",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Anterior",
            next: "Seguinte",
            today: "Hoje",
            month: "M??s",
            week: "Semana",
            day: "Dia",
            list: "Agenda"
        },
        weekLabel: "Sem",
        allDayText: "Todo o dia",
        eventLimitText: "mais",
        noEventsMessage: "N??o h?? eventos para mostrar"
    };

    var _m50 = {
        code: "ro",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "precedent??",
            next: "urm??toare",
            today: "Azi",
            month: "Lun??",
            week: "S??pt??m??n??",
            day: "Zi",
            list: "Agend??"
        },
        weekLabel: "S??pt",
        allDayText: "Toat?? ziua",
        eventLimitText: function (n) {
            return "+alte " + n;
        },
        noEventsMessage: "Nu exist?? evenimente de afi??at"
    };

    var _m51 = {
        code: "ru",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "????????",
            next: "????????",
            today: "??????????????",
            month: "??????????",
            week: "????????????",
            day: "????????",
            list: "???????????????? ??????"
        },
        weekLabel: "??????",
        allDayText: "???????? ????????",
        eventLimitText: function (n) {
            return "+ ?????? " + n;
        },
        noEventsMessage: "?????? ?????????????? ?????? ??????????????????????"
    };

    var _m52 = {
        code: "sk",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Predch??dzaj??ci",
            next: "Nasleduj??ci",
            today: "Dnes",
            month: "Mesiac",
            week: "T????de??",
            day: "De??",
            list: "Rozvrh"
        },
        weekLabel: "Ty",
        allDayText: "Cel?? de??",
        eventLimitText: function (n) {
            return "+??al??ie: " + n;
        },
        noEventsMessage: "??iadne akcie na zobrazenie"
    };

    var _m53 = {
        code: "sl",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "Prej??nji",
            next: "Naslednji",
            today: "Trenutni",
            month: "Mesec",
            week: "Teden",
            day: "Dan",
            list: "Dnevni red"
        },
        weekLabel: "Teden",
        allDayText: "Ves dan",
        eventLimitText: "ve??",
        noEventsMessage: "Ni dogodkov za prikaz"
    };

    var _m54 = {
        code: "sq",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "mbrapa",
            next: "P??rpara",
            today: "sot",
            month: "Muaj",
            week: "Jav??",
            day: "Dit??",
            list: "List??"
        },
        weekLabel: "Ja",
        allDayHtml: "Gjith??<br/>dit??n",
        eventLimitText: function (n) {
            return "+m?? tep??r " + n;
        },
        noEventsMessage: "Nuk ka evente p??r t?? shfaqur"
    };

    var _m55 = {
        code: "sr-cyrl",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "??????????????????",
            next: "??????????????",
            today: "??????????",
            month: "??????????",
            week: "????????????",
            day: "??????",
            list: "????????????"
        },
        weekLabel: "??????",
        allDayText: "?????? ??????",
        eventLimitText: function (n) {
            return "+ ?????? " + n;
        },
        noEventsMessage: "???????? ???????????????? ???? ????????????"
    };

    var _m56 = {
        code: "sr",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "Prethodna",
            next: "Sledec??i",
            today: "Danas",
            month: "M??s??c",
            week: "N??d??lja",
            day: "Dan",
            list: "Plan??r"
        },
        weekLabel: "Sed",
        allDayText: "C??o dan",
        eventLimitText: function (n) {
            return "+ jo?? " + n;
        },
        noEventsMessage: "N??ma doga??aja za prikaz"
    };

    var _m57 = {
        code: "sv",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "F??rra",
            next: "N??sta",
            today: "Idag",
            month: "M??nad",
            week: "Vecka",
            day: "Dag",
            list: "Program"
        },
        weekLabel: "v.",
        allDayText: "Heldag",
        eventLimitText: "till",
        noEventsMessage: "Inga h??ndelser att visa"
    };

    var _m58 = {
        code: "th",
        buttonText: {
            prev: "????????????",
            next: "???????????????",
            today: "??????????????????",
            month: "???????????????",
            week: "?????????????????????",
            day: "?????????",
            list: "??????????????????"
        },
        allDayText: "?????????????????????",
        eventLimitText: "???????????????????????????",
        noEventsMessage: "???????????????????????????????????????????????????????????????"
    };

    var _m59 = {
        code: "tr",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "geri",
            next: "ileri",
            today: "bug??n",
            month: "Ay",
            week: "Hafta",
            day: "G??n",
            list: "Ajanda"
        },
        weekLabel: "Hf",
        allDayText: "T??m g??n",
        eventLimitText: "daha fazla",
        noEventsMessage: "G??sterilecek etkinlik yok"
    };

    var _m60 = {
        code: "uk",
        week: {
            dow: 1,
            doy: 7 // The week that contains Jan 1st is the first week of the year.
        },
        buttonText: {
            prev: "????????????????????",
            next: "????????",
            today: "????????????????",
            month: "????????????",
            week: "??????????????",
            day: "????????",
            list: "?????????????? ????????????"
        },
        weekLabel: "??????",
        allDayText: "?????????? ????????",
        eventLimitText: function (n) {
            return "+???? " + n + "...";
        },
        noEventsMessage: "?????????? ?????????? ?????? ????????????????????????"
    };

    var _m61 = {
        code: "vi",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Tr?????c",
            next: "Ti???p",
            today: "H??m nay",
            month: "Th??ng",
            week: "Tu????n",
            day: "Ng??y",
            list: "L???ch bi???u"
        },
        weekLabel: "Tu",
        allDayText: "C??? ng??y",
        eventLimitText: function (n) {
            return "+ th??m " + n;
        },
        noEventsMessage: "Kh??ng c?? s??? ki???n ????? hi???n th???"
    };

    var _m62 = {
        code: "zh-cn",
        week: {
            // GB/T 7408-1994?????????????????????????????????????????????????????????????????????????ISO 8601:1988??????
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "??????",
            next: "??????",
            today: "??????",
            month: "???",
            week: "???",
            day: "???",
            list: "??????"
        },
        weekLabel: "???",
        allDayText: "??????",
        eventLimitText: function (n) {
            return "?????? " + n + " ???";
        },
        noEventsMessage: "??????????????????"
    };

    var _m63 = {
        code: "zh-tw",
        buttonText: {
            prev: "??????",
            next: "??????",
            today: "??????",
            month: "???",
            week: "???",
            day: "???",
            list: "????????????"
        },
        weekLabel: "???",
        allDayText: "??????",
        eventLimitText: '????????????',
        noEventsMessage: "??????????????????"
    };

    var _rollupPluginMultiEntry_entryPoint = [
    _m0, _m1, _m2, _m3, _m4, _m5, _m6, _m7, _m8, _m9, _m10, _m11, _m12, _m13, _m14, _m15, _m16, _m17, _m18, _m19, _m20, _m21, _m22, _m23, _m24, _m25, _m26, _m27, _m28, _m29, _m30, _m31, _m32, _m33, _m34, _m35, _m36, _m37, _m38, _m39, _m40, _m41, _m42, _m43, _m44, _m45, _m46, _m47, _m48, _m49, _m50, _m51, _m52, _m53, _m54, _m55, _m56, _m57, _m58, _m59, _m60, _m61, _m62, _m63
    ];

    return _rollupPluginMultiEntry_entryPoint;

}));


/***/ }),

/***/ "./resources/assets/vendor/libs/fullcalendar/locale-all.js":
/*!*****************************************************************!*\
  !*** ./resources/assets/vendor/libs/fullcalendar/locale-all.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! @fullcalendar/core/locales-all.js */ "./node_modules/@fullcalendar/core/locales-all.js");

/***/ }),

/***/ 74:
/*!***********************************************************************!*\
  !*** multi ./resources/assets/vendor/libs/fullcalendar/locale-all.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\appwork\resources\assets\vendor\libs\fullcalendar\locale-all.js */"./resources/assets/vendor/libs/fullcalendar/locale-all.js");


/***/ })

/******/ })));