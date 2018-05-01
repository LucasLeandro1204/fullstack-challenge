<template>
  <section>
    <header class="mb-8 border-b">
      <nav>
        <ul class="list-reset h-8 flex items-center">
          <li>
            <router-link CLASS="text-black" :to="{ name: 'home.index', query: $route.query }">
              <h1 class="font-thin text-xl">All</h1>
            </router-link>
          </li>

          <template v-if="current.name">
            <li class="ml-2 cursor-default">></li>

            <li class="ml-2" v-if="current.name">
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
  import { mapGetters } from 'vuex';
  import HomeDropdown from './Dropdown.vue';

  export default {
    components: {
      HomeDropdown,
    },

    computed: {
      ...mapGetters('category', [
        'current',
      ]),
    },
  };
</script>
