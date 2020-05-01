<template>
    <div class="col-lg-4">
        <div class="card text-white bg-success mb-3" v-for="(idea, index) in ideas">
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
</template>

<script>
    const dict = {
        custom: {
            ideaInput: {
                required: "This field is required.",
            },
        }
    };

    export default {
        name: "idea-column",
        components: {},
        props: {
            ideas: Array
        },
        data() {
            return {
                ovlContent: '',
                ovlContentIndex: 0,
                letShowError: false,
                ideaInput: "",
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

        },
        created: function () {
            this.$validator.localize('en', dict);
        },
    };
</script>

<style scoped>
</style>
