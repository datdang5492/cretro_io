<template>
    <div>
        <section id="welcome" class="d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
                        <div>
                            <h1>Remote retrospective is easy!</h1>
                            <h2>Have fun doing Scrum retrospective with Cretro. <br>Easy & Convenient!</h2>
                            <a href="/meeting/retrospective/create" class="cretro_btn"><i class='bx bx-calendar-check' ></i> Start a meeting!</a>
                            <a href="/meeting/retrospective/meeting_id" class="cretro_btn"><i class='bx bxs-hand-right'></i> Join a meeting</a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 welcome-img" data-aos="fade-up">
                        <img :src="'/images/welcome_img.png'" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "welcome",
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
    #welcome {
        width: 100%;
        position: relative;
        overflow: hidden;
        padding: 140px 0 100px 0;
    }

    #welcome::before {
        content: '';
        position: absolute;
        right: -100%;
        top: 20%;
        width: 250%;
        height: 200%;
        z-index: -1;
        background-color: #e8ecf5;
        transform: skewY(135deg);
    }

    #welcome h1 {
        margin: 0 0 10px 0;
        font-size: 48px;
        font-weight: 500;
        line-height: 56px;
        color: #5777ba;
        font-family: "Poppins", sans-serif;
    }

    #welcome h2 {
        color: #515f7d;
        margin-bottom: 50px;
        font-size: 20px;
    }

    @media (max-width: 991px) {
        #welcome {
            text-align: center;
        }
        #welcome .cretro_btn + .cretro_btn {
            margin: 0 10px;
        }
        #welcome .welcome-img {
            text-align: center;
        }
        #welcome .welcome-img img {
            width: 60%;
        }
    }

    @media (max-width: 768px) {
        #welcome h1 {
            font-size: 28px;
            line-height: 36px;
        }
        #welcome h2 {
            font-size: 18px;
            line-height: 24px;
            margin-bottom: 30px;
        }
        #welcome .welcome-img img {
            width: 70%;
        }
    }

    @media (max-width: 575px) {
        #welcome .welcome-img img {
            width: 80%;
        }
    }

</style>
