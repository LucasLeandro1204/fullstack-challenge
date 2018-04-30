<template>
  <li class="relative">
    <a class="text-black text-xs" href="#" @click="dropdown = ! dropdown">
      <span class="text-base" v-text="selected.name"></span> <i class="fa fa-chevron-down"></i>
    </a>
    <ul class="list-reset absolute bg-white shadow mt-2 w-32 pin-r p-2" v-if="dropdown">
      <li :key="i" v-for="(option, i) in options">
        <a
          href="#"
          class="py-1 block hover:text-black text-sm"
          :class="index == i ? 'text-black' : 'text-grey-dark'"
          @click.prevent="select(i)"
          v-text="option.name"></a>
      </li>
    </ul>
  </li>
</template>

<script>
  export default {
    computed: {
      filters () {
        return this.$route.query.filters || {};
      },

      selected () {
        return this.options[this.index];
      },

      options () {
        return [
          {
            name: 'Latest',
            field: 'created_at',
            sorted: 'asc',
          },
          {
            name: 'Oldest',
            field: 'created_at',
            sorted: 'desc',
          },
          {
            name: 'Price High',
            field: 'price',
            sorted: 'asc',
          },
          {
            name: 'Price Low',
            field: 'price',
            sorted: 'desc',
          },
        ];
      },
    },

    data () {
      return {
        index: 0,
        dropdown: false,
      };
    },

    created () {
      const filters = this.$route.query.filters;

      if (filters && filters.order_by) {
        const index = this.options.findIndex(
          option => option.field == filters.order_by.field && option.sorted == filters.order_by.sorted
        );

        this.index = index == -1 ? 0 : index;
      }
    },

    methods: {
      select (index) {
        this.index = index;
        this.$router.push({
          query: {
            filters: Object.assign({}, this.filters, {
              order_by: {
                field: this.selected.field,
                sorted: this.selected.sorted,
              },
            }),
          },
        });
        this.dropdown = false;
      },
    },
  };
</script>
