import Vue from 'vue'
import Router from 'vue-router'
import {encryptData, decryptData} from './../utils/encrypt'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            redirect: '/dashboard'
        },
        {
            path: '/',
            beforeEnter: requireAuth,
            component: resolve => require(['./../components/layouts/Home.vue'], resolve),
            children: [
                {
                    path: '/dashboard',
                    component: resolve => require(['../pages/Dashboard.vue'], resolve)
                }, {
                    path: '/mall',
                    component: resolve => require(['../pages/Test.vue'], resolve)
                }, {
                    path: '/floor',
                    component: resolve => require(['../pages/Test2.vue'], resolve)
                }, {
                    path: '/shop/index',
                    component: resolve => require(['../pages/shop/index.vue'], resolve)
                }, {
                    path: '/shop/create',
                    component: resolve => require(['../pages/shop/create.vue'], resolve)
                }
            ]
        },
        {
            path: '/login',
            component: resolve => require(['../pages/auth/Login.vue'], resolve)
        },
        {
            path: '/demo',
            component: resolve => require(['../components/Example.vue'], resolve)
        },
        {
            path: '/404',
            component: resolve => require(['../pages/errors/404.vue'], resolve)
        },
        {
            path: '/401',
            component: resolve => require(['../pages/errors/401.vue'], resolve)
        },
        {
            path: '*',
            redirect: '/404'
        }
    ]
})

/**
 * Auth Route
 */
function requireAuth(to, from, next) {

    let encryptAuthUser = window.localStorage.getItem('authUser')
    let decryptedAuthUser = decryptData(encryptAuthUser);

    if (decryptedAuthUser && decryptedAuthUser.access_token) {
        next()
    } else {
        next('/login')
    }
}
