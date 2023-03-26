<template>
    <div>
        <div class="row rounded">
            <div class="pt-3 font-bold">
                <h4 style="text-decoration: underline;letter-spacing: 1px">Profile</h4>
            </div>
            <div class="col-md-6 flex justify-content-between align-items-center">

                <div>
                    <div>

                        <img class="img-thumbnail" @click="selectPhoto" :src='previewImage ?? user.image ?? "data:image/png;base64,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"'
                         style="width: 150px;height:120px">
                    </div>


                    <!-- <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('img').src = e.target.result
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    document.addEventListener('DOMContentLoaded',function(){
                        document.getElementById('select_img').onclick = () => {
                            var file = document.getElementById('fileInput');
                            file.click();
                            file.onchange = (event) => {
                                readURL(event.target);
                                document.getElementById('subimage').click()
                            }
                        }
                    })
                </script> -->
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
            </div>


            <div class="col-md-6 my-3">
                <div style="user-select: none;"
                    class="d-flex p-2 firstBox container-fluid justify-content-start w-100 align-items-center">
                    <div class="w-100 @auth py-2 @endauth" id="scroll_skills"
                        style="height: auto;max-height: 245px; overflow: auto;">

                        <!-- <livewire:skills /> -->
                        <Skills @message="eventMessage($event)"></Skills>
                    </div>
                </div>
            </div>

        </div>

        <!-- {{-- <div>
        <livewire:accounts />
    </div> --}} -->



        <div class="my-3">

            <input type="text" v-model="user.message" placeholder="UR Message . . ." class="form-control">
            <!-- {{-- <textarea id="editor" wire:model='Message'>{{ $Message }}</textarea> --}} -->

        </div>

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

        <div class="text-end mb-2">

            <button @click="updateData" class="btn btn-outline-dark" type="submit" wire:click='$emit("Save")'>
                <div v-if="loading">
                    <div class="spinner-border"></div>
                </div>
                <div v-else>
                    Save
                </div>
            </button>

        </div>
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


<script>
    import { computed } from '@vue/reactivity'
    import axios from 'axios'
    import Skills from './Skills.vue'
    export default {
        name: 'Profile',
        data() {
            return {
                user:computed(()=>this.$store.state.User),
                loading:false,

                previewImage:null,

                messageSuccessfully:null,
                messageFailed:null,
            }
        },

        methods: {
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

            selectPhoto(){
                var element = document.createElement('input')
                element.type = 'file'
                element.accept = 'image/,.jpg,.png,.jpeg'
                element.click()
                element.onchange = (self)=>{
                    var file = self.target.files[0]
                    this.previewImage = URL.createObjectURL(file)
                    this.user.image = file
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
        components:{Skills},

    }
</script>
