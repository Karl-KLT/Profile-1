import { createWebHistory, createRouter } from 'vue-router'

import Home from '../Components/Home.vue'
import Login from '../Components/Auth/Login.vue'
import Create from '../Components/Auth/Create.vue'
import Profile from '../Components/Profile.vue'
import VerifyEmail from '../Components/Auth/VerificationEmails/VerifyEmail.vue'
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
        path: '/Login/Create',
        name: 'CreateUser',
        component: Create,
    },

    {
        path: '/Profile',
        name: 'Profile',
        component: Profile,
    },

    {
        path: '/VerifyEmail',
        name: 'VerifyEmail',
        component: VerifyEmail
    }


]


var Router = createRouter({
    routes,
    history:createWebHistory()
})

export default Router;
