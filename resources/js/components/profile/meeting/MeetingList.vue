<template>
    <div class="col-lg-5" v-if="meetings.length > 0">
        <b-list-group>
            <b-list-group-item v-for="meeting in meetings" :key="meeting.id"
                               v-bind:href="'/meeting/retrospective/' + meeting.id"
                               v-bind:variant="getRowVariant(meeting.status)">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        Sprint: {{meeting.sprintName}}
                        <b-badge v-bind:variant="getBadgeVariant(meeting.status)" pill>{{getStatus(meeting.status)}}
                        </b-badge>
                    </h5>
                    <small>{{meeting.time}}</small>
                </div>

                <p class="mb-1">
                    <small>Team: {{meeting.teamName}}</small>
                </p>
                <p class="mb-1">
                    <small>Duration: {{meeting.duration}} minutes</small>
                </p>
                <small>Attendees: {{meeting.attendeeNo}}</small>
            </b-list-group-item>
        </b-list-group>
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
            getRowVariant: function (status) {
                return status === 1 ? 'primary' : 'light'
            },
            getBadgeVariant: function (status) {
                return status === 1 ? 'primary' : 'danger'
            },
            getStatus: function (status) {
                return status === 1 ? 'unfinished' : 'finished'
            },
            getMeetingList: function () {
                this.$http.post('profile/get-meeting-list').then(function (res) {
                    if (res.ok) {
                        this.meetings = res.body;
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
