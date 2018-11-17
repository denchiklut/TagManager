import Login from './auth/login'
import Analytics from './views/Analytics'
import Companies from './views/Companies'
import Containers from './views/Containers'
import Templates from './views/Templates'
import Relax from './views/Relax'


export const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/',
        name: 'analytics',
        component: Analytics,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/companies',
        name: 'companies',
        component: Companies,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/containers/:url/:id',
        props: true,
        name: 'containers',
        component: Containers,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/templates',
        name: 'templates',
        component: Templates,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/relax',
        name: 'relax',
        component: Relax,
    },

];
