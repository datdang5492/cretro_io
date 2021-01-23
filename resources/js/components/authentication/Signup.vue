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
                                    Become a member
                                </h3>
                                <p>Already have an account? <a href="/sign-in">Sign in</a></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <b-alert variant="primary"
                                         dismissible
                                         fade
                                         :show="showInfoMsg"
                                         @dismissed="showInfoMsg=false">
                                    {{resMsg}}
                                </b-alert>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <b-alert variant="danger"
                                         dismissible
                                         fade
                                         :show="showErrMsg"
                                         @dismissed="showErrMsg=false">
                                    {{resMsg}}
                                </b-alert>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="email" class="form-control input_high"
                                           name="email"
                                           v-validate="'required|email'"
                                           v-bind:class="[errors.has('email') ? 'is-invalid' : '']"
                                           placeholder="Your email address"
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
                                    <button v-on:click="handleSignUp()"
                                            class="btn btn-lg btn-block outlineCretroBtn">
                                        Sign up
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

<script>
    const dict = {
        custom: {
            email: {
                email: "Please enter valid email (i.e: abc@gmail.com)",
            },
        }
    };
    export default {
        name: "signup",
        components: {},
        data() {
            return {
                email: '',
                password: '',
                resMsg: '',
                showInfoMsg: false,
                showErrMsg: false
            };
        },
        methods: {
            handleSignUp: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === false) {
                        return;
                    }

                    let loader = this.$loading.show({
                        container: this.$refs.formContainer,
                    });

                    this.$http.post('register', {
                        email: this.email,
                        password: this.password
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
            // enable custom validation message
            this.$validator.localize('en', dict);
        }
    };
</script>

<style scoped>
    .input_high {
        line-height: 3;
        height: auto;
    }

    .outlineCretroBtn {
        border-color: #5777ba;
        color: #47536e;
        border-radius: 50px;
        padding: 10px 25px;
    }

    .outlineCretroBtn:hover {
        background: #748ec6;
        color: #fff;
    }
</style>
