import Vue from 'vue'
import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard'
import Index from './components/Index'
import Craving from './components/Craving'
import BookSales from './components/BookSales'
import Savings from './components/Savings'
import Roamings from './components/Roaming'
import Cravity from './components/Cravity'
import Cleaning from './components/Cleaning'
import MusicStreams from './components/MusicStreams'
import Opportunify from './components/Opportunify'
import Threats from './components/Threats'
import Fungalify from './components/Fungalify'
import Account from './components/Account'
import Login from './components/Login'
import Challenge from './components/Challenge'

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
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
            path: '/dashboard/cleaning',
            name: 'cleaning',
            component: Cleaning
        },
        {
            path: '/dashboard/threats',
            name: 'threats',
            component: Threats
        },
        {
            path: '/dashboard/opportunities',
            name: 'opportunities',
            component: Opportunify
        },
        {
            path: '/dashboard/stats/cravings',
            name: 'cravingStats',
            component: Cravity
        },
        {
            path: '/dashboard/music/streams',
            name: 'musicStreams',
            component: MusicStreams
        },
        {
            path: '/dashboard/savings',
            name: 'savings',
            component: Savings
        },
        {
            path: '/dashboard/challenges/:id',
            name: 'challenges',
            component: Challenge
        },
        {
            path: '/dashboard/fungalify',
            name: 'entity',
            component: Fungalify
        },
        {
            path: '/dashboard/accounts/:id',
            name: 'account',
            component: Account
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
