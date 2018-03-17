import VueRouter from 'vue-router'

let routes = [
    {
        path: '/',
        component: require('./components/Home')
    },
    {
        path: '/about',
        component: require('./components/About')
    },
    {
        path: '/register',
        name: 'regist',
        component: require('./components/register/Register')
    },
    {
        path: '/login',
        name: 'login',
        component: require('./components/login/Login')
    }
]
export default new VueRouter({
    mode: 'history', //这里是去掉vue路由#号
    routes
})
