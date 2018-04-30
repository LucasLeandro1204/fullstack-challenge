<template>
  <aside class="text-sm">
    <form class="text-grey-darkest" @submit.prevent="submit">
      <filter-field class="h-8 border rounded items-center pl-4 pr-8" row>
        <input type="text" placeholder="Search" class="rounded w-full" v-model="values.query">
        <button type="submit" class="-mr-4">
          <i class="fa fa-search text-grey"></i>
        </button>
      </filter-field>

      <filter-field :title="field.name" :key="field.id" v-for="field in current.fields">
        <div class="flex h-8" v-if="field.type === 'range'">
          <input class="w-full border px-2 rounded-tl rounded-bl" type="number" placeholder="From" v-model="values[field.id].from">
          <input class="w-full border border-l-0 px-2 rounded-tr rounded-br" type="number" placeholder="To" v-model="values[field.id].to">
        </div>

        <label :key="option" v-for="(option, index) in field.options" v-else>
          <input class="mr-1" :class="{ 'mt-3': index != 0 }" type="checkbox" :value="option" v-model="values[field.id]">
          {{ option }}
        </label>
      </filter-field>

      <filter-field v-if="current.fields">
        <button type="submit" class="h-8 w-full bg-blue text-white rounded">Search</button>
      </filter-field>
    </form>

    <filter-field title="Categories">
      <ul class="list-reset" v-if="list.length">
        <li :key="category.id" v-for="category in list">
          <router-link
            :to="{ name: 'home.index', params: { categorySlug: category.slug }, query }"
            class="text-grey-darkest block p-1 -mx-1 my-1 hover:bg-grey-lightest rounded"
            :class="{ 'bg-grey-lightest': categorySlug === category.slug }" >
            <span class="float-right text-grey" v-text="category.advertisements"></span>
            {{ category.name }}
          </router-link>
        </li>
      </ul>
    </filter-field>
  </aside>
</template>

<script>
  import FilterField from './Field.vue';
  import { mapActions, mapGetters, mapState, mapMutations } from 'vuex';

  export default {
    components: {
      FilterField,
    },

    props: {
      categorySlug: {
        type: String,
      },
    },

    data () {
      return {
        filters: {},
      };
    },

    computed: {
      values () {
        const filters = this.filters;

        if (! this.current.fields) {
          return filters;
        }

        this.current.fields.forEach(({ id, type }) => {
          if (filters[id]) {
            return;
          }

          if (type == 'range') {
            filters[id] = {
              from: null,
              to: null,
            };
          } else {
            filters[id] = [];
          }
        });

        return filters;
      },

      query () {
        return {
          filters: {
            query: this.filters.query,
          },
        };
      },

      ...mapState('category', [
        'list',
      ]),

      ...mapGetters('category', [
        'current',
      ]),
    },

    beforeRouteEnter (to, from, next) {
      next(self =>
        self.loadCategories(self.categorySlug)
          .then(() => self.CHANGE_CATEGORY(self.categorySlug))
          .then(() => self.filters = self.$route.query.filters || {})
      );
    },

    beforeRouteUpdate (to, from, next) {
      this.CHANGE_CATEGORY(to.params.categorySlug);

      next();
    },

    methods: {
      submit () {
        this.$router.push({}); // ?
        this.$router.push({ query: { filters: this.filters } });
      },

      ...mapMutations('category', [
        'CHANGE_CATEGORY',
      ]),

      ...mapActions('category', [
        'loadCategories',
      ]),
    },
  };
</script>
