<template>
  <aside class="text-sm">
    <form class="text-grey-darkest" @submit.prevent="update">
      <filter-field class="h-8 border rounded items-center pl-4 pr-8" row>
        <input type="text" placeholder="Search" class="rounded w-full" v-model="filters.query ">
        <button type="submit" class="-mr-4">
          <i class="fa fa-search text-grey"></i>
        </button>
      </filter-field>

      <filter-field :title="field.name" :key="field.id" v-for="field in current.fields">
        <div class="flex h-8" v-if="field.type === 'range'">
          <input class="w-full border px-2 rounded-tl rounded-bl" type="number" placeholder="From" v-model="filters[field.id].from">
          <input class="w-full border border-l-0 px-2 rounded-tr rounded-br" type="number" placeholder="To" v-model="filters[field.id].to">
        </div>

        <label :key="option" v-for="(option, index) in field.options" v-else>
          <input class="mr-1" :class="{ 'mt-3': index != 0 }" type="checkbox" :value="option" v-model="filters[field.id]">
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

  const FILTER_KEY = '?filters';

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
      query () {
        return { [FILTER_KEY]: this.filters };
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
          .then(() => self.reset())
          .then(() => self.filters = self.$route.query.filters || {})
      );
    },

    beforeRouteUpdate (to, from, next) {
      this.CHANGE_CATEGORY(to.params.categorySlug);

      if (! to.query[FILTER_KEY]) {
        to.query[FILTER_KEY] = this.filters;
      }

      next();
    },

    methods: {
      reset () {
        if (! this.current.fields) {
          this.filters = {};

          return;
        }

        this.filters = this.current.fields.reduce((pr, field) => {
          if (field.type === 'range') {
            pr[field.id] = {
              to: 0,
              from: 0,
            };
          } else {
            pr[field.id] = [];
          }

          return pr;
        }, {});

        console.log(this.filters, this.current.fields);
      },

      update () {
        this.$router.push({ query: this.query });
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
