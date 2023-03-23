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

            <div class="mt-2">
                <div class="flex justify-content-end me-2">

                    <button @click="Login" type="button" class="btn btn-outline-dark fw-bold" style="letter-spacing: 1px">
                        <div v-if="loading">
                            <div class="spinner-border"></div>
                        </div>
                        <div v-else>
                            SignIn
                        </div>
                    </button>

                    <!-- <a href="" class="btn btn-outline-dark fw-bold" style="letter-spacing: 1px">
                        <div>
                            SignUp
                        </div>
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name:'Login',

        data() {
            return {
                email:null,
                password:null,

                loading:false
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
                    this.$store.dispatch('setToken',`${res.data.token_type} ${res.data.access_token}`);
                    this.$store.dispatch('setAuth',true);
                    this.$router.push({name:'Home'})
                })

            }
        }
    }
</script>
