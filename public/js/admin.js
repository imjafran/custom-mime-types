/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/admin.js":
/*!*************************!*\
  !*** ./src/js/admin.js ***!
  \*************************/
/***/ (() => {

eval("if (typeof $ == \"undefined\") var $ = jQuery;\nvar cmt = {};\n\ncmt.init = function () {\n  var hash = window.location.hash.replace('#', '');\n  hash = hash.length == '' ? 'mimes' : hash;\n  if (hash) cmt.show(hash);\n}; // cmt.loader = (width) => {\n//     let timer = setTimeout(() => {\n//         cmt_app.$data.loader = width\n//     }, 1000);\n// }\n\n\ncmt.show = function (page) {\n  $(\"[data-content=\\\"\".concat(page, \"\\\"]\")).fadeIn(200).siblings().hide(0);\n};\n\n$(function () {\n  cmt.init();\n});\nvar cmt_vue = Vue.createApp({\n  data: function data() {\n    return {\n      loader: 10,\n      mimes: [{\n        name: \"\"\n      }]\n    };\n  },\n  computed: {},\n  methods: {\n    show: function show(page) {\n      cmt.show(page);\n    }\n  },\n  mounted: function mounted() {\n    console.log(\"Vue init\");\n    $(\"[data-loader]\").animate({\n      width: \"100%\",\n      opacity: 0\n    }, 2000, function () {\n      $('.cmt_loader').hide(0);\n    });\n  }\n});\nvar cmt_app = cmt_vue.mount(\"#cmt_app\");\n\n//# sourceURL=webpack://my-webpack-project/./src/js/admin.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/js/admin.js"]();
/******/ 	
/******/ })()
;