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
                            Hello👋 , I appreciate that you are looking at my small site that I've made, anyway this is just an profile image of me just explaining about myself, and I hope that we will be friends.
                        </p>

                    </div>

                </div>
                <div class="row mb-3">

                    <div class="col-md-6 mt-4">

                        <div id="prof" class="d-flex p-2 firstBox container-fluid justify-content-start w-100 align-items-center">

                            <div class="me-3">
                                <img src="{{ user.image  }}" style="width: 115px;height: 115px;border-radius: 100%;border: 4px solid #B6CDC6">
                            </div>

                            <div class="mt-2 ms-3 pb-3">

                                <h4 class="fw-bold " style="letter-spacing: 1px;">
                                    <div v-if="user.type == 1">
                                        <div class="flex align-items-center">
                                            <i class='bx bxs-user-rectangle'></i>
                                            <span>{{ user.name }}</span>
                                        </div>
                                    </div>

                                    <div v-else>
                                        {{ user.name }}
                                    </div>

                                </h4>

                                <h6 class='text-secondary'>
                                    {{ user.country }}
                                </h6>

                                <h6 class='text-secondary'>
                                    {{ user.Bio }}
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

        <div v-else class="w-100 d-flex justify-content-center" style='font-size:21px'>
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
                user:computed(()=>this.$store.state.User)
            }
        },

        methods: {
            getUser(){

                axios.post('/api/Auth/me',null,{
                    headers:{
                        Authorization:this.$store.state.token ?? null
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
