<template>
    <div class="section meeting min-height-normal">
        <!--MEETING HEADER-->
        <meeting-header></meeting-header>

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
                                        v-model="badInput"
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
                                        v-model="ideaInput"
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
                        >
                        </good-column>

                        <!--WHAT WENT WRONG?-->
                        <bad-column :bads="bads"></bad-column>

                        <!--IDEAS-->
                        <idea-column :ideas="ideas"></idea-column>
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
        name: "create_meeting",
        components: {MeetingHeader, Attendee, IdeaColumn, BadColumn, GoodColumn},
        data() {
            return {
                meetingId: "uuid",
                attendeeId: 12,
                ovlContent: '',
                ovlContentIndex: 0,
                letShowError: false,
                goodInput: "",
                badInput: "",
                ideaInput: "",
                goods: [],
                bads: [],
                ideas: []
            };
        },
        methods: {
            removeGoodItem: function(id){
                this.goods.splice(id, 1);
            },
            fetchItems: function (){
                this.$http.post('retrospective/meeting/item/fetch', {
                    meetingId: this.meetingId,
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

            addGood: function () {
                this.$validator.validate('goodInput').then((validateResult) => {
                    if (validateResult === true) {
                        this.letShowError = false;
                        let goodItem = {
                            meetingId: this.meetingId,
                            attendeeId: this.attendeeId,
                            type: 0,
                            content: this.goodInput
                        };

                        this.$http.post('retrospective/meeting/item/add', goodItem).then(function (res) {
                            if (res.ok) {
                                goodItem.id = res.body;
                                goodItem.vote = 0;
                                this.goods.unshift(goodItem);
                                console.log(this.goods);
                            }
                        }).catch(function (res) {
                            console.log(res);
                        });
                    } else {
                        this.letShowError = true;
                    }
                });
            },

            addBad: function () {
                this.bads.unshift({
                    content: this.badInput,
                    vote: 0
                });
            },

            addIdea: function () {
                this.ideas.unshift({
                    content: this.ideaInput,
                    vote: 0
                });
            },

        },
        created: function () {
            // enable custom validation message
            this.$validator.localize('en', dict);

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
