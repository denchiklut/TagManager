require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueMaterial from 'vue-material'

Vue.use(VueRouter);
Vue.use(VueMaterial);


import App from './views/App'
import Analytics from './views/Analytics'
import Companies from './views/Companies'
import UsersIndex from './views/UsersIndex'


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'analytics',
            component: Analytics
        },
        {
            path: '/companies',
            name: 'companies',
            component: Companies,
        },
        {
            path: '/users',
            name: 'users.index',
            component: UsersIndex,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});