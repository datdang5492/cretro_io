<template>
    <div class="col-lg-2">
        <div class="row text-center text-small">
            <div class="col-lg-12">
                <!--https://icons8.com/icons/set/animal-->
                <b-list-group class="text-left">
                    <b-list-group-item href="#" class="font-weight-bold text-center">Attendees
                    </b-list-group-item>

                    <b-list-group-item v-for="attendee in attendees"
                                       :key="attendee.id"
                                       v-bind:variant="profileImgClass[attendee.id]"
                                       href="#">
                        <b-img secondaryrounded="circle"
                               alt="Circle image"
                               v-bind:src="profileImg[attendee.id]"></b-img>
                        {{attendee.name}}

                        <i class="fas fa-user-shield" v-b-tooltip.hover v-if="attendee.isConductor"
                           title="Only meeting conductor can stop the meeting and remove posts"></i>
                    </b-list-group-item>
                </b-list-group>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "attendee",
        components: {},
        props: {},
        data() {
            return {
                meetingId: 1,
                attendees: [],
                profileImgClass: [
                    'primary', 'secondary', 'danger', 'info', 'light',
                ],
                profileImg: [
                    'https://img.icons8.com/emoji/30/000000/crying-cat.png',
                    'https://img.icons8.com/plasticine/30/000000/octopus.png',
                    'https://img.icons8.com/plasticine/30/000000/cow.png',
                    'https://img.icons8.com/plasticine/30/000000/pig.png',
                    'https://img.icons8.com/plasticine/30/000000/reindeer.png',
                    'https://img.icons8.com/dusk/30/000000/--camel.png',
                    'https://img.icons8.com/officel/30/000000/giraffe.png'
                ],
            };
        },
        methods: {
            getAttendeeList: function () {
                this.$http.post('retrospective/meeting/attendee/get-list', {
                    meetingId: this.meetingId,
                }).then(function (res) {
                    if (res.ok) {
                        this.attendees = res.data;
                    }
                    this.resMsg = res.body.message;
                }).catch(function (res) {
                    this.resMsg = res.body.message;
                });
            },
        },
        created: function () {
            this.getAttendeeList();
        },
    };
</script>

<style scoped>
</style>
