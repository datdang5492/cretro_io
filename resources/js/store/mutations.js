let mutations = {
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
        if (item.type === 0) {
            state.items.goods = [...state.items.goods, item];
        }

        if (item.type === 1) {
            state.items.bads = [...state.items.bads, item];
        }

        if (item.type === 2) {
            state.items.ideas = [...state.items.ideas, item];
        }

        if (item.type === 3) {
            state.items.appreciations = [...state.items.appreciations, item];
        }
    },

    EDIT_ITEM_CONTENT(state, item) {
        if (item.type === 0) {
            let foundIndex = state.items.goods.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.goods[foundIndex] !== undefined) {
                state.items.goods[foundIndex].content = item.content;
            }
        }

        if (item.type === 1) {
            let foundIndex = state.items.bads.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.bads[foundIndex] !== undefined) {
                state.items.bads[foundIndex].content = item.content;
            }
        }

        if (item.type === 2) {
            let foundIndex = state.items.ideas.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.ideas[foundIndex] !== undefined) {
                state.items.ideas[foundIndex].content = item.content;
            }
        }

        if (item.type === 3) {
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
        if (item.type === 0) {
            let foundIndex = state.items.goods.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.goods[foundIndex] !== undefined) {
                state.items.goods[foundIndex].vote = item.vote;
            }
        }

        if (item.type === 1) {
            let foundIndex = state.items.bads.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.bads[foundIndex] !== undefined) {
                state.items.bads[foundIndex].vote = item.vote;
            }
        }

        if (item.type === 2) {
            let foundIndex = state.items.ideas.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.ideas[foundIndex] !== undefined) {
                state.items.ideas[foundIndex].vote = item.vote;
            }
        }

        if (item.type === 3) {
            let foundIndex = state.items.appreciations.findIndex(function (ticket) {
                if (ticket.id === item.id)
                    return true;
            });

            if (state.items.appreciations[foundIndex] !== undefined) {
                state.items.appreciations[foundIndex].vote = item.vote;
            }
        }
    },
};

export default mutations
