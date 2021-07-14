/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _js_admin__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./js/admin */ \"./src/js/admin.js\");\n\n\n//# sourceURL=webpack://my-webpack-project/./src/index.js?");

/***/ }),

/***/ "./src/js/admin.js":
/*!*************************!*\
  !*** ./src/js/admin.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"pushme\": () => (/* binding */ pushme),\n/* harmony export */   \"pushme_vue\": () => (/* binding */ pushme_vue),\n/* harmony export */   \"pushme_app\": () => (/* binding */ pushme_app)\n/* harmony export */ });\nif (typeof $ == \"undefined\") var $ = jQuery;\nvar pushme = {};\n\npushme.show = function () {\n  var target = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : \"dashboard\";\n  $(\".pushme-contents\").find(\"[data-content=\\\"\".concat(target, \"\\\"]\")).fadeIn(200).siblings().hide(0);\n};\n\n$(document).on(\"click\", \".pushme-nav a\", function (e) {\n  $(\".pushme-nav a\").removeClass(\"active\");\n  $(this).removeClass(\"active\");\n  var target = $(this).attr(\"href\").replace(\"#/\", \"\");\n  pushme.show(target);\n});\nwindow.addEventListener(\"DOMContentLoaded\", function () {\n  // show section\n  var target = window.location.hash.replace(\"#/\", \"\");\n  pushme.show(target.length ? target : \"projects\");\n});\nvar pushme_vue = Vue.createApp({\n  data: function data() {\n    return {\n      projects: {\n        items: [],\n        offset: 0\n      }\n    };\n  },\n  computed: {},\n  methods: {\n    loadProjects: function loadProjects() {\n      var offset = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;\n      var self = this;\n      $.get(\"\".concat(pushme_options.ajaxurl, \"?action=pushme_projects&offset=0\"), function (data) {\n        self.projects.items = data;\n      });\n    },\n    update_project: function update_project(project) {\n      var self = this;\n      console.log(project);\n      $.post(\"\".concat(pushme_options.ajaxurl, \"?action=pushme_project\"), project, function (data) {\n        console.log(data);\n        self.loadProjects();\n      });\n    }\n  },\n  created: function created() {\n    this.loadProjects();\n    console.log(\"Loaded\");\n  },\n  mounted: function mounted() {}\n});\nvar pushme_app = pushme_vue.mount(\"#pushme-admin\");\n\n//# sourceURL=webpack://my-webpack-project/./src/js/admin.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/index.js");
/******/ 	
/******/ })()
;