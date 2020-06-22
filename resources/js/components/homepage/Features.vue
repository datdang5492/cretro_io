<template>
    <div>
        <section id="features" class="features">
            <div class="container">

                <div class="section-title">
                    <h2>App Features</h2>
                    <!--<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>-->
                </div>

                <div class="row no-gutters">
                    <div class="col-xl-7 d-flex align-items-stretch order-2 order-lg-1">
                        <div class="content d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-md-6 icon-box" data-aos="fade-up">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Easy doing retrospective meeting remotely</h4>
                                    <p>Conduct and join the retrospective meeting anywhere, anytime.</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Scrum-focus meeting formats</h4>
                                    <p>Don't let your retro be boring. Choose between various of scrum-focus meeting formats to review your sprint performance.</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                    <i class="bx bx-images"></i>
                                    <h4>No need to buy post-it</h4>
                                    <p>Reduce consuming paper can save the environment :)</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                    <i class="bx bx-shield"></i>
                                    <h4>Data protection</h4>
                                    <p>Your data is safe with us.</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                    <i class="bx bx-atom"></i>
                                    <h4>Learn from the community</h4>
                                    <p>Get advised, see how other teams doing, practice Scrum correctly.</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                                    <i class="bx bx-id-card"></i>
                                    <h4>Data management</h4>
                                    <p>Manage you meeting results after each sprint to see your team improvement.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="image col-xl-5 d-flex align-items-stretch justify-content-center order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                        <img :src="'/images/features.svg'" class="img-fluid" alt="">
                    </div>
                </div>

            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "features",
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
    .features .content {
        padding: 30px 0;
    }

    .features .content .icon-box {
        margin-top: 25px;
    }

    .features .content .icon-box h4 {
        font-size: 20px;
        font-weight: 700;
        margin: 5px 0 10px 60px;
    }

    .features .content .icon-box i {
        font-size: 48px;
        float: left;
        color: #5777ba;
    }

    .features .content .icon-box p {
        font-size: 15px;
        color: #979aa1;
        margin-left: 60px;
    }

    @media (max-width: 991px) {
        .features .image {
            text-align: center;
        }
        .features .image img {
            max-width: 80%;
        }
    }

    @media (max-width: 667px) {
        .features .image img {
            max-width: 100%;
        }
    }

</style>
