<template>
    <div id="container_Skills">
        <div>


            <div v-if="User.Skills">
                <div v-for="skill in User.Skills">
                    <div class="Box container-fluid navbar mt-2" :id="skill.id">

                        <div style="letter-spacing: 0.8px;font-weight: bold;">
                            {{ skill.name  }}
                        </div>
                        <div class="flex text-secondary" style="font-weight: bold;">
                            <span>
                                <span>{{ skill.count }}</span>%
                            </span>
                            <!-- delete if skill for owner -->

                            <span class="ms-2">
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
            <!-- @forelse ($skills as $skill)

                <div class="Box container-fluid navbar mt-2" id="{{ $skill->Name }}">

                    <div style="letter-spacing: 0.8px;font-weight: bold;">
                        {{ Str::upper($skill->Name) }}
                    </div>
                    <div class="flex text-secondary" style="font-weight: bold;"><span id="{{ $skill->Name }}Num">
                        <span>
                            {{ $skill->MaxNum }}</span>%
                        </span>
                        @if (!$visitor)
                            @auth
                                <span class="ms-2">
                                    <form wire:submit.prevent="remove({{ $skill->id }})">
                                        <button type="submit" style="outline: none" class="hover:text-red-400"><i class='bx bxs-message-square-x'></i></button>
                                    </form>
                                </span>
                            @endauth
                        @endif
                    </div>
                    <div style="display: flex;width: 100%;height: 10px;">
                        <div class="badge bg-secondary w-100 p-0">
                            <div class="badge" id="{{ $skill->Name }}Num_bar" style="float:left;height: 10px;background-color: #A2CABD;width:{{$skill->MaxNum}}%;">&nbsp;</div>
                        </div>
                    </div>
                </div>

            @empty -->
            <!-- @endforelse -->
        </div>



        <div class="w-100 mt-2  container-fluid">
            <form @submit.prevent="save" class="flex">

                <div class="w-100">
                    <input type="text" placeholder="Name" :disabled="loading" v-model='name'  maxlength="12" class="form-control" id="">
                </div>

                <div class="w-25 mx-2">
                    <input type="text" maxlength="3" :disabled="loading" placeholder="MaxNum" v-model='count' class="form-control" id="">
                </div>

                <div>
                    <button v-if="loading" type="submit" :disabled="loading" class="btn btn-dark text-gray-900">
                        <div class="spinner-border"></div>
                    </button>
                    <button v-else type="submit" :disabled="loading" class="btn btn-dark text-gray-900">Add</button>
                </div>
            </form>
        </div>
        <!-- @if (!$visitor)
            @auth

                <div class="w-100 mt-2  container-fluid">





                    <form wire:submit.prevent='$emit("save")' class="flex">


                        <div class="w-100">
                            <input type="text" placeholder="Name" wire:model.lazy='Name'  maxlength="12" class="form-control" id="">
                        </div>



                        <div class="w-25 mx-2">
                            <input type="text" maxlength="3" placeholder="MaxNum" wire:model.lazy='MaxNum' class="form-control" id="">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-dark text-gray-900">Add</button>
                        </div>
                    </form>

                    @if($errors->any())
                        <div class="flex my-4 justify-content-between w-100">

                            @error('Name')
                                <div>
                                    <span class="error alert alert-danger">{{ $message }}</span>
                                </div>
                            @enderror


                            @error('MaxNum')
                                <div>
                                    <span class="error alert alert-danger">{{ $message }}</span>
                                </div>
                            @enderror

                        </div>
                    @endif


                </div>
            @endauth
        @endif -->
    </div>
</template>
<style>.Box{width: 100%;height: auto;background-color: #CDE4DD;border-radius: 10px; }</style>


<script>
    import { computed } from '@vue/reactivity'
    import axios from 'axios'
    export default {
        name:'Skills',

        data(){
            return {
                User:computed(()=>this.$store.state.User),

                name:null,
                count:null,

                loading:false,

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

            save(){
                this.loading = true;
                axios.post('api/Skills/updateOrCreate',{
                    name:this.name,
                    count:this.count
                },{headers:{'Authorization': 'bearer '+this.$store.state.token}}).then((res)=>{
                    if(!this.User.Skills){
                        this.User.Skills = [];
                    }
                    this.User.Skills.push(res.data.data)
                    // restore values
                    this.$emit('message',res.data)
                    this.name = null;
                    this.count = null;
                    this.loading = false;
                }).catch((err)=>{
                    this.$emit('message',err.response.data)
                    this.loading = false
                })
            }
        },

    }
</script>
