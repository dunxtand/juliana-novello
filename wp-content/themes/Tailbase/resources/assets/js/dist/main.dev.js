"use strict";

var _vue = _interopRequireDefault(require("vue"));

var _sal = _interopRequireDefault(require("sal.js"));

var _nav_bar = _interopRequireDefault(require("./components/nav_bar"));

var _nav_menu_item = _interopRequireDefault(require("./components/nav_menu_item"));

var _nav_menu_mobile = _interopRequireDefault(require("./components/nav_menu_mobile"));

var _navbar_burger = _interopRequireDefault(require("./components/navbar_burger"));

var _footer_contact_form = _interopRequireDefault(require("./components/footer_contact_form"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

/* ==========================================================================
Global Imports
========================================================================== */
// import $ from 'jquery'; // https://www.youtube.com/watch?v=FaSFzp6IDgw

/* ==========================================================================
Vue Components
========================================================================== */
_vue["default"].component('nav-bar', _nav_bar["default"]);

_vue["default"].component('nav-menu-item', _nav_menu_item["default"]);

_vue["default"].component('nav-menu-mobile', _nav_menu_mobile["default"]);

_vue["default"].component('navbar-burger', _navbar_burger["default"]);

_vue["default"].component('footer-contact-form', _footer_contact_form["default"]);

new _vue["default"]({
  el: '#app',
  mounted: function mounted() {
    // initialize animations
    (0, _sal["default"])({
      once: false
    });
  }
});
/* ==========================================================================
Template Components
========================================================================== */
// const app = {}
// /* ==========================================================================
// Config
// ========================================================================== */
// app.instantiate = function (elem) {
//   const $this = $(elem);
//   const module = $this.attr('data-module');
//   console.log("data-module: " + module);
//   if (module === undefined) {
//     throw 'Module not defined (use data-module="")';
//   } else if (module in app) {
//     if ($this.attr('data-initialized') === "true") return;
//     app[module](elem);
//     $this.attr('data-initialized', true);
//   } else {
//     throw 'Module \'' + module + '\' not found';
//   }
// };
// $(document).ready(function () {
//   // Component functions that should only run if the component exists in the ajax container or page
//   $('[data-module]').each(function () {
//     // console.log( $(this) );
//     app.instantiate(this);
//   });
// });
// /* ==========================================================================
// Globals
// ========================================================================== */
// // Hide Page Loader when DOM and images are ready
// $(window).on('load', () => $('.pageloader').removeClass('is-active'));
// // Toggle mobile menu
// $('.navbar-burger').on('click', () => $('.navbar-burger, .navbar-menu').toggleClass('is-active'));