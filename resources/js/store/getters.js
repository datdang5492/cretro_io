let getters = {
    items: state => {
        return state.items;
    },

    attendees: state => {
        return state.attendees;
    },

    error: state => {
        return state.error;
    }

};

export default getters
