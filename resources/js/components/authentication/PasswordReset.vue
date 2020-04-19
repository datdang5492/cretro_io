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
                                <h3 class="font-weight-bold">Reset Password</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <b-alert
                                    variant="primary"
                                    dismissible
                                    fade
                                    :show="showInfoMsg"
                                    @dismissed="showInfoMsg=false"
                                >
                                    {{resMsg}}
                                </b-alert>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <b-alert
                                    variant="danger"
                                    dismissible
                                    fade
                                    :show="showErrMsg"
                                    @dismissed="showErrMsg=false"
                                >
                                    {{resMsg}}
                                </b-alert>
                            </div>
                        </div>

                        <div class="row mt-4">
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
                                    <input type="password" class="form-control input_high"
                                           placeholder="Your password"
                                           name="password"
                                           ref="password"
                                           v-validate="'required|alpha_num|min:6'"
                                           v-bind:class="[errors.has('password') ? 'is-invalid' : '']"
                                           v-model="password">
                                    <div class="invalid-feedback">{{errors.first('password')}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="password" class="form-control input_high"
                                           placeholder="Confirm your password"
                                           name="password_confirmation"
                                           v-validate="'required|alpha_num|min:6|confirmed:password'"
                                           v-bind:class="[errors.has('password_confirmation') ? 'is-invalid' : '']"
                                           v-model="password_confirmation">
                                    <div class="invalid-feedback">{{errors.first('password_confirmation')}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <button class="btn btn-lg btn-block cretroBtn"
                                            v-on:click="resetPassword()">
                                        Reset password
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12 text-right">
                                <a href="/sign-in">Back to Sign-in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const dict = {
        custom: {
            email: {
                email: "Please enter valid email (i.e: abc@gmail.com)",
            },
            password_confirmation: {
                confirmed: "Password confirmation does not match.",
                required: "The password confirmation is required.",
                min: "The password field must be at least 6 characters.",
                alpha_num: "The password field may only contain alpha-numeric characters."
            },
        }
    };
    export default {
        name: "password_reset",
        components: {},
        data() {
            return {
                activate_token: '',
                email: '',
                password: '',
                password_confirmation: '',
                resMsg: '',
                showInfoMsg: false,
                showErrMsg: false
            };
        },
        methods: {

            resetPassword: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === false) {
                        return;
                    }

                    let loader = this.$loading.show({
                        container: this.$refs.formContainer,
                    });
                    this.$http.post('password/reset', {
                        token: this.activate_token,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    }).then(function (res) {
                        if (res.ok) {
                            this.showInfo();
                        } else {
                            this.showError();
                        }
                        this.resMsg = res.body.message;
                        loader.hide();
                    }).catch(function (res) {
                        this.showError();
                        this.resMsg = res.body.message;
                        loader.hide();
                    });
                });
            },

            showError: function () {
                this.showErrMsg = true;
                this.showInfoMsg = false;
            },

            showInfo: function () {
                this.showErrMsg = false;
                this.showInfoMsg = true;
            },
        },
        created: function () {
            this.activate_token = this.$route.params.token;
            if (this.activate_token === '') {
                return;
            }

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
