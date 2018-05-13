<template>
  <article class="flex flex-wrap relative -mx-2">
    <template v-if="list == null">
      <p>Loading...</p>
    </template>

    <template v-else-if="list.length">
      <a href="#" class="w-full sm:w-1/2 lg:w-1/3 px-2 pb-4" :key="item.id" v-for="item in list">
        <div class="bg-cover bg-no-repeat flex items-center justify-center w-full h-64 bg-grey-light text-5xl sm:h-32" :style="{ backgroundImage: 'url(' + item.thumbnail +')' }">
          <i class="fa text-grey-dark" :class="item.placeholder" v-if="! item.thumbnail"></i>
        </div>
        <div class="border px-2 py-4 text-sm hover:bg-grey-lighter">
          <div class="flex">
            <h2 class="text-grey-darkest font-normal text-sm">{{ item.title | truncate(22) }}</h2>
            <p class="text-blue font-bold ml-auto">{{ item.price / 100 | BRL }}</p>
          </div>
          <p class="text-grey mt-2" v-text="item.category"></p>
        </div>
      </a>
    </template>

    <template v-else>
      No results
    </template>
  </article>
</template>

<script>
  import { mapState } from 'vuex';

  export default {
    computed: {
      ...mapState('advertisement', [
        'list',
      ]),
    },
  };
</script>
