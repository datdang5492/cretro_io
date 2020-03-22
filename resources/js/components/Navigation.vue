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
                    <ul>
                        <li class="active"><a href="#header">Home</a></li>
                        <li><a href="#features">App Features</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#faq">F.A.Q</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="#" class="btn btn-outline-info">Sign in</a></li>
                        <li class="get-started"><a href="#features">Sign up</a></li>
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

                this.$http.post('logout', {}).then(function (data) {
                    loader.hide();
                    window.location.reload();
                });
            },
        },
        created: function () {
        }
    };
</script>

<style scoped>

</style>
