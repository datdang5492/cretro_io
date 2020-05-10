<template>
    <div class="col-lg-3">
        <div class="card text-white bg-secondary mb-3" v-for="(bad, index) in bads">
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
                                v-on:click="removeBad(bad.id, index)">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <button type="button" v-on:click="showEditOvl(bads[index].content, index, bad.id)"
                                class="btn btn-outline-light btn-sm">
                            <i class="far fa-edit"></i>
                        </button>
                    </div>
                    <div class="col-lg-6 text-right">
                        <button type="button"
                                v-bind:class="getVotedClass(bad.isVoted)"
                                class="btn btn-outline-light btn-sm"
                                v-on:click="voteBad(index, bad.id, bad.isVoted)">
                            <img src="https://img.icons8.com/dusk/20/000000/facebook-like.png"/>
                            <strong>
                                <b-badge pill variant="light" class="text-tiny">{{bad.vote}}
                                </b-badge>
                            </strong>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <b-modal ref="edit_ovl" centered title="Edit" no-close-on-backdrop @ok="saveInputBad()">
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
            badInput: {
                required: "This field is required.",
            },
        }
    };

    export default {
        name: "bad-column",
        components: {},
        props: {
            bads: Array
        },
        data() {
            return {
                ovlContent: '',
                ovlContentIndex: 0,
                ovlItemId: 0

            };
        },
        methods: {
            getVotedClass: function (isVoted) {
                return isVoted === true ? 'voted' : '';
                return isVoted === true ? 'voted' : '';
            },
            showEditOvl: function (content, index, itemId) {
                this.ovlContent = content;
                this.ovlContentIndex = index;
                this.ovlItemId = itemId;
                this.$refs['edit_ovl'].show()
            },

            saveInputBad: function () {
                this.$http.post('retrospective/meeting/item/edit', {
                    itemId: this.ovlItemId,
                    attendeeId: 'attendee_id',
                    content: this.ovlContent
                }).then(function (res) {
                    if (res.ok && res.body === true) {
                        this.bads[this.ovlContentIndex].content = this.ovlContent;
                    }
                }).catch(function (res) {
                    console.log(res);
                });
            },

            removeBad: function (id, index) {
                this.$bvModal.msgBoxConfirm('Are you sure removing this sticker?', {
                    centered: true
                }).then(value => {
                    if (value === true) {
                        this.$http.post('retrospective/meeting/item/remove', {
                            itemId: id,
                            attendeeId: 'attendee_id'
                        }).then(function (res) {
                            if (res.ok) {
                                this.$emit('getRemovedBadItem', index);
                            } else {
                                // todo: show error
                            }
                        }).catch(function (res) {
                            console.log(res);
                        });
                    }
                }).catch(err => {
                    // todo: show error message
                })
            },

            voteBad: function (index, id, voteValue) {
                if (voteValue == false) {
                    voteValue = true;
                } else {
                    voteValue = false;
                }

                this.$http.post('retrospective/meeting/item/vote', {
                    itemId: id,
                    attendeeId: 'attendee_id',
                    voteValue: voteValue
                }).then(function (res) {
                    if (res.ok && res.body === true) {
                        let voteItem = {
                            index: index,
                            value: voteValue
                        };
                        this.$emit('getVotedItem', voteItem);
                    } else {
                        // todo: show error
                    }

                }).catch(function (res) {
                    // todo: show error
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
