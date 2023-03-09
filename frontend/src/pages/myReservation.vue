<template>
  <div class="flex">
    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">My Reservation :</h1>
  </div>

  <div class="relative overflow-x-auto my-7 ticket">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-4 rounded-l-lg">
          Movie name
        </th>
        <th scope="col" class="px-6 py-4 w-full">
          Movie&nbspDate
        </th>
        <th scope="col" class="px-6 py-4 text-center w-full flex">
          Réservation&nbspDate
        </th>
        <th scope="col" class="px-4 py-4 w-full text-center">
          hall
        </th>
        <th scope="col" class="px-4 py-4">
          seat
        </th>
        <th scope="col" class="px-4 py-4">
          Price
        </th>
        <th scope="col" class="px-4 py-4">
        </th>
        <th scope="col" class="px-4 py-4  rounded-r-lg">
        </th>
      </tr>
      </thead>
      <tbody id="ticket">
      <tr
          class="bg-white dark:bg-gray-800"
          v-for="reservation in reservation"
          :key="reservation.id"
      >
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ reservation.movieName }}
        </th>
        <td class="px-6 py-4 text-center">
          {{ reservation.eventdate }}
        </td>
        <td class="py-4  w-full text-center">
          {{ reservation.reservationDate }}
        </td>
        <td class="px-6 py-4 text-center">
          {{ reservation.hall }}
        </td>
        <td class="px-6 py-4 text-center">
          {{ reservation.seat }}
        </td>
        <td class="px-6 py-4 text-center">
          {{ reservation.eventPrice }} DH
        </td>
        <td class="px-6 py-4 text-center">
          <button
              class="px-4 py-2 opacity-80 font-semibold text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600"
              @click="cancelReservation(reservation.id,reservation.eventdate)">Cancel
          </button>
        </td>
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          <button
              class="px-4 py-2 opacity-80 font-semibold text-white bg-blue-800 rounded-md hover:bg-blue-900 focus:outline-none focus:bg-blue-600"
              @click="sendTicket(reservation.id)">Ticket
          </button>
        </th>
      </tr>
      </tbody>
    </table>
  </div>


</template>

<script>
export default {
  data() {
    return {
      reservation: [],
      userInfo: localStorage.getItem("auth:cinhall")
          ? this.parseJwt(JSON.stringify(localStorage.getItem("auth:cinhall")))
          : null,
    }
  },
  beforeCreate() {
    if (!localStorage.getItem("auth:cinhall")) {
      this.$router.push("/login");
    }
  },
  methods: {
    async getReservation() {
      await axios({
        method: "get",
        url: `${config.API_URL}reservation/getUserReservation/${this.userInfo.user}`,
        headers: {
          "Content-Type": "application/json",
        },
      })
          .then((result) => {
            console.log(result)
            this.reservation = result.data;
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
    cancelReservation(id, eventDate) {
      console.log(id)
      if (!localStorage.getItem("auth:cinhall")) {
        this.$router.push("/login");
        return;
      }
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          if (this.compareDates(eventDate)) {
            Swal.fire({
              position: "center",
              icon: "error",
              title: "You can't cancel this reservation",
              showConfirmButton: false,
              timer: 2000,
            });
            DarkSwal();
            return;
          }
          const jwt = JSON.parse(localStorage.getItem("auth:cinhall"));
          axios({
            method: "DELETE",
            url: `${config.API_URL}reservation/deleteReservationById`,
            headers: {
              "Content-Type": "application/json",
              "Authorization": `Bearer ${jwt}`,
            },
            data: {
              "id": id,
            }
          })
              .then((result) => {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: result.data.message,
                  showConfirmButton: false,
                  timer: 3000,
                });
                DarkSwal();
                this.getReservation();
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
                DarkSwal();
              });
        }
      });
      DarkSwal();
    },
    sendTicket(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You Want receive your ticket by email",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          const jwt = JSON.parse(localStorage.getItem("auth:cinhall"));
          const resData = new FormData();
          resData.append("id", id);
          axios({
            method: "POST",
            url: `${config.API_URL}reservation/sendTicket`,
            headers: {
              "Authorization": `Bearer ${jwt}`,
            },
            data: resData
          })
              .then((result) => {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: result.data.message,
                  showConfirmButton: false,
                  timer: 3000,
                });
                DarkSwal();
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
                DarkSwal();
              })
        }
      });
      DarkSwal();
    },
    compareDates(date) {
      const currentDate = new Date();
      return new Date(date) < currentDate;
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
  }
  ,
  created() {
    this.getReservation();
  }
  ,
}
</script>

<style>

</style>