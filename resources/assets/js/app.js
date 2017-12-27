
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import routes from './routes';

import VueRouter from 'vue-router'

import App from './components/App.vue'
import FileUpload from './components/FileUpload.vue'

window.Vue = require('vue');
window.Vue.use(VueRouter)

window.Vue.component('buddhalow-fileupload', FileUpload)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: routes,
    render: h => h(App)
});