import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const Foo = { template: '<div><h3>foo</h3></div>' }
const Bar = { template: '<div><h3>bar</h3></div>' }

export default new Router({
    routes: [
        {
            path: '/foo',
            component: Foo,
        },
        {
            path: '/bar',
            component: Bar,
        },
        {
            path: '/demo',
            component: resolve => require(['../components/Example.vue'], resolve)
        },
    ]
})
