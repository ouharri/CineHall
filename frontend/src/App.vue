<script>
import leftSideBar from "./components/leftSideBar.vue";
import rightSideBar from "./components/rightSideBar.vue";
import calendar from "./components/calendar.vue";
import navBar from "./components/navBar.vue";

export default {
  name: "App",
  components: {
    leftSideBar,
    rightSideBar,
    calendar,
    navBar,
  },
  data() {
    return {
      isDark:
          window.matchMedia &&
          window.matchMedia("(prefers-color-scheme: dark)").matches &&
          localStorage.getItem("mode")
              ? JSON.parse(localStorage.getItem("mode")) === "dark"
              : false,
      isLoged: null,
    };
  },
  methods: {
    async Loged() {
      if (!localStorage.getItem("auth:cinhall")) {
        this.isLoged = false;
      } else {
        const jwt = JSON.parse(localStorage.getItem("auth:cinhall"));
        await axios({
          method: "get",
          url: `${config.API_URL}users/tokenIsValid`,
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${jwt}`,
          },
        })
            .then((result) => {
              this.isLoged = result.data.success;
            })
            .catch((error) => {
              this.isLoged = false;
            });
      }
    },
    setMode(ChangeMode = false) {
      if (ChangeMode) {
        this.isDark = !this.isDark;
      }
      localStorage.setItem(
          "mode",
          JSON.stringify(this.isDark ? "dark" : "light")
      );
    },
  },
  beforeRouteUpdate(to, from, next) {
    this.$nextTick(() => {
      // Appel à la méthode qui charge les composants
      this.loadComponents().then(() => {
        next();
      });
    });
  },
  watch: {
    async $route(to, from) {
      await this.Loged();
    },
  },
  created() {
    this.setMode();
  },
};
</script>
<script setup>
</script>
<template>
  <div :class="isDark ? 'dark' : 'light'">
    <div
        class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700 w-full dark:bg-gray-800 dark:text-gray-200 overflow-x-hidden transition duration-1000 ease-linear"
    >
      <leftSideBar
          :isDark="isDark"
          @isdark="setMode(true)"
          :Loged="this.isLoged"
      ></leftSideBar>
      <main
          class="main flex-1 py-10 px-5 sm:px-10 transition duration-200 max-h-screen md:scrollbar-thin scrollbar-gray-700 scrollbar-track-transparent"
          id="main-page"
      >
        <navBar></navBar>
        <router-view></router-view>
      </main>
      <rightSideBar :Loged="this.isLoged"></rightSideBar>
    </div>
  </div>
</template>

<style>
</style>