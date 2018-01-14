
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import moment from 'moment'
import Chart from 'chart.js'
import routes from './routes';

import VueRouter from 'vue-router'

import App from './components/App.vue'
import FileUpload from 'v-file-upload'
import VueCharts from 'hchs-vue-charts'
import Chartkick from 'chartkick'
import VueChartkick from 'vue-chartkick'
import VueCircle from 'vue2-circle-progress'

import VueIntercom from 'vue-intercom'; 
  import VueC3 from 'vue-c3'


window.Vue = require('vue');
window.Vue.use(VueChartkick, { Chartkick })
window.Vue.use(VueIntercom, { appId: 'mvl0jasu' });

window.Vue.component('file-upload', FileUpload)
window.Vue.use(FileUpload);
window.Vue.use(VueRouter)

window.Vue.component('buddhalow-fileupload', FileUpload);
window.Vue.component('vue-circle', VueCircle);
window.Vue.component('vue-c3', VueC3);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: routes,
    components: {
      VueC3  
    },
    mounted() {
   /*     this.$intercom.boot({
          user_id: this.userId,
          name: this.name,
          email: this.email,
        });
        this.$intercom.show();*/
    },
    watch: {
        email(email) {
          this.$intercom.update({ email });
        }
    },
    render: h => h(App)
});