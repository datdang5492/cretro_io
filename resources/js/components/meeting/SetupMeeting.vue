<template>
    <div class="container-fluid meeting min-height-normal mt-5">
        <div class="row">
            <div class="col-lg-6 other_half min-height-normal"></div>

            <div class="col-lg-6">
                <div class="col-lg-6 offset-lg-3" v-if="meetingCreated === false">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <h4 class="text-center font-weight-bold">
                                <a href="/">Cretro.io</a>
                            </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h4>
                                <b-img secondaryrounded="circle"
                                       alt="Circle image"
                                       src="https://img.icons8.com/dusk/30/000000/settings.png"></b-img>
                                Setup meeting
                            </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <b-alert
                                variant="danger"
                                dismissible
                                fade
                                :show="showErrorMsg"
                                @dismissed="showErrorMsg=false"
                            >
                                {{errorMsg}}
                            </b-alert>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Team name *</label>
                                <p class="text-danger" v-if="errors.has('teamName')">
                                    {{errors.first('teamName')}}
                                </p>
                                <input type="text"
                                       name="teamName"
                                       v-model="teamName"
                                       v-validate="'required'"
                                       class="form-control input_high"
                                       placeholder="Enter your team name">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>
                                    <span class="font-weight-bold">Sprint name</span> (optional)
                                </label>
                                <input type="text" name="sprintName"
                                       v-model="sprintName"
                                       class="form-control input_high"
                                       placeholder="What 's the sprint name?">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>
                                    <span class="font-weight-bold">Number of attendees *</span> (max.20)
                                </label>
                                <p class="text-danger" v-if="errors.has('attendeeNo')">
                                    {{errors.first('attendeeNo')}}
                                </p>
                                <input type="text" name="attendeeNo"
                                       v-model="attendeeNo"
                                       v-validate="'required|numeric|max_value:20'"
                                       class="form-control input_high"
                                       placeholder="How many people are going to attend?">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Maximum vote per attendee</label>
                                <p class="text-danger" v-if="errors.has('maxVote')">
                                    {{errors.first('maxVote')}}
                                </p>
                                <input type="text" name="maxVote"
                                       v-model="maxVote"
                                       v-validate="'required|numeric|min:1'"
                                       class="form-control input_high"
                                       placeholder="Suggested: 3 votes">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button class="btn btn-lg btn-block cretroBtn" v-on:click="create()">Create</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 offset-lg-2 text-center" v-if="meetingCreated === true">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>
                                <b-img secondaryrounded="circle"
                                       alt="Circle image"
                                       src="https://img.icons8.com/dusk/30/000000/settings.png"></b-img>
                                Setup meeting
                            </h4>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <b-alert
                                variant="success"
                                dismissible
                                fade
                                :show="showSuccessMsg"
                                @dismissed="showSuccessMsg=false"
                            >
                                {{successMsg}}
                            </b-alert>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <p>Share the meeting url with your team member :)</p>
                            <a :href="this.meetingUrl">{{"https://cretro.io/retrospective/meeting/" + this.meetingUrl}}</a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="form-group">
                                <button class="btn btn-lg btn-block cretroBtn" v-on:click="goToMeeting()">
                                    Go to meeting <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    const dict = {
        custom: {
            teamName: {
                required: "This field is required.",
            },
            attendeeNo: {
                required: "This field is required.",
                numeric: "This field must be number.",
                max_value: "Number of attendees can not exceed 20."
            },

            maxVote: {
                required: "This field is required.",
                numeric: "This field must be number.",
                min: "Min. 1 vote"
            }
        }
    };

    export default {
        name: "setup_meeting",
        components: {},
        data() {
            return {
                showErrorMsg: false,
                errorMsg: '',
                sprintName: '',
                teamName: '',
                attendeeNo: null,
                maxVote: null,
                meetingCreated: false,
                showSuccessMsg: false,
                successMsg: '',
                meetingUrl: ''
            };
        },
        methods: {
            create: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        this.showErrorMsg = false;
                        let data = {
                            sprintName: this.sprintName,
                            teamName: this.teamName,
                            attendeeNo: this.attendeeNo,
                            maxVote: this.maxVote
                        };
                        this.$http.post('retrospective/meeting/create', data).then(function (res) {
                            if (res.ok) {
                                this.meetingCreated = true;
                                this.showSuccessMsg = true;
                                this.successMsg = "Team " + this.teamName + "'s retrospective meeting is ready!"
                                this.meetingUrl = res.body;
                            }
                        }).catch(function (res) {
                            this.errorMsg = res.body.message;
                            this.showErrorMsg = true;
                        });
                    }
                });
            },

            goToMeeting: function () {
                this.$router.push(this.meetingUrl);
            },

        },
        created: function () {
            // enable custom validation message
            this.$validator.localize('en', dict);
        },
    };
</script>

<style>
    .cretroBtn {
        background: #5777ba;
        color: #fff;
        border-radius: 50px;
        padding: 10px 25px;
    }

    .cretroBtn:hover {
        background: #748ec6;
        color: #fff;
    }

    .input_high {
        line-height: 2;
        height: auto;
    }

    .other_half {
        border-left: 1px slategray solid;
        background-image: url('https://c1.sfdcstatic.com/content/dam/blogs/ca/Blog%20Posts/shake-up-sales-meeting-og.jpg');
    }

</style>
