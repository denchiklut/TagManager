require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import  {initialize} from "./helpers/utilities";
import VueMaterial from 'vue-material'

import storeData from './store'
import {routes} from './routes'
import moment from 'moment'
import App from './views/App'

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(VueMaterial);

const store = new Vuex.Store(storeData);

const router = new VueRouter({
    mode: 'history',
    routes
});

initialize(store, router);

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
});
const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
