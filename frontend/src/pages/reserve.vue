<template>
  <div class="space-y-3">
    <div
        class="flex p-0 m-0 flex-col space-y-6 rounded-[40px] border-zinc-200 bg-gradient-to-t from-transparent dark:2xl:border-zinc-700 dark:from-black/10 to-gray-100 dark:text-gray-200 overflow-x-hidden transition duration-1000 ease-linear overflow-hidden py-8"
    >
      <div class="flex flex-col px-6 space-y-3">
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
        <hr class="hr-text" data-content=""/>
        <div class="text-md flex justify-between">
          <span class="font-bold">{{ event.Time }} | {{ event.genre }}</span>
          <span class="font-bold"></span>
        </div>
        <!-- transform hover:absolute hover:scale-125 hover:bg-white top-[10%] left-[22%] -->
        <div
            class="rounded-[30px] space-y-6 dark:border-gray-700 border-2 border-gray-200 py-6 text-gray-200"
        >
          <div class="container flex justify-center">
            <div
                class="screen dark:shadow-custom sm:relative"
                :style="this.bgScreen"
            >
              <div class="screen2"></div>
            </div>
          </div>

          <div
              class="flex justify-center items-center gap-x-14 gap-y-10 flex-wrap"
          >
            <div class="cinema-seats left flex flex-wrap">
              <div
                  :key="i"
                  v-for="i in 6"
                  class="cinema-row flex flex-col flex-wrap"
                  :class="this.rowSeat(i)"
              >
                <!-- <div v-if="i > 3" class="md:m-2"></div> -->
                <div
                    v-for="(seatNumber, index) in getSeatNumbers(i)"
                    :key="index"
                    class="seat m-1 shadow-lg"
                    :class="seatParamClass(seatNumber, i)"
                    @click="reservSeat($event, seatNumber)"
                >
                  <p
                      class="absolute p-2 text-center opacity-40 font-bold w-full border-b-2 border-spacing-1 border-gray-100"
                  >
                    {{ seatNumber }}
                  </p>
                </div>
              </div>
            </div>
            <div class="cinema-seats right flex flex-wrap">
              <div
                  :key="i"
                  v-for="i in 6"
                  class="cinema-row shadow-gray-700"
                  :class="this.rowSeat(i)"
              >
                <!-- <div v-if="i <= 3" class="md:m-5"></div> -->

                <div
                    v-for="(seatNumber, index) in getSeatNumbers(i + 6)"
                    :key="index"
                    class="seat m-1 shadow-lg"
                    :class="seatParamClass(seatNumber, i)"
                    @click="reservSeat($event, seatNumber)"
                >
                  <p
                      class="absolute p-2 text-center opacity-40 font-bold border-b-2 border-spacing-1 border-gray-100"
                  >
                    {{ seatNumber }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="pl-5">
          <p class="max-h-40 overflow-y-hidden py-2">
            {{ event.description }}
          </p>
          <p class="flex text-md my-2">
            <span class="font-bold mr-1">Actor:</span> {{ event.actors }}
          </p>
          <p class="flex text-md my-2">
            <span class="font-bold mr-1">Date: </span> {{ event.date }}
            <span class="fo-bold px-2">|</span>
            <span class="font-bold mr-1">Hall: </span>{{ event.hallNumber }}
          </p>
          <p class="flex text-md my-2">
            <span class="font-bold mr-1">Rating: </span>{{ event.imdbRating }}
            <span class="fo-bold px-2">|</span>
            <span class="font-bold mr-1">Lang: </span> {{ event.language }}
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
  </div>
</template>


<script>
import site from "../components/site.vue";

export default {
  name: "reserv",
  components: {
    site,
  },
  data() {
    return {
      event: {},
      hall: [],
      seatNumbers: [],
      reservedSeats: [],
      numberOfSeats: null,
      userReservedSeats: [],
      bgScreen: "background: #fff;",
      user: localStorage.getItem("auth:cinhall")
          ? this.parseJwt(JSON.stringify(localStorage.getItem("auth:cinhall")))
          : null,
    };
  },
  methods: {
    rowSeat(j) {
      return `row-${j}`;
    },
    seatParamClass(seatNumber, i) {
      let classSeat = "";
      classSeat += this.reservedSeats.includes(seatNumber)
          ? i === 3
              ? "mr-4 redSeat cursor-not-allowed"
              : "redSeat cursor-not-allowed"
          : i === 3
              ? "mr-4 greenSeat"
              : "greenSeat";
      classSeat += this.userReservedSeats.includes(seatNumber)
          ? " orangeSeat"
          : "";
      return classSeat;
    },
    compareDates(date) {
      const currentDate = new Date();
      return new Date(date) < currentDate;
    },
    async setSiteParam() {
      const jwt = JSON.parse(localStorage.getItem("auth:cinhall"));
      const TmpUser = !this.user ? 0 : this.user.user;
      await axios({
        method: "get",
        url: `${config.API_URL}reservation/getExist/${TmpUser}/${this.$route.params.id}`,
        headers: {
          "Content-Type": "application/json",
        },
      })
          .then((result) => {
            this.reservedSeats = result.data.map((item) => item.seat);
          })
          .catch((error) => {
            Swal.fire({
              position: "center",
              icon: "error",
              title:
                  error &&
                  error.response &&
                  error.response.data &&
                  error.response.data.message
                      ? error.response.data.message
                      : error,
              showConfirmButton: false,
              timer: 3000,
            });
          });
      await axios({
        method: "get",
        url: `${config.API_URL}reservation/getUserExist/${TmpUser}/${this.$route.params.id}`,
        headers: {
          "Content-Type": "application/json",
        },
      })
          .then((result) => {
            this.userReservedSeats = result.data.map((item) => item.seat);
          })
          .catch((error) => {
            Swal.fire({
              position: "center",
              icon: "error",
              title:
                  error &&
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
    getSeatNumbers(rowNumber) {
      const seatNumbers = [];

      for (let i = 1; i <= Math.round(this.numberOfSeats / 4 / 3); i++) {
        const seatNumber =
            (rowNumber - 1) * Math.round(this.numberOfSeats / 4 / 3) + i;
        seatNumbers.push(seatNumber);
      }

      return seatNumbers;
    },
    async getEvent() {
      await axios({
        method: "get",
        url: `${config.API_URL}event/getDetailEvent/${this.$route.params.id}`,
        headers: {
          "Content-Type": "application/json",
        },
      })
          .then((result) => {
            this.event = result.data;
            this.numberOfSeats = result.data.nbrPlace;
            this.bgScreen = `background-image: url('${result.data.image}');`;
          })
          .catch((error) => {
            Swal.fire({
              position: "center",
              icon: "error",
              title:
                  error &&
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
    },
    getSpacerClass(groupIndex) {
      const remainingColumns = 14 - ((groupIndex * 4) % 14);
      return `col-span-${remainingColumns}`;
    },
    async reservSeat(e, seatNumber) {
      if (!localStorage.getItem("auth:cinhall")) {
        Swal.fire({
          position: "center",
          icon: "error",
          title: "You must be logged in to reserve a seat",
          showConfirmButton: false,
          timer: 2000,
        });
        DarkSwal();
        this.$router.push("/login");
        return;
      }
      if (this.reservedSeats.includes(seatNumber)) {
        Swal.fire({
          position: "center",
          icon: "error",
          title: "You can't reserve this seat",
          showConfirmButton: false,
          timer: 2000,
        });
        DarkSwal();
        return;
      }
      if (this.userReservedSeats.includes(seatNumber)) {
        Swal.fire({
          title: "Are you sure?",
          text: "Are you sure you want to cancel this reservation?",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, cancel it!",
        }).then(async (result) => {
          if (result.isConfirmed) {
            if (this.compareDates(this.event.eventDate)) {
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
            const ReservationData = {
              event: this.$route.params.id,
              user: this.user.user,
              seat: seatNumber,
            };
            await axios({
              method: "DELETE",
              url: `${config.API_URL}reservation/delete`,
              data: ReservationData,
              headers: {
                Authorization: `Bearer ${jwt}`,
              },
            })
                .then((result) => {
                  if (result.data.success) {
                    let index = this.userReservedSeats.indexOf(seatNumber);
                    if (index !== -1) {
                      this.userReservedSeats.splice(index, 1);
                    }
                    const seat = e.target.parentNode;
                    seat.classList.add("greenSeat");
                    seat.classList.remove("orangeSeat");
                    Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "Reservation canceled successfully",
                      showConfirmButton: false,
                      timer: 3000,
                    });
                  } else {
                    Swal.fire({
                      position: "center",
                      icon: "error",
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
          }
        });
        DarkSwal();
        return;
      }
      Swal.fire({
        title: "Are you sure?",
        text: "You want to reserve this seat",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, reserve it!",
      }).then(async (result) => {
        if (result.isConfirmed) {
          const jwt = JSON.parse(localStorage.getItem("auth:cinhall"));
          const ReservationData = new FormData();
          ReservationData.append("seat", seatNumber);
          ReservationData.append("event", this.$route.params.id);
          ReservationData.append("user", this.user.user);
          await axios({
            method: "POST",
            url: `${config.API_URL}reservation/add`,
            data: ReservationData,
            headers: {
              Authorization: `Bearer ${jwt}`,
            },
          })
              .then(async (result) => {
                if (result.data.success) {
                  this.userReservedSeats.push(seatNumber);
                  const seat = e.target.parentNode;
                  seat.classList.add("orangeSeat");
                  seat.classList.remove("greenSeat");
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Your reservation has been added successfully",
                    showConfirmButton: false,
                    timer: 3000,
                  });
                  await DarkSwal();
                } else {
                  Swal.fire({
                    position: "center",
                    icon: "error",
                    title: result.data.message,
                    showConfirmButton: false,
                    timer: 3000,
                  });
                  await DarkSwal();
                }
              })
              .catch(async (error) => {
                Swal.fire({
                  position: "center",
                  icon: "error",
                  title: error.response.data.message,
                  showConfirmButton: false,
                  timer: 3000,
                });
                await DarkSwal();
              });
        }
      });
      DarkSwal();
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
  },
  async created() {
    await this.getEvent();
    for (let i = 1; i <= this.numberOfSeats; i++) {
      this.seatNumbers.push(i);
    }
    await this.setSiteParam();
  },
  beforeCreate() {
    // if (!auth()) this.$router.push({ name: "login" });
    if (!this.$route.params.id) this.$router.push({name: "event"});
  },
};
</script>

<style>
.container {
  perspective: 1000px;
}

.screen {
  height: 170px;
  width: 80%;
  margin: 15px 0;
  /* transform: rotateX(-45deg); */
  background-size: contain;
  background-attachment: scroll;
  /* background-repeat: no-repeat; */
  background-clip: border-box;
  background-position: center;
  transform: rotate3d(1, 0, 0, -45deg);
  box-shadow: 0 3px 10px rgba(72, 104, 117, 0.5) !important;
}

.screen2 {
  height: 100%;
  width: 100%;
  background: #54b5ff;
  opacity: 0.5;
  z-index: 1;
  /* transform: rotate3d(1, 0, 0, -45deg); */
  box-shadow: 0 3px 10px rgba(157, 221, 244, 0.7);
}

.shadow-custom {
  box-shadow: 0 3px 10px rgba(255, 255, 255, 0.7);
}

.theatre {
  /* display: flex; */
  /* position: absolute; */
  /* position: fixed; */
  /* top: 100%; */
  /* left: 50%; */
}

.cinema-seats {
  display: flex;
}

.cinema-seats .seat {
  cursor: pointer;
}

.cinema-seats .seat:hover:before {
  content: "";
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  border-radius: 7px;
}

.cinema-seats .seat.active:before {
  content: "";
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.6);
  border-radius: 7px;
}

.left .cinema-row {
  transform: skew(-15deg);
  margin: 0 6px;
}

.left .seat {
  width: 35px;
  height: 50px;
  border-radius: 7px;
  background: linear-gradient(
      to top,
      #a01f1f,
      #761818,
      #761818,
      #761818,
      #761818,
      #b54041,
      #f3686a
  );
  margin-bottom: 10px;
  transform: skew(20deg);
  margin-top: -32px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

.left .row-2 {
  transform: skew(-13deg);
}

.left .row-2 .seat {
  transform: skew(18deg);
}

.left .row-3 {
  transform: skew(-12deg);
}

.left .row-3 .seat {
  transform: skew(16deg);
}

.left .row-4 {
  transform: skew(-11deg);
}

.left .row-4 .seat {
  transform: skew(15deg);
}

.left .row-5 {
  transform: skew(-10deg);
}

.left .row-5 .seat {
  transform: skew(12deg);
}

.left .row-6 {
  transform: skew(-9deg);
}

.left .row-6 .seat {
  transform: skew(10deg);
}

.left .row-7 {
  transform: skew(-7deg);
}

.left .row-7 .seat {
  transform: skew(8deg);
}

.right {
  /* margin-left: 80px; */
}

.right .cinema-row {
  transform: skew(7deg);
  margin: 0 6px;
}

.right .seat {
  width: 35px;
  height: 50px;
  border-radius: 7px;
  background: linear-gradient(
      to top,
      #a01f1f,
      #761818,
      #761818,
      #761818,
      #761818,
      #b54041,
      #f3686a
  );
  margin-bottom: 10px;
  transform: skew(-8deg);
  margin-top: -32px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

.right .row-2 {
  transform: skew(9deg);
}

.right .row-2 .seat {
  transform: skew(-10deg);
}

.right .row-3 {
  transform: skew(10deg);
}

.right .row-3 .seat {
  transform: skew(-12deg);
}

.right .row-4 {
  transform: skew(11deg);
}

.right .row-4 .seat {
  transform: skew(-15deg);
}

.right .row-5 {
  transform: skew(12deg);
}

.right .row-5 .seat {
  transform: skew(-16deg);
}

.right .row-6 {
  transform: skew(13deg);
}

.right .row-6 .seat {
  transform: skew(-18deg);
}

.right .row-7 {
  transform: skew(15deg);
}

.right .row-7 .seat {
  transform: skew(-20deg);
}

/* Chaise vide */
.greenSeat {
  background: linear-gradient(
      to top,
      #025f0d,
      #1b7c2c,
      #1b7c2c,
      #1b7c2c,
      #1b7c2c,
      #1dd45c,
      #2bff9c
  ) !important;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3) !important;
}

/* Chaise réservée */
.yellowSeat {
  background: linear-gradient(
      to top,
      #ffd600,
      #bfa300,
      #bfa300,
      #bfa300,
      #bfa300,
      #ffee00,
      #fff94d
  ) !important;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3) !important;
}

/* Chaise occupée */
.redSeat {
  background: linear-gradient(
      to top,
      #a01f1f,
      #761818,
      #761818,
      #761818,
      #761818,
      #b54041,
      #f3686a
  ) !important;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3) !important;
}

/* Chaise sélectionnée */
.orangeSeat {
  background: linear-gradient(
      to top,
      #ff9000,
      #bf6b00,
      #bf6b00,
      #bf6b00,
      #bf6b00,
      #ffc04d,
      #ffd68f
  ) !important;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3) !important;
}
</style>