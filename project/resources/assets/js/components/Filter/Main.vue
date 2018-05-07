<template>
  <aside class="text-sm">
    <form class="text-grey-darkest" @submit.prevent="MERGE_FILTERS(filtered())">
      <filter-field class="h-8 border rounded items-center pl-4 pr-8" row>
        <input type="text" placeholder="Search by title" class="rounded w-full" v-model="values.query">
        <button type="submit" class="-mr-4">
          <i class="fa fa-search text-grey"></i>
        </button>
      </filter-field>

      <filter-field :title="field.name" :key="field.id" v-for="field in current.fields">
        <div class="flex h-8" v-if="field.type === 'range'">
          <input class="w-full border px-2 rounded-tl rounded-bl" type="number" placeholder="From" v-model="values.filters[field.id].from">
          <input class="w-full border border-l-0 px-2 rounded-tr rounded-br" type="number" placeholder="To" v-model="values.filters[field.id].to">
        </div>

        <label :key="option" v-for="(option, index) in field.options" v-else>
          <input class="mr-1" :class="{ 'mt-3': index != 0 }" type="checkbox" :value="option" v-model="values.filters[field.id]">
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
            :to="{ name: 'home.index', params: { categorySlug: category.slug } }"
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
      ...mapState('category', [
        'list',
      ]),

      ...mapGetters('category', [
        'current',
      ]),

      values () {
        this.filters = {
          filters: {},
          query: this.filters.query,
        };

        if (this.current && this.current.fields) {
          this.current.fields.forEach(field =>
            this.filters.filters[field.id] = field.type === 'range'
              ? {
                from: '',
                to: '',
              } : []
          );
        }

        return this.filters;
      },
    },

    beforeRouteEnter (to, from, next) {
      next(self =>
        self.loadCategories(self.categorySlug)
          .then(() => self.CHANGE_CATEGORY(self.categorySlug))
      );
    },

    beforeRouteUpdate (to, from, next) {
      this.CHANGE_CATEGORY(to.params.categorySlug);

      next();
    },

    methods: {

      /**
       * Ugly as fuck, but you can understand it.
       */
      filtered () {
        const filters = this.filters.filters;
        const filtered = {};

        if (this.filters.query) {
          filtered.query = this.filters.query;
        }

        filtered.filters = Object.keys(filters)
          .reduce((obj, key) => {
            const value = filters[key];

            if (typeof value === 'string' && value) {
              obj[key] = value;
            }

            if (Array.isArray(value) && value.length) {
              obj[key] = value;
            }

            if (value.from || value.to) {
              obj[key] = {};
            }

            if (value.from) {
              obj[key].from = value.from;
            }

            if (value.to) {
              obj[key].to = value.to;
            }

            return obj;
          }, {});

        return filtered;
      },

      ...mapMutations('filter', [
        'MERGE_FILTERS',
      ]),

      ...mapMutations('category', [
        'CHANGE_CATEGORY',
      ]),

      ...mapActions('category', [
        'loadCategories',
      ]),
    },
  };
</script>
