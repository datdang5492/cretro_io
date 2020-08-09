<template>
    <div class="section meeting min-height-normal" v-if="isMeetingAvailable && isAttendeeAuthenticated">
        <!--MEETING HEADER-->
        <meeting-header v-if="teamName !== ''"
                        :teamName="teamName"
                        :sprintName="sprintName"
                        :duration="duration"
                        :meetingId="meetingId"
                        :isMeetingStopped="isMeetingStopped"
                        v-on:meetingStopped="stopMeeting($event)"
        >
        </meeting-header>

        <!--main area-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-10">
                    <!--TITLE-->
                    <div class="row text-center">
                        <div class="col-lg-3">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-header font-weight-bold">
                                    <div class="row">
                                        <div class="col-lg-9 text-left">
                                            <b-img secondaryrounded="circle" alt="Circle image"
                                                   src="https://img.icons8.com/dusk/30/000000/happy.png"></b-img>
                                            What went right?
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="addGood()">
                                                <img src="https://img.icons8.com/officel/30/000000/add-tag.png"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card text-white bg-secondary mb-3">
                                <div class="card-header font-weight-bold">
                                    <div class="row">
                                        <div class="col-lg-9 text-left">
                                            <b-img secondaryrounded="circle" alt="Circle image"
                                                   src="https://img.icons8.com/dusk/30/000000/sad.png"></b-img>
                                            What went wrong?
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="addBad()">
                                                <img src="https://img.icons8.com/officel/30/000000/add-tag.png"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-header font-weight-bold">
                                    <div class="row">
                                        <div class="col-lg-9 text-left">
                                            <b-img secondaryrounded="circle" alt="Circle image"
                                                   src="https://img.icons8.com/dusk/30/000000/idea.png"></b-img>
                                            Action items
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="addIdea()">
                                                <img src="https://img.icons8.com/officel/30/000000/add-tag.png"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header font-weight-bold">
                                    <div class="row">
                                        <div class="col-lg-9 text-left">
                                            <b-img secondaryrounded="circle" alt="Circle image"
                                                   src="https://img.icons8.com/dusk/30/000000/two-hearts.png"></b-img>
                                            Appreciation
                                        </div>
                                        <div class="col-lg-3 text-right">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="addAppreciation()">
                                                <img src="https://img.icons8.com/officel/30/000000/add-tag.png"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--TEXTAREA-->
                    <div class="row text-left">
                        <div class="col-lg-3">
                            <div class="alert alert-danger" v-if="errors.has('goodInput')">
                                {{errors.first('goodInput')}}
                            </div>

                            <div class="card mb-3 border-info">
                                <b-form-textarea
                                    id="textarea"
                                    placeholder="Write something then post it ..."
                                    rows="3"
                                    name="goodInput"
                                    v-model="goodInput"
                                    v-validate="'required'"
                                ></b-form-textarea>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="alert alert-danger" v-if="errors.has('badInput')">
                                {{errors.first('badInput')}}
                            </div>
                            <div class="card mb-3 border-secondary">
                                <div class="">
                                    <b-form-textarea
                                        id="textarea"
                                        placeholder="Write something then post it ..."
                                        rows="3"
                                        name="badInput"
                                        v-model="badInput"
                                        v-validate="'required'"
                                    ></b-form-textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="alert alert-danger" v-if="errors.has('ideaInput')">
                                {{errors.first('ideaInput')}}
                            </div>
                            <div class="card mb-3 border-warning">
                                <div class="">
                                    <b-form-textarea
                                        id="textarea"
                                        placeholder="Write something then post it ..."
                                        rows="3"
                                        name="ideaInput"
                                        v-model="ideaInput"
                                        v-validate="'required'"
                                    ></b-form-textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="alert alert-danger" v-if="errors.has('appreciationInput')">
                                {{errors.first('appreciationInput')}}
                            </div>
                            <div class="card mb-3 border-success">
                                <div class="">
                                    <b-form-textarea
                                        id="textarea"
                                        placeholder="Write something then post it ..."
                                        rows="3"
                                        name="appreciationInput"
                                        v-model="appreciationInput"
                                        v-validate="'required'"
                                    ></b-form-textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--CONTENTS-->
                    <div class="row text-left">
                        <!--WHAT WENT RIGHT?-->
                        <good-column :goods="items.goods"
                                     :meetingId="meetingId">
                        </good-column>

                        <!--WHAT WENT WRONG?-->
                        <bad-column :bads="items.bads"
                                    :meetingId="meetingId">
                        </bad-column>

                        <!--IDEAS-->
                        <idea-column :ideas="items.ideas"
                                     :meetingId="meetingId">
                        </idea-column>

                        <!--APPRECIATION-->
                        <appreciation-column :appreciations="items.appreciations"
                                             :meetingId="meetingId">
                        </appreciation-column>
                    </div>
                </div>

                <!--CURRENT IN MEETING-->
                <attendee :attendees="attendees"></attendee>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import GoodColumn from "./GoodColumn";
    import BadColumn from "./BadColumn";
    import IdeaColumn from "./IdeaColumn";
    import Attendee from "./Attendee";
    import AppreciationColumn from "./AppreciationColumn";
    import MeetingHeader from "./MeetingHeader";

    const dict = {
        custom: {
            goodInput: {
                required: "This field is required.",
            },
            badInput: {
                required: "This field is required.",
            },
            ideaInput: {
                required: "This field is required.",
            },
            appreciationInput: {
                required: "This field is required.",
            },
        }
    };

    export default {
        name: "retrospective",
        components: {MeetingHeader, Attendee, IdeaColumn, BadColumn, GoodColumn, AppreciationColumn},
        data() {
            return {
                isMeetingStopped: false,
                isMeetingAvailable: false,
                meetingId: '',
                attendeeId: "attendee_id",
                ovlContent: '',
                ovlContentIndex: 0,
                letShowGoodItemError: false,
                letShowBadItemError: false,
                letShowIdeaItemError: false,
                letShowAppreciationItemError: false,
                goodInput: "",
                badInput: "",
                ideaInput: "",
                appreciationInput: "",

                teamName: '',
                attendeeNo: null,
                sprintName: '',
                maxVote: 0,
                duration: 0,

                pusherCluster: 'eu',
                pusherAppKey: 'a86248d0a37b2bebdb1f',

                isAttendeeAuthenticated: false,
            };
        },
        methods: {
            authenticate: function () {
                let attendeeData = this.$storage.get('attendeeName');

                if (attendeeData === undefined || attendeeData === null
                    || attendeeData.meetingCode === undefined
                    || attendeeData.name === undefined) {
                    this.isMeetingAvailable = false;
                    this.$router.push({name: 'join_meeting'});
                } else {
                    let data = {
                        meetingCode: attendeeData.meetingCode,
                        userName: attendeeData.name
                    };
                    this.$http.post('retrospective/meeting/check-attendee', data).then(function (res) {
                        if (res.ok) {
                            this.isAttendeeAuthenticated = true;
                        } else {
                            this.isMeetingAvailable = false;
                            this.$router.push({name: 'join_meeting'});
                        }
                    }).catch(function (res) {
                        this.isMeetingAvailable = false;
                        this.$router.push({name: 'join_meeting'});
                    });
                }
            },

            stopMeeting: function () {
                this.isMeetingStopped = true;
            },

            getMeetingData: function () {
                this.$http.post('retrospective/meeting/get-data', {
                    meetingId: this.meetingId,
                }).then(function (res) {
                    if (res.ok) {
                        this.isMeetingAvailable = true;
                        this.teamName = res.body.team_name;
                        this.attendeeNo = res.body.sprint_name;
                        this.sprintName = res.body.sprint_name;
                        this.maxVote = res.body.max_vote;
                        this.duration = res.body.duration;
                    }
                }).catch(function (res) {
                    if (res.status !== 200) {
                        this.$router.push({name: 'page_not_found'});
                    }
                });
            },

            addGood: function () {
                this.$validator.validate('goodInput').then((validateResult) => {
                    if (validateResult === true) {
                        this.letShowGoodItemError = false;
                        let data = {
                            meetingId: this.meetingId,
                            attendeeId: this.attendeeId,
                            type: 0,
                            content: this.goodInput
                        };

                        this.$store.dispatch('ADD_ITEM', data).then(response => {
                            if (response.status === 200) {
                                //console.log('success');
                            }
                        }).catch(err => {
                            console.log(err);
                        });
                    } else {
                        this.letShowGoodItemError = true;
                    }
                });
            },

            addBad: function () {
                this.$validator.validate('badInput').then((validateResult) => {
                    if (validateResult === true) {
                        this.letShowBadItemError = false;
                        let data = {
                            meetingId: this.meetingId,
                            attendeeId: this.attendeeId,
                            type: 1,
                            content: this.badInput
                        };

                        this.$store.dispatch('ADD_ITEM', data).then(response => {
                            if (response.status === 200) {
                                //console.log('success');
                            }
                        }).catch(err => {
                            console.log(err);
                        });
                    } else {
                        this.letShowBadItemError = true;
                    }
                });
            },

            addIdea: function () {
                this.$validator.validate('ideaInput').then((validateResult) => {
                    if (validateResult === true) {
                        this.letShowIdeaItemError = false;
                        let data = {
                            meetingId: this.meetingId,
                            attendeeId: this.attendeeId,
                            type: 2,
                            content: this.ideaInput
                        };
                        this.$store.dispatch('ADD_ITEM', data).then(response => {
                            if (response.status === 200) {
                                //console.log('success');
                            }
                        }).catch(err => {
                            console.log(err);
                        });
                    } else {
                        this.letShowIdeaItemError = true;
                    }
                });
            },

            addAppreciation: function () {
                this.$validator.validate('appreciationInput').then((validateResult) => {
                    if (validateResult === true) {
                        this.letShowAppreciationItemError = false;
                        let data = {
                            meetingId: this.meetingId,
                            attendeeId: this.attendeeId,
                            type: 3,
                            content: this.appreciationInput
                        };
                        this.$store.dispatch('ADD_ITEM', data).then(response => {
                            if (response.status === 200) {
                                //console.log('success');
                            }
                        }).catch(err => {
                            console.log(err);
                        });
                    } else {
                        this.letShowAppreciationItemError = true;
                    }
                });
            },

            // getAttendeeList: function () {
            //     this.$http.post('retrospective/meeting/attendee/get-list', {
            //         meetingId: this.meetingId,
            //     }).then(function (res) {
            //         if (res.ok) {
            //             this.attendees = res.data;
            //         }
            //     }).catch(function (res) {
            //         this.resMsg = res.body.message;
            //     });
            // },

        },
        created: function () {
            // enable custom validation message
            this.$validator.localize('en', dict);
            this.meetingId = this.$route.params.id;
            this.authenticate();
            this.getMeetingData();
        },

        mounted() {
            let getItemReq = {
                meetingId: this.meetingId,
                attendeeId: this.attendeeId,
            };

            let getAttendeeReq = {
                meetingId: this.meetingId,
            };

            this.$store.dispatch('GET_ITEMS', getItemReq);
            this.$store.dispatch('GET_ATTENDEES', getAttendeeReq);

            //use your own credentials you get from Pusher
            let pusher = new Pusher(this.pusherAppKey, {
                cluster: this.pusherCluster,
                encrypted: false,
            });

            let channel = pusher.subscribe('retrospective-channel' + this.meetingId);

            channel.bind('new-item' + this.meetingId, (data) => {
                this.$store.commit('ADD_ITEM', data.item);
            });

            channel.bind('edit-item' + this.meetingId, (data) => {
                this.$store.commit('EDIT_ITEM_CONTENT', data.item);
            });

            channel.bind('vote-item' + this.meetingId, (data) => {
                this.$store.commit('VOTE_ITEM', data.item);
            });

            channel.bind('remove-item' + this.meetingId, (data) => {
                this.$store.commit('REMOVE_ITEM', data.item);
            });

            channel.bind('attendee-joined' + this.meetingId, (data) => {
                console.log(123);
                this.$store.commit('ATTENDEE_JOINED', data.attendee);
            });

            channel.bind('attendee-left' + this.meetingId, (data) => {
                this.$store.commit('ATTENDEE_LEFT', data.attendee);
            });
        },

        computed: {
            ...mapGetters([
                'items',
                'attendees'
            ])
        }
    };
</script>

<style>
    .btn-outline-light:hover {
        color: black;
    }

    .bg-warning {
        background-color: #ffb927 !important;
    }

    .card-body {
        padding: 0.25rem;
    }

    /* use when like btn is clicked */
    .voted {
        background-color: #f8f9fa;
    }

    .list-group-item {
        padding: 0.75rem 1rem;
    }
</style>
