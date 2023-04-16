<template>
    <div>
        <div v-if="user">
            <!-- <div class="pt-3 font-bold">
                <h4 style="text-decoration: underline;letter-spacing: 1px">Home</h4>
            </div> -->
            <!-- old template -->
            <!-- <div class="mt-1">

                <div id="desc" class="mt-2 text-light container-fluid w-md-75 rounded" style="background: #CDE4DD;">

                    <div class="container-fluid p-1 w-100 text-dark" style="letter-spacing: 0.5px;">

                        <b style="text-decoration: underline;">Message,</b><br>

                        <p class="container-fluid text-secondary">
                            {{ user.message }}
                        </p>

                    </div>

                </div>
                <div class="row mb-3">

                    <div :class="(user.Skills ? 'col-md-6' : 'col-md-12')+' mt-4'">

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

                    </div>

                    <div v-if="user.Skills" class="col-md-6 mt-4">
                        <div style="user-select: none;" class="d-flex p-2 firstBox container-fluid justify-content-start w-100 align-items-center">
                            <div class="w-100 py-2" id="scroll_skills" style="height: auto;max-height: 245px; overflow: auto;">
                                <Skills></Skills>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- end old template -->
            <!-- new template -->
            <div class="w-100 d-flex flex-column justify-content-center">
                <div class="w-100 d-flex justify-content-center">
                    <div class="profile_cover_image" :style="'background-image: url('+(user.cover_image ?? 'cover.jpg')+');'">

                        <!-- cover image -->

                    </div>
                    <!-- <img id="cover_image" style="width: 50%;height: 350px;border-radius: 10px;" src="https://scontent.fcai19-1.fna.fbcdn.net/v/t39.30808-6/330447781_1405703233572120_9193100482535445812_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=e3f864&_nc_ohc=ApSrzf1dLy0AX8Pp-Xp&_nc_ht=scontent.fcai19-1.fna&oh=00_AfDeWr-HAYdLXg5DTkUAmwylrsIBllX0uxqraE4GyUSIbg&oe=64387AF5"
                    alt="cover_image"> -->
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <div class="profile-box-main">
                        <div class="profile-box-info mx-5">
                            <div class="profile-box-image">
                                <img style="border-radius: 100%;transform: translateY(-35px);box-shadow: 0px 0px 0px 5px white;padding: 0px;max-height: 120px;background-color: white;"  width="120" :src="user.image ?? 'data:image/png;base64,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'" alt="user_image">
                            </div>
                            <div style="letter-spacing: 0.8px;" class="fw-bold fs-5 profile-info-design">
                                <div class="d-flex flex-column">
                                    <span class="fs-4 profile-info-design">
                                        <div>
                                            {{ user.name }}
                                        </div>
                                    </span>

                                    <span class="w-100" v-if="user.type != 0">
                                        <div class="profile-info-design-badge">
                                            <svg v-if="user.type == 2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16">
                                                <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/>
                                                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                                            </svg>

                                            <svg v-if="user.type == 2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16">
                                                <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/>
                                                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                                            </svg>

                                            <svg v-else-if="user.type == 1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16">
                                                <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/>
                                                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                                            </svg>
                                        </div>
                                    </span>

                                    <span class="fs-6 d-flex align-items-center profile-info-design" v-if="user.country">
                                        <i class='bx bx-location-plus'></i>
                                        {{ user.country }}
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div v-if="!visit" class="profile-info-design-btn">
                            <!-- btn for update profile -->
                            <button class="btn btn-dark"  @click="this.$router.push({name:'Profile'})">Edit profile</button>
                        </div>

                    </div>

                </div>
            </div>

            <!-- contact info -->
            <div class="container-fluid w-50 my-1">

                <div class="badge d-flex flex-wrap justify-content-center w-100 p-1 bg-dark">

                    <div @click="saveContact('phoneNumber',user.phoneNumber)" :class="'phoneNumber badge '+(user.phoneNumber ? 'bg-primary cursor-pointer' : 'bg-secondary')+' m-1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                        </svg>
                    </div>

                    <div @click="saveContact('facebook',user.facebook)" :class="'facebook badge '+(user.facebook ? 'bg-primary cursor-pointer' : 'bg-secondary')+' m-1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                    </div>

                    <div @click="saveContact('instagram',user.instagram)" :class="'instagram badge '+(user.instagram ? 'bg-primary cursor-pointer' : 'bg-secondary')+' m-1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                        </svg>
                    </div>

                    <div @click="saveContact('twitter',user.twitter)" :class="'twitter badge '+(user.twitter ? 'bg-primary cursor-pointer' : 'bg-secondary')+' m-1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                        </svg>
                    </div>

                    <div @click="saveContact('linkedIn',user.linkedIn)" :class="'linkedIn badge '+(user.linkedIn ? 'bg-primary cursor-pointer' : 'bg-secondary')+' m-1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                        </svg>
                    </div>

                    <div @click="saveContact('website',user.website)" :class="'website badge '+(user.website ? 'bg-primary cursor-pointer' : 'bg-secondary')+' m-1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-browser-chrome" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M16 8a8.001 8.001 0 0 1-7.022 7.94l1.902-7.098a2.995 2.995 0 0 0 .05-1.492A2.977 2.977 0 0 0 10.237 6h5.511A8 8 0 0 1 16 8ZM0 8a8 8 0 0 0 7.927 8l1.426-5.321a2.978 2.978 0 0 1-.723.255 2.979 2.979 0 0 1-1.743-.147 2.986 2.986 0 0 1-1.043-.7L.633 4.876A7.975 7.975 0 0 0 0 8Zm5.004-.167L1.108 3.936A8.003 8.003 0 0 1 15.418 5H8.066a2.979 2.979 0 0 0-1.252.243 2.987 2.987 0 0 0-1.81 2.59ZM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                        </svg>
                    </div>

                    <div @click="saveContact('location',user.location)" :class="'location badge '+(user.location ? 'bg-primary cursor-pointer' : 'bg-secondary')+' m-1'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-geo" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <!-- end contact info -->

            <div v-if="user.bio" class="w-100 d-flex justify-content-center">
                <div class="w-50 d-flex justify-content-center">
                    <span class="fs-6 border-top">{{ user.bio }}</span>
                </div>
            </div>


            <!-- end new template -->
        </div>

        <div v-else class="w-100">
            <!-- <div class="justify-content-center badge bg-dark m-3 text-light">
                something went wrong , user has not found
            </div> -->
            <div class="pt-3 font-bold">
                <h4 style="text-decoration: underline;letter-spacing: 1px">Home</h4>
            </div>
            <div class="mt-1">
                <div id="desc" class="mt-2 text-light container-fluid w-md-75 rounded" style="background: #CDE4DD;">

                    <div class="container-fluid p-1 w-100 text-dark" style="letter-spacing: 0.5px;">

                        <b style="text-decoration: underline;">Hi,</b><br>

                        <p class="container-fluid text-secondary">
                            customize ur profile and make friends on ProfileBank, <span class="fw-bold text-decoration-underline">please login to get start</span>
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .profile-box-main{
        display: flex;
        justify-content: space-between;
        width: 50%;
    }
    .profile-box-info{
        display: flex;
    }
    .profile-info-design{
        margin: 5px;
    }
    .profile-info-design-btn{
        margin: 5px;
        display: flex;
        justify-content: end;
        align-items: end;
    }

    .profile-info-design-badge{
        margin: 5px;
        display: flex;
        flex-direction: row;
    }
    .profile_cover_image{
        width: 50%;
        height: 350px;
        border-radius: 10px;
        background-position: center;

        /* /////// full screen cover ////// */
        background-repeat: no-repeat;
        background-size: cover;
        /* /////////////////////////////// */
        display: flex;
        justify-content: end;
        align-items: end;

        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;

    }
    @media only screen and (max-width: 1150px){
        .profile-box-main{
            /* display: none; */
            display: block;
            width: 100%;
        }
        .profile-box-info{
            display: block;
        }
        .profile-box-image{
            display: flex;
            width: 100%;
            justify-content: center;
        }
        .profile-info-design{
            width: 100%;
            margin: 0px;
            display: flex;
            transform: translateY(-10px);
            justify-content: center;
        }

        .profile-info-design-btn{
            margin: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-info-design-badge{
            width: 100%;
            margin: 0px;
            display: flex;
            transform: translateY(-10px);
            justify-content: center;
        }
        .profile_cover_image{
            width: 100%;
        }
    }

</style>
<script>
    import { computed } from '@vue/reactivity';
    import Skills from '../Components/Skills.vue'
    import axios from 'axios'
import Swal from 'sweetalert2';

    export default {
        name:'Home',

        data() {
            return {
                user:computed(()=>this.$store.state.User),

                visit:false
            }
        },

        methods: {
            saveContact(column_name, value = null){
                if(value){
                    switch (column_name) {
                        case 'phoneNumber':
                            window.location.href = 'tel:'+value
                            break;
                        case 'facebook':
                            window.open(value,'_blank')
                            break;
                        case 'instagram':
                            window.open(value,'_blank')
                            break;
                        case 'twitter':
                            window.open(value,'_blank')
                            break;
                        case 'linkedIn':
                            window.open(value,'_blank')
                            break;
                        case 'website':
                            window.open(value,'_blank')
                            break;
                        case 'location':
                            Swal.fire(value)
                            break;
                    }
                }
            },

            getUser(query = null){
                if(query){
                    axios.post('/api/Auth/visit',{
                        user_code:query
                    }).then((res)=>{
                        this.$store.dispatch('setUser',res.data.User)
                    })
                }else{
                    this.$store.dispatch('setUser',null)
                    if(this.$cookies.get('XSRF-TOKEN-REMEMBER-ME')){
                        this.$store.dispatch('setToken',this.$cookies.get('XSRF-TOKEN-REMEMBER-ME'));
                        this.getRequest()
                    }else{
                        this.getRequest()
                    }
                }


            },

            getRequest(){
                axios.post('/api/Auth/me',null,{
                    headers:{
                        Authorization:'bearer ' + this.$store.state.token
                    }
                })
                .then((res)=>{

                    if(!res.data.data.email_verified_at){
                        this.$store.dispatch('setAuth',false);
                        this.$store.dispatch('setUser',{'email': res.data.data.email});
                        this.$router.push({ name: 'VerifyEmail' })

                    }else{
                        this.$store.dispatch('setAuth',true);
                        this.$store.dispatch('setUser',res.data.data);
                    }

                }).catch((error)=>{
                    if(error.response.status == 401){
                        this.$store.dispatch('setAuth',false);
                    }
                })
            }
        },

        mounted(){
            if(this.$route.params.query){
                this.visit = true
            }

            this.getUser(this.$route.params.query)
        },


        components:{Skills}
    }
</script>
