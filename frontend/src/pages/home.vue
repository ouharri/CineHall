<template>
  <main class="flex-1 py-10 px-5 sm:px-10">
    <section>
      <nav class="flex space-x-6 text-gray-400 font-medium">
        <!--        <a href="#" class="hover:text-gray-700 dark:hover:text-white"-->
        <!--        >TV Series</a-->
        <!--        >-->
        <!--        <a href="#" class="text-gray-700 dark:text-white font-semibold"-->
        <!--        >Movies</a-->
        <!--        >-->
        <!--        <a href="#" class="hover:text-gray-700 dark:hover:text-white">Animes</a>-->
        <a href="#" class="text-gray-700 dark:text-white font-semibold">The Month Movie </a>
      </nav>

      <div
          class="topmovie flex relative flex-col justify-between mt-4 bg-black/10 bg-blend-multiply rounded-3xl h-80 overflow-hidden bg-center px-7 pt-4 pb-6 text-white"
          :class="this.bgMonthImage"
          :style="this.bgMonthImage"
      >
        <!--         <img class="object-cover w-full h-full" src="/inception.jpg" alt="">-->

        <div class="absolute top-[-1px] right-0 h-full w-full bg-white opacity-20 z-[1]"></div>
        <div class="flex -space-x-1 items-center" v-if="this.bgMonthImage">
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
        <div role="status"
             class="flex flex-col justify-center items-center space-y-2.5 animate-pulse w-[65vw] md:w-full"
             v-if="!this.bgMonthImage">
          <div class="flex items-center w-full space-x-2 ">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
          </div>
          <div class="flex items-center w-full space-x-2">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
          </div>
          <div class="flex items-center w-full space-x-2">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
          </div>
          <div class="flex items-center w-full space-x-2">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
          </div>
          <div class="flex items-center w-full space-x-2" v-for="i in 2">
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-80"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
          </div>
          <div class="flex items-center w-full space-x-2">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
          </div>
          <div class="flex items-center w-full space-x-2" v-for="i in 3">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
          </div>
          <div class="flex items-center w-full space-x-2">
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-32"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-full"></div>
          </div>
          <div class="flex items-center w-full space-x-2">
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-80"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
          </div>
          <div class="flex items-center w-full space-x-2" v-for="i in 3">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-full"></div>
            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
          </div>
        </div>

        <div
            class="bg-gradient-to-r from-black/30 to-transparent z-[2] -mx-7 -mb-6 px-7 pb-6 pt-2"
            v-if="this.bgMonthImage"
        >
          <span class="uppercase text-3xl font-semibold drop-shadow-lg"
          >{{ this.monthMovie.libel }}</span
          >
          <div class="text-xs text-gray-200 mt-2">
            {{ this.monthMovie.genre }}
          </div>
          <div class="mt-4 flex space-x-3 items-center">
            <router-link
                :to="{name: 'reserve', params: {id: this.monthMovie.id}}"
                class="px-5 py-2.5 bg-red-600 hover:bg-red-700 rounded-lg text-xs inline-block cursor-pointer"
            >Reserve
            </router-link>
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
      <div class="flex items-center justify-between mt-10">
      <span class="font-semibold text-gray-700 text-base dark:text-white">
        Movies
      </span>
        <div class="flex items-center space-x-2 fill-gray-500">
          <div
              @click="preventMovie"
              :class="currentPage === 1 ? '' : 'cursor-pointer'"
          >
            <svg
                class="h-7 w-7 rounded-full border p-1 hover:border-red-600 hover:fill-red-600 dark:fill-white dark:hover:fill-red-600"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
            >
              <path
                  d="M13.293 6.293L7.58 12l5.7 5.7 1.41-1.42 -4.3-4.3 4.29-4.293Z"
              ></path>
            </svg>
          </div>
          <div
              @click="nextMovie"
              :class="movies.length < moviesPerPage ? '' : 'cursor-pointer'"
          >
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
      </div>
      <div class="mt-4 grid grid-cols-2 gap-y-5 sm:grid-cols-3 gap-x-5">
        <movieCard
            v-if="movies.length > 0"
            :key="movie.id"
            v-for="movie in movies"
            :movie="movie"
        ></movieCard>
        <div
            v-else
            class="flex flex-col px-2 opacity-50 justify-center items-center rounded-xl overflow-hidden aspect-square border border-opacity-[20%] dark:border-zinc-700"
            v-for="i in 3"
            :key="i"
        >
          <div role="status" class="max-w-sm animate-pulse w-full h-full">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32 px-2 mt-3 mb-4"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-4"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
          </div>
        </div>
      </div>

    </section>
  </main>
</template>

<script>
import movieCard from "../components/movieCard.vue";

export default {
  name: "home",
  components: {movieCard},
  data() {
    return {
      currentPage: 1,
      moviesPerPage: 3,
      tmpMovies: [],
      monthMovie: {id: 0},
      bgMonthImage: null,
      movies: [],
    };
  },
  methods: {
    nextMovie() {
      if (this.movies.length < this.moviesPerPage) return;
      const startIndex = (this.currentPage) * this.moviesPerPage;
      const endIndex = startIndex + this.moviesPerPage;
      this.movies = this.tmpMovies.slice(startIndex, endIndex);
      this.currentPage++;
    },
    preventMovie() {
      if (this.currentPage === 1) return;
      if (this.currentPage > 1) {
        const startIndex = (this.currentPage - 2) * this.moviesPerPage;
        const endIndex = startIndex + this.moviesPerPage;
        this.movies = this.tmpMovies.slice(startIndex, endIndex);
        this.currentPage--;
      }
    },
    async getMonthMovies() {
      await axios({
        method: "get",
        url: `${config.API_URL}event/getMonthEvent`,
        headers: {
          "Content-Type": "application/json",
        },
      })
          .then((result) => {
            this.monthMovie = result.data;
            this.bgMonthImage = 'background-image: url("' + result.data.image + '");';
          })
          .catch((error) => {
            Swal.fire({
              position: "center",
              icon: "error",
              title: error &&
              error.response &&
              error.response.data &&
              error.response.data.message
                  ? error.response.data.message
                  : error,
              showConfirmButton: false,
              timer: 3000,
            });
          });
      await DarkSwal();
    },
    async getMovie() {
      await axios({
        method: "get",
        url: `${config.API_URL}movie/getAll`,
        headers: {
          "Content-Type": "application/json",
        },
      })
          .then((result) => {
            this.tmpMovies = result.data;
            this.movies = result.data.slice(0, this.moviesPerPage);
          })
          .catch((error) => {
            Swal.fire({
              position: "center",
              icon: "error",
              title: error &&
              error.response &&
              error.response.data &&
              error.response.data.message
                  ? error.response.data.message
                  : error,
              showConfirmButton: false,
              timer: 3000,
            });
          });
      await DarkSwal();
    },
  },
  async created() {
    await this.getMonthMovies();
    await this.getMovie();
  },
};
</script>

<style scoped>
.topmovie {
  color: #ffffff;
}
</style>