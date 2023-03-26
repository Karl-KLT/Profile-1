import { createWebHistory, createRouter } from 'vue-router'

import Home from '../Components/Home.vue'
import Login from '../Components/Login.vue'
import Profile from '../Components/Profile.vue'
var routes = [

    {
        path: '/',
        name: 'Home',
        component: Home
    },

    {
        path: '/Login',
        name: 'Login',
        component: Login
    },

    {
        path: '/Profile',
        name: 'Profile',
        component: Profile
    }

]


var Router = createRouter({
    routes,
    history:createWebHistory()
})

export default Router;
