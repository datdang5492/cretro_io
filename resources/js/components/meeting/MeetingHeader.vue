<template>
    <div class="container-fluid mt-4">
        <div class="row text-center">
            <div class="col-lg-9">
                <h3 class="text-center" v-if="teamName !== ''">Team: {{teamName}}</h3>
                <h4 class="text-center" v-if="sprintName !== ''">Sprint: {{sprintName}}</h4>
                <h4 class="text-center" v-if="duration !== 0">Meeting duration: {{duration}} minutes</h4>

                <!--not display clock when meeting has not started-->
                <!--<h4 v-if="status > 0">Time left: {{this.countHours + ":" + this.countMinutes + ":" +-->
                <!--this.countSeconds}}</h4>-->
            </div>

            <div class="col-lg-3 text-right" v-if="status >= 0">
                <!--<button type="button"-->
                <!--class="btn btn-info meetingControl"-->
                <!--v-on:click="startCounting()"-->
                <!--v-if="status === 0">-->
                <!--<i class="fas fa-play"></i> Start the meeting-->
                <!--</button>-->

                <!--<button type="button"-->
                <!--class="btn btn-danger meetingControl"-->
                <!--v-on:click="stopCounting()"-->
                <!--v-if="status === 1">-->
                <!--<i class="fas fa-stop-circle"></i> Stop counting-->
                <!--</button>-->

                <button type="button"
                        class="btn btn-danger meetingControl"
                        v-on:click="stopMeeting()">
                    <i class="fas fa-stop-circle"></i> Stop meeting
                </button>
            </div>
        </div>

        <b-modal
            id="sumUpModal"
            ref="sumUpModal"
            title="Meeting Summary"
            size="xl"
            :no-close-on-backdrop="true"
            :no-close-on-esc="true"
            :centered="true"
            :header-bg-variant="'success'"
        >
            <b-container fluid>
                <b-table striped hover :items="items" :fields="tableFields">
                    <template v-slot:cell(name)="data">
                        <b-img secondaryrounded="circle"
                               alt="Circle image"
                               v-bind:src="data.item.profilePic"></b-img>,
                        <b>{{data.item.name }}</b>
                    </template>
                </b-table>
            </b-container>

            <template v-slot:modal-footer>
                <div class="w-100">
                    <p class="float-left">Modal Footer Content</p>
                    <b-button
                        variant="primary"
                        size="sm"
                        class="float-right"
                        @click="show=false"
                    >
                        Close
                    </b-button>
                </div>
            </template>
        </b-modal>
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
            status: Number,
            meetingId: String,


        },
        data() {
            return {
                countHours: 0,
                countMinutes: 0,
                countSeconds: 0,

                tableFields: [
                    {
                        key: 'name',
                        label: '',
                        variant: 'light'
                    },
                    {
                        key: 'contributed_post',
                        label: 'Contributed Posts',
                        class: 'text-center'
                    },
                    {
                        key: 'contributed_idea',
                        label: 'Contributed Ideas',
                        class: 'text-center'
                    },
                    {
                        key: 'received_vote',
                        label: 'Given votes',
                        class: 'text-center'
                    },
                    {
                        key: 'quality_post',
                        label: 'Quality posts',
                        class: 'text-center'
                    },
                    {
                        key: 'total',
                        label: 'Total score',
                        class: 'text-center'
                    }
                ],
                items: []
            };
        },
        methods: {
            startCounting: function () {
                this.status = 1;
                this.countDown(this.duration);
            },

            stopCounting: function () {
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
                }, 1000, distance, hour, minute, second);
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
            },

            confirmStopMeeting: function () {
                this.$bvModal.msgBoxConfirm('Are you sure to stop the meeting?', {
                    centered: true
                }).then(value => {
                    if (value === true) {
                        this.stopMeeting();
                    }
                })
            },

            stopMeeting: function () {
                this.$http.post('retrospective/meeting/stop', {
                    meetingId: this.meetingId,
                }).then(function (res) {
                    if (res.ok) {
                        this.items = res.body;
                        this.$refs['sumUpModal'].toggle();
                    }
                }).catch(function (res) {
                    console.log(res);
                });
            },

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
