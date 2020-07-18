<template>
    <div>
        <welcome></welcome>
        <main id="main">
            <!--<features></features>-->
            <!--<details-section></details-section>-->
            <!--<gallery></gallery>-->
            <testimonials></testimonials>
            <pricing></pricing>
            <!--<faq></faq>-->
            <contact></contact>
        </main>
        <a href="#" class="back-to-top"><i class="fas fa-chevron-up"></i></a>
    </div>
</template>

<script>
    import Welcome from "./Welcome";
    import Features from "./Features";
    import DetailsSection from "./DetailsSection";
    import Gallery from "./Gallery";
    import Testimonials from "./Testimonials";
    import Pricing from "./Pricing";
    import Faq from "./Faq";
    import Contact from "./Contact";

    export default {
        name: "homepage",
        components: {
            Welcome,
            Features,
            DetailsSection,
            Gallery,
            Testimonials,
            Pricing,
            Faq,
            Contact,
        },
        data() {
            return {};
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>

</style>
