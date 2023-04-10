<template>
    <div id="container_Skills">
        <div>
            <div v-if="User.Skills">
                <div v-for="skill in User.Skills">
                    <div class="Box container-fluid navbar p-3" :id="skill.id">

                        <div style="letter-spacing: 0.8px;font-weight: bold;">
                            {{ skill.name.substr(0,1).toUpperCase() + skill.name.substr(1,Infinity) }}
                        </div>
                        <div class="flex text-secondary" style="font-weight: bold;">
                            <span>
                                <span>{{ skill.count }}</span>%
                            </span>
                            <!-- delete if skill for owner -->

                            <span v-if="!visit" class="ms-2">
                                <div @click="remove(skill.id)">
                                    <button type="submit" style="outline: none" class="hover:text-red-400"><i class='bx bxs-message-square-x'></i></button>
                                </div>
                            </span>
                        </div>

                        <div style="display: flex;width: 100%;height: 10px;">
                            <div class="badge bg-secondary w-100 p-0">
                                <div class="badge" :style="'float:left;height: 10px;background-color: #A2CABD;width:'+skill.count+'%'">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div v-else>
                <div class="Box container-fluid navbar mt-2">
                    <div style="letter-spacing: 0.8px;font-weight: bold;letter-spacing: 1px" class="flex justify-center w-100 underline">
                        without any skills
                    </div>
                </div>
            </div>
        </div>



        <div v-if="!visit" class="w-100 mt-2  container-fluid">
            <button type="button" @click="saveTemplate" :disabled="loading" class="btn btn-dark w-100">Add</button>
        </div>
    </div>
</template>
<style>.Box{width: 100%;height: auto;background-color: #CDE4DD;border-radius: 10px; }</style>


<script>
    import { computed } from '@vue/reactivity'
    import Swal from 'sweetalert2'
    import axios from 'axios'
    export default {
        name:'Skills',

        data(){
            return {
                User:computed(()=>this.$store.state.User),

                name:null,
                count:null,

                loading: false,

                visit:false

            }
        },

        methods: {

            remove(id){
                axios.post('api/Skills/destroy',{
                    id:id
                },{headers:{'Authorization': 'bearer '+this.$store.state.token}}).then((res)=>{
                    this.User.Skills = res.data.data
                    this.$emit('message',res.data)
                }).catch((err)=>{
                    this.$emit('message',err.response.data)
                })
            },

            saveTemplate(){
                this.loading = true;

                Swal.fire({
                    title:'add new skill',

                    html:'<input id="name" type="text" placeholder="name" class="swal2-input">'+
                    '<input id="expRatio" type="text" placeholder="expRatio" class="swal2-input">'+'<div id="errors"></div>',

                    showConfirmButton:true,
                    confirmButtonText:'save',

                    showDenyButton:true,
                    denyButtonText:'Close',

                    preConfirm(){
                        var name = document.getElementById('name').value
                        var expRatio = document.getElementById('expRatio').value

                        if(name != '' && expRatio != ''){
                            return {
                                name:name,
                                count:expRatio
                            }
                        }else{
                            document.getElementById('errors').innerHTML = '<div class="alert mt-3 alert-danger">fields is empty</div>'
                            return false;
                        }
                    },
                    preDeny(){return {name:null,count:null}}
                })
                .then((swal)=>{
                    if(swal.value.name && swal.value.count){
                        axios.post('api/Skills/updateOrCreate',{
                            name:swal.value.name.toLowerCase(),
                            count:swal.value.count
                        },{headers:{'Authorization': 'bearer '+this.$store.state.token}}).then((res)=>{

                            if(!this.User.Skills){
                                this.User.Skills = [];
                            }

                            this.User.Skills.push(res.data.data)

                            this.$emit('message',res.data)
                            this.name = null;
                            this.count = null;
                            this.loading = false;
                        }).catch((err)=>{
                            this.$emit('message',err.response.data)
                            this.loading = false
                        })
                    }else{
                        this.loading = false
                    }

                })


            }
        },
        beforeMount(){
            if(this.$route.params.user_code){
                this.visit = true
            }
        }
    }
</script>
