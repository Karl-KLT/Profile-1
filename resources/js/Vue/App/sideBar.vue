<template>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <router-link :to="{ name:'Home' }" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">ProfileBank</span>
                </router-link>

                <div class="nav_list">

                    <!-- if not login -->
                    <router-link :to="{ name:'Home' }" title="Home" class="nav_link" active-class="active">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name" style="font-weight: bold">Home</span>
                    </router-link>

                    <router-link :to="{ name:'Login' }" title="Login" class="nav_link" v-if="!loggedIn" active-class="active">
                        <i class='bx bx-log-in-circle'></i>
                        <span class="nav_name" style="font-weight: bold">Login</span>
                    </router-link>


                    <!-- if login -->

                    <router-link :to="{ name:'Profile' }" title="Profile" class="nav_link" v-if="loggedIn" active-class="active">
                        <i class='bx bxs-user-rectangle'></i>
                        <span class="nav_name" style="font-weight: bold">Profile</span>
                    </router-link>

                    <router-link :to="{ name:'Settings' }"  class="nav_link" title="Settings" active-class="active" style="cursor: pointer;" v-if="loggedIn">
                        <i class='bx bx-cog'></i>
                        <span class="nav_name" style="font-weight: bold">Settings</span>
                    </router-link>

                    <!-- to logout -->
                    <a  class="nav_link" title="lgoOut" @click="logOut" style="cursor: pointer;" v-if="loggedIn">
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
    import Swal from 'sweetalert2';

    export default {
        name:'sideBar',

        data() {
            return {
                loggedIn:computed(()=>this.$store.state.authenticated)
            }
        },

        methods: {
            logOut(){
                Swal.fire({
                    icon:'warning',
                    title:'r u sure?',

                    // confirm button
                    showConfirmButton:true,
                    confirmButtonText:'Yes',
                    // //////////////////
                    
                    // deny button
                    showDenyButton:true,
                    denyButtonText:'close'
                    // ////////////////
                }).then((res)=>{
                    if(res.isConfirmed){
                        this.$cookies.remove('XSRF-TOKEN-REMEMBER-ME')
                        this.$store.state.token = null
                        this.$store.state.User = null
                        this.$store.state.authenticated = false
                        this.$router.push({name:'Home'})
                    }
                })
            }
        },

    }
</script>
