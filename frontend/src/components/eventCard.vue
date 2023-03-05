<template>
  <div class="py-3 w-full">
    <div
      class="bg-white h-full w-fit shadow-lg min-h-80 border sm:rounded-3xl p-8 dark:border-2 border-gray-100 flex space-x-8 2xl:border-gray-200 dark:2xl:border-zinc-700 dark:bg-gray-800 dark:text-gray-200 transition duration-1000 ease-linear sm:flex-row flex-col align-center justify-center"
    >
      <div class="flex-none justify-center items-center flex m-0">
        <img
          :src="event.image"
          alt="pic"
          class="h-72 w-56 rounded-3xl dark:border-2 border-4 border-[#F5C518] shadow-2xl dark:2xl:border-zinc-500"
        />
      </div>
      <div class="flex flex-col px-6 space-y-1">
        <div class="flex justify-between">
          <p class="pt-4 text-2xl font-bold">{{ event.libel }}</p>
          <div
            class="pt-4 text-2xl font-bold flex space-x-2 items-center text-xs"
          >
            <svg
              class="w-8 h-5"
              xmlns="http://www.w3.org/2000/svg"
              width="64"
              height="32"
              viewBox="0 0 64 32"
              version="1.1"
            >
              <g fill="#F5C518">
                <rect x="0" y="0" width="100%" height="100%" rx="4"></rect>
              </g>
              <g
                transform="translate(8.000000, 7.000000)"
                fill="#000000"
                fill-rule="nonzero"
              >
                <polygon points="0 18 5 18 5 0 0 0"></polygon>
                <path
                  d="M15.6725178,0 L14.5534833,8.40846934 L13.8582008,3.83502426 C13.65661,2.37009263 13.4632474,1.09175121 13.278113,0 L7,0 L7,18 L11.2416347,18 L11.2580911,6.11380679 L13.0436094,18 L16.0633571,18 L17.7583653,5.8517865 L17.7707076,18 L22,18 L22,0 L15.6725178,0 Z"
                ></path>
                <path
                  d="M24,18 L24,0 L31.8045586,0 C33.5693522,0 35,1.41994415 35,3.17660424 L35,14.8233958 C35,16.5777858 33.5716617,18 31.8045586,18 L24,18 Z M29.8322479,3.2395236 C29.6339219,3.13233348 29.2545158,3.08072342 28.7026524,3.08072342 L28.7026524,14.8914865 C29.4312846,14.8914865 29.8796736,14.7604764 30.0478195,14.4865461 C30.2159654,14.2165858 30.3021941,13.486105 30.3021941,12.2871637 L30.3021941,5.3078959 C30.3021941,4.49404499 30.272014,3.97397442 30.2159654,3.74371416 C30.1599168,3.5134539 30.0348852,3.34671372 29.8322479,3.2395236 Z"
                ></path>
                <path
                  d="M44.4299079,4.50685823 L44.749518,4.50685823 C46.5447098,4.50685823 48,5.91267586 48,7.64486762 L48,14.8619906 C48,16.5950653 46.5451816,18 44.749518,18 L44.4299079,18 C43.3314617,18 42.3602746,17.4736618 41.7718697,16.6682739 L41.4838962,17.7687785 L37,17.7687785 L37,0 L41.7843263,0 L41.7843263,5.78053556 C42.4024982,5.01015739 43.3551514,4.50685823 44.4299079,4.50685823 Z M43.4055679,13.2842155 L43.4055679,9.01907814 C43.4055679,8.31433946 43.3603268,7.85185468 43.2660746,7.63896485 C43.1718224,7.42607505 42.7955881,7.2893916 42.5316822,7.2893916 C42.267776,7.2893916 41.8607934,7.40047379 41.7816216,7.58767002 L41.7816216,9.01907814 L41.7816216,13.4207851 L41.7816216,14.8074788 C41.8721037,15.0130276 42.2602358,15.1274059 42.5316822,15.1274059 C42.8031285,15.1274059 43.1982131,15.0166981 43.281155,14.8074788 C43.3640968,14.5982595 43.4055679,14.0880581 43.4055679,13.2842155 Z"
                ></path>
              </g>
            </svg>
            <span>{{ event.imdbRating }}</span>
          </div>
        </div>
        <hr class="hr-text" data-content="" />
        <div class="text-md flex justify-between">
          <span class="font-bold">{{ event.Time }} | {{ event.genre }}</span>
          <span class="font-bold"></span>
        </div>
        <p class="max-h-40 overflow-y-hidden py-2 pl-5">
          {{ event.description }}
        </p>
        <p class="flex text-md my-2">
          <span class="font-bold mr-1">Date: </span> {{ event.eventDate }}
          <span class="fo-bold px-2">|</span>
          <span class="font-bold mr-1">Hall: </span>{{ event.hallNumber }}
        </p>
        <p class="flex text-md my-2">
          <span class="font-bold mr-1">Rating: </span>{{ event.imdbRating }}
          <span class="fo-bold px-2">|</span>
          <span class="font-bold mr-1">Lang: </span> {{ event.language }}
        </p>
        <p class="flex text-md my-2">
          <!-- Country: {{ event.Country }} -->
          <!-- <span class="fo-bold px-2">|</span> -->
          <span class="font-bold mr-1">Actor:</span> {{ event.actors }}
        </p>
        <div class="flex justify-between">
          <div class="text-xs flex-col">
            <button
              type="button"
              class="border mt-5 border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-[#F5C518] focus:outline-none focus:shadow-outline"
            >
              TRAILER
            </button>

            <button
              type="button"
              class="border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-[#F5C518] focus:outline-none focus:shadow-outline"
            >
              IMDB
            </button>

            <button
              type="button"
              class="border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-[#F5C518] focus:outline-none focus:shadow-outline"
            >
              AMAZON
            </button>
          </div>
          <div class="mt-5">
            <div class="flex">
              <div
                type="button"
                class="border bg-[#F5C518] text-black rounded-md px-2 py-1 transition duration-500 ease cursor-default font-bold hover:bg-[#b4900f] focus:outline-none focus:shadow-outline"
              >
                Price: {{ event.price }} DH
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "event",
  props: {
    event: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style>
</style>