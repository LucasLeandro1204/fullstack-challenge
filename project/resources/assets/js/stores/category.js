import Axios from 'core/axios';

const state = {
  list: [],
  current: -1,
};

const getters = {
  current: ({ list, current }) => list[current] || {},
};

const mutations = {
  'SET_CATEGORIES' (state, categories) {
    state.list = categories;
  },

  'CHANGE_CATEGORY' (state, slug) {
    state.current = state.list.findIndex(category => category.slug == slug);
  },
};

const actions = {
  loadCategories ({ commit }) {
    return Axios.get('category')
      .then(({ data }) => {
        commit('SET_CATEGORIES', data.data);
      })
      .catch(() => {});
  },
};

export default {
  state,
  actions,
  getters,
  mutations,
  namespaced: true,
};
