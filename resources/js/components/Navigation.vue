<template>
    <div>
        <header id="header" class="fixed-top">
            <div class="container d-flex">

                <div class="logo mr-auto">
                    <h1 class="text-light"><a href="index.html">Cretro.io</a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <a href="index.html"><img :src="'/images/logo.png'" alt="" class="img-fluid"></a>
                </div>

                <nav class="nav-menu d-none d-lg-block">
                    <!--not sign in navigation-->
                    <ul>
                        <li><a href="#pricing">Buy me a coffee</a></li>
                        <li><a href="#faq">F.A.Q</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li class="sign-in" v-if="!isUserAuthenticated()">
                            <a href="/sign-in" class="cretroBtn btn btn-outline-info">Sign in</a>
                        </li>
                        <li class="sign-up" v-if="!isUserAuthenticated()">
                            <a href="/sign-up" class="outlineCretroBtn btn btn-outline-info">Sign up</a>
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

                this.$http.post('logout', {}).then(function (res) {
                    console.log(res);
                    loader.hide();
                    window.location.reload();
                });
            },

            isUserAuthenticated: function () {
                return window.Laravel.is_authenticated;
            }
        },
        created: function () {
            // check authentication
            this.isUserAuthenticated(window.Laravel.is_authenticated);
        }
    };
</script>

<style scoped>

</style>
