<template>
  <section class="mt-9">
    <calendar></calendar>
    <div class="flex items-center justify-between mt-10">
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
      movies: null,
    };
  },
  methods: {
    async getMovie() {
      const jwt = JSON.parse(localStorage.getItem("JWT"));
      await axios({
        method: "get",
        url: "http://cdn.cinehall.ma/movie/getAll",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${jwt}`,
        },
      })
        .then((result) => {
          this.movies = result.data;
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