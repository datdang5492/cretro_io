<template>
    <div>
        <section id="gallery" class="gallery">
            <div class="container">

                <div class="section-title">
                    <h2>Gallery</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="owl-carousel gallery-carousel" data-aos="fade-up">
                    <a href="/images/gallery/gallery_1.png" class="venobox" data-gall="gallery-carousel"><img :src="'/images/gallery/gallery_1.png'" alt=""></a>
                    <a href="/images/gallery/gallery_2.png" class="venobox" data-gall="gallery-carousel"><img :src="'/images/gallery/gallery_2.png'" alt=""></a>
                    <a href="/images/gallery/gallery_3.png" class="venobox" data-gall="gallery-carousel"><img :src="'/images/gallery/gallery_3.png'" alt=""></a>
                    <a href="/images/gallery/gallery_4.png" class="venobox" data-gall="gallery-carousel"><img :src="'/images/gallery/gallery_4.png'" alt=""></a>
                    <a href="/images/gallery/gallery_5.png" class="venobox" data-gall="gallery-carousel"><img :src="'/images/gallery/gallery_5.png'" alt=""></a>
                </div>

            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "gallery",
        components: {
        },
        data() {
            return {
            };
        },
        methods: {
        },
        created: function () {
        }
    };
</script>

<style scoped>
    .gallery {
        overflow: hidden;
    }

    .gallery .owl-nav, .gallery .owl-dots {
        margin-top: 40px;
        text-align: center;
    }

    .gallery .owl-item {
        transition: 0.3s ease-in-out;
    }

    .gallery .owl-dot {
        display: inline-block;
        margin: 0 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #eff2f8 !important;
    }

    .gallery .owl-dot.active {
        background-color: #5777ba !important;
    }

    .gallery .gallery-carousel {
        padding-top: 30px;
    }

    .gallery .gallery-carousel .owl-stage-outer {
        overflow: visible;
    }

    @media (min-width: 992px) {
        .gallery .gallery-carousel .center {
            border: 6px solid #5777ba;
            padding: 4px;
            background: #fff;
            z-index: 1;
            transform: scale(1.2);
            margin-top: 10px;
            border-radius: 25px;
        }
    }

</style>
