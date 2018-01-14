import Vue from 'vue'
import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard'
import Index from './components/Index'
import Craving from './components/Craving'
import BookSales from './components/BookSales'
import Savings from './components/Savings'
import Roamings from './components/Roaming'
import CravingStats from './components/CravingStats'

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
            path: '/dashboard/craving/stats',
            name: 'cravingStats',
            component: CravingStats
        },
        {
            path: '/dashboard/savings',
            name: 'savings',
            component: Savings
        },
        {
            path: '/dashboard/aqtivity',
            name: 'aqtivity',
            component: Roamings
        },
        {
            path: '/dashboard/sales/books',
            name: 'booksales',
            component: BookSales
        }
    ]
});
