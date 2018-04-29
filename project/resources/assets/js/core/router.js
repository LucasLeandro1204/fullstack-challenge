import Vue from 'vue';
import VueRouter from 'vue-router';
import { stringify, parse } from 'qs';

import Home from '@/Home/Main.vue';
import Filter from '@/Filter/Main.vue';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  parseQuery: parse,
  stringifyQuery: query => stringify(query, { arrayFormat: 'brackets', encode: false }),
  routes: [
    {
      path: '/:categorySlug?',
      components: {
        default: Home,
        sidebar: Filter,
      },
      props: {
        sidebar: true,
      },
      name: 'home.index',
    },
  ],
});
