import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import filter from 'stores/filter';
import category from 'stores/category';
import advertisement from 'stores/advertisement';

export default new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',

  modules: {
    filter,
    category,
    advertisement,
  },
});
