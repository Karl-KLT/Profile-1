<template>
    <div>
        <div>
            <div class="pt-3 font-bold">
                <h4 style="text-decoration: underline;letter-spacing: 1px">VerifyEmail</h4>
            </div>

            <div class="d-flex container-fluid mt-5 justify-content-center align-items-center w-100">
                <!-- section to verify email -->
                <div>
                    <div class="w-100 d-flex align-items-center fw-bold justify-content-center" style="letter-spacing: 0.8px">
                        <p>
                            We just send a confirmation code over to <span class="text-decoration-underline">{{ userEmail }}</span>.
                        </p>
                    </div>

                    <div class="d-flex flex-col justify-content-center">
                        <!-- <span class="w-100 d-flex align-items-center fw-bold justify-content-center" style="letter-spacing: 0.8px">Verification Code</span>
                        <input type="text" class="form-control">
                        <button type="button"></button> -->
                        <div class="d-flex justify-content-center">
                            <input type="text" class="form-control m-1" style="width: 50px;text-align: center;" v-model="Code1" maxlength="1">
                            <input type="text" class="form-control m-1" style="width: 50px;text-align: center;" v-model="Code2" maxlength="1">
                            <input type="text" class="form-control m-1" style="width: 50px;text-align: center;" v-model="Code3" maxlength="1">
                            <input type="text" class="form-control m-1" style="width: 50px;text-align: center;" v-model="Code4" maxlength="1">
                        </div>

                        <div class="d-flex justify-content-center mt-3 flex-col">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="form-control w-50 btn btn-primary" @click="verify">Verify</button>
                            </div>

                            <div class="d-flex w-100 justify-content-center">

                                <div class="btn-form mt-2 w-50">

                                    <button class="btn btn-dark btnRC" :disabled="counterForCode" @click="sendCode">{{ firstVerificationCodeHasSended ? 'Send' : 'Resend'}} code</button>

                                    <button class="btn btn-dark btnCE" @click="changeEmail">Change email</button>
                                </div>

                            </div>

                            <div class="d-flex justify-content-center  w-100 mt-2">

                                <div v-if="Error" class="alert alert-danger w-50">
                                    {{ Error }}
                                </div>

                                <div v-if="Success" class="alert alert-success w-50">
                                    {{ Success }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<style>
    @import 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css';

    .btnRC,.btnCE{
        /* font-size: 15px; */
    }

    .btn-form{
        display: flex;
        justify-content: space-between;
    }

    @media only screen and (max-width: 1150px){

        .btnRC,.btnCE{
            margin: 5px;
        }

        .btn-form{
            flex-direction: column;
        }
    }

    /* input::-webkit-outer-spin-button,input::-webkit-inner-spin-button {-webkit-appearance: none;margin: 0;}input[type=number] {-moz-appearance: textfield;} */

</style>

<script>
    import { computed } from '@vue/reactivity';

    export default {
        name: 'VerifyEmail',

        data(){
            return {
                userEmail: computed(()=>this.$store.state.User.email),

                firstVerificationCodeHasSended: true,

                counterForCode: 0,



                // ////////// inputs /////////////////
                Code1: '',
                Code2: '',
                Code3: '',
                Code4: '',
                // ////////// Code ///////////////
                Code: null,
                // //////////// Messages ////////////////
                Error:null,
                Success:null
            }
        },

        methods: {
            changeEmail(){
                this.$router.push({ name: 'Login' })
            },

            verify(){
                this.Code = this.Code1+this.Code2+this.Code3+this.Code4;
                if(this.Code1 == '' || this.Code2 == '' || this.Code3 == '' || this.Code4 == ''){
                    this.Error = 'field is empty'
                    setTimeout(() => {
                        this.Error = null
                    }, 4000);
                }else{
                    axios.post('/api/Auth/Verifications/checkVerifyCode',{
                        email:this.userEmail,
                        code:this.Code
                    })
                    .then((res)=>{
                        this.Success = res.data.message
                        setTimeout(() => {
                            this.Success = null
                            setTimeout(() => {
                                this.$router.push({ name:'Home' })
                            }, 500);
                        }, 4000);
                    })
                }
            },

            sendCode(){
                this.customCounterCode();
                // /////////////////////////

                axios.post('/api/Auth/Verifications/sendVerifyCode',{
                    email:this.userEmail,
                })
                .then((res)=>{
                    this.Success = res.data.message
                    setTimeout(() => {
                        this.Success = null
                    }, 4000);
                })

            },


            customCounterCode(){
                this.counterForCode = 15;
                var Interval = setInterval(() => {
                    this.counterForCode--
                    if(this.counterForCode == 0 || this.counterForCode <= 0){
                        clearInterval(Interval)
                        this.firstVerificationCodeHasSended = false
                    }
                }, 1000);
            }
        },
    }
</script>
