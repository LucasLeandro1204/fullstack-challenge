import Axios from 'core/axios';

const state = {
  list: null,
  paginate: {},
};

const mutations = {
  'SET_ADVERTISEMENTS' (state, advertisements) {
    state.list = advertisements;
  },

  'CHANGE_CATEGORY' (state, slug) {
    state.current = state.list.findIndex(category => category.slug == slug);
  },
};

const actions = {
  fetchAdvertisements ({ commit, rootState, rootGetters }) {
    const params = Object.assign({}, rootState.filter.filters);
    const category = rootGetters['category/current'];

    if (category.id) {
      params.category = category.id;
    }

    commit('SET_ADVERTISEMENTS', null);

    return Axios.get('advertisement', {
        params,
      })
      .then(({ data }) => {
        commit('SET_ADVERTISEMENTS', data.data);
      })
      .catch(() => {});
  },
};

export default {
  state,
  actions,
  mutations,
  namespaced: true,
};
