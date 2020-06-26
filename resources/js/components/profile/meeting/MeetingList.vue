<template>
    <div class="col-lg-5" v-if="meetings != []">
        <div class="row mb-3 text-right">
            <div class="col-lg-12">
                <a href="/meeting/retrospective/create" class="cretro_btn_normal">New meeting</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <b-list-group>
                    <b-list-group-item v-for="(meeting, index) in meetings" :key="meeting.id"
                                       v-bind:variant="getRowVariant(meeting.stopped_at)">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <a v-bind:href="'/meeting/retrospective/' + meeting.id">Sprint:
                                    {{meeting.sprint_name}}</a>

                                <b-badge v-bind:variant="getBadgeVariant(meeting.stopped_at)" pill>
                                    {{getMeetingStatus(meeting.stopped_at)}}
                                </b-badge>

                                <b-badge v-if="meeting.status === 0" v-bind:variant="warning" pill>
                                    Archived
                                </b-badge>
                            </h5>
                            <small>created at {{convertFrontendDate(meeting.created_at)}}</small>
                        </div>

                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <p class="mb-1">
                                    <small>Team: {{meeting.teamName}}</small>
                                </p>
                                <p class="mb-1">
                                    <small>Duration: {{meeting.duration}} minutes</small>
                                </p>
                                <small>Attendees: {{meeting.attendee_no}}</small>
                            </div>

                            <div>
                                <br>
                                <br>
                                <button v-if="meeting.status === 1"
                                        type="button"
                                        class="btn btn-outline-dark btn-sm"
                                        v-on:click="archiveMeeting(meeting.id, index)">
                                    Archive
                                </button>

                                <button v-if="meeting.status === 0"
                                        type="button"
                                        class="btn btn-outline-info btn-sm"
                                        v-on:click="activateMeeting(meeting.id, index)">
                                    Activate
                                </button>
                            </div>
                        </div>
                    </b-list-group-item>
                </b-list-group>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "meeting_list",
        components: {},
        data() {
            return {
                meetings: [],
            };
        },
        methods: {

            convertFrontendDate: function (date) {
                return this.$moment(date, 'YYYY-MM-DD').format('DD.MM.YYYY');
            },

            getRowVariant: function (stopped_at) {
                return stopped_at === null ? 'primary' : 'light'
            },

            getBadgeVariant: function (stopped_at) {
                return stopped_at === null ? 'primary' : 'dark'
            },

            getMeetingStatus: function (stopped_at) {
                return stopped_at === null ? 'unfinished' : 'finished'
            },

            getMeetingList: function () {
                this.$http.post('profile/get-meeting-list').then(function (res) {
                    if (res.ok == true) {
                        this.meetings = res.body.data;
                    }
                }).catch(function (res) {
                    console.log(res);
                });
            },

            archiveMeeting: function (meetingId, index) {
                let data = {
                    meetingId: meetingId,
                };
                this.$http.post('profile/archive-meeting', data).then(function (res) {
                    if (res.ok == true) {
                        this.meetings[index].status = 0;
                    }
                }).catch(function (res) {
                    console.log(res);
                });
            },

            activateMeeting: function (meetingId, index) {
                let data = {
                    meetingId: meetingId,
                };
                this.$http.post('profile/activate-meeting', data).then(function (res) {
                    if (res.ok == true) {
                        this.meetings[index].status = 1;
                    }
                }).catch(function (res) {
                    console.log(res);
                });
            },
        },
        created: function () {
            this.getMeetingList();
            this.$emit('activeTabTriggered', 'meeting');
        }
    };
</script>

<style scoped>


</style>
