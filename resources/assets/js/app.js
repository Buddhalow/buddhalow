/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import moment from 'moment'
import numeral from 'numeral'

numeral.register('locale', 'qi', {
    delimiters: {
        thousands: '•',
        decimal: ':'
    },
    abbreviations: {
        thousand: 'k',
        million: 'm',
        billion: 'b',
        trillion: 't'
    },
    ordinal : function (number) {
        return number === 1 ? 'one' : 'two';
    },
    currency: {
        symbol: '☯'
    }
});

import Chart from 'chart.js'

var windowLocale = require('browser-locale')()

var locale = windowLocale.split('-')[0]

import vuexI18n from 'vuex-i18n'
import Vuex from 'vuex'

import ChartComponent from './components/Chart'

import routes from './routes';

import VueRouter from 'vue-router'

import App from './components/App.vue'
import TabBar from './components/TabBar.vue'
import TabBarItem from './components/TabBarItem.vue'
import FileUpload from 'v-file-upload'
import VueCharts from 'hchs-vue-charts'
import Chartkick from 'chartkick'
import VueChartkick from 'vue-chartkick'
import VueCircle from 'vue2-circle-progress'
import VueChartJs from 'vue-chartjs'

import VueIntercom from 'vue-intercom'; 
import VueC3 from 'vue-c3'

window.Vue = require('vue');
window.Vue.use(VueChartkick, { Chartkick })
window.Vue.use(VueIntercom, { appId: 'mvl0jasu' })

window.Vue.component('tab-bar', TabBar)
window.Vue.component('tabbar-item', TabBarItem)

window.Vue.component('file-upload', FileUpload)

const store = new Vuex.Store()

window.Vue.use(vuexI18n.plugin, store)

const langEn = require('./lang/en.json')
const langSV = require('./lang/sv.json')


window.Vue.i18n.add('en', langEn)
window.Vue.i18n.add('sv', langSV)

window.Vue.i18n.set(locale)

numeral.locale('qi') // Buddhalow uses our own locale, QI (Qiland)

window.Vue.use(FileUpload);
window.Vue.use(VueRouter)

window.Vue.component('buddhalow-fileupload', FileUpload);
window.Vue.component('vue-circle', VueCircle);
window.Vue.component('vue-c3', VueC3);
window.Vue.component('vue-chart', ChartComponent);

window.Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

window.Vue.filter("formatNumber", function (value) {
  return numeral(parseFloat(value)).format("0,0.00"); // displaying other groupings/separators is possible, look at the docs
});

window.Vue.filter("formatLongNumber", function (value) {

  let val = value >= 0 ? value + 1000000 : value - 1000000
  console.log("Val", val)
  return numeral(val).format("0,0.00").substr(3); // displaying other groupings/separators is possible, look at the docs
});

window.Vue.filter("fromNow", function (value) {
  return moment(value).fromNow(); // displaying other groupings/separators is possible, look at the docs
});

window.Vue.filter("formatDate", function (value) {
  return moment(value).format('YY-MM-DD'); // displaying other groupings/separators is possible, look at the docs
});

window.Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

window.Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 
var spinner =  document.querySelector('#spinner');
spinner.parentNode.removeChild(spinner);

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