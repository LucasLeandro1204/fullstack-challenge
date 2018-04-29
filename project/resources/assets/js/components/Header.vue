<template>
  <header class="flex bg-white border-t w-full pin-b z-50 fixed shadow-inner md:relative md:border-t-0 md:border-b">
    <div class="container">
      <div class="flex items-center">
        <a class="text-blue-dark font-bold text-2xl py-1 px-2 mr-8 md:text-3xl" href="#">XLO</a>

        <ul class="list-reset flex w-full max-w-xs -mt-px md:-mt-0 md:-mb-px">
          <li class="flex-1" :key="index" v-for="(link, index) in links">
            <a
              class="text-black border-t py-3 px-2 text-xs flex items-center justify-center hover:border-blue md:text-sm md:py-4 md:border-t-0 md:border-b"
              :class="{ 'bg-grey-lightest border-blue': index === 0 }"
              href="#">
              {{ link }}
            </a>
          </li>
        </ul>

        <a href="#" class="hidden py-3 px-2 text-xs text-white bg-blue ml-auto sm:block md:text-sm md:rounded md:py-2">
          Post Free Ads
        </a>
      </div>
    </div>
  </header>
</template>

<script>
  export default {
    computed: {
      links () {
        return [
          'Home', 'Help', 'Me',
        ];
      },
    },
  };
</script>
