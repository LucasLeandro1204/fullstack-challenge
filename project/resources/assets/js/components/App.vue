<template>
  <div class="font-sans flex flex-col-reverse pb-9 min-h-screen md:flex-col md:pb-0">
    <app-header />

    <main class="container">
      <router-view />
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
  };
</script>
