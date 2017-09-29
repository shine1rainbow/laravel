
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';
import Http from './utils/fetch';
import VueI18n from 'vue-i18n';
import router from './router/index.js';
import store from './store/index.js';
import locales from './lang/index.js';
import App from './App';

Vue.use(Http)
Vue.use(ElementUI)
Vue.use(VueI18n)

/* Require Vue Componments */
//Vue.component('example', require('./components/Example.vue'));

/* Create VueI18n instance with options: {zh_cn, en} */
const i18n = new VueI18n({
    locale: 'zh_cn',
    messages: locales
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    router,
    store,
    i18n
    ,
    template: '<App/>',
    components: { App }
});
