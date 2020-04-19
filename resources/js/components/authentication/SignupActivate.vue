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
                                    <p>Already have an account? <a href="/sign-in">Sign in</a></p>
                                </h3>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "signup_activate",
        components: {},
        data() {
            return {
                resMsg: '',
                showInfoMsg: false,
                showErrMsg: false
            };
        },
        methods: {
            activateAccount: function (token) {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                this.$http.post('sign-up/activate', {
                    token: token,
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
            var token = this.$route.params.token;
            if (token === '') {
                return;
            }
            this.activateAccount(token);
        }
    };
</script>

<style scoped>

</style>
