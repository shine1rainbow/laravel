webpackJsonp([0],{

/***/ 134:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(33)
/* script */
var __vue_script__ = __webpack_require__(135)
/* template */
var __vue_template__ = __webpack_require__(136)
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/Example.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key.substr(0, 2) !== "__"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Example.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2b9b0123", Component.options)
  } else {
    hotAPI.reload("data-v-2b9b0123", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 135:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__utils_fetch__ = __webpack_require__(32);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        console.log(this.$store);
        console.log(this.$store.state.language);
    },


    computed: {
        formatLanguage: function formatLanguage() {
            return this.$store.getters.formatLanguage;
        }
    },

    created: function created() {
        this.fetch();
    },


    methods: {
        fetch: function fetch() {
            //demo of http request
            Object(__WEBPACK_IMPORTED_MODULE_0__utils_fetch__["b" /* http */])({ url: '/test', method: 'get' }).then(function (response) {
                console.log(response.data);
            }).catch(function (err) {
                console.log(err);
            });
        },
        updateLanguage: function updateLanguage(language) {
            this.$store.commit('CHANGE_LANGUAGE', language);
            console.log(this.$store.state.language);
        },
        change: function change() {
            console.log(this.$store.state.language);
            this.$store.dispatch('changeLanguage', 'change language');
            console.log(this.$store.state.language);
        }
    }
});

/***/ }),

/***/ 136:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "container" }, [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-8 col-md-offset-2" }, [
        _c("div", { staticClass: "panel panel-default" }, [
          _c("div", { staticClass: "panel-heading" }, [
            _vm._v("Example Component")
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "panel-body" }, [
            _vm._v(
              "\n                    I'm an example component!\n                    " +
                _vm._s(_vm.$t("test.name")) +
                "\n\n                    "
            ),
            _c("hr"),
            _vm._v(
              "\n                    from store getters: " +
                _vm._s(_vm.formatLanguage) +
                "\n                "
            )
          ]),
          _vm._v(" "),
          _c("button", { on: { click: _vm.change } }, [
            _vm._v("changeLanguage")
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-2b9b0123", module.exports)
  }
}

/***/ })

});