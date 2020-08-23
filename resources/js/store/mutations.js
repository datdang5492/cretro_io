const GOOD_ITEM = 0;
const BAD_ITEM = 1;
const IDEA_ITEM = 2;
const APPRECIATION_ITEM = 3;

let mutations = {

    GET_ATTENDEES(state, attendees) {
        if (attendees.length === 0) {
            attendees = [];
        }
        state.attendees = attendees;
    },

    ATTENDEE_JOINED(state, attendee) {
        state.attendees = [...state.attendees, attendee];
    },

    ATTENDEE_LEFT(state, attendee) {

    },

    GET_ITEMS(state, items) {
        if (items.length === 0) {
            items = {
                goods: [],
                bads: [],
                ideas: [],
                appreciations: [],
            }
        }

        state.items = items;
    },

    ADD_ITEM(state, item) {
        if (item.type === GOOD_ITEM) {
            state.items.goods = [...state.items.goods, item];
        }

        if (item.type === BAD_ITEM) {
            state.items.bads = [...state.items.bads, item];
        }

        if (item.type === IDEA_ITEM) {
            state.items.ideas = [...state.items.ideas, item];
        }

        if (item.type === APPRECIATION_ITEM) {
            state.items.appreciations = [...state.items.appreciations, item];
        }
    },

    EDIT_ITEM_CONTENT(state, item) {
        if (item.type === GOOD_ITEM) {
            let foundIndex = state.items.goods.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.goods[foundIndex] !== undefined) {
                state.items.goods[foundIndex].content = item.content;
            }
        }

        if (item.type === BAD_ITEM) {
            let foundIndex = state.items.bads.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.bads[foundIndex] !== undefined) {
                state.items.bads[foundIndex].content = item.content;
            }
        }

        if (item.type === IDEA_ITEM) {
            let foundIndex = state.items.ideas.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.ideas[foundIndex] !== undefined) {
                state.items.ideas[foundIndex].content = item.content;
            }
        }

        if (item.type === APPRECIATION_ITEM) {
            let foundIndex = state.items.appreciations.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.appreciations[foundIndex] !== undefined) {
                state.items.appreciations[foundIndex].content = item.content;
            }
        }
    },

    VOTE_ITEM(state, item) {
        if (item.type === GOOD_ITEM) {
            let foundIndex = state.items.goods.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.goods[foundIndex] !== undefined) {
                state.items.goods[foundIndex].vote = item.vote;
            }
        }

        if (item.type === BAD_ITEM) {
            let foundIndex = state.items.bads.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.bads[foundIndex] !== undefined) {
                state.items.bads[foundIndex].vote = item.vote;
            }
        }

        if (item.type === IDEA_ITEM) {
            let foundIndex = state.items.ideas.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.ideas[foundIndex] !== undefined) {
                state.items.ideas[foundIndex].vote = item.vote;
            }
        }

        if (item.type === APPRECIATION_ITEM) {
            let foundIndex = state.items.appreciations.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.appreciations[foundIndex] !== undefined) {
                state.items.appreciations[foundIndex].vote = item.vote;
            }
        }
    },

    REMOVE_ITEM(state, item) {
        if (item.type === GOOD_ITEM) {
            let foundIndex = state.items.goods.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });


            if (state.items.goods[foundIndex] !== undefined) {
                state.items.goods.splice(foundIndex, 1);
            }
        }

        if (item.type === BAD_ITEM) {
            let foundIndex = state.items.bads.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.bads[foundIndex] !== undefined) {
                state.items.bads.splice(foundIndex, 1);
            }
        }

        if (item.type === IDEA_ITEM) {
            let foundIndex = state.items.ideas.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.ideas[foundIndex] !== undefined) {
                state.items.ideas.splice(foundIndex, 1);
            }
        }

        if (item.type === APPRECIATION_ITEM) {
            let foundIndex = state.items.appreciations.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.appreciations[foundIndex] !== undefined) {
                state.items.appreciations.splice(foundIndex, 1);
            }
        }
    },

    ADD_ERROR(state, errorMsg) {
        state.error = errorMsg;
    }
};

export default mutations
