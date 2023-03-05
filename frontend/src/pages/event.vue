<template>
  <calendar :cliked="this.date" @clikedDate="getAllByDate"></calendar>
  <div class="flex items-center justify-between mt-10">
    <span class="font-semibold text-gray-700 text-base dark:text-white">
      Event {{ this.eventDate ? " in : " + this.eventDate : "" }}
    </span>
    <div class="flex items-center space-x-2 fill-gray-500">
      <div
        @click="preventevent"
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
        @click="nextevent"
        :disabled="events.length < eventsPerPage"
        :class="events.length < eventsPerPage ? '' : 'cursor-pointer'"
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
  <eventCard
    :key="event.id"
    v-for="event in events"
    :event="event"
    @click="reserve(event.id)"
    class="cursor-pointer hover:transform hover:scale-105 transition duration-500 ease-in-out"
  ></eventCard>
</template>

<script>
import eventCard from "../components/eventCard.vue";
import calendar from "../components/calendar.vue";

export default {
  name: "event",
  components: { eventCard, calendar },
  data() {
    return {
      currentPage: 1,
      eventsPerPage: 2,
      tmpEvents: [],
      events: [],
      eventDate: null,
      date: null,
    };
  },
  methods: {
    nextevent() {
      if (this.events.length < this.eventsPerPage) return;
      const startIndex = (this.currentPage - 1) * this.eventsPerPage;
      const endIndex = startIndex + this.eventsPerPage;
      this.events = this.tmpEvents.slice(startIndex+1, endIndex);
      this.currentPage++;
    },
    preventevent() {
      if (this.currentPage === 1) return;
      if (this.currentPage > 1) {
        const startIndex = (this.currentPage - 2) * this.eventsPerPage;
        const endIndex = startIndex + this.eventsPerPage;
        this.events = this.tmpEvents.slice(startIndex, endIndex);
        this.currentPage--;
      }
    },
    getAllByDate(date) {
      axios({
        method: "get",
        url: `${config.API_URL}event/getAllByDate/${date}`,
        headers: {
          //   "Content-Type": "application/json",
          // Authorization: `Bearer ${jwt}`,
        },
      })
        .then((result) => {
          this.tmpEvents = result.data;
          this.eventDate = date;
          this.events = result.data.slice(0, this.eventsPerPage);
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
    reserve(id) {
      this.$router.push({ name: "reserve", params: { id: id } });
    },
    async getEvent() {
      const jwt = JSON.parse(localStorage.getItem("auth:cinhall"));
      await axios({
        method: "get",
        url: `${config.API_URL}event/getAll`,
        headers: {
          //   "Content-Type": "application/json",
          // Authorization: `Bearer ${jwt}`,
        },
      })
        .then((result) => {
          this.tmpEvents = result.data;
          this.events = result.data.slice(0, this.eventsPerPage);
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

  //   beforeMount() {
  //     if (!auth()) this.$router.push({ name: "login" });
  //   },
  async mounted() {
    await this.getEvent();
  },
};
</script>

<style>
</style>