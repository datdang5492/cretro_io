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
                                    Login to continue
                                </h3>
                                <p>Don't have an account yet? <a href="/sign-up">Sign up</a></p>
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
                            <div class="col-lg-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="customCheck1"
                                           name="remember_me"
                                           v-model="remember_me">
                                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="/forgot-password">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <button v-on:click="handleLogin()" class="btn btn-lg btn-block cretroBtn">Sign in
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--<div class="row text-center mt-2">-->
                        <!--<div class="col-lg-12">-->
                        <!--<span class="">or sign up using</span>-->
                        <!--</div>-->
                        <!--</div>-->
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
                password: '',
                remember_me: false,
                showErrorMsg: false,
                emailError: ''
            };
        },
        methods: {
            handleLogin: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        let loader = this.$loading.show({
                            container: this.$refs.formContainer,
                        });

                        this.$http.post('login', {
                            email: this.email,
                            password: this.password,
                            remember_me: this.remember_me
                        }).then(function (res) {
                            loader.hide();
                            this.$router.push({name: 'homepage'});
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
