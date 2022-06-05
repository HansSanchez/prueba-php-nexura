import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home'
import Employee from './views/Employee'
import NotFount from './components/NotFountComponent'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [

        // PÁGINA DE INICIO
        {path: '/v/home', name: 'home', component: Home},
        {path: '/v/employees', name: 'employees', component: Employee},

        // ERROR 404
        {path: '/error-404', name: 'error-404', component: NotFount},
        {path: '*', redirect: 'error-404'},

    ]
})
