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
                    path: '/shop/user',
                    component: resolve => require(['../pages/shop/user.vue'], resolve)
                }, {
                    path: '/shop/show/:id',
                    component: resolve => require(['../pages/shop/show.vue'], resolve)
                }, {
                    path: '/shop/create',
                    component: resolve => require(['../pages/shop/create.vue'], resolve)
                }, {
                    path: '/menutype/user',
                    component: resolve => require(['../pages/menuType/user.vue'], resolve)
                }, {
                    path: '/menutype/create',
                    component: resolve => require(['../pages/menuType/create.vue'], resolve)
                }, {
                    path: '/menutype/show/:id',
                    component: resolve => require(['../pages/menuType/show.vue'], resolve)
                }, {
                    path: '/menucategory/user',
                    component: resolve => require(['../pages/menuCategory/user.vue'], resolve)
                }, {
                    path: '/menucategory/create',
                    component: resolve => require(['../pages/menuCategory/create.vue'], resolve)
                }, {
                    path: '/menucategory/show/:id',
                    component: resolve => require(['../pages/menuCategory/show.vue'], resolve)
                }, {
                    path: '/menu/user',
                    component: resolve => require(['../pages/menu/user.vue'], resolve)
                }, {
                    path: '/menu/create',
                    component: resolve => require(['../pages/menu/create.vue'], resolve)
                }, {
                    path: '/menu/show/:id',
                    component: resolve => require(['../pages/menu/show.vue'], resolve)
                }, {
                    path: '/menuoption/user',
                    component: resolve => require(['../pages/menuOption/user.vue'], resolve)
                }, {
                    path: '/menuoption/create',
                    component: resolve => require(['../pages/menuOption/create.vue'], resolve)
                }, {
                    path: '/menuoption/show/:id',
                    component: resolve => require(['../pages/menuOption/show.vue'], resolve)
                }, {
                    path: '/menuaddition/user',
                    component: resolve => require(['../pages/menuAddition/user.vue'], resolve)
                }, {
                    path: '/menuaddition/create',
                    component: resolve => require(['../pages/menuAddition/create.vue'], resolve)
                }, {
                    path: '/menuaddition/show/:id',
                    component: resolve => require(['../pages/menuAddition/show.vue'], resolve)
                }, {
                    path: '/staff/user',
                    component: resolve => require(['../pages/staff/user.vue'], resolve)
                }, {
                    path: '/staff/index',
                    component: resolve => require(['../pages/staff/index.vue'], resolve)
                }, {
                    path: '/staff/create',
                    component: resolve => require(['../pages/staff/create.vue'], resolve)
                }, {
                    path: '/staff/show/:id',
                    component: resolve => require(['../pages/staff/show.vue'], resolve)
                }, {
                    path: '/tag/index',
                    component: resolve => require(['../pages/tag/index.vue'], resolve)
                }, {
                    path: '/tag/user',
                    component: resolve => require(['../pages/tag/user.vue'], resolve)
                }, {
                    path: '/picture/index',
                    component: resolve => require(['../pages/picture/index.vue'], resolve)
                }, {
                    path: '/picture/user',
                    component: resolve => require(['../pages/picture/user.vue'], resolve)
                }, {
                    path: '/picture/create',
                    component: resolve => require(['../pages/picture/create.vue'], resolve)
                }, {
                    path: '/picture/show/:id',
                    component: resolve => require(['../pages/picture/show.vue'], resolve)
                }, {
                    path: '/user/avater',
                    component: resolve => require(['../pages/user/avatarUpload.vue'], resolve)
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
