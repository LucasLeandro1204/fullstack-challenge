<template>
  <div class="font-sans flex flex-col-reverse pb-9 md:flex-col md:pb-0">
    <app-header />

    <main class="container flex flex-wrap py-8">
      <router-view class="w-full md:w-48 pr-4" name="sidebar" />
      <router-view class="flex-1 pl-4" />
    </main>
  </div>
</template>

<script>
  import AppHeader from '@/Header.vue';

  import router from 'core/router';

  export default {
    router,

    components: {
      AppHeader,
    },

    mounted () {
      console.log(this.$router.matcher);
    },
  };
</script>
