<template>
    <div>
        <div v-if="Auth" class="row">



            <div class="w-100 d-flex flex-column justify-content-center">


                <div class="d-flex justify-content-center">
                        <div class="profile_cover_image d-flex" :style="'background-image: url('+(previewCoverImage ?? user.cover_image ?? 'https://scontent.fcai19-1.fna.fbcdn.net/v/t39.30808-6/330447781_1405703233572120_9193100482535445812_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=e3f864&_nc_ohc=ApSrzf1dLy0AX8Pp-Xp&_nc_ht=scontent.fcai19-1.fna&oh=00_AfDeWr-HAYdLXg5DTkUAmwylrsIBllX0uxqraE4GyUSIbg&oe=64387AF5')+');'">
                            <div>
                                <button @click="selectPhoto(true)" title="Edit cover photo" class="m-2 btn btn-dark d-flex align-items-center">
                                    <div class="me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </div>
                                    <span class="cover-profile-text">
                                        Edit cover photo
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                <div class="w-100 d-flex justify-content-center">
                    <div class="profile-box-main">
                        <div class="profile-box-info mx-5">

                            <div class="profile-box-image">
                                <img style="border-radius: 100%;transform: translateY(-35px);box-shadow: 0px 0px 0px 5px white;padding: 0px;background-color: white;max-height: 120px;"  width="120" :src="previewImage ?? user.image ?? 'data:image/png;base64,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'" alt="user_image"/>
                                <div @click="selectPhoto(false)" class="position-absolute" style="transform: translateY(-25px);box-shadow: 0px 0px 0px 5px white;background-color: white;border-radius: 100%;cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div style="letter-spacing: 0.8px;" class="fw-bold fs-5 profile-info-design">
                                <div class="d-flex flex-column">
                                    <span class="fs-4 profile-info-design">
                                        <div class="d-flex align-items-center">
                                            {{ user.name }}
                                            <div @click="changeUserData('name')" class="ms-2 btn btn-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg>
                                            </div>

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
                                        <div @click="changeUserData('country')" class="ms-2 btn btn-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg>
                                        </div>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div v-if="!visit" class="profile-info-design">
                            <!-- btn for update profile -->
                            <button class="btn btn-dark"  @click="updateData" :disabled="loading">Save</button>
                        </div>
                    </div>

                </div>
            </div>
            <div  class="w-100 d-flex justify-content-center">
                <div class="w-50 d-flex justify-content-center">
                    <span class="fs-6 border-top py-4">
                        {{ user.bio }}
                        <div @click="changeUserData('bio')" class="ms-2 btn btn-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </div>
                    </span>
                </div>
            </div>
            <!-- <div class="pt-3 font-bold">
                <h4 style="text-decoration: underline;letter-spacing: 1px">Profile</h4>
            </div> -->
            <!-- <div class="d-flex justify-content-center">
                <div class="profile_cover_image w-50 d-flex col-12">
                    <div>
                        <button class="m-2 btn btn-dark d-flex align-items-center">
                            <div class="me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </div>
                            <span>
                                Edit cover photo
                            </span>
                        </button>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-md-6 flex justify-content-between align-items-center">




                <div>
                    <div>
                        <img class="img-thumbnail" @click="selectPhoto" :src='previewImage ?? user.image ?? "data:image/png;base64,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"'
                         style="width: 150px;height:120px">
                    </div>
                </div>

                <div class="ms-4 w-100">

                    <div class="my-2">
                        <input type="text" v-model="user.name" placeholder="Name . . ." class="form-control">
                    </div>

                    <div class="my-2">
                        <input type="text" v-model='user.country' placeholder="country . . ." class="form-control">
                    </div>

                    <div class="my-2">
                        <input type="text" v-model="user.bio" placeholder="Bio . . ." class="form-control">
                    </div>

                </div>
            </div> -->


            <!-- <div class="col-md-6 my-3">
                <div style="user-select: none;"
                    class="d-flex p-2 firstBox container-fluid justify-content-start w-100 align-items-center">
                    <div class="w-100 py-2" id="scroll_skills"
                        style="height: auto;max-height: 245px; overflow: auto;">
                        <Skills @message="eventMessage($event)"></Skills>
                    </div>
                </div>
            </div> -->

        </div>

        <!-- {{-- <div>
        <livewire:accounts />
    </div> --}} -->



        <!-- <div class="my-3">

            <input type="text" v-model="user.message" placeholder="UR Message . . ." class="form-control">

        </div> -->

        <div v-if="messageSuccessfully">
            <div class="alert alert-success text-dark fw-bold">{{ messageSuccessfully }}</div>
        </div>

        <div v-if="messageFailed">
            <div class="alert alert-danger text-dark fw-bold">
                <ul v-for="messages in messageFailed">
                    <li>{{ messages[0] }}</li>
                </ul>
            </div>
        </div>

        <!-- <div class="text-end mb-2">

            <button @click="updateData" class="btn btn-outline-dark" type="submit" wire:click='$emit("Save")'>
                <div v-if="loading">
                    <div class="spinner-border"></div>
                </div>
                <div v-else>
                    Save
                </div>
            </button>

        </div> -->
        <!-- <script>
        $(document).ready(function(){
            CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                toolbar: {
                    items: [
                        'undo','selectAll','redo','|',
                        'bold','italic','underline','subscript','superscript','|',
                        'outdent','indent','|',
                        'findAndReplace','fontSize','fontFamily','fontColor','link','insertImage'
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                placeholder: 'Message . . .',
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22, 25 ],
                    supportAllValues: true
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                htmlEmbed: {
                    showPreviews: true
                },
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                //  ex : '@html'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                removePlugins: [
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType'
                ]
            }).then((editor)=>{
                editor.model.document.on('change',function(){
                })
            });
        })
    </script> -->
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
    .profile-box-image{
        /* d-flex justify-content-end */
        display: flex;
        justify-content: end;
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
        .cover-profile-text{
            display: none;
        }
    }

</style>
<script>
    import { computed } from '@vue/reactivity'
    import axios from 'axios'
    import Skills from './Skills.vue'
    import Swal from 'sweetalert2'
    export default {
        name: 'Profile',
        data() {
            return {
                user:computed(()=>this.$store.state.User),
                Auth:computed(()=>this.$store.state.authenticated),
                loading:false,

                previewImage:null,
                previewCoverImage:null,

                messageSuccessfully:null,
                messageFailed:null,
            }
        },

        methods: {

            changeUserData(column_name = null){
                Swal.fire({
                    title:`change ur ${column_name}`,
                    background: 'black',
                    input:'text',
                    color:'white',
                    inputAttributes:{class:'form-control'},
                    inputPlaceholder:column_name,
                }).then((res)=>{
                    if(res.isConfirmed){
                        var value = res.value

                        switch (column_name){
                            case 'name':
                                this.user.name = value
                                break
                            case 'country':
                                this.user.country = value
                                break
                            case 'bio':
                                this.user.bio = value
                                break
                        }

                    }
                })
            },

            eventMessage(event){
                if(event.status == 200){
                    this.messageSuccessfully = event.message
                }else{
                    this.messageFailed = event.error
                }
                setTimeout(() => {
                    this.removeMessages()
                }, 5000);
            },

            updateData(){
                this.loading = true
                axios.post('/api/Auth/updateOrCreate',this.user,{
                    headers:{
                        'Content-Type':'multipart/form-data',
                    }
                })
                .then((res)=>{
                    this.removeMessages()
                    this.messageSuccessfully = res.data.message
                    setTimeout(() => {
                        this.messageSuccessfully = null
                    }, 5000);
                    this.loading = false
                })
                .catch((err)=>{
                    this.removeMessages()
                    this.messageFailed = err.response.data.error
                    setTimeout(() => {
                        this.messageFailed = null
                    }, 5000);
                    this.loading = false
                })
            },

            selectPhoto(cover = false){
                var element = document.createElement('input')
                element.type = 'file'
                element.accept = 'image/,.jpg,.png,.jpeg'
                element.click()
                element.onchange = (self)=>{
                    var file = self.target.files[0]
                    if(cover){
                        this.previewCoverImage = URL.createObjectURL(file)
                        this.user.cover_image = file
                    }else{
                        this.previewImage = URL.createObjectURL(file)
                        this.user.image = file
                    }
                }
                // var reader = new FileReader();
                // reader.onload = function (e) {
                //     document.getElementById('img').src = e.target.result
                // }
                // reader.readAsDataURL(input.files[0]);
            },

            removeMessages(){
                this.messageSuccessfully = null
                this.messageFailed = null
            }
        },

        mounted(){
            if(!this.Auth){
                return this.$router.push({ name:'Home' })
            }
        },


        components:{Skills},

    }
</script>
