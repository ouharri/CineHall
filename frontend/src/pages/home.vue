<template>
  <main class="flex-1 py-10 px-5 sm:px-10">
    <section>
      <nav class="flex space-x-6 text-gray-400 font-medium">
        <a href="#" class="hover:text-gray-700 dark:hover:text-white"
          >TV Series</a
        >
        <a href="#" class="text-gray-700 dark:text-white font-semibold"
          >Movies</a
        >
        <a href="#" class="hover:text-gray-700 dark:hover:text-white">Animes</a>
      </nav>

      <div
        class="topmovie flex flex-col justify-between mt-4 bg-black/10 bg-blend-multiply rounded-3xl h-80 overflow-hidden bg-cover bg-center px-7 pt-4 pb-6 text-white"
      >
        <!-- <img class="object-cover w-full h-full" src="../assets/inception.jpg" alt=""> -->
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
            <a href="#" class="">Action</a>, <a href="#" class="">Adventure</a>,
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
      <div class="flex items-center justify-between mt-10">
      <span class="font-semibold text-gray-700 text-base dark:text-white">
        Movies
      </span>
      <div class="flex items-center space-x-2 fill-gray-500">
        <div
          @click="preventMovie"
          :disabled="currentPage === 1"
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
          :disabled="movies.length < moviesPerPage"
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
        :key="movie.id"
        v-for="movie in movies"
        :movie="movie"
      ></movieCard>
    </div>

    </section>
  </main>
</template>

<script>
import movieCard from "../components/movieCard.vue";
export default {
  name: "home",
  components: { movieCard },
  data() {
    return {
      currentPage: 1,
      moviesPerPage: 3,
      tmpMovies: [],
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
    async getMovie() {
      await axios({
        method: "get",
        url:  `${config.API_URL}movie/getAll`,
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
    },
  },
  async mounted() {
    await this.getMovie();
  },
};
</script>

<style scoped>
.topmovie {
  background-image: url("/inception.jpg");
  color: #ffffff;
}
</style>