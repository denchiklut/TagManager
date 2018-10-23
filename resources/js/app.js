require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Analytics from './views/Analytics'
import Companies from './views/Companies'


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
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});