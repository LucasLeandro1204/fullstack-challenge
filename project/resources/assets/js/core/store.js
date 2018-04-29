import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import category from 'stores/category';

export default new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',

  modules: {
    category,
  },
});
