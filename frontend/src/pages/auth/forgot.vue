<template>
  <div
      class="flex my-20 flex-col justify-center transition rounded-3xl duration-1000 ease-linear border-zinc-200 bg-gradient-to-tr from-gray-50 dark:2xl:border-zinc-700 dark:from-black/10 to-transparent dark:text-gray-200 overflow-x-hidden transition duration-1000 ease-linear overflow-hidden shadow"
  >
    <div class="relative rounded-lg">
      <div class="px-6 py-6 lg:px-8">
        <div class="flex items-start flex-col text-center gap-3">
          <div class="font-bold text-lg flex items-center gap-x-2">
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
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">
            Recovery your account
            <span class="text-red-600">:</span>
          </h3>
        </div>
        <form class="space-y-6 py-10" action="#" @submit="checkForm">
          <label
              for="email"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Your email :</label
          >
          <input
              type="text"
              name="email"
              id="email"
              placeholder="outmanouharri@gmail.com"
              class="bg-transparent border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
              :class="
              errors
                ? 'border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:border-red-400'
                : ''
            "
              v-model="this.email"
          />
          <p v-if="errors" class="text-red-500 text-sm">
            {{ errors }}
          </p>
          <div class="flex justify-between">
            <div class="flex items-start"></div>
            <router-link
                to="/login"
                class="text-sm mt-8 text-[#f5c518] hover:underline dark:text-[#cba724]"
            >remember Token?
            </router-link
            >
          </div>
          <button
              type="submit"
              class="w-full text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
          >
            Recovery your account
          </button>
          <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
            Not registered?
            <router-link
                to="/register"
                href="#"
                class="text-[#f5c518] hover:underline dark:text-[#cba724]"
            >Create account
            </router-link
            >
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errors: false,
      email: null,
      remember: false,
    };
  },
  methods: {
    async checkForm(e) {
      e.preventDefault();
      let flag = false;
      let email = true;
      if (
          this.email &&
          !this.email
              .toLowerCase()
              .match(
                  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
              )
      ) {
        this.errors = "Email is not valid.";
        flag = true;
        email = false;
      }
      if (!this.email) {
        this.errors = "Email is required.";
        flag = true;
      } else {
        if (email) {
          this.errors = "";
        }
      }
      if (flag) {
        return;
      }
      const data = new FormData();
      data.append("email", this.email);
      await axios({
        method: "POST",
        url: `${config.API_URL}users/forgotToken`,
        data: data,
      })
          .then((result) => {
            if (result.data.success) {
              localStorage.setItem("JWT", JSON.stringify(result.data.token));
              this.$router.push({name: "login"});
              Swal.fire({
                position: "center",
                icon: "success",
                title: result.data.message,
                showConfirmButton: false,
                timer: 3000,
              });
            }
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
      DarkSwal();
    },
  },
};
</script>

<style>
</style>