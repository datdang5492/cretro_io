<template>
    <div class="section meeting min-height-normal">
        <div class="container-fluid mt-4">
            <div class="row text-center">
                <div class="col-lg-9">
                    <h3 class="text-center">Cerberus Team</h3>
                    <h4 class="text-center">Sprint 20.07</h4>
                    <h4>Time left: {{this.duration.countHours + "h " + this.duration.countMinutes + "m " +
                        this.duration.countSeconds + "s"}}</h4>
                </div>

                <div class="col-lg-3 text-right">
                    <button type="button" class="btn btn-danger"><i class="fas fa-exclamation-circle"></i> Stop the
                        meeting
                    </button>
                </div>
            </div>
        </div>

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
                            <div class="alert alert-dismissible alert-danger" v-if="errors.has('goodInput')">
                                <button type="button" class="close" data-dismiss="alert">×</button>
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
                        <div class="col-lg-4">
                            <div class="card text-white bg-info mb-3" v-for="(good, index) in this.goods">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="card-text">
                                                <b-badge pill variant="light">{{index+1}}</b-badge>
                                                {{good.content}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row text-right mt-3">
                                        <div class="col-lg-6 text-left">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="removeGood(index)">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <button type="button" v-on:click="showEditOvl(goods[index].content, index)"
                                                    class="btn btn-outline-light btn-sm">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <button type="button"
                                                    v-bind:class="getVotedClasss(good.isVoted)"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="voteGood(index)">
                                                <img src="https://img.icons8.com/dusk/20/000000/facebook-like.png"/>
                                                <strong>
                                                    <b-badge pill variant="light" class="text-tiny">{{good.vote}}
                                                    </b-badge>
                                                </strong>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <b-modal ref="edit_ovl" centered title="Edit" no-close-on-backdrop @ok="saveInputGood()">
                                <b-form-textarea
                                    class="border-info"
                                    id="textarea"
                                    rows="7"
                                    name="ovlContent"
                                    v-model="ovlContent"
                                    v-validate="'required'"
                                ></b-form-textarea>
                            </b-modal>
                        </div>

                        <!--WHAT WENT WRONG?-->
                        <div class="col-lg-4">
                            <div class="card text-white bg-secondary mb-3" v-for="(bad, index) in this.bads">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="card-text">
                                                <b-badge pill variant="light">{{index+1}}</b-badge>
                                                {{bad.content}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row text-right mt-3">
                                        <div class="col-lg-6 text-left">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="removeBad(index)">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="voteBad(index)">
                                                <img src="https://img.icons8.com/dusk/20/000000/facebook-like.png"/>
                                                <b-badge pill variant="light">{{bad.vote}}</b-badge>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--IDEAS-->
                        <div class="col-lg-4">
                            <div class="card text-white bg-success mb-3" v-for="(idea, index) in this.ideas">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="card-text">
                                                <b-badge pill variant="light">{{index+1}}</b-badge>
                                                {{idea.content}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row text-right mt-3">
                                        <div class="col-lg-6 text-left">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="removeIdea(index)">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <button type="button"
                                                    class="btn btn-outline-light btn-sm"
                                                    v-on:click="voteIdea(index)">
                                                <img src="https://img.icons8.com/dusk/20/000000/facebook-like.png"/>
                                                <b-badge pill variant="light">{{idea.vote}}</b-badge>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--CURRENT IN MEETING-->
                <div class="col-lg-3">
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <!--https://icons8.com/icons/set/animal-->
                            <b-list-group class="text-left">
                                <b-list-group-item href="#" class="font-weight-bold text-center">Attendees
                                </b-list-group-item>
                                <b-list-group-item href="#" variant="primary">
                                    <b-img secondaryrounded="circle" alt="Circle image"
                                           src="https://img.icons8.com/emoji/30/000000/crying-cat.png"></b-img>
                                    Vasiliy Stepkin
                                </b-list-group-item>
                                <b-list-group-item href="#" variant="secondary">
                                    <b-img secondaryrounded="circle" alt="Circle image"
                                           src="https://img.icons8.com/plasticine/30/000000/octopus.png"></b-img>
                                    Dat Dang
                                </b-list-group-item>
                                <b-list-group-item href="#" variant="success">
                                    <b-img secondaryrounded="circle" alt="Circle image"
                                           src="https://img.icons8.com/plasticine/30/000000/cow.png"></b-img>
                                    Wahaab Bhati
                                </b-list-group-item>
                                <b-list-group-item href="#" variant="danger">
                                    <b-img secondaryrounded="circle" alt="Circle image"
                                           src="https://img.icons8.com/plasticine/30/000000/pig.png"></b-img>
                                    Robert Huffrau
                                    <i class="fas fa-user-shield" v-b-tooltip.hover
                                       title="Only meeting conductor can stop the meeting and remove posts"></i>
                                </b-list-group-item>
                                <b-list-group-item href="#" variant="secondary">
                                    <b-img secondaryrounded="circle" alt="Circle image"
                                           src="https://img.icons8.com/plasticine/30/000000/reindeer.png"></b-img>
                                    Ron Fetchner
                                </b-list-group-item>
                                <b-list-group-item href="#" variant="info">
                                    <b-img secondaryrounded="circle" alt="Circle image"
                                           src="https://img.icons8.com/dusk/30/000000/--camel.png"></b-img>
                                    Artur Naravous
                                </b-list-group-item>
                                <b-list-group-item href="#" variant="light">
                                    <b-img secondaryrounded="circle" alt="Circle image"
                                           src="https://img.icons8.com/officel/30/000000/giraffe.png"></b-img>
                                    Stefan Schmidhuber
                                </b-list-group-item>
                            </b-list-group>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center">

        </div>
    </div>
</template>

<script>
    export default {
        name: "create_meeting",
        components: {},
        data() {
            return {
                ovlContent: '',
                ovlContentIndex: 0,
                duration: {
                    countHours: 0,
                    countMinutes: 0,
                    countSeconds: 0
                },
                goodInput: "",
                badInput: "",
                ideaInput: "",
                goods: [
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1,
                        isVoted: false,
                    },
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1,
                        isVoted: false,
                    },
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1,
                        isVoted: false,
                    }
                ],
                bads: [
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1,
                        isVoted: false,
                    },
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1,
                        isVoted: false,
                    },
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1,
                        isVoted: false,
                    }
                ],
                ideas: [
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1
                    },
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1
                    },
                    {
                        content: "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        vote: 1
                    }
                ]
            };
        },
        methods: {
            getVotedClasss: function (isVoted) {
                return isVoted === true ? 'voted' : '';
            },
            addGood: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        content = this.goodInput;
                        this.goods.unshift({
                            content: content,
                            vote: 0
                        });
                    }
                });
            },
            showEditOvl: function (content, index) {
                this.ovlContent = content;
                this.ovlContentIndex = index;
                this.$refs['edit_ovl'].show()
            },

            saveInputGood: function () {
                this.goods[this.ovlContentIndex].content = this.ovlContent;
            },

            removeGood: function (id) {
                this.$bvModal.msgBoxConfirm('Are you sure removing this sticker?', {
                    centered: true
                }).then(value => {
                    if (value === true) {
                        this.goods.splice(id, 1)
                    }
                }).catch(err => {
                })
            },

            voteGood: function (id) {
                if (this.goods[id].isVoted === false) {
                    this.goods[id].vote++;
                    this.goods[id].isVoted = true;
                } else {
                    this.goods[id].vote--;
                    this.goods[id].isVoted = false;
                }
            },


            addBad: function () {
                this.bads.unshift({
                    content: this.badInput,
                    vote: 0
                });
            },
            removeBad: function (id) {
                this.$bvModal.msgBoxConfirm('Are you sure removing this sticker?', {
                    centered: true
                }).then(value => {
                    if (value === true) {
                        this.bads.splice(id, 1)
                    }
                }).catch(err => {
                })
            },
            voteBad: function (id) {
                this.bads[id].vote++;
            },


            addIdea: function () {
                this.ideas.unshift({
                    content: this.ideaInput,
                    vote: 0
                });
            },
            removeIdea: function (id) {
                this.$bvModal.msgBoxConfirm('Are you sure removing this sticker?', {
                    centered: true
                }).then(value => {
                    if (value === true) {
                        this.ideas.splice(id, 1)
                    }
                }).catch(err => {
                })
            },
            voteIdea: function (id) {
                this.ideas[id].vote++;
            },

            countDown: function () {
                // Set the date we're counting down to
                var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
                var self = this;
                // Update the count down every 1 second
                var x = setInterval(function () {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    self.duration.countHours = hours;
                    self.duration.countMinutes = minutes;
                    self.duration.countSeconds = seconds;

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                    }
                }, 1000);
            }
        },
        created: function () {
            this.countDown();
        }

    };
</script>

<style scoped>
    .btn-outline-light:hover {
        color: black;
    }

    .card-body {
        padding: 0.25rem;
    }

    .voted {
        background-color: #f8f9fa;
    }

</style>
