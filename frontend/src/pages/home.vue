<template>
  <div :key="$route.meta.isLoged">
    <h1 v-text="$route.meta.isLoged" @click="hhh($route.meta.isLoged)"></h1>
  </div>
</template>

<script>
export default {
  name: "home",
  methods: {
    hhh(isLoged) {
      console.log(isLoged);
    },
  },
};
</script>

<style>
</style>