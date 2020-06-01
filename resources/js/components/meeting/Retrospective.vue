<template>
    <div class="section meeting min-height-normal">
        <!--MEETING HEADER-->
        <meeting-header v-if="teamName !== ''"
                        :teamName="teamName"
                        :sprintName="sprintName"
                        :duration="duration"
                        :status="status"
        >
        </meeting-header>

        <!--main area-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-9">
                    <!--TITLE-->
                    <div class="row text-center">
                        <div class="col-lg-4">
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

                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
                            <div class="card text-white bg-success mb-3">
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
                    </div>

                    <!--TEXTAREA-->
                    <div class="row text-left">
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
                            <div class="alert alert-dismissible alert-danger" v-if="errors.has('badInput')">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{errors.first('badInput')}}
                            </div>
                            <div class="card mb-3 border-warning">
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
                        <div class="col-lg-4">
                            <div class="alert alert-dismissible alert-danger" v-if="errors.has('ideaInput')">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{errors.first('ideaInput')}}
                            </div>
                            <div class="card mb-3 border-primary">
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
                    </div>

                    <!--CONTENTS-->
                    <div class="row text-left">
                        <!--WHAT WENT RIGHT?-->
                        <good-column :goods="goods"
                                     v-on:getRemovedGoodItem="removeGoodItem($event)"
                                     v-on:getVotedItem="voteGoodItem($event)"
                        >
                        </good-column>

                        <!--WHAT WENT WRONG?-->
                        <bad-column :bads="bads"
                                    v-on:getRemovedBadItem="removeBadItem($event)"
                                    v-on:getVotedItem="voteBadItem($event)">
                        </bad-column>

                        <!--IDEAS-->
                        <idea-column :ideas="ideas"
                                     v-on:getRemovedIdeaItem="removeIdeaItem($event)"
                                     v-on:getVotedItem="voteIdeaItem($event)">
                        </idea-column>
                    </div>
                </div>

                <!--CURRENT IN MEETING-->
                <attendee></attendee>
            </div>
        </div>
    </div>
</template>

<script>
    import GoodColumn from "./GoodColumn";
    import BadColumn from "./BadColumn";
    import IdeaColumn from "./IdeaColumn";
    import Attendee from "./Attendee";
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
        }
    };

    export default {
        name: "retrospective",
        components: {MeetingHeader, Attendee, IdeaColumn, BadColumn, GoodColumn},
        data() {
            return {
                meetingId: '',
                attendeeId: "attendee_id",
                ovlContent: '',
                ovlContentIndex: 0,
                letShowGoodItemError: false,
                letShowBadItemError: false,
                letShowIdeaItemError: false,
                goodInput: "",
                badInput: "",
                ideaInput: "",

                teamName: '',
                attendeeNo: null,
                sprintName: '',
                maxVote: 0,
                status: 0,
                duration: 0,

                goods: [],
                bads: [],
                ideas: []
            };
        },
        methods: {
            removeGoodItem: function (index) {
                this.goods.splice(index, 1);
            },

            removeBadItem: function (index) {
                this.bads.splice(index, 1);
            },

            removeIdeaItem: function (index) {
                this.ideas.splice(index, 1);
            },

            voteGoodItem: function (data) {
                this.goods[data.index].isVoted = data.value;
                if (data.value === false) {
                    this.goods[data.index].vote--;
                } else {
                    this.goods[data.index].vote++;
                }
            },

            voteBadItem: function (data) {
                this.bads[data.index].isVoted = data.value;
                if (data.value === false) {
                    this.bads[data.index].vote--;
                } else {
                    this.bads[data.index].vote++;
                }
            },

            voteIdeaItem: function (data) {
                this.ideas[data.index].isVoted = data.value;
                if (data.value === false) {
                    this.ideas[data.index].vote--;
                } else {
                    this.ideas[data.index].vote++;
                }
            },
            fetchItems: function () {
                this.$http.post('retrospective/meeting/item/fetch', {
                    meetingId: this.meetingId,
                    attendeeId: this.attendeeId,
                }).then(function (res) {
                    if (res.ok) {
                        this.goods = res.data.goods;
                        this.bads = res.data.bads;
                        this.ideas = res.data.ideas;
                    }
                }).catch(function (res) {
                    console.log(res.msg);
                });
            },

            getMeetingData: function () {
                this.$http.post('retrospective/meeting/get-data', {
                    meetingId: this.meetingId,
                }).then(function (res) {
                    if (res.ok) {
                        this.teamName = res.body.team_name;
                        this.attendeeNo = res.body.sprint_name;
                        this.sprintName = res.body.sprint_name;
                        this.maxVote = res.body.max_vote;
                        this.status = res.body.meetingStatus;
                        this.duration = res.body.duration;
                    }
                }).catch(function (res) {
                    console.log(res.msg);
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
                        let goodItem = {
                            isVoted: false,
                            vote: 0,
                            content: this.goodInput
                        };

                        this.$http.post('retrospective/meeting/item/add', data).then(function (res) {
                            if (res.ok && res.body > 0) {
                                goodItem.id = res.body;
                                this.goods.unshift(goodItem);
                            }
                        }).catch(function (res) {
                            console.log(res);
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
                        let badItem = {
                            isVoted: false,
                            vote: 0,
                            content: this.badInput
                        };

                        this.$http.post('retrospective/meeting/item/add', data).then(function (res) {
                            if (res.ok && res.body > 0) {
                                badItem.id = res.body;
                                this.bads.unshift(badItem);
                            }
                        }).catch(function (res) {
                            console.log(res);
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
                        let ideaItem = {
                            isVoted: false,
                            vote: 0,
                            content: this.ideaInput
                        };

                        this.$http.post('retrospective/meeting/item/add', data).then(function (res) {
                            if (res.ok && res.body > 0) {
                                ideaItem.id = res.body;
                                this.ideas.unshift(ideaItem);
                            }
                        }).catch(function (res) {
                            console.log(res);
                        });
                    } else {
                        this.letShowIdeaItemError = true;
                    }
                });
            },

        },
        created: function () {
            // enable custom validation message
            this.$validator.localize('en', dict);
            this.meetingId = this.$route.params.id;

            this.getMeetingData();
            this.fetchItems();
        },
    };
</script>

<style>
    .btn-outline-light:hover {
        color: black;
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
