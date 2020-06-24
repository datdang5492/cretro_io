<template>
    <div class="min-height-normal profile main_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 offset-lg-2">
                    <b-list-group>
                        <router-link to="/my-profile/information">
                            <b-list-group-item v-on:click="setActiveTab(0)"
                                               v-bind:active="this.activeTab == 'profile_setting'"
                                               variant="light">
                                Basic Information
                            </b-list-group-item>
                        </router-link>

                        <router-link to="/my-profile/meetings">
                            <b-list-group-item v-on:click="setActiveTab(1)"
                                               v-bind:active="this.activeTab == 'meeting'"
                                               variant="light">
                                My meetings
                            </b-list-group-item>
                        </router-link>

                        <router-link to="/my-profile/subscription">
                            <b-list-group-item v-on:click="setActiveTab(2)"
                                               v-bind:active="this.activeTab == 'subscription'"
                                               variant="light">
                                Subscription Plan
                            </b-list-group-item>
                        </router-link>

                        <router-link to="/my-profile/change-password">
                            <b-list-group-item v-on:click="setActiveTab(3)"
                                               v-bind:active="this.activeTab == 'change_password'"
                                               variant="light">
                                Change password
                            </b-list-group-item>
                        </router-link>
                    </b-list-group>
                </div>
                <router-view v-on:activeTabTriggered="setActiveTab($event)"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "profile",
        components: {},
        data() {
            return {
                activeTab: 0
            };
        },
        methods: {
            setActiveTab: function (tabNo) {
                this.activeTab = tabNo;
            }
        },
        created: function () {

        }
    };
</script>

<style>
</style>
