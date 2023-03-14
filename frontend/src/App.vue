<script>
import leftSideBar from "./components/leftSideBar.vue";
import rightSideBar from "./components/rightSideBar.vue";
import navBar from "./components/navBar.vue";

export default {
  name: "App",
  components: {²
    leftSideBar,
    rightSideBar,
    navBar,
  },
  data() {
    return {
      isDark:
          localStorage.getItem("mode") !== null ?
              JSON.parse(localStorage.getItem("mode")) === 'dark'
              : window.matchMedia &&
              window.matchMedia("(prefers-color-scheme: dark)").matches ?
                  window.matchMedia &&
                  window.matchMedia("(prefers-color-scheme: dark)").matches : false,
      isLoged: null,
      user: localStorage.getItem("auth:cinhall")
          ? this.parseJwt(JSON.stringify(localStorage.getItem("auth:cinhall")))
          : null,
    };
  },
  methods: {
    async Loged() {
      if (!localStorage.getItem("auth:cinhall")) {
        this.isLoged = false;
        this.user = null;
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
              this.user = this.parseJwt(
                  JSON.stringify(localStorage.getItem("auth:cinhall"))
              );
            })
            .catch((error) => {
              this.isLoged = false;
              this.user = null;
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
    loadComponents() {
      return Promise.all([
        import("./components/leftSideBar.vue"),
        import("./components/rightSideBar.vue"),
        import("./components/calendar.vue"),
        import("./components/navBar.vue"),
      ]);
    },
    parseJwt(token) {
      const base64Url = token.split(".")[1];
      const base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
      const jsonPayload = decodeURIComponent(
          window
              .atob(base64)
              .split("")
              .map(function (c) {
                return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
              })
              .join("")
      );
      return JSON.parse(jsonPayload);
    },
  },
  beforeRouteUpdate(to, from, next) {
    this.$nextTick(() => {
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
        class="flex max-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700 w-full dark:bg-gray-800 dark:text-gray-200 overflow-x-hidden transition duration-1000 ease-linear scrollbar-thin scrollbar-gray-700 scrollbar-track-transparent scrollbar-thumb-gray-200 dark:scrollbar-thumb-gray-700"
    >
      <leftSideBar
          :isDark="isDark"
          @isdark="setMode(true)"
          :Loged="this.isLoged"
      ></leftSideBar>
      <main
          class="main flex-1 max-h-screen py-10 px-5 sm:px-10 transition duration-200 max-h-screen md:scrollbar-thin scrollbar-gray-700 scrollbar-track-transparent"
          id="main-page"
      >
        <navBar></navBar>
        <router-view></router-view>
      </main>
      <rightSideBar
          :Loged="this.isLoged"
          :user="this.user"
          :key="this.user"
      ></rightSideBar>
    </div>
  </div>
</template>

<style>
</style>