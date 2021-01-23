<template>
    <div>
        <header id="header" class="fixed-top">
            <div class="container d-flex">

                <div class="logo mr-auto">
                    <h1 class="text-light"><a href="/">Cretro.io</a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <a href="index.html"><img :src="'/images/logo.png'" alt="" class="img-fluid"></a>
                </div>

                <nav class="nav-menu d-none d-lg-block">
                    <!--not sign in navigation-->
                    <ul>
                        <li><a href="#pricing">Buy me a coffee</a></li>
                        <li class="sign-in" v-if="!isUserAuthenticated()">
                            <a href="/sign-in" class="cretroBtn btn btn-outline-info">Sign in</a>
                        </li>
                        <li class="sign-up" v-if="!isUserAuthenticated()">
                            <a href="/sign-up" class="outlineCretroBtn btn btn-outline-info">Sign up</a>
                        </li>

                        <li v-if="isUserAuthenticated()">
                            <a href="my-profile">My Profile</a>
                        </li>

                        <li v-if="isUserAuthenticated()">
                            <a href="#" @click="handleSignOut()">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    </div>
</template>

<script>
    export default {
        name: "navigation",
        components: {},
        data() {
            return {
                selected_language: null,
                languages: [
                    {value: null, text: 'Languages'},
                    {value: 'en', text: 'English'},
                    {value: 'de', text: 'Deutsch'},
                    {value: 'vi', text: 'Tiếng Việt'},
                ]
            };
        },
        methods: {
            handleSignOut: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                this.$http.post('logout').then(function (res) {
                    if (res.ok == true) {
                        loader.hide();
                        window.location.reload();
                    }
                }).catch(function (res) {
                    console.log(res);
                });
            },

            isUserAuthenticated: function () {
                return window.Laravel.is_authenticated;
            }
        },
        created: function () {

        }
    };
</script>

<style scoped>

</style>
