import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/Home/Main.vue';
import Filter from '@/Filter/Main.vue';

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    {
      path: '/',
      components: {
        default: Home,
        sidebar: Filter,
      },
      name: 'home.index',
    },
  ],
});
