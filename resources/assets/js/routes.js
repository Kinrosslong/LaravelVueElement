import VueRouter from 'vue-router'

let routes = [
    {
        path: '/',
        component: require('./components/Home')
    },
    {
        path: '/about',
        component: require('./components/About')
    }
]
export default new VueRouter({
    mode: 'history', //这里是去掉vue路由#号
    routes
})
