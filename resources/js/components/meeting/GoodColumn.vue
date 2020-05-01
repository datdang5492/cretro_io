<template>
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
                                v-bind:class="getVotedClass(good.isVoted)"
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
</template>

<script>
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
        name: "good-column",
        components: {},
        props: {
            goods: Array,
        },
        data() {
            return {
                ovlContent: '',
                ovlContentIndex: 0,
            };
        },
        methods: {
            getVotedClass: function (isVoted) {
                return isVoted === true ? 'voted' : '';
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

        },
        created: function () {
            this.$validator.localize('en', dict);
        },
    };
</script>

<style scoped>
</style>
