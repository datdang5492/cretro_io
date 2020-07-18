<template>
    <div>
        <footer id="footer">
            <!--<div class="footer-top">-->
                <!--<div class="container">-->
                    <!--<div class="row">-->

                        <!--<div class="col-lg-3 col-md-6 footer-contact" data-aos="fade-up">-->
                            <!--<h3>Cretro IO</h3>-->
                            <!--<h6>Okela AG</h6>-->
                            <!--<p>-->
                                <!--Kazbockstr. 21<br>-->
                                <!--86157 Augsburg<br>-->
                                <!--Germany <br><br>-->
                                <!--<strong>Phone:</strong> (+49) 1575 479 2720<br>-->
                                <!--<strong>Email:</strong> cretro@gmail.com<br>-->
                            <!--</p>-->
                        <!--</div>-->

                        <!--<div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="100">-->
                            <!--<h4>Useful Links</h4>-->
                            <!--<ul>-->
                                <!--<li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>-->
                                <!--<li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>-->
                                <!--<li><i class="bx bx-chevron-right"></i> <a href="#">Career</a></li>-->
                                <!--<li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>-->
                                <!--<li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>-->
                            <!--</ul>-->
                        <!--</div>-->

                        <!--<div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="200">-->
                            <!--<h4>Our Services</h4>-->
                            <!--<ul>-->
                                <!--<li><i class="bx bx-chevron-right"></i> <a href="#">Okela Money Transfer</a></li>-->
                                <!--<li><i class="bx bx-chevron-right"></i> <a href="#">Okela Ship</a></li>-->
                            <!--</ul>-->
                        <!--</div>-->

                        <!--<div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="300">-->
                            <!--<h4>Our Social Networks</h4>-->
                            <!--<div class="social-links mt-3">-->
                                <!--<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>-->
                                <!--<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>-->
                                <!--<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>-->
                            <!--</div>-->
                        <!--</div>-->

                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->

            <div class="container py-4">
                <div class="copyright">
                    &copy; Copyright <strong><span>Cretro IO</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/ -->
                    <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
                </div>
            </div>
        </footer><
    </div>
</template>

<script>
    export default {
        name: "bottom",
        components: {},
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
    /*--------------------------------------------------------------
    # Footer
    --------------------------------------------------------------*/
    #footer {
        background: #fff;
        padding: 0 0 30px 0;
        color: #47536e;
        font-size: 14px;
        background: #eff2f8;
    }

    #footer .footer-newsletter {
        padding: 50px 0;
        background: #eff2f8;
        text-align: center;
        font-size: 15px;
    }

    #footer .footer-newsletter h4 {
        font-size: 24px;
        margin: 0 0 20px 0;
        padding: 0;
        line-height: 1;
        font-weight: 600;
        color: #47536e;
    }

    #footer .footer-newsletter form {
        margin-top: 30px;
        background: #fff;
        padding: 6px 10px;
        position: relative;
        border-radius: 50px;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
        text-align: left;
    }

    #footer .footer-newsletter form input[type="email"] {
        border: 0;
        padding: 4px 8px;
        width: calc(100% - 100px);
    }

    #footer .footer-newsletter form input[type="submit"] {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        border: 0;
        background: none;
        font-size: 16px;
        padding: 0 20px;
        background: #5777ba;
        color: #fff;
        transition: 0.3s;
        border-radius: 50px;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
    }

    #footer .footer-newsletter form input[type="submit"]:hover {
        background: #415f9d;
    }

    #footer .footer-top {
        padding: 60px 0 30px 0;
        background: #fff;
    }

    #footer .footer-top .footer-contact {
        margin-bottom: 30px;
    }

    #footer .footer-top .footer-contact h4 {
        font-size: 22px;
        margin: 0 0 30px 0;
        padding: 2px 0 2px 0;
        line-height: 1;
        font-weight: 700;
        color: #47536e;
    }

    #footer .footer-top .footer-contact p {
        font-size: 14px;
        line-height: 24px;
        margin-bottom: 0;
        font-family: "Raleway", sans-serif;
        color: #8a8c95;
    }

    #footer .footer-top h4 {
        font-size: 16px;
        font-weight: bold;
        color: #47536e;
        position: relative;
        padding-bottom: 12px;
    }

    #footer .footer-top .footer-links {
        margin-bottom: 30px;
    }

    #footer .footer-top .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #footer .footer-top .footer-links ul i {
        padding-right: 2px;
        color: #9fb2d8;
        font-size: 18px;
        line-height: 1;
    }

    #footer .footer-top .footer-links ul li {
        padding: 10px 0;
        display: flex;
        align-items: center;
    }

    #footer .footer-top .footer-links ul li:first-child {
        padding-top: 0;
    }

    #footer .footer-top .footer-links ul a {
        color: #8a8c95;
        transition: 0.3s;
        display: inline-block;
        line-height: 1;
    }

    #footer .footer-top .footer-links ul a:hover {
        text-decoration: none;
        color: #5777ba;
    }

    #footer .footer-top .social-links a {
        font-size: 18px;
        display: inline-block;
        background: #5777ba;
        color: #fff;
        line-height: 1;
        padding: 8px 0;
        margin-right: 4px;
        border-radius: 50%;
        text-align: center;
        width: 36px;
        height: 36px;
        transition: 0.3s;
    }

    #footer .footer-top .social-links a:hover {
        background: #27282c;
        color: #fff;
        text-decoration: none;
    }

    #footer .copyright {
        text-align: center;
        float: left;
        color: #47536e;
    }

    #footer .credits {
        float: right;
        text-align: center;
        font-size: 13px;
        color: #47536e;
    }

    @media (max-width: 768px) {
        #footer .copyright, #footer .credits {
            float: none;
            text-align: center;
            padding: 5px 0;
        }
    }


</style>
