<template>
    <div>
        <section id="details" class="details">
            <div class="container">
                <div class="row content">
                    <div class="col-md-4" data-aos="fade-right">
                        <img :src="'/images/details_1.png'" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8 pt-4" data-aos="fade-up">
                        <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                        <p class="font-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="fas fa-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                            <li><i class="fas fa-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                            <li><i class="fas fa-check"></i> Iure at voluptas aspernatur dignissimos doloribus repudiandae.</li>
                            <li><i class="fas fa-check"></i> Est ipsa assumenda id facilis nesciunt placeat sed doloribus praesentium.</li>
                        </ul>
                        <p>
                            Voluptas nisi in quia excepturi nihil voluptas nam et ut. Expedita omnis eum consequatur non. Sed in asperiores aut repellendus. Error quisquam ab maiores. Quibusdam sit in officia
                        </p>
                    </div>
                </div>

                <div class="row content">
                    <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
                        <img :src="'/images/details_4.png'" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
                        <h3>Quas et necessitatibus eaque impedit ipsum animi consequatur incidunt in</h3>
                        <p class="font-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum
                        </p>
                        <ul>
                            <li><i class="fas fa-check"></i> Et praesentium laboriosam architecto nam .</li>
                            <li><i class="fas fa-check"></i> Eius et voluptate. Enim earum tempore aliquid. Nobis et sunt consequatur. Aut repellat in numquam velit quo dignissimos et.</li>
                            <li><i class="fas fa-check"></i> Facilis ut et voluptatem aperiam. Autem soluta ad fugiat.</li>
                        </ul>
                    </div>
                </div>

                <div class="row content">
                    <div class="col-md-4" data-aos="fade-right">
                        <img :src="'/images/details_3.png'" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8 pt-5" data-aos="fade-up">
                        <h3>Sunt consequatur ad ut est nulla consectetur reiciendis animi voluptas</h3>
                        <p>Cupiditate placeat cupiditate placeat est ipsam culpa. Delectus quia minima quod. Sunt saepe odit aut quia voluptatem hic voluptas dolor doloremque.</p>
                        <ul>
                            <li><i class="fas fa-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                            <li><i class="fas fa-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                            <li><i class="fas fa-check"></i> Facilis ut et voluptatem aperiam. Autem soluta ad fugiat.</li>
                        </ul>
                        <p>
                            Qui consequatur temporibus. Enim et corporis sit sunt harum praesentium suscipit ut voluptatem. Et nihil magni debitis consequatur est.
                        </p>
                        <p>
                            Suscipit enim et. Ut optio esse quidem quam reiciendis esse odit excepturi. Vel dolores rerum soluta explicabo vel fugiat eum non.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "details-section",
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
    .details .content + .content {
        margin-top: 100px;
    }

    .details .content h3 {
        font-weight: 700;
        font-size: 32px;
        color: #47536e;
    }

    .details .content ul {
        list-style: none;
        padding: 0;
    }

    .details .content ul li {
        padding-bottom: 10px;
    }

    .details .content ul i {
        font-size: 20px;
        padding-right: 4px;
        color: #5777ba;
    }

    .details .content p:last-child {
        margin-bottom: 0;
    }

</style>
