import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store/index';
import Login from '../components/Auth/Login';
import Dashboard from '../components/Dashboard';
import Settings from '../components/Settings/index';
import Categories from '../components/Categories/index';

import Users from '../components/Users/index';
import User from '../components/Users/create';

Vue.use(VueRouter);

const Routes = new VueRouter({
    routes: [
        { path: '/', component: Login, name: 'app' },
        { path: '/login', component: Login, name: 'login', alias: '/' },
        { path: '/dashboard', component: Dashboard, name: 'dashboard', meta: { requiresAuth: true } },

        { path: '/settings', component: Settings, name: 'settings.index', meta: { requiresAuth: true, authorize: ['view-settings'] } },

        //Categories
        { path: '/categories', component: Categories, name: 'categories', meta: { requiresAuth: true, authorize: ['view-categories'] } },

        //Users
        { path: '/users', component: Users, name: 'users.index', meta: { requiresAuth: true, authorize: ['view-users'] } },
        { path: '/users/create', component: User, name: 'users.create', meta: { requiresAuth: true, authorize: ['create-users'] } },
        { path: '/users/edit/:user', component: User, name: 'users.edit', meta: { requiresAuth: true, authorize: ['update-users'] } },

    ],
    mode: 'history'
});

Routes.beforeEach((to, from, next) => {

    const { requiresAuth, authorize } = to.meta;
    const { authenticated } = store.getters;

    if (requiresAuth) {
        if (authenticated) {
            const { permissions } = store.getters.user.data;

            if (authorize) {
                if (!authorize.some(permission => permissions.includes(permission))) {
                    next({ name: 'login' });
                }
            } else {
                next();
            }
            next();
        } else {
            next({ name: 'login' });
        }
    }
    next();
});

export default Routes;