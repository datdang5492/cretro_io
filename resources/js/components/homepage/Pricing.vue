<template>
    <div>
        <section id="pricing" class="pricing">
            <div class="container">

                <div class="section-title">
                    <h2>Buy me a coffee</h2>
                    <p>Hi guys, thank you very much for using this tiny tool. We hope this somehow help you when working with Scrum and Agile.
                    However, this tool need your support to be up and running. :)</p>
                </div>

                <div class="row no-gutters">

                    <div class="col-lg-4 box" data-aos="fade-right">
                        <h3>Simply a coffee</h3>
                        <h4>$6<span>per month</span></h4>
                        <ul>
                            <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                            <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                            <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                            <li class="na"><i class="bx bx-x"></i> <span>Pharetra massa massa ultricies</span></li>
                            <li class="na"><i class="bx bx-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
                        </ul>
                        <a href="#" class="get-started-btn">Get Started</a>
                    </div>

                    <div class="col-lg-4 box featured" data-aos="fade-up">
                        <h3>A coffee and a croissant</h3>
                        <h4>$11<span>per month</span></h4>
                        <ul>
                            <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                            <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                            <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                            <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                            <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
                        </ul>
                        <a href="#" class="get-started-btn">Get Started</a>
                    </div>

                    <div class="col-lg-4 box" data-aos="fade-left">
                        <h3>A Texas breakfast</h3>
                        <h4>$20<span>per month</span></h4>
                        <ul>
                            <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                            <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                            <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                            <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                            <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
                        </ul>
                        <a href="#" class="get-started-btn">Get Started</a>
                    </div>

                </div>

            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "pricing",
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
    .pricing .row {
        padding-top: 40px;
    }

    .pricing .box {
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0px 0px 30px rgba(73, 78, 92, 0.15);
        background: #fff;
        text-align: center;
    }

    .pricing h3 {
        font-weight: 300;
        margin-bottom: 15px;
        font-size: 28px;
    }

    .pricing h4 {
        font-size: 46px;
        color: #5777ba;
        font-weight: 400;
        font-family: "Open Sans", sans-serif;
        margin-bottom: 25px;
    }

    .pricing h4 span {
        color: #bababa;
        font-size: 18px;
        display: block;
    }

    .pricing ul {
        padding: 0;
        list-style: none;
        color: #999;
        text-align: left;
        line-height: 20px;
    }

    .pricing ul li {
        padding-bottom: 12px;
    }

    .pricing ul i {
        color: #5777ba;
        font-size: 18px;
        padding-right: 4px;
    }

    .pricing ul .na {
        color: #ccc;
    }

    .pricing ul .na i {
        color: #ccc;
    }

    .pricing ul .na span {
        text-decoration: line-through;
    }

    .pricing .get-started-btn {
        background: #47536e;
        display: inline-block;
        padding: 6px 30px;
        border-radius: 20px;
        color: #fff;
        transition: none;
        font-size: 14px;
        font-weight: 400;
        font-family: "Raleway", sans-serif;
        transition: 0.3s;
    }

    .pricing .get-started-btn:hover {
        background: #5777ba;
    }

    .pricing .featured {
        z-index: 10;
        margin: -30px -5px 0 -5px;
    }

    .pricing .featured .get-started-btn {
        background: #5777ba;
    }

    .pricing .featured .get-started-btn:hover {
        background: #748ec6;
    }

    @media (max-width: 992px) {
        .pricing .box {
            max-width: 60%;
            margin: 0 auto 30px auto;
        }
    }

    @media (max-width: 767px) {
        .pricing .box {
            max-width: 80%;
            margin: 0 auto 30px auto;
        }
    }

    @media (max-width: 420px) {
        .pricing .box {
            max-width: 100%;
            margin: 0 auto 30px auto;
        }
    }

</style>
