<script>
import leftSideBar from "./components/leftSideBar.vue";
import rightSideBar from "./components/rightSideBar.vue";

export default {
  name: "App",
  components: {
    leftSideBar,
    rightSideBar,
  },
};
</script>

<template>
  <div
      class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700 w-full dark:bg-gray-800 dark:text-gray-200 overflow-x-hidden transition duration-1000 ease-linear"
  >
    <leftSideBar></leftSideBar>

    <main
        class="main flex-1 py-10 px-5 sm:px-10 transition duration-200"
        id="main-page"
    >
      <!-- <x-nav.navbar></x-nav.navbar> -->

      <section>
        <nav class="flex space-x-6 text-gray-400 font-medium">
          <a href="#" class="hover:text-gray-700 dark:hover:text-white"
          >TV Series</a
          >
          <a href="#" class="text-gray-700 dark:text-white font-semibold"
          >Movies</a
          >
          <a href="#" class="hover:text-gray-700 dark:hover:text-white"
          >Animes</a
          >
        </nav>

        <div
            class="flex flex-col justify-between mt-4 bg-black/10 bg-blend-multiply rounded-3xl h-80 overflow-hidden bg-cover bg-center px-7 pt-4 pb-6 text-white"
            style="background-image: url('images/inception.jpg')"
        >
          <!-- <img class="object-cover w-full h-full" src="images/inception.jpg" alt=""> -->
          <div class="flex -space-x-1 items-center">
            <img
                class="rounded-full w-7 h-7 shadow-lg border border-white"
                src="https://api.lorem.space/image/face?w=32&amp;h=32&amp;hash=zsrj8csk"
                alt=""
                srcset=""
            />
            <img
                class="rounded-full w-7 h-7 shadow-lg border border-white"
                src="https://api.lorem.space/image/face?w=32&amp;h=32&amp;hash=zsrj8cck"
                alt=""
                srcset=""
            />
            <img
                class="rounded-full w-7 h-7 shadow-lg border border-white"
                src="https://api.lorem.space/image/face?w=32&amp;h=32&amp;hash=zsfj8cck"
                alt=""
                srcset=""
            />
            <span class="pl-4 text-xs drop-shadow-lg"
            >+8 friends are watching</span
            >
          </div>

          <div
              class="bg-gradient-to-r from-black/30 to-transparent -mx-7 -mb-6 px-7 pb-6 pt-2"
          >
            <span class="uppercase text-3xl font-semibold drop-shadow-lg"
            >Inception</span
            >
            <div class="text-xs text-gray-200 mt-2">
              <a href="#" class="">Action</a>,
              <a href="#" class="">Adventure</a>,
              <a href="#" class="">Sci-Fi</a>
            </div>
            <div class="mt-4 flex space-x-3 items-center">
              <a
                  href="#"
                  class="px-5 py-2.5 bg-red-600 hover:bg-red-700 rounded-lg text-xs inline-block"
              >Watch</a
              >
              <a
                  href="#"
                  class="p-2.5 bg-gray-800/80 rounded-lg hover:bg-red-600"
              >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                  <path
                      fill-rule="evenodd"
                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                      clip-rule="evenodd"
                  />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </section>

      <section class="mt-9">
        <div class="flex items-center justify-between">
          <span class="font-semibold text-gray-700 text-base dark:text-white"
          >Top Stars</span
          >
          <div class="flex items-center space-x-2 fill-gray-500">
            <svg
                class="h-7 w-7 rounded-full border p-1 hover:border-red-600 hover:fill-red-600 dark:fill-white dark:hover:fill-red-600"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
            >
              <path
                  d="M13.293 6.293L7.58 12l5.7 5.7 1.41-1.42 -4.3-4.3 4.29-4.293Z"
              ></path>
            </svg>
            <svg
                class="h-7 w-7 rounded-full border p-1 hover:border-red-600 hover:fill-red-600 dark:fill-white dark:hover:fill-red-600"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
            >
              <path
                  d="M10.7 17.707l5.7-5.71 -5.71-5.707L9.27 7.7l4.29 4.293 -4.3 4.29Z"
              ></path>
            </svg>
          </div>
        </div>

        <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-x-5 gap-y-5">
          <div class="relative rounded-xl overflow-hidden">
            <img
                src="https://www.jolie.de/sites/default/files/styles/image_gallery360w/public/2020-02/leonardo-dicaprio-oscars.jpg?h=64dbc2fc&itok=EH0B3oo4"
                class="object-cover h-full w-full -z-10"
                alt=""
            />
            <div
                class="absolute top-0 h-full w-full bg-gradient-to-t from-black/50 p-3 flex flex-col justify-between"
            >
              <a
                  href="#"
                  class="p-2.5 bg-gray-800/80 bg-white rounded-lg text-white self-end hover:bg-red-600/80"
              >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                  <path
                      fill-rule="evenodd"
                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                      clip-rule="evenodd"
                  />
                </svg>
              </a>

              <div class="self-center flex flex-col items-center space-y-2">
                <span class="capitalize text-white font-medium drop-shadow-md"
                >Leonardo DiCaprio</span
                >
                <span class="text-gray-100 text-xs">+12 Movies</span>
              </div>
            </div>
          </div>
          <div class="relative rounded-xl overflow-hidden">
            <img
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/WP_-_random_-5_%2814094372762%29.jpg/319px-WP_-_random_-5_%2814094372762%29.jpg"
                class="object-cover w-full h-full -z-10"
                alt=""
            />
            <div
                class="absolute top-0 h-full w-full bg-gradient-to-t from-black/50 p-3 flex flex-col justify-between"
            >
              <a
                  href="#"
                  class="p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80"
              >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                  <path
                      fill-rule="evenodd"
                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                      clip-rule="evenodd"
                  />
                </svg>
              </a>

              <div class="self-center flex flex-col items-center space-y-2">
                <span class="capitalize text-white font-medium drop-shadow-md"
                >Joseph Gordon-Levitt</span
                >
                <span class="text-gray-300 text-xs">+24 Movies</span>
              </div>
            </div>
          </div>
          <div class="relative rounded-xl overflow-hidden">
            <img
                src="https://img.zeit.de/kultur/film/2020-12/elliot-page-tranmann/wide__450x253__mobile__scale_1"
                class="object-cover h-full w-full -z-10"
                alt=""
            />
            <div
                class="absolute top-0 h-full w-full bg-gradient-to-t from-black/50 p-3 flex flex-col justify-between"
            >
              <a
                  href="#"
                  class="p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80"
              >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                  <path
                      fill-rule="evenodd"
                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                      clip-rule="evenodd"
                  />
                </svg>
              </a>

              <div class="self-center flex flex-col items-center space-y-2">
                <span class="capitalize text-white font-medium drop-shadow-md"
                >Elliot Page</span
                >
                <span class="text-gray-300 text-xs">+10 Movies</span>
              </div>
            </div>
          </div>
          <div class="relative rounded-xl overflow-hidden">
            <img
                src="https://de.web.img3.acsta.net/c_310_420/pictures/16/01/19/11/06/274206.jpg"
                class="object-cover h-full w-full -z-10"
                alt=""
            />
            <div
                class="absolute top-0 h-full w-full bg-gradient-to-t from-black/50 p-3 flex flex-col justify-between"
            >
              <a
                  href="#"
                  class="p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80"
              >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                  <path
                      fill-rule="evenodd"
                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                      clip-rule="evenodd"
                  />
                </svg>
              </a>

              <div class="self-center flex flex-col items-center space-y-2">
                <span class="capitalize text-white font-medium drop-shadow-md"
                >Tom Hardy</span
                >
                <span class="text-gray-300 text-xs">+27 Movies</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="mt-9">
        <div class="flex items-center justify-between">
          <span class="font-semibold text-gray-700 text-base dark:text-white"
          >Similar Movies</span
          >
          <div class="flex items-center space-x-2 fill-gray-500">
            <svg
                class="h-7 w-7 rounded-full border p-1 hover:border-red-600 hover:fill-red-600 dark:fill-white dark:hover:fill-red-600"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
            >
              <path
                  d="M13.293 6.293L7.58 12l5.7 5.7 1.41-1.42 -4.3-4.3 4.29-4.293Z"
              ></path>
            </svg>
            <svg
                class="h-7 w-7 rounded-full border p-1 hover:border-red-600 hover:fill-red-600 dark:fill-white dark:hover:fill-red-600"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
            >
              <path
                  d="M10.7 17.707l5.7-5.71 -5.71-5.707L9.27 7.7l4.29 4.293 -4.3 4.29Z"
              ></path>
            </svg>
          </div>
        </div>

        <div class="mt-4 grid grid-cols-2 gap-y-5 sm:grid-cols-3 gap-x-5">
          <div
              class="flex flex-col rounded-xl overflow-hidden aspect-square border dark:border-zinc-600"
          >
            <img
                src="https://upload.wikimedia.org/wikipedia/en/1/14/Tenet_movie_poster.jpg"
                class="h-4/5 object-cover w-full"
                alt=""
            />
            <div
                class="w-full h-1/5 bg-white dark:bg-zinc-800 dark:text-white px-3 flex items-center justify-between border-t-2 border-t-red-600"
            >
              <span class="capitalize font-medium truncate">Tenet</span>
              <div class="flex space-x-2 items-center text-xs">
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
                <span>7.4</span>
              </div>
            </div>
          </div>
          <div
              class="flex flex-col rounded-xl overflow-hidden aspect-square border dark:border-zinc-600"
          >
            <img
                src="https://upload.wikimedia.org/wikipedia/en/f/fc/Fight_Club_poster.jpg"
                class="h-4/5 object-cover w-full"
                alt=""
            />
            <div
                class="w-full h-1/5 bg-white dark:bg-zinc-800 dark:text-white px-3 flex items-center justify-between border-t-2 border-t-red-600"
            >
              <span class="capitalize font-medium truncate">Fight Club</span>
              <div class="flex space-x-2 items-center text-xs">
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
                <span>8.8</span>
              </div>
            </div>
          </div>
          <div
              class="flex flex-col rounded-xl overflow-hidden aspect-square border dark:border-zinc-600"
          >
            <img
                src="https://upload.wikimedia.org/wikipedia/en/8/8e/Dune_%282021_film%29.jpg"
                class="h-4/5 object-cover w-full"
                alt=""
            />
            <div
                class="w-full h-1/5 bg-white dark:bg-zinc-800 dark:text-white px-3 flex items-center justify-between border-t-2 border-t-red-600"
            >
              <span class="capitalize font-medium truncate">Dune</span>
              <div class="flex space-x-2 items-center text-xs">
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
                <span>8.1</span>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <rightSideBar></rightSideBar>
  </div>
</template>

<style scoped>
/* @import url("./style/reset.css"); */
/* @import url("./style/index.css"); */
</style>
