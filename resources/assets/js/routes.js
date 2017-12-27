import Vue from 'vue'
import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard'; 
import Index from './components/Index';
import Craving from './components/Craving';
import SaleData from './components/SaleData';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard
        },
        {
            path: '/dashboard/cravings',
            name: 'cravings',
            component: Craving
        },
        {
            path: '/dashboard/sales',
            name: 'sales',
            component: SaleData
        }
    ]
});
