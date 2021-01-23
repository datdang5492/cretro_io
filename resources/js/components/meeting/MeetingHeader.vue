<template>
    <div class="container-fluid mt-4">
        <div class="row text-center">
            <div class="col-lg-3 text-left">
                <h3 v-if="teamName !== ''">Team: {{teamName}}</h3>
                <h4 v-if="sprintName !== ''">Sprint: {{sprintName}}</h4>
                <!--<h4 v-if="duration !== 0">Meeting duration: {{duration}} minutes</h4>-->
                <h4 v-if="sprintName !== ''">Date: {{sprintName}}</h4>

                <!--not display clock when meeting has not started-->
                <!--<h4>Time left: {{this.countHours + ":" + this.countMinutes + ":" +-->
                <!--this.countSeconds}}</h4>-->
            </div>

            <!--Notification slot-->
            <div class="col-lg-6">
                <div class="alert alert-dismissible alert-danger" v-if="isThereAnyError()">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Error! {{this.$store.getters.error}}</strong>
                </div>
            </div>

            <div class="col-lg-3 text-right">
                <button type="button"
                        v-if="!isMeetingStopped"
                        class="btn btn-danger meetingControl"
                        v-on:click="stopMeeting()">
                    <i class="fas fa-stop-circle"></i> Stop meeting
                </button>

                <button type="button"
                        v-if="isMeetingStopped"
                        class="btn btn-info meetingControl"
                        v-on:click="stopMeeting()">
                    <i class="fas fa-info"></i> Meeting summary
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
                               v-bind:src="data.item.profilePic"></b-img>
                        <b>{{data.item.name }}</b>
                        <span v-if="data.item.is_winner"> - Winner
                            <b-img secondaryrounded="circle"
                                   alt="Circle image"
                                   v-bind:src="'https://img.icons8.com/plasticine/40/000000/trophy.png'"></b-img>
                            </span>

                        <span v-if="!data.item.is_winner"> - Honor
                            <b-img secondaryrounded="circle"
                                   alt="Circle image"
                                   v-bind:src="'https://img.icons8.com/cotton/20/000000/olympic-medal-silver.png'"></b-img>
                            </span>
                    </template>
                </b-table>
            </b-container>

            <template v-slot:modal-header>
                <div class="w-200">
                    Meeting fun facts
                    <b-img secondaryrounded="circle"
                           alt="Circle image"
                           v-bind:src="'https://img.icons8.com/doodle/25/000000/firework-explosion.png'"></b-img>

                    <b-img secondaryrounded="circle"
                           alt="Circle image"
                           v-bind:src="'https://img.icons8.com/plasticine/25/000000/confetti.png'"></b-img>

                    <b-img secondaryrounded="circle"
                           alt="Circle image"
                           v-bind:src="'https://img.icons8.com/cotton/25/000000/firework-explosion.png'"></b-img>
                </div>
            </template>

            <template v-slot:modal-footer>
                <div class="w-200 text-center">
                    <b-button variant="info" @click="toggleMeetingSummaryModal()">Close</b-button>
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
            meetingId: String,
            isMeetingStopped: Boolean
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
                        label: 'Received votes',
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
            isThereAnyError: function () {
                return this.$store.getters.error !== '';
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

            toggleMeetingSummaryModal: function () {
                this.$refs['sumUpModal'].toggle();
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
                        this.$emit('meetingStopped');
                        this.items = res.body;
                        this.toggleMeetingSummaryModal();
                    }
                }).catch(function (err) {
                    this.$store.dispatch("ADD_ERROR", err.body.message);
                    console.log(res);
                });
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
