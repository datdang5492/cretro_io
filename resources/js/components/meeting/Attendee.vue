<template>
    <div class="col-lg-2">
        <div class="row text-center text-small">
            <div class="col-lg-12">
                <!--https://icons8.com/icons/set/animal-->
                <b-list-group class="text-left">
                    <b-list-group-item href="#" class="font-weight-bold text-center">Attendees
                    </b-list-group-item>

                    <b-list-group-item v-for="(attendee, index) in attendees"
                                       :key="attendee.id"
                                       v-bind:variant="profileImgClass[index]"
                                       href="#">
                        <b-img secondaryrounded="circle"
                               alt="Circle image"
                               v-bind:src="attendee.profilePic"></b-img>
                        {{attendee.name}}

                        <i v-if="attendee.id == attendeeId" class="fas fa-user-shield" v-b-tooltip.hover
                           title="It's you!"></i>
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
        props: {
            attendees: Array,
            attendeeId: String,
        },
        data() {
            return {
                profileImgClass: [
                    'primary', 'secondary', 'danger', 'info', 'light',
                ],
            };
        },
        methods: {

        },
        created: function () {

        },
    };
</script>

<style scoped>
</style>
