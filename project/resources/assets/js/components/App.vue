<template>
  <div class="font-sans">
    <main class="container-xl">
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
  import router from 'core/router';

  export default {
    router,
  };
</script>
