<template>
    <div>
        <section id="faq" class="faq section-bg">
            <div class="container">

                <div class="section-title">

                    <h2>Frequently Asked Questions</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="accordion-list">
                    <ul>
                        <li data-aos="fade-up">
                            <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#accordion-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="accordion-list-1" class="collapse show" data-parent=".accordion-list">
                                <p>
                                    Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#accordion-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="accordion-list-2" class="collapse" data-parent=".accordion-list">
                                <p>
                                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="200">
                            <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#accordion-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">
                                <p>
                                    Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="300">
                            <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#accordion-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="accordion-list-4" class="collapse" data-parent=".accordion-list">
                                <p>
                                    Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="400">
                            <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#accordion-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="accordion-list-5" class="collapse" data-parent=".accordion-list">
                                <p>
                                    Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                                </p>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "faq",
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
    .faq .accordion-list {
        padding: 0 100px;
    }

    .faq .accordion-list ul {
        padding: 0;
        list-style: none;
    }

    .faq .accordion-list li + li {
        margin-top: 15px;
    }

    .faq .accordion-list li {
        padding: 20px;
        background: #fff;
        border-radius: 4px;
        position: relative;
    }

    .faq .accordion-list a {
        display: block;
        position: relative;
        font-family: "Poppins", sans-serif;
        font-size: 16px;
        line-height: 24px;
        font-weight: 500;
        padding: 0 30px;
        outline: none;
    }

    .faq .accordion-list .icon-help {
        font-size: 24px;
        position: absolute;
        right: 0;
        left: 20px;
        color: #b1c0df;
    }

    .faq .accordion-list .icon-show, .faq .accordion-list .icon-close {
        font-size: 24px;
        position: absolute;
        right: 0;
        top: 0;
    }

    .faq .accordion-list p {
        margin-bottom: 0;
        padding: 10px 0 0 0;
    }

    .faq .accordion-list .icon-show {
        display: none;
    }

    .faq .accordion-list a.collapsed {
        color: #343a40;
    }

    .faq .accordion-list a.collapsed:hover {
        color: #5777ba;
    }

    .faq .accordion-list a.collapsed .icon-show {
        display: inline-block;
    }

    .faq .accordion-list a.collapsed .icon-close {
        display: none;
    }

    @media (max-width: 1200px) {
        .faq .accordion-list {
            padding: 0;
        }
    }
</style>
