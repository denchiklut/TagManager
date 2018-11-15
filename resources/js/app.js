require('./bootstrap');

import Vue from 'vue'
import moment from 'moment'
import VueRouter from 'vue-router'
import VueMaterial from 'vue-material'

Vue.use(VueRouter);
Vue.use(VueMaterial);

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
});


import App from './views/App'
import Analytics from './views/Analytics'
import Companies from './views/Companies'
import Containers from './views/Containers'
import Templates from './views/Templates'
import Relax from './views/Relax'


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
            path: '/containers/:url/:id',
            props: true,
            name: 'containers',
            component: Containers,
        },
        {
            path: '/templates',
            name: 'templates',
            component: Templates,
        },
        {
            path: '/relax',
            name: 'relax',
            component: Relax,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
