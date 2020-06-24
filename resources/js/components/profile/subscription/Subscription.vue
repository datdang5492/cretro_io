<template>
    <div class="col-lg-5">
        subscription
    </div>
</template>

<script>
    export default {
        name: "subscription",
        components: {},
        data() {
            return {
                meetings: [],
            };
        },
        methods: {
            getMeetingList: function () {
                this.$http.post('profile/get-meeting-list').then(function (res) {
                    if (res.ok) {
                        this.meetings = res.body;
                    }
                }).catch(function (res) {
                    console.log(res);
                });
            },
        },
        created: function () {
            this.$emit('activeTabTriggered', 'subscription');
            // this.getMeetingList();
        }
    };
</script>

<style scoped>



</style>
