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
    }
};

export default mutations
