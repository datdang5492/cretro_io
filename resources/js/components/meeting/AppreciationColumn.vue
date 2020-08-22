<template>
    <div class="col-lg-3">
        <div class="card text-white bg-success mb-3" v-for="(appreciation, index) in appreciations">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="card-text">
                            <b-badge pill variant="light">{{index+1}}</b-badge>
                            {{appreciation.content}}
                        </p>
                    </div>
                </div>
                <div class="row text-right mt-3">
                    <div class="col-lg-6 text-left">
                        <button type="button"
                                v-if="shouldThisBtnBeShown(appreciation.author, attendeeId)"
                                class="btn btn-outline-light btn-sm"
                                v-on:click="removeAppreciation(appreciation.id, appreciation.author, attendeeId)">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <button type="button"
                                v-if="shouldThisBtnBeShown(appreciation.author, attendeeId)"
                                v-on:click="showEditOvl(appreciations[index].content, index, appreciation.id, appreciation.author, attendeeId)"
                                class="btn btn-outline-light btn-sm">
                            <i class="far fa-edit"></i>
                        </button>
                    </div>
                    <div class="col-lg-6 text-right">
                        <button type="button"
                                v-bind:class="getVotedClass(appreciation.isVoted)"
                                class="btn btn-outline-light btn-sm"
                                v-on:click="voteAppreciation(index, appreciation.id, appreciation.isVoted)">
                            <img src="https://img.icons8.com/dusk/20/000000/facebook-like.png"/>
                            <strong>
                                <b-badge pill variant="light" class="text-tiny">{{appreciation.vote}}
                                </b-badge>
                            </strong>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <b-modal ref="edit_ovl" centered title="Edit" no-close-on-backdrop @ok="saveInputAppreciation(appreciation.author, attendeeId)">
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
</template>

<script>
    const dict = {
        custom: {
            appreciationInput: {
                required: "This field is required.",
            }
        }
    };

    export default {
        name: "appreciation-column",
        components: {},
        props: {
            appreciations: Array,
            meetingId: String,
            attendeeId: String,
        },
        data() {
            return {
                ovlContent: '',
                ovlContentIndex: 0,
                ovlItemId: 0,
                appreciateItemValue: 3
            };
        },
        methods: {
            shouldThisBtnBeShown: function (authorId, attendeeId) {
                return authorId === attendeeId;
            },

            getVotedClass: function (isVoted) {
                return isVoted === true ? 'voted' : '';
            },

            showEditOvl: function (content, index, itemId, authorId, attendeeId) {

                if (authorId !== attendeeId) {
                    this.$store.dispatch("ADD_ERROR", "Only the author of this ticket can update it!");
                    return;
                }

                this.ovlContent = content;
                this.ovlContentIndex = index;
                this.ovlItemId = itemId;
                this.$refs['edit_ovl'].show()
            },

            saveInputAppreciation: function (authorId, attendeeId) {

                if (authorId !== attendeeId) {
                    this.$store.dispatch("ADD_ERROR", "Only the author of this ticket can update it!");
                    return;
                }

                let data = {
                    itemId: this.ovlItemId,
                    attendeeId: this.attendeeId,
                    type: this.appreciateItemValue,
                    content: this.ovlContent,
                    meetingId: this.meetingId
                };

                this.$store.dispatch('EDIT_ITEM_CONTENT', data).then(res => {
                    if (res.status === 200) {
                        this.appreciations[this.ovlContentIndex].content = this.ovlContent;
                    }
                }).catch(err => {
                    this.$store.dispatch("ADD_ERROR", err.response.data.message);
                });
            },

            removeAppreciation: function (id, authorId, attendeeId) {

                if (authorId !== attendeeId) {
                    this.$store.dispatch("ADD_ERROR", "Only the author of this ticket can delete it!");
                    return;
                }

                this.$bvModal.msgBoxConfirm('Are you sure removing this sticker?', {
                    centered: true
                }).then(value => {
                    if (value === true) {
                        let data = {
                            itemId: id,
                            attendeeId: this.attendeeId,
                            type: this.appreciateItemValue,
                            meetingId: this.meetingId,
                        };

                        this.$store.dispatch('REMOVE_ITEM', data).then(res => {
                            if (res.status === 200) {

                            }
                        }).catch(err => {
                            this.$store.dispatch("ADD_ERROR", err.response.data.message);
                        });
                    }
                }).catch(err => {
                    this.$store.dispatch("ADD_ERROR", err.response.data.message);
                })
            },

            voteAppreciation: function (index, id, voteValue) {
                if (voteValue === false) {
                    voteValue = true;
                } else {
                    voteValue = false;
                }

                let data = {
                    itemId: id,
                    attendeeId: this.attendeeId,
                    voteValue: voteValue,
                    type: this.appreciateItemValue,
                    meetingId: this.meetingId,
                    isVoted: voteValue
                };

                this.$store.dispatch('VOTE_ITEM', data).then(res => {
                    if (res.status === 200) {
                        this.appreciations[index].isVoted = voteValue;
                    }
                }).catch(err => {
                    this.$store.dispatch("ADD_ERROR", err.response.data.message);
                });
            },
        },
        created: function () {
            this.$validator.localize('en', dict);
        }
    }
    ;
</script>

<style scoped>
</style>
