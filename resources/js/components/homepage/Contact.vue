<template>
    <div>
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Have a question? Or you have some suggestion to improve this tool?
                        Don't be hesitate, tell me anything. :) </p>
                </div>

                <div class="row">

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6 info" data-aos="fade-up">
                                <i class="bx bx-map"></i>
                                <h4>Address</h4>
                                <p>86157 Augsburg<br>Germany</p>
                            </div>
                            <div class="col-lg-6 info" data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-phone"></i>
                                <h4>Call</h4>
                                <p>+49 1575 479 2720</p>
                            </div>
                            <div class="col-lg-6 info" data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-envelope"></i>
                                <h4>Email</h4>
                                <p>dangbadat5492@gmail.com</p>
                            </div>
                            <div class="col-lg-6 info" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-time-five"></i>
                                <h4>Working Hours</h4>
                                <p>Mon - Fri: 9AM to 5PM<br>Sunday: 9AM to 1PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form" data-aos="fade-up">
                            <div class="form-group">
                                <input placeholder="Your Name" type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input placeholder="Your Email" type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input placeholder="Subject" type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Message" class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us"></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="mb-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "contact",
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
    .contact .info {
        padding: 20px 40px;
        background: #f1f3f6;
        color: #47536e;
        text-align: center;
        border: 1px solid #fff;
    }

    .contact .info i {
        font-size: 48px;
        color: #9fb2d8;
        margin-bottom: 15px;
    }

    .contact .info h4 {
        padding: 0;
        margin: 0 0 10px 0;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        font-family: "Poppins", sans-serif;
    }

    .contact .info p {
        font-size: 15px;
    }

    .contact .php-email-form {
        width: 100%;
    }

    .contact .php-email-form .validate {
        display: none;
        color: red;
        margin: 0;
        font-weight: 400;
        font-size: 13px;
    }

    .contact .php-email-form .error-message {
        display: none;
        color: #fff;
        background: #ed3c0d;
        text-align: center;
        padding: 15px;
        font-weight: 600;
    }

    .contact .php-email-form .sent-message {
        display: none;
        color: #fff;
        background: #18d26e;
        text-align: center;
        padding: 15px;
        font-weight: 600;
    }

    .contact .php-email-form .loading {
        display: none;
        background: #fff;
        text-align: center;
        padding: 15px;
    }

    .contact .php-email-form .loading:before {
        content: "";
        display: inline-block;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        margin: 0 10px -6px 0;
        border: 3px solid #18d26e;
        border-top-color: #eee;
        -webkit-animation: animate-loading 1s linear infinite;
        animation: animate-loading 1s linear infinite;
    }

    .contact .php-email-form label {
        font-family: "Poppins", sans-serif;
        margin-bottom: 5px;
        color: #8a8c95;
    }

    .contact .php-email-form input, .contact .php-email-form textarea {
        border-radius: 0;
        box-shadow: none;
        font-size: 14px;
    }

    .contact .php-email-form input::focus, .contact .php-email-form textarea::focus {
        background-color: #5777ba;
    }

    .contact .php-email-form input {
        padding: 20px 15px;
    }

    .contact .php-email-form textarea {
        padding: 12px 15px;
    }

    .contact .php-email-form button[type="submit"] {
        background: #fff;
        border: 2px solid #5777ba;
        padding: 10px 24px;
        color: #5777ba;
        transition: 0.4s;
        border-radius: 50px;
        margin-top: 5px;
    }

    .contact .php-email-form button[type="submit"]:hover {
        background: #5777ba;
        color: #fff;
    }

    @media (max-width: 1024px) {
        .contact .php-email-form {
            padding: 30px 15px 15px 15px;
        }
    }

    @media (max-width: 768px) {
        .contact .php-email-form {
            padding: 15px 0 0 0;
        }
    }

    @-webkit-keyframes animate-loading {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes animate-loading {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>
