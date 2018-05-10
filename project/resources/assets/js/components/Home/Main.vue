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

    <article>
      <home-list />
    </article>
  </section>
</template>

<script>
  import HomeList from './List';
  import HomeDropdown from './Dropdown';
  import { mapGetters, mapState, mapActions } from 'vuex';

  export default {
    components: {
      HomeList,
      HomeDropdown,
    },

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
        this.fetchAdvertisements();
      },
    },

    created () {
      this.fetchAdvertisements();
    },

    methods: {
      ...mapActions('advertisement', [
        'fetchAdvertisements',
      ]),
    },
  };
</script>
