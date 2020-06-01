<template>
    <div class="container-fluid mt-4">
        <div class="row text-center">
            <div class="col-lg-9">
                <h3 class="text-center" v-if="teamName !== ''">Team: {{teamName}}</h3>
                <h4 class="text-center" v-if="sprintName !== ''">Sprint: {{sprintName}}</h4>
                <h4 class="text-center" v-if="duration !== 0">Meeting duration: {{duration}} minutes</h4>

                <!--not display clock when meeting has not started-->
                <h4 v-if="status > 0">Time left: {{this.countHours + ":" + this.countMinutes + ":" +
                    this.countSeconds}}</h4>
            </div>

            <div class="col-lg-3 text-right" v-if="status >= 0">
                <button type="button"
                        class="btn btn-info meetingControl"
                        v-on:click="startMeeting()"
                        v-if="status === 0">
                    <i class="fas fa-play"></i> Start the meeting
                </button>

                <button type="button"
                        class="btn btn-danger meetingControl"
                        v-on:click="stopMeeting()"
                        v-if="status === 1">
                    <i class="fas fa-stop-circle"></i> Stop the meeting
                </button>

                <button type="button"
                        class="btn btn-dark meetingControl"
                        v-on:click="stopMeeting()"
                        v-if="status === 2">
                    Meeting Finished
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "meeting-header",
        components: {},
        props: {
            teamName: String,
            sprintName: String,
            duration: Number,
            status: Number
        },
        data() {
            return {
                countHours: 0,
                countMinutes: 0,
                countSeconds: 0,
            };
        },
        methods: {
            startMeeting: function () {
                this.status = 1;
                this.countDown(this.duration);
            },

            stopMeeting: function () {
                this.status = 2;
            },

            countDown: function (duration) {
                // Set the date we're counting down to
                var countDownDate = new Date();

                var timeup = countDownDate.setMinutes(countDownDate.getMinutes() + duration);

                var self = this;

                // Get today's date and time
                let now = new Date().getTime();

                // Find the distance between now and the count down date
                let distance = timeup - now;

                // Time calculations for days, hours, minutes and seconds
                let hour = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minute = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let second = Math.floor((distance % (1000 * 60)) / 1000);

                var x;
                // Update the count down every 1 second
                x = setInterval(function () {
                    self.createClock(hour, minute, second);
                }, 1000, distance, hour, minute , second);
            },

            createClock: function (distance, hour, minute, second) {
                // // Get today's date and time
                // let now = new Date().getTime();
                //
                // // Find the distance between now and the count down date
                // let distance = timeup - now;
                //
                // // Time calculations for days, hours, minutes and seconds
                // let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                // let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                // let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                this.countHours = hour;
                if (hour < 10) {
                    self.countHours = "0" + hour;
                }

                this.countMinutes = minute;
                if (minute < 10) {
                    self.countHours = "0" + minute;
                }

                this.countSeconds = second;
                if (second < 10) {
                    self.countHours = "0" + second;
                }

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                }

                if (minute === 0) {
                    alert("meeting stopped");
                }
            }

        },
        created: function () {

        },
    };
</script>

<style scoped>
    .meetingControl {
        height: 3.5rem;
    }
</style>
