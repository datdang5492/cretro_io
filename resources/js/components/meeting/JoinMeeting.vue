<template>
    <div class="container-fluid meeting min-height-normal">
        <div class="row mt-5">
            <div class="col-lg-6 other_half min-height-normal"></div>

            <div class="col-lg-6">
                <div class="row mt-7">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <h4 class="text-center font-weight-bold">
                                    <a href="/">Cretro.io</a>
                                </h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h4>Join meeting</h4>
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
                                    <p class="text-danger" v-if="errors.has('meetingCode')">
                                        {{errors.first('meetingCode')}}
                                    </p>
                                    <input type="text"
                                           name="meetingCode"
                                           v-model="meetingCode"
                                           v-validate="'required'"
                                           class="form-control input_high"
                                           placeholder="Enter meeting code">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <p class="text-danger" v-if="errors.has('userName')">
                                        {{errors.first('userName')}}
                                    </p>
                                    <input type="text"
                                           name="userName"
                                           v-model="userName"
                                           v-validate="'required|alpha'"
                                           class="form-control input_high"
                                           placeholder="Enter your name">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-block cretroBtn" v-on:click="joinMeeting()">Join
                                    </button>
                                </div>
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
            meetingCode: {
                required: "Meeting code is required. Ask your meeting organizer (scrum master) for it :).",
            },
            userName: {
                required: "Hello, what 's your name?",
                alpha: "Heyo, first name only would be ok. Please enter only alphabetic characters :)."
            },
        }
    };

    export default {
        name: "join_meeting",
        components: {},
        data() {
            return {
                meetingCode: '',
                userName: '',
                showErrorMsg: false,
                errorMsg: '',
            };
        },
        methods: {
            joinMeeting: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        this.showErrorMsg = false;
                        let data = {
                            meetingCode: this.meetingCode,
                            userName: this.userName
                        };

                        this.$store.dispatch('ATTENDEE_JOINED', data).then(res => {
                            if (res.status === 200) {
                                this.$storage.set('attendeeData', {
                                    name: this.userName,
                                    meetingCode: this.meetingCode,
                                    attendeeCode: res.data.attendeeId
                                });


                                // saving to local storage seem take time
                                // redirect to meeting page
                                if (this.$storage.get('attendeeData') !== undefined) {
                                    this.$router.push(res.data.meetingId);
                                }
                            }
                        }).catch(err => {
                            this.errorMsg = err.response.data.message;
                            this.showErrorMsg = true;
                        });
                    }
                });
            },
        },
        created: function () {
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
