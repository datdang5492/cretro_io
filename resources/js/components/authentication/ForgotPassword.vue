<template>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-lg-8"
                 style="background-image: url('https://c1.sfdcstatic.com/content/dam/blogs/ca/Blog%20Posts/shake-up-sales-meeting-og.jpg');">
            </div>

            <div class="col-lg-4">
                <div class="row mt-7">
                    <div class="col-lg-10 offset-1">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="text-center font-weight-bold">
                                    <a href="/">Cretro.io</a>
                                </h4>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12 text-center">
                                <h3 class="font-weight-bold">
                                    Forgot password?
                                </h3>
                                <p>Enter your registered email, we will send you a link to reset your password.</p>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="email"
                                           class="form-control input_high"
                                           placeholder="Your email address"
                                           name="email"
                                           v-validate="'required|email'"
                                           v-bind:class="[errors.has('email') ? 'is-invalid' : '']"
                                           v-model="email">
                                    <div class="invalid-feedback">{{errors.first('email')}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <button class="btn btn-lg btn-block cretroBtn"
                                            v-on:click="resetPassword()">
                                        Send password reset link
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!--https://medium.com/modulr/api-rest-with-laravel-5-6-passport-authentication-reset-password-part-4-50d27455dcca-->

<script>
    const dict = {
        custom: {
            email: {
                email: "Please enter invalid email (i.e: abc@gmail.com)",
            },
        }
    };
    export default {
        name: "login",
        components: {},
        data() {
            return {
                email: '',
            };
        },
        methods: {
            resetPassword: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        let loader = this.$loading.show({
                            container: this.$refs.formContainer,
                        });

                        this.$http.post('password/reset', {
                            email: this.email,
                        }).then(function (res) {
                            loader.hide();
                            this.$router.push({name: 'sign-in'});
                        });
                        loader.hide();
                    } else {
                        this.showErrorMsg = true;
                    }
                });
            },
        },
        created: function () {
            // enable custom validation message
            this.$validator.localize('en', dict);
        }
    };
</script>

<style scoped>
    .cretroBtn {
        background: #5777ba;
        color: #fff;
        border-radius: 50px;
        margin: 0 15px;
        padding: 10px 25px;
    }

    .cretroBtn:hover {
        background: #748ec6;
        color: #fff;
    }

    .input_high {
        line-height: 3;
        height: auto;
    }
</style>
