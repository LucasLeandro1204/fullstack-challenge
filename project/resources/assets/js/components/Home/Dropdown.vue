<template>
  <li class="relative font-thin ">
    <a class="text-black text-xs" href="#" @click="dropdown = ! dropdown">
      <span class="text-base" v-text="selected.name"></span> <i class="fa fa-chevron-down"></i>
    </a>
    <ul class="list-reset absolute bg-white shadow mt-2 w-32 pin-r p-2" v-if="dropdown">
      <li :key="i" v-for="(option, i) in options">
        <a
          href="#"
          class="py-1 block hover:text-grey-darkest text-sm"
          :class="index == i ? 'text-black' : 'text-grey-dark'"
          @click.prevent="select(i)"
          v-text="option.name"></a>
      </li>
    </ul>
  </li>
</template>

<script>
  import { mapState, mapMutations } from 'vuex';

  export default {
    computed: {
      selected () {
        return this.options[this.index];
      },

      options () {
        return [
          {
            name: 'Latest',
            field: 'created_at',
            sort: 'asc',
          },
          {
            name: 'Oldest',
            field: 'created_at',
            sort: 'desc',
          },
          {
            name: 'Price High',
            field: 'price',
            sort: 'asc',
          },
          {
            name: 'Price Low',
            field: 'price',
            sort: 'desc',
          },
        ];
      },

      ...mapState('filter', [
        'filters',
      ]),
    },

    data () {
      return {
        index: 0,
        dropdown: false,
      };
    },

    created () {
      const order_by = this.filters.order_by;

      if (order_by) {
        const index = this.options.findIndex(
          option => option.field == order_by.field && option.sort == order_by.sort
        );

        this.index = index == -1 ? 0 : index;
      }
    },

    methods: {
      select (index) {
        this.index = index;
        this.MERGE_FILTERS({
          order_by: {
            field: this.selected.field,
            sort: this.selected.sort,
          },
        });
        this.dropdown = false;
      },

      ...mapMutations('filter', [
        'MERGE_FILTERS',
      ]),
    },
  };
</script>
