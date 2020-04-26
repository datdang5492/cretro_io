<template>
    <div class="">
        <router-view name="navigation"></router-view>
        <router-view></router-view>
        <router-view name="bottom"></router-view>
    </div>
</template>

<script>
    import Navigation from "./components/Navigation";
    import Bottom from "./components/Bottom";
    import Authentication from "./components/Authentication";

    export default {
        name: "app",
        components: {
            Navigation,
            Bottom,
            Authentication
        },
        data() {
            return {};
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style>
    .min-height-normal {
        min-height: 1000px;
    }

    .mt-6, .my-6 {
        margin-top: 4rem !important;
    }

    .mt-7, .my-7 {
        margin-top: 5rem !important;
    }

    .mt-8, .my-8 {
        margin-top: 6rem !important;
    }

    .text-huge {
        font-size: 20px !important;
    }

    .text-big {
        font-size: 18px !important
    }

    .text-medium {
        font-size: 16px !important
    }

    .text-small {
        font-size: 14px !important
    }

    .text-tiny {
        font-size: 12px !important
    }


</style>
