<template>
  <div class="font-sans flex flex-col-reverse pb-9 md:flex-col md:pb-0 text-black">
    <app-header />

    <main class="container flex flex-wrap py-8">
      <router-view class="w-full md:w-56 md:pr-4" name="sidebar" />
      <router-view class="flex-1 md:pl-4" />
    </main>
  </div>
</template>

<script>
  import AppHeader from '@/Header';

  import store from 'core/store';
  import router from 'core/router';

  export default {
    store,
    router,

    components: {
      AppHeader,
    },
  };
</script>
