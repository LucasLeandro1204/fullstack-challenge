const state = {
  filters: {},
};

const getters = {
   query: ({ filters }) => {

    return {
      query: {
        filters,
      },
    };
   },
};

const mutations = {
  'MERGE_FILTERS' (state, filters) {
    state.filters = Object.assign({}, state.filters, filters);
  },
};

export default {
  state,
  getters,
  mutations,
  namespaced: true,
};
