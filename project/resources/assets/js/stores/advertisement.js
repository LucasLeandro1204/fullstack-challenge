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
    const params = Object.assign({}, rootState.filter.filters, this.paginate);
    const category = rootGetters['category/current'];

    if (category.id) {
      params.category = category.id;
    }

    commit('SET_ADVERTISEMENTS', null);

    const promise = Axios.get('advertisement', {
      params,
    });
    const timeout = new Promise((resolve) => setTimeout(resolve, 2000));

    Promise.all([promise, timeout])
      .then(([{ data }]) => {
        commit('SET_ADVERTISEMENTS', data.data);
      })
      .catch(console.log);
  },
};

export default {
  state,
  actions,
  mutations,
  namespaced: true,
};
