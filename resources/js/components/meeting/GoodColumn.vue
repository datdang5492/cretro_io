<template>
    <div class="col-lg-3">
        <div class="card text-white bg-info mb-3" v-for="(good, index) in goods">
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
                                v-on:click="removeGood(good.id)">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <button type="button" v-on:click="showEditOvl(goods[index].content, index, good.id)"
                                class="btn btn-outline-light btn-sm">
                            <i class="far fa-edit"></i>
                        </button>
                    </div>
                    <div class="col-lg-6 text-right">
                        <button type="button"
                                v-bind:class="getVotedClass(good.isVoted)"
                                class="btn btn-outline-light btn-sm"
                                v-on:click="voteGood(index, good.id, good.isVoted)">
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
</template>

<script>
    const dict = {
        custom: {
            goodInput: {
                required: "This field is required.",
            }
        }
    };

    export default {
        name: "good-column",
        components: {},
        props: {
            goods: Array,
            meetingId: String
        },
        data() {
            return {
                ovlContent: '',
                ovlContentIndex: 0,
                ovlItemId: 0,
                goodItemValue: 0
            };
        },
        methods: {
            getVotedClass: function (isVoted) {
                return isVoted === true ? 'voted' : '';
            },
            showEditOvl: function (content, index, itemId) {
                this.ovlContent = content;
                this.ovlContentIndex = index;
                this.ovlItemId = itemId;
                this.$refs['edit_ovl'].show()
            },

            saveInputGood: function () {
                let data = {
                    itemId: this.ovlItemId,
                    attendeeId: 'attendee_id',
                    type: this.goodItemValue,
                    content: this.ovlContent,
                    meetingId: this.meetingId
                };

                this.$store.dispatch('EDIT_ITEM_CONTENT', data).then(res => {
                    if (res.status === 200) {
                        this.goods[this.ovlContentIndex].content = this.ovlContent;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },

            removeGood: function (id) {
                this.$bvModal.msgBoxConfirm('Are you sure removing this sticker?', {
                    centered: true
                }).then(value => {
                    if (value === true) {
                        let data = {
                            itemId: id,
                            attendeeId: 'attendee_id',
                            type: this.goodItemValue,
                            meetingId: this.meetingId,
                        };

                        this.$store.dispatch('REMOVE_ITEM', data).then(res => {
                            if (res.status === 200) {

                            }
                        }).catch(err => {
                            console.log(err);
                        });
                    }
                }).catch(err => {
                    console.log(res);
                })
            },

            voteGood: function (index, id, voteValue) {
                if (voteValue === false) {
                    voteValue = true;
                } else {
                    voteValue = false;
                }

                let data = {
                    itemId: id,
                    attendeeId: 'attendee_id',
                    voteValue: voteValue,
                    type: this.goodItemValue,
                    meetingId: this.meetingId,
                    isVoted: voteValue
                };

                this.$store.dispatch('VOTE_ITEM', data).then(res => {
                    if (res.status === 200) {
                        this.goods[index].isVoted = voteValue;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },

        },
        created: function () {
            this.$validator.localize('en', dict);
        },
    };
</script>

<style scoped>
</style>
