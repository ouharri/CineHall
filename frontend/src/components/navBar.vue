<template>
  <header
    class="font-bold text-lg flex items-center justify-between gap-x-3 md:hidden mb-12"
  >
    <div class="flex">
      <span class="mr-6 cursor-pointer" id="menu-toggle">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-7 w-7 text-gray-700 dark:text-white"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h7"
          />
        </svg>
      </span>
      <router-link id="Logo" to="/" class="flex items-center">
        <svg
          class="h-8 w-8 fill-red-600 shrink-0"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
        >
          <path
            d="M10 15.5v-7c0-.41.47-.65.8-.4l4.67 3.5c.27.2.27.6 0 .8l-4.67 3.5c-.33.25-.8.01-.8-.4Zm11.96-4.45c.58 6.26-4.64 11.48-10.9 10.9 -4.43-.41-8.12-3.85-8.9-8.23 -.26-1.42-.19-2.78.12-4.04 .14-.58.76-.9 1.31-.7v0c.47.17.75.67.63 1.16 -.2.82-.27 1.7-.19 2.61 .37 4.04 3.89 7.25 7.95 7.26 4.79.01 8.61-4.21 7.94-9.12 -.51-3.7-3.66-6.62-7.39-6.86 -.83-.06-1.63.02-2.38.2 -.49.11-.99-.16-1.16-.64v0c-.2-.56.12-1.17.69-1.31 1.79-.43 3.75-.41 5.78.37 3.56 1.35 6.15 4.62 6.5 8.4ZM5.5 4C4.67 4 4 4.67 4 5.5 4 6.33 4.67 7 5.5 7 6.33 7 7 6.33 7 5.5 7 4.67 6.33 4 5.5 4Z"
          ></path>
        </svg>
        <div class="tracking-wide dark:text-white flex-1">
          CineHall<span class="text-red-600">.</span>
        </div>
      </router-link>
    </div>
    <div class="relative items-center content-center flex ml-2">
      <span class="text-gray-400 absolute left-4 cursor-pointer">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
          ></path>
        </svg>
      </span>
      <label>
        <input
          type="text"
          class="text-xs ring-1 bg-transparent ring-gray-200 dark:ring-zinc-600 focus:ring-red-300 pl-10 pr-5 text-gray-600 dark:text-white py-3 rounded-full w-full outline-none focus:ring-1"
          placeholder="Search ..."
        />
      </label>
    </div>
  </header>
</template>

<script>
export default {
  mounted() {
    let flag = true;
    $("#menu-toggle").click(async () => {
      await $("#Logo").toggleClass("hidden");
      const toggleMain = flag && (await $(".main").toggleClass("active", 500));
      await $("#left-sidebar")
        .stop()
        .slideToggle(600, "linear", async () => {
          flag = !flag;
          $("#left-sidebar")
            .css("display", "")
            .toggleClass("block hidden active");
        })
        .promise()
        .then(() => {
          !toggleMain && $(".main").toggleClass("active", 100);
        });
    });
  },
};
</script>

<style>
</style>