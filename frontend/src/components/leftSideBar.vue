<template>
  <aside
      class="w-1/6 py-10 pl-10 min-w-min border-r border-gray-300 dark:border-zinc-700 hidden md:block transition duration-1000 ease-linear max-h-screen overflow-x-auto scrollbar-thin scrollbar-gray-700 scrollbar-track-transparent"
      id="left-sidebar"
  >
    <div class="font-bold text-lg flex items-center gap-x-3 mr-10">
      <svg
          class="h-8 w-8 fill-red-600"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
      >
        <path
            d="M10 15.5v-7c0-.41.47-.65.8-.4l4.67 3.5c.27.2.27.6 0 .8l-4.67 3.5c-.33.25-.8.01-.8-.4Zm11.96-4.45c.58 6.26-4.64 11.48-10.9 10.9 -4.43-.41-8.12-3.85-8.9-8.23 -.26-1.42-.19-2.78.12-4.04 .14-.58.76-.9 1.31-.7v0c.47.17.75.67.63 1.16 -.2.82-.27 1.7-.19 2.61 .37 4.04 3.89 7.25 7.95 7.26 4.79.01 8.61-4.21 7.94-9.12 -.51-3.7-3.66-6.62-7.39-6.86 -.83-.06-1.63.02-2.38.2 -.49.11-.99-.16-1.16-.64v0c-.2-.56.12-1.17.69-1.31 1.79-.43 3.75-.41 5.78.37 3.56 1.35 6.15 4.62 6.5 8.4ZM5.5 4C4.67 4 4 4.67 4 5.5 4 6.33 4.67 7 5.5 7 6.33 7 7 6.33 7 5.5 7 4.67 6.33 4 5.5 4Z"
        ></path>
      </svg>
      <div class="tracking-wide dark:text-white">
        CineHall<span class="text-red-600">.</span>
      </div>
    </div>

    <!-- Menu -->
    <div
        class="mt-12 flex flex-col gap-y-4 text-gray-500 fill-gray-500 text-sm"
    >
      <div class="text-gray-400/70 font-medium uppercase">Menu</div>
      <router-link
          to="/"
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
          :class="this.$route.path === '/' ? 'border-r-4 border-r-red-600' : ''"
      >
        <svg
            class="h-5 w-5"
            :class="this.$route.path === '/' ? 'fill-red-600' : ''"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <path
              d="M5 22h14v0c1.1 0 2-.9 2-2v-9 0c0-.27-.11-.53-.29-.71l-8-8v0c-.4-.39-1.02-.39-1.41 0l-8 8h0c-.2.18-.3.44-.3.71v9 0c0 1.1.89 2 2 2Zm5-2v-5h4v5Zm-5-8.59l7-7 7 7V20h-3v-5 0c0-1.11-.9-2-2-2h-4v0c-1.11 0-2 .89-2 2v5H5Z"
          ></path>
        </svg>
        <span>Home</span>
      </router-link>
      <router-link
          to="/movies"
          :class="
          this.$route.path === '/movies' ? 'border-r-4 border-r-red-600' : ''
        "
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
      >
        <svg
            class="h-5 w-5 group-hover:fill-red-600"
            :class="this.$route.path === '/movies' ? 'fill-red-600' : ''"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <g>
            <path
                d="M12 2C6.48 2 2 6.48 2 12c0 5.51 4.48 10 10 10 5.51 0 10-4.49 10-10 0-5.52-4.49-10-10-10Zm0 18c-4.42 0-8-3.59-8-8 0-4.42 3.58-8 8-8 4.41 0 8 3.58 8 8 0 4.41-3.59 8-8 8Z"
            ></path>
            <path d="M8 16l5.991-2 2-6 -6 2Z"></path>
          </g>
        </svg>
        <span>Movie</span>
      </router-link>
      <router-link
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
          to="/event"
          :class="
          this.$route.path === '/event' ? 'border-r-4 border-r-red-600' : ''
        "
      >
        <svg
            class="h-5 w-5 group-hover:fill-red-600"
            :class="this.$route.path === '/event' ? 'fill-red-600' : ''"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <g>
            <path
                d="M19 2H9c-1.11 0-2 .89-2 2v5.586l-4.707 4.7v0c-.4.39-.4 1.02 0 1.41 .18.18.44.29.7.29v5 0c0 .55.44 1 1 1h16v0c.55 0 1-.45 1-1v-17c0-1.11-.9-2-2-2Zm-8 18H5v-5.586l3-3 3 3V20Zm8 0h-6v-4 0c.55 0 .99-.45 1-1 0-.27-.11-.53-.3-.72L8.99 9.57V3.984h10v16Z"
            ></path>
            <path
                d="M11 6h2v2h-2Zm4 0h2v2h-2Zm0 4.03h2v1.96h-2Zm0 3.96h2v2h-2Zm-8 1h2v2H7Z"
            ></path>
          </g>
        </svg>
        <span>Event</span>
      </router-link>
      <router-link
          to="/reserve/my-reserve"
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
          :class="
          /^\/reserve\//.test(this.$route.path)
            ? 'border-r-4 border-r-red-600'
            : ''
        "
          v-if="this.Loged"
      >
        <svg
            class="h-5 w-5 group-hover:fill-red-600"
            :class="/^\/reserve\//.test(this.$route.path) ? 'fill-red-600' : ''"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <g>
            <path
                d="M12 2C6.48 2 2 6.48 2 12c0 5.51 4.48 10 10 10 5.51 0 10-4.49 10-10 0-5.52-4.49-10-10-10Zm0 18c-4.42 0-8-3.59-8-8 0-4.42 3.58-8 8-8 4.41 0 8 3.58 8 8 0 4.41-3.59 8-8 8Z"
            ></path>
            <path d="M13 7h-2v5.414l3.29 3.29 1.41-1.42 -2.71-2.71Z"></path>
          </g>
        </svg>
        <span>Reservation</span>
      </router-link>

      <div class="mt-8 text-gray-400/70 font-medium uppercase">Social</div>
      <router-link
          to="/favorites"
          :class="
          this.$route.path === '/favorites' ? 'border-r-4 border-r-red-600' : ''
        "
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
      >
        <svg
            :class="this.$route.path === '/favorites' ? 'fill-red-600' : ''"
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 24 24"
        >
          <path
              d="M20 22V4c0-1.103-.897-2-2-2H6c-1.103 0-2 .897-2 2v18l8-4.572L20 22zM6 10V4h12v14.553l-6-3.428-6 3.428V10z"
          ></path>
          <path
              d="M15.409 9.512c.361-.372.585-.888.585-1.456s-.223-1.083-.585-1.456a1.962 1.962 0 0 0-1.412-.603S13.001 5.994 12 7.026c-1.001-1.032-1.997-1.029-1.997-1.029-.552 0-1.051.23-1.412.603-.362.373-.585.887-.585 1.456s.223 1.084.585 1.456L12 13.203l3.409-3.691z"
          ></path>
        </svg>
        <span>Favorite</span>
      </router-link>
      <router-link
          to="/profile"
          :class="
          this.$route.path === '/profile' ? 'border-r-4 border-r-red-600' : ''
        "
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
      >
        <svg
            :class="this.$route.path === '/profile' ? 'fill-red-600' : ''"
            class="h-5 w-5 group-hover:fill-red-600"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <path
              d="M12 2v0C9.23 2 7 4.23 7 7c0 2.76 2.23 5 5 5 2.76 0 5-2.24 5-5v0c0-2.77-2.24-5-5-5Zm0 8v0c-1.66 0-3-1.35-3-3 0-1.66 1.34-3 3-3 1.65 0 3 1.34 3 3v0c0 1.65-1.35 3-3 3Zm9 11v-1 0c0-3.87-3.14-7-7-7h-4v0c-3.87 0-7 3.13-7 7v1h2v-1 0c0-2.77 2.23-5 5-5h4v0c2.76 0 5 2.23 5 5v1Z"
          ></path>
        </svg>
        <span>Profile</span>
      </router-link>
      <router-link
          to="/starts"
          :class="
          this.$route.path === '/starts' ? 'border-r-4 border-r-red-600' : ''
        "
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
      >
        <svg
            :class="this.$route.path === '/starts' ? 'fill-red-600' : ''"
            class="h-5 w-5 group-hover:fill-red-600"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <g>
            <path
                d="M16.6 11.04v-.001c.6-1.04.87-2.25.75-3.44 -.18-1.79-1.18-3.37-2.81-4.44l-1.11 1.66c1.11.742 1.8 1.79 1.91 2.974l-.001 0c.11 1.1-.29 2.2-1.08 2.98l-1.2 1.19 1.61.47c4.23 1.24 4.28 5.49 4.28 5.53h2c0-1.79-.96-5.285-4.4-6.952Z"
            ></path>
            <path
                d="M9.5 12c2.2 0 4-1.8 4-4 0-2.21-1.8-4-4-4 -2.21 0-4 1.79-4 4 0 2.2 1.79 4 4 4Zm0-6c1.1 0 2 .89 2 2 0 1.1-.9 2-2 2 -1.11 0-2-.9-2-2 0-1.11.89-2 2-2Zm1.5 7H8c-3.31 0-6 2.69-6 6v1h2v-1c0-2.21 1.79-4 4-4h3c2.2 0 4 1.79 4 4v1h2v-1c0-3.31-2.7-6-6-6Z"
            ></path>
          </g>
        </svg>
        <span>Stars</span>
      </router-link>
      <a
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
          href="#"
      >
        <svg
            class="h-5 w-5 group-hover:fill-red-600"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <g>
            <path
                d="M12 2v0C6.47 2 2 6.47 2 12c0 5.52 4.47 10 10 10 5.52 0 10-4.48 10-10v-.001c0-5.53-4.48-10-10-10Zm0 18v0c-4.42 0-8-3.59-8-8 0-4.42 3.58-8 8-8 4.41 0 8 3.58 8 8v0c0 4.41-3.59 8-8 8Z"
            ></path>
            <path
                d="M12 8v0c-2.21 0-4 1.79-4 4 0 2.2 1.79 4 4 4 2.2 0 4-1.8 4-4v0c0-2.21-1.8-4-4-4Zm0 6v0c-1.11 0-2-.9-2-2 0-1.11.89-2 2-2 1.1 0 2 .89 2 2v0c0 1.1-.9 2-2 2Z"
            ></path>
          </g>
        </svg>
        <span>Media</span>
      </a>

      <div class="mt-8 text-gray-400/70 font-medium uppercase">General</div>
      <!-- <a
        class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
        href="#"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 group-hover:stroke-red-600"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
          />
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
          />
        </svg>
        <span>Settings</span>
      </a> -->

      <router-link
          to="/login"
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white cursor-pointer"
          v-if="!this.Loged"
      >
        <svg
            class="h-5 w-5 group-hover:fill-red-600"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <g>
            <path d="M16 13v-2H7V8l-5 4 5 4v-3Z"></path>
            <path
                d="M20 3h-9c-1.11 0-2 .89-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.89 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.11-.9-2-2-2Z"
            ></path>
          </g>
        </svg>
        <span>Login</span>
      </router-link>

      <router-link
          to="/register"
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white"
          v-if="!this.Loged"
      >
        <svg
            class="h-5 w-5 group-hover:fill-red-600"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <g>
            <path d="M16 13v-2H7V8l-5 4 5 4v-3Z"></path>
            <path
                d="M20 3h-9c-1.11 0-2 .89-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.89 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.11-.9-2-2-2Z"
            ></path>
          </g>
        </svg>
        <span>register</span>
      </router-link>

      <a
          class="flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white cursor-pointer"
          v-if="this.Loged"
          @click="logout"
      >
        <svg
            class="h-5 w-5 group-hover:fill-red-600"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
        >
          <g>
            <path d="M16 13v-2H7V8l-5 4 5 4v-3Z"></path>
            <path
                d="M20 3h-9c-1.11 0-2 .89-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.89 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.11-.9-2-2-2Z"
            ></path>
          </g>
        </svg>
        <span>Logout</span>
      </a>
      <a class="flex items-center space-x-2 py-1 mt-4" href="#">
        <div
            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in"
        >
          <input
              type="checkbox"
              name="toggle"
              id="toggle"
              class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"
              @click="$emit('isdark')"
              :value="this.isDark"
          />
          <label
              for="toggle"
              class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
          ></label>
        </div>
        <label for="toggle" class="">Dark Theme</label>
      </a>
    </div>
    <!-- /Menu -->
  </aside>
</template>

<script>
export default {
  props: {
    isDark: {
      type: Boolean,
      default:
          window.matchMedia &&
          window.matchMedia("(prefers-color-scheme: dark)").matches,
    },
    Loged: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    logout() {
      localStorage.removeItem("auth:cinhall");
      this.$router.go(0);
    },
  },
};
</script>

<style>
</style>