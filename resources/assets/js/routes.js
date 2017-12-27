import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard'; 
import Index from './components/Index';
 
let routes = [
    {
        path: '/dashboard',
        component: Dashboard
    },
    {
        path: '/',
        component: Index
    }
];
 
 
export default new VueRouter({
    routes
});
