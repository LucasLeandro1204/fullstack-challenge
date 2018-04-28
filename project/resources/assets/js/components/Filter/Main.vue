<template>
  <aside>
    <form>
      <filter-field class="h-8 border rounded-full items-center pl-4 pr-8" row>
        <input type="text" placeholder="Search" class="rounded-full w-full">
        <button type="submit" class="-mr-4">
          <i class="fa fa-search text-grey"></i>
        </button>
      </filter-field>
    </form>

    <filter-field title="Categories">
      <ul class="list-reset text-sm">
        <li v-for="i in 8">
          <router-link to="/" class="text-grey-darkest block p-1 -mx-1 my-1 hover:bg-grey-lightest rounded">
            <span class="float-right text-grey">255</span>
            Cars
          </router-link>
        </li>
      </ul>
    </filter-field>
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
