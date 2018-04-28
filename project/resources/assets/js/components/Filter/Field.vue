<template>
  <div class="relative flex mb-8" :class="{ 'flex-col': ! row }">
    <h4 class="font-medium text-grey-darkest block text-xs border-b pb-2 mb-4" v-text="title.toUpperCase()" v-if="title"></h4>
    <slot />
  </div>
</template>

<script>
  export default {
    props: {
      title: {
        type: String,
      },
      row: {
        type: Boolean,
        default: false,
      },
    },
  };
</script>
