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
            </div>
        </div>
    </div>
</template>

<script>
    import { computed } from '@vue/reactivity';
    import Swal from 'sweetalert2';
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
