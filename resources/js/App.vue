<template>
    <div class="">
        <authentication></authentication>
        <navigation></navigation>
        <router-view></router-view>
        <bottom></bottom>
    </div>
</template>

<script>
    import Navigation from "./components/Navigation";
    import Bottom from "./components/Bottom";
    import SearchSection from "./components/SearchSection";
    import Authentication from "./components/Authentication";
    import FilterSection from "./components/FilterSection";

    export default {
        name: "app",
        components: {
            FilterSection,
            Navigation,
            Bottom,
            SearchSection,
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


</style>
