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
                                <p>Enter your registered email, we'll send you a link to reset your password.</p>
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

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <button class="btn btn-lg btn-block cretroBtn"
                                            v-on:click="resetPassword()">
                                        Send password reset link
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
        }
    };
    export default {
        name: "login",
        components: {},
        data() {
            return {
                email: '',
                resMsg: '',
                showInfoMsg: false,
                showErrMsg: false
            };
        },
        methods: {
            resetPassword: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        let loader = this.$loading.show({
                            container: this.$refs.formContainer,
                        });

                        this.$http.post('password/create', {
                            email: this.email,
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
                    }
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
