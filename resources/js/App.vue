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

    export default {
        name: "app",
        components: {
            Navigation,
            Bottom,
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

    .main_content {
        width: 100%;
        position: relative;
        overflow: hidden;
        padding: 140px 0 100px 0;
    }


    .cretro_btn {
        font-family: "Raleway", sans-serif;
        font-weight: 500;
        font-size: 15px;
        display: inline-block;
        padding: 8px 24px 10px 46px;
        border-radius: 3px;
        transition: 0.5s;
        color: #fff;
        background: #47536e;
        position: relative;
    }

    .cretro_btn:hover {
        background: #5777ba;
        color: #fff;
    }

    .cretro_btn i {
        font-size: 20px;
        position: absolute;
        left: 18px;
        top: 8.5px;
    }

    .cretro_btn_normal {
        font-family: "Raleway", sans-serif;
        font-weight: 500;
        font-size: 15px;
        display: inline-block;
        padding: 8px 24px 10px 24px;
        border-radius: 3px;
        transition: 0.5s;
        color: #fff;
        background: #5777ba;
        position: relative;
    }

    .cretro_btn_normal:hover {
        background: #5777ba;
        color: #fff;
    }

    .download-btn + .download-btn {
        margin-left: 20px;
    }


</style>
