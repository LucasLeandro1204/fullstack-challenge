<template>
  <section>
    <header class="mb-8 border-b">
      <nav>
        <ul class="list-reset h-8 flex items-center">
          <li>
            <router-link class="text-black" :to="{ name: 'home.index' }">
              <h1 class="font-thin text-xl">All</h1>
            </router-link>
          </li>

          <template v-if="current.name">
            <li class="ml-2 cursor-default">
              >
            </li>

            <li class="ml-2">
              <a href="#" class="text-black">
                <h1 class="font-thin text-xl" v-text="current.name"></h1>
              </a>
            </li>
          </template>

          <home-dropdown class="ml-auto" />
        </ul>
      </nav>
    </header>
  </section>
</template>

<script>
  import Axios from 'core/axios';
  import HomeDropdown from './Dropdown.vue';
  import { mapGetters, mapState } from 'vuex';

  export default {
    components: {
      HomeDropdown,
    },

    data: () => ({
      advertisements: null,
    }),

    computed: {
      ...mapGetters('category', [
        'current',
      ]),

      ...mapState('filter', [
        'filters',
      ]),
    },

    watch: {
      'filters' () {
        this.fetch();
      },
    },

    created () {
      this.fetch();
    },

    methods: {
      fetch () {
        const params = Object.assign({}, this.filters);

        if (this.current.category) {
          params.category = this.current.id;
        }

        Axios.get('advertisement', {
          params,
        });
      },
    },
  };
</script>
