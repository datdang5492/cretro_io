<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 login100-more"
                 style="background-image: url('https://c1.sfdcstatic.com/content/dam/blogs/ca/Blog%20Posts/shake-up-sales-meeting-og.jpg');">
            </div>

            <div class="col-lg-4">
                <div class="row mt-7">
                    <div class="col-lg-10 offset-1">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="text-center font-weight-bold">
                                    Cretro.io
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

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="text" class="form-control input_high" placeholder="Your email address">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="text" class="form-control input_high" placeholder="Your password">
                                </div>
                            </div>
                        </div>

                        <!--<div class="row mt-5">-->
                            <!--<div class="col-lg-6">-->
                                <!--<div class="custom-control custom-checkbox">-->
                                    <!--<input type="checkbox" class="custom-control-input" id="customCheck1" checked="">-->
                                    <!--<label class="custom-control-label" for="customCheck1">Remember me</label>-->
                                <!--</div>-->
                            <!--</div>-->
                            <!--<div class="col-lg-6 text-right">-->
                                <!--<a href="#">-->
                                    <!--Forgot Password?-->
                                <!--</a>-->
                            <!--</div>-->
                        <!--</div>-->

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-block outlineCretroBtn">Sign up</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "signup",
        components: {},
        data() {
            return {
                guest: {
                    email: '',
                    name: '',
                    password: '',
                    password_confirmation: ''
                },

                user: {
                    email: '',
                    password: '',
                    remember_me: false
                }
            };
        },
        methods: {
            handleLogin: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                this.$http.post('login', {
                    email: this.user.email,
                    password: this.user.password,
                    remember_me: this.user.remember_me
                }).then(function (data) {
                    loader.hide();
                    window.location.reload();
                });
            },

            handleSignUp: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                this.$http.post('register', {
                    email: this.guest.email,
                    name: this.guest.name,
                    password: this.guest.password
                }).then(function (data) {
                    loader.hide();
                    window.location.reload();
                });
            }
        },
        created: function () {
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
