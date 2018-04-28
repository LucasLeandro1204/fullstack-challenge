<template>
  <aside>
    <form>
      <filter-field class="h-8 border rounded-full items-center pl-4 pr-8" row>
        <input type="text" placeholder="Search" class="rounded-full flex-1">
        <button type="submit" class="-mr-4">
          <i class="fa fa-search text-grey"></i>
        </button>
      </filter-field>
      <filter-field title="Cars">
      </filter-field>
    </form>
  </aside>
</template>

<script>
  import FilterField from './Field.vue';

  export default {
    components: {
      FilterField,
    },
  };
</script>
