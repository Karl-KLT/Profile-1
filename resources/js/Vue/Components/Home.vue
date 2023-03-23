<template>
    <div>
        <div v-if="user">
            <div class="pt-3 font-bold">
                <h4 style="text-decoration: underline;letter-spacing: 1px">Home</h4>
            </div>
            <div class="mt-1">

                <div id="desc" class="mt-2 text-light container-fluid w-md-75 rounded" style="background: #CDE4DD;">

                    <div class="container-fluid p-1 w-100 text-dark" style="letter-spacing: 0.5px;">

                        <b style="text-decoration: underline;">Message,</b><br>

                        <p class="container-fluid text-secondary">
                            {{ user.message }}
                        </p>

                    </div>

                </div>
                <div class="row mb-3">

                    <div class="col-md-6 mt-4">

                        <div id="prof" class="d-flex p-2 firstBox container-fluid justify-content-start w-100 align-items-center">

                            <div class="me-3">
                                <img :src='user.image ?? "data:image/png;base64,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"' style="width: 115px;height: 115px;border-radius: 100%;border: 4px solid #B6CDC6">
                            </div>

                            <div class="mt-2 ms-3 pb-3">

                                <h4 class="fw-bold " style="letter-spacing: 1px;">
                                    <div v-if="user.type == 1">
                                        <div class="flex align-items-center">
                                            <i class='bx bxs-user-rectangle mb-1' title="Admin"></i>
                                            <span>{{ user.name }}</span>
                                        </div>
                                    </div>

                                    <div v-else>
                                        {{ user.name }}
                                    </div>

                                </h4>

                                <h6 v-if="user.country" class='text-secondary d-flex align-items-center'>
                                    <i class='bx bx-location-plus'></i>
                                    {{ user.country }}
                                </h6>

                                <h6 v-if="user.bio" class='text-secondary d-flex align-items-center'>
                                    {{ user.bio }}
                                </h6>

                            </div>
                        </div>

                        <!-- {{-- <livewire:accounts /> --}} -->

                    </div>

                    <div class="col-md-6 mt-4">
                        <div style="user-select: none;" class="d-flex p-2 firstBox container-fluid justify-content-start w-100 align-items-center">
                            <div class="w-100 @auth py-2 @endauth" id="scroll_skills" style="height: auto;max-height: 245px; overflow: auto;">
                                <!-- <livewire:skills USER_SID='{{ $user->USER_SID }}'/> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="w-100 d-flex justify-content-center" style="font-size:21px">
            <div class="justify-content-center badge bg-dark m-3 text-light">
                something went wrong , user has not found
            </div>
        </div>
    </div>
</template>


<script>
    import { computed } from '@vue/reactivity';
    import axios from 'axios'

    export default {
        name:'Home',

        data() {
            return {
                user:computed(()=>this.$store.state.User),
            }
        },

        methods: {
            getUser(){
                if(this.$cookies.get('XSRF-TOKEN-REMEMBER-ME')){
                    this.$store.dispatch('setToken',this.$cookies.get('XSRF-TOKEN-REMEMBER-ME'));
                    this.$store.dispatch('setAuth',true);
                    this.getRequest()
                }else{
                    this.getRequest()
                }
            },

            getRequest(){
                axios.post('/api/Auth/me',null,{
                    headers:{
                        Authorization:'bearer ' + this.$store.state.token
                    }
                })
                .then((res)=>{
                    this.$store.dispatch('setUser',res.data.data);
                })
            }
        },

        beforeMount(){
            this.getUser()
        }
    }
</script>
