<template>
    <div>
        <div v-if="Auth">

            <div class="pt-3 font-bold">
                <h4 style="text-decoration: underline;letter-spacing: 1px">Settings</h4>
            </div>



            <div class="mt-1">
                <div class="container-fluid">
                    <span class="text-decoration-underline fs-5">Profile link</span>
                </div>
                <div class="container-fluid">
                    <div>
                        <input class="form-control" type="text" v-model="profileLink" readonly>
                    </div>

                    <div class="mt-2 w-100 d-flex justify-content-center">
                        <button class="btn btn-secondary w-100" @click="copy">copy</button>
                    </div>
                </div>

                <hr>

                <div class="w-100">
                    <button class="btn btn-danger w-100" @click="deleteAccount">Delete account</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { computed } from '@vue/reactivity';
    import Swal from 'sweetalert2';
    import axios from 'axios';
    export default {
        name: 'Settings',

        data() {
            return {
                Auth:computed(()=>this.$store.state.authenticated),

                User:computed(()=>this.$store.state.User),

                link:location.origin,

                profileLink:null
            }
        },

        methods: {
            copy(){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                navigator.clipboard.writeText(this.profileLink).then(()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'ur profile id copied'
                    })
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'failed to copy ur profile id'
                    })
                })

            },

            deleteAccount(){
                var user_code = this.User.user_code
                var token = this.$store.state.token

                Swal.fire({
                    icon:'warning',
                    text:`to delete ur account write ur code (${this.User.user_code})`,
                    title:'delete account',
                    input:'text',
                    inputAttributes:{
                        class:'form-control'
                    },
                    preConfirm(value){
                        Swal.showLoading()
                        if(value != ''){
                            if(user_code == value){
                                axios.post('/api/Auth/destroy',null,{
                                    headers:{
                                        'Authorization':'bearer '+token
                                    }
                                }).then(()=>{
                                    return true
                                })
                            }else{
                                Swal.showValidationMessage('code not correct, try again')
                            }
                        }else{
                            Swal.showValidationMessage('input is empty')
                        }
                    }
                }).then((res)=>{
                    if(res.isConfirmed){
                        this.$store.dispatch('setToken',null);
                        this.$store.dispatch('setUser',null);
                        this.$store.dispatch('setAuth',false);
                        this.$router.push({name:'Home'})
                    }
                })
            }
        },

        mounted() {
            if(!this.Auth){
                return this.$router.push({ name:'Home' })
            }

            this.profileLink = this.link+'/'+this.User.user_code
        }
    }
</script>
