<template>

    <div class="pt-3 font-bold">
        <h4 style="text-decoration: underline;letter-spacing: 1px">Login</h4>
    </div>

    <div class="mt-3">
        <div class="d-flex justify-content-center flex-col">
            <div>
                <input type="email" v-model="email" class="form-control" placeholder="Email . . ." required>
            </div>

            <div class="mt-1">
                <input type="password" v-model="password" autocomplete="current-password" class="form-control" placeholder="Password . . ." required>
            </div>

            <div>
                <div class="flex justify-content-between align-items-center me-2">
                    <!-- <div class="ms-2">
                        <div class="d-flex form-check align-items-center">
                            <input v-model="remember_me" type="checkbox" class="form-check-input">
                            <b class="ms-1">
                                remember me
                            </b>
                        </div>
                    </div>

                    <div>
                        <RouterLink :to="{name:'CreateUser'}" type="button" class="btn btn-outline-dark fw-bold me-2" style="letter-spacing: 1px">
                            CreateUser
                        </RouterLink>

                        <button @click="Login" type="button" class="btn btn-outline-dark fw-bold" style="letter-spacing: 1px">
                            <div v-if="loading">
                                <div class="spinner-border"></div>
                            </div>
                            <div v-else>
                                SignIn
                            </div>
                        </button>

                    </div> -->

                    <div class="w-100">
                        <span>
                            <div class="d-flex form-check align-items-center my-2">
                                <input v-model="remember_me" type="checkbox" class="form-check-input">
                                <b class="ms-1">
                                    Remember me
                                </b>
                            </div>
                        </span>

                        <button @click="Login" type="button" class="btn btn-outline-dark fw-bold w-100" style="letter-spacing: 1px">
                            <div v-if="loading">
                                <div class="spinner-border"></div>
                            </div>
                            <div v-else>
                                SignIn
                            </div>
                        </button>

                        <div class="d-flex justify-content-center my-2 align-items-center">
                            <span style="background-color: gray;height: 5px;" class="rounded lines"></span>
                            <span style="width: 5%;text-align: center;letter-spacing: 0.8px;" class="fw-bold">or</span>
                            <span style="background-color: gray;height: 5px;" class="rounded lines"></span>
                        </div>

                        <RouterLink :to="{name:'CreateUser'}" type="button" class="btn btn-outline-dark fw-bold w-100" style="letter-spacing: 1px">
                            CreateUser
                        </RouterLink>

                    </div>
                </div>

                <div class="w-100 mt-3 alert alert-danger" v-if="Errors">
                    <ul v-for="error in Errors" class="m-1">
                        <li>- {{ error[0] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .lines{
        width: 45%;
    }
    @media only screen and (max-width: 1150px){
        .lines{
            width: 50%;
        }
    }
</style>

<script>
    import axios from 'axios'
    export default {
        name:'Login',

        data() {
            return {
                email:null,
                password:null,

                loading:false,

                remember_me:false,


                Errors: null
            }
        },

        methods: {
            Login(){
                this.loading = true
                axios.post('/api/Auth/login',{
                    email:this.email,
                    password:this.password
                })
                .then((res)=>{
                    if(this.remember_me){
                        this.$cookies.set('XSRF-TOKEN-REMEMBER-ME',res.data.access_token,res.data.expires_in)
                    }

                    this.$store.dispatch('setToken',res.data.access_token);
                    this.$store.dispatch('setAuth',true);
                    this.$router.push({name:'Home'})
                }).catch((err)=>{
                    this.Errors = err.response.data.error
                    this.loading = false
                })

            }
        }
    }
</script>
