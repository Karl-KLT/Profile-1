<template>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <router-link :to="{ name:'Home' }" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name"></span>
                </router-link>

                <div class="nav_list">


                    <router-link :to="{ name:'Home' }" class="nav_link" active-class="active">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name" style="font-weight: bold">Home</span>
                    </router-link>

                    <router-link :to="{ name:'Login' }" class="nav_link" v-if="!loggedIn" active-class="active">
                        <i class='bx bx-log-in-circle'></i>
                        <span class="nav_name" style="font-weight: bold">Login</span>
                    </router-link>


                    <!-- if login -->

                    <router-link :to="{ name:'Profile' }" class="nav_link" v-if="loggedIn" active-class="active">
                        <i class='bx bxs-user-rectangle'></i>
                        <span class="nav_name" style="font-weight: bold">Profile</span>
                    </router-link>

                    <a  class="nav_link" @click="logOut" style="cursor: pointer;" v-if="loggedIn">
                        <i class='bx bxs-log-out'></i>
                        <span class="nav_name" style="font-weight: bold">logOut</span>
                    </a>

                </div>

            </div>
        </nav>
    </div>

</template>


<script>
    import { computed } from '@vue/reactivity';

    export default {
        name:'sideBar',

        data() {
            return {
                loggedIn:computed(()=>this.$store.state.authenticated)
            }
        },

        methods: {
            logOut(){
                this.$cookies.remove('XSRF-TOKEN-REMEMBER-ME')
                this.$store.state.token = null
                this.$store.state.User = null
                this.$store.state.authenticated = false
                this.$router.push({name:'Home'})
            }
        },

    }
</script>
