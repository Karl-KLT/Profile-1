<template>

    <div class="pt-3 font-bold">
        <h4 style="text-decoration: underline;letter-spacing: 1px">Login</h4>
    </div>

    <div class="mt-3">
        <div class="d-flex justify-content-center flex-col">
            <div>
                <input type="text" v-model="name" class="form-control" placeholder="Name . . ." required autocomplete="off">
            </div>

            <div class="my-1">
                <input type="email" v-model="email" class="form-control" placeholder="Email . . ." required autocomplete="off">
            </div>

            <div>
                <input type="password" v-model="password" autocomplete="off" class="form-control" placeholder="Password . . ." required>
            </div>

            <div class="mt-2 d-flex justify-content-end">
                <div class="flex justify-content-between align-items-center me-2">
                    <button @click="singUp" type="button" class="btn btn-outline-dark fw-bold" style="letter-spacing: 1px">
                        <div v-if="loading">
                            <div class="spinner-border"></div>
                        </div>
                        <div v-else>
                            singUp
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
        name:'Create',

        data() {
            return {
                name:null,
                email:null,
                password:null,

                loading:false,
            }
        },

        methods: {
            singUp(){
                this.loading = true
                axios.post('/api/Auth/updateOrCreate',{
                    name:this.name,
                    email:this.email,
                    password:this.password
                })
                .then((res)=>{
                    console.log(res.data)
                    this.loading = false
                    this.$router.push({name:'Login'})
                }).catch((err)=>{
                    console.log(err.response.data)
                    this.loading = false
                })
                // .catch((err)=>{console.log(err)})

            }
        }
    }
</script>
