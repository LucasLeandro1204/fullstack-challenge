<template>
  <section>
    <header class="mb-8 border-b">
      <nav>
        <ul class="list-reset h-8 flex items-center">
          <li>
            <router-link :to="{ name: 'home.index' }">
              <h1 class="font-thin text-xl text-black">All</h1>
            </router-link>
          </li>
          <li class="ml-2" v-if="current.name">
            <router-link :to="{ name: 'home.index', params: { currentSlug: current.slug } }">
              <h1 class="font-thin text-xl text-black">> {{ current.name }}</h1>
            </router-link>
          </li>

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
