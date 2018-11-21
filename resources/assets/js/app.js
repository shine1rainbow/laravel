/*
|--------------------------------------------------------------------------
| Init js library
|--------------------------------------------------------------------------
|
| First we will load all of this project's JavaScript dependencies which
| includes Vue and other libraries. It is a great starting point when
| building robust, powerful web applications using Vue and Laravel.
|
*/

require('./bootstrap');
require('admin-lte')

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Http from './utils/fetch';
import router from './router/index';
import store from './store/index';
import i18n from './lang/index';
import App from './App';

Vue.use(Http)
Vue.use(ElementUI)

/* Require Vue Componments */
//Vue.component('example', require('./components/Example.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
export const app = new Vue({
    el: '#app',
    router,
    store,
    i18n,
    template: '<App/>',
    components: {App}
});

/* Set vue instance and vuex store as window variable, so we can ccess your i18n in your chrome */
//window['vue'] = app
//window.store = store
