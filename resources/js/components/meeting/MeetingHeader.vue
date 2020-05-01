<template>
    <div class="container-fluid mt-4">
        <div class="row text-center">
            <div class="col-lg-9">
                <h3 class="text-center">{{teamName}}</h3>
                <h4 class="text-center">{{sprintName}}</h4>
                <h4>Time left: {{this.duration.countHours + "h " + this.duration.countMinutes + "m " +
                    this.duration.countSeconds + "s"}}</h4>
            </div>

            <div class="col-lg-3 text-right">
                <button type="button" class="btn btn-danger"><i class="fas fa-stop-circle"></i> Stop the
                    meeting
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "meeting-header",
        components: {},
        props: {},
        data() {
            return {
                sprintName: 'Sprint 20.07',
                teamName: 'Cerberus Team',
                duration: {
                    countHours: 0,
                    countMinutes: 0,
                    countSeconds: 0
                },
            };
        },
        methods: {
            countDown: function () {
                // Set the date we're counting down to
                var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
                var self = this;
                // Update the count down every 1 second
                var x = setInterval(function () {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    self.duration.countHours = hours;
                    self.duration.countMinutes = minutes;
                    self.duration.countSeconds = seconds;

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                    }
                }, 1000);
            }
        },
        created: function () {
            this.countDown();
        },
    };
</script>

<style scoped>
</style>
