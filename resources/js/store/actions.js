let actions = {
    ADD_ITEM({commit}, item) {
        return new Promise((resolve, reject) => {
            axios.post(`/retrospective/meeting/item/add`, item).then(res => {
                resolve(res);
            }).catch(err => {
                reject(err);
            })
        })
    },

    EDIT_ITEM_CONTENT({commit}, itemData) {
        return new Promise((resolve, reject) => {
            axios.post(`/retrospective/meeting/item/edit`, itemData).then(res => {
                resolve(res);
            }).catch(err => {
                reject(err);
            })
        })
    },

    VOTE_ITEM({commit}, itemData) {
        return new Promise((resolve, reject) => {
            axios.post(`/retrospective/meeting/item/vote`, itemData).then(res => {
                resolve(res);
            }).catch(err => {
                reject(err);
            })
        })
    },

    REMOVE_ITEM({commit}, itemData) {
        return new Promise((resolve, reject) => {
            axios.post(`/retrospective/meeting/item/remove`, itemData).then(res => {
                resolve(res);
            }).catch(err => {
                reject(err);
            })
        })
    },


    GET_ITEMS({commit}, req) {
        axios.post('/retrospective/meeting/item/fetch', req).then(res => {
            {
                commit('GET_ITEMS', res.data);
            }
        }).catch(err => {
            console.log(err);
        })
    },

    GET_ATTENDEES({commit}, req) {
        axios.post('/retrospective/meeting/attendee/get-list', req).then(res => {
            {
                commit('GET_ATTENDEES', res.data);
            }
        }).catch(err => {
            console.log(err);
        })
    },

    ATTENDEE_JOINED({commit}, attendee) {
        return new Promise((resolve, reject) => {
            axios.post(`/retrospective/meeting/attendee/join`, attendee).then(res => {
                resolve(res);
            }).catch(err => {
                reject(err);
            })
        })
    },

    ATTENDEE_LEFT({commit}, attendee) {
        return new Promise((resolve, reject) => {
            axios.post(`/retrospective/meeting/attendee/leave`, attendee).then(res => {
                resolve(res);
            }).catch(err => {
                reject(err);
            })
        })
    },

    ADD_ERROR({commit}, errorMsg) {
        commit('ADD_ERROR', errorMsg);
    },

};

export default actions
