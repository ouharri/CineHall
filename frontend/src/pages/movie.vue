<template>
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
</template>

<script>
import movieCard from "../components/movieCard.vue";
import calendar from "../components/calendar.vue";
export default {
  name: "movie",
  components: { movieCard, calendar },
  data() {
    return {
      currentPage: 1,
      moviesPerPage: 10,
      tmpMovies: [],
      movies: [],
    };
  },
  methods: {
    nextMovie() {
      if (this.movies.length < this.moviesPerPage) return;
      const startIndex = (this.currentPage - 1) * this.moviesPerPage;
      const endIndex = startIndex + this.moviesPerPage;
      this.movies = this.tmpMovies.slice(startIndex + 1, endIndex + 1);
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
        url: "http://cdn.cinehall.ma/movie/getAll",
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
            title: error.response.data.message,
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

<style>
</style>