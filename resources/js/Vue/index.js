import { createApp } from 'vue'
import { createStore } from 'vuex'
import VueCookies from 'vue-cookies'
import App from './App/App.vue'

import Router from './Router/index.js'

var store = createStore({
    state(){
        return {
            token:null,
            User:null,
            authenticated:false
        }
    },

    actions:{
        setToken(context,token){
            context.commit('setToken',token)
        },

        setAuth(context,key){
            context.commit('setAuth',key)
        },

        setUser(context,User){
            context.commit('setUser',User)
        }
    },

    mutations:{
        setToken(state,payload = null){
            state.token = payload
        },

        setAuth(state,payload = false){
            state.authenticated = payload
        },

        setUser(state,payload = false){
            state.User = payload
        }
    }
})

createApp(App).use(Router).use(store).use(VueCookies).mount('#App')
