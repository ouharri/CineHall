<template>
  <div
      class="calendar mb-10 border-zinc-200 bg-gradient-to-tr from-gray-100 dark:2xl:border-zinc-700 dark:from-black/10 to-transparent dark:text-gray-200 transition duration-1000 ease-linear overflow-hidden shadow-inner"
  >
    <div class="calendar-header bg-red-600">
      <span class="month-picker" id="month-picker"> May </span>
      <div class="year-picker" id="year-picker">
        <span class="year-change" id="pre-year">
          <pre>&lt;</pre>
        </span>
        <span id="year">2020 </span>
        <span class="year-change" id="next-year">
          <pre>&gt;</pre>
        </span>
      </div>
    </div>

    <div class="calendar-body">
      <div class="calendar-week-days mt-3">
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
        <div>Sun</div>
        <div>Mon</div>
      </div>
      <div class="calendar-days"></div>
    </div>
    <div class="calendar-footer"></div>
    <div
        class="date-time-formate h-fit relative top-[100px] flex w-full align-middle items-center justify-center gap-7"
    >
      <div class="day-text-formate border-r-4 border-red-600">TODAY</div>
      <div class="date-time-value">
        <div class="time-formate">02:51:20</div>
        <div class="date-formate">23 - july - 2022</div>
      </div>
    </div>
    <div
        class="month-list grid relative bottom-[25px] justify-center items-center border border-red-600 dark:text-gray-200 overflow-x-hidden"
    ></div>
  </div>
</template>

<script>
export default {
  mounted() {
    const isLeapYear = (year) => {
      return (
          (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) ||
          (year % 100 === 0 && year % 400 === 0)
      );
    };
    const getFebDays = (year) => {
      return isLeapYear(year) ? 29 : 28;
    };
    let calendar = document.querySelector(".calendar");
    const month_names = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];

    let month_picker = document.querySelector("#month-picker");
    const dayTextFormate = document.querySelector(".day-text-formate");
    const timeFormate = document.querySelector(".time-formate");
    const dateFormate = document.querySelector(".date-formate");

    month_picker.innerHTML = "";

    month_picker.onclick = () => {
      month_list.classList.remove("hideonce");
      month_list.classList.remove("hide");
      month_list.classList.add("show");
      dayTextFormate.classList.remove("showtime");
      dayTextFormate.classList.add("hidetime");
      timeFormate.classList.remove("showtime");
      timeFormate.classList.add("hideTime");
      dateFormate.classList.remove("showtime");
      dateFormate.classList.add("hideTime");
    };

    const generateCalendar = (month, year) => {
      let calendar_days = document.querySelector(".calendar-days");
      let calendar_header_year = document.querySelector("#year");
      let days_of_month = [
        31,
        getFebDays(year),
        31,
        30,
        31,
        30,
        31,
        31,
        30,
        31,
        30,
        31,
      ];

      calendar_days.innerHTML = "";
      let currentDate = new Date();

      month_picker.innerHTML = month_names[month];

      calendar_header_year.innerHTML = year;

      let first_day = new Date(year, month);

      for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
        let day = document.createElement("div");

        if (i >= first_day.getDay()) {
          day.innerHTML = i - first_day.getDay() + 1;
          const date =
              year + "-" + (month + 1) + "-" + (i - first_day.getDay() + 1);

          if (
              i - first_day.getDay() + 1 === currentDate.getDate() &&
              year === currentDate.getFullYear() &&
              month === currentDate.getMonth()
          ) {
            day.classList.add("current-date");
          }

          if (
              year < currentDate.getFullYear() ||
              (year === currentDate.getFullYear() &&
                  month < currentDate.getMonth()) ||
              (year === currentDate.getFullYear() &&
                  month === currentDate.getMonth() &&
                  i - first_day.getDay() + 1 < currentDate.getDate())
          ) {
            day.classList.add("cursor-not-allowed");
            day.classList.add("hover:bg-gray-200");
          } else if ((i + 1) % 7 === 0) {
            day.classList.add("cursor-not-allowed");
            day.classList.add("hover:bg-gray-200");
          } else {
            day.setAttribute("x-date", date);
            day.onclick = () => {
              this.$emit('clikedDate', date);
            };
          }
        } else {
          day.classList.add("cursor-auto");
          day.classList.add("bg-transparent");
        }

        calendar_days.appendChild(day);
      }
    };

    let month_list = calendar.querySelector(".month-list");
    month_list.innerHTML = "";
    month_names.forEach((e, index) => {
      let month = document.createElement("div");
      month.innerHTML = `<div>${e}</div>`;

      month_list.append(month);
      month.onclick = () => {
        currentMonth.value = index;
        generateCalendar(currentMonth.value, currentYear.value);
        month_list.classList.replace("show", "hide");
        dayTextFormate.classList.remove("hideTime");
        dayTextFormate.classList.add("showtime");
        timeFormate.classList.remove("hideTime");
        timeFormate.classList.add("showtime");
        dateFormate.classList.remove("hideTime");
        dateFormate.classList.add("showtime");
      };
    });

    (function () {
      month_list.classList.add("hideonce");
    })();
    document.querySelector("#pre-year").onclick = () => {
      --currentYear.value;
      generateCalendar(currentMonth.value, currentYear.value);
    };
    document.querySelector("#next-year").onclick = () => {
      ++currentYear.value;
      generateCalendar(currentMonth.value, currentYear.value);
    };

    let currentDate = new Date();
    let currentMonth = {value: currentDate.getMonth()};
    let currentYear = {value: currentDate.getFullYear()};
    generateCalendar(currentMonth.value, currentYear.value);

    const todayShowTime = document.querySelector(".time-formate");
    const todayShowDate = document.querySelector(".date-formate");

    const currshowDate = new Date();
    const showCurrentDateOption = {
      year: "numeric",
      month: "long",
      day: "numeric",
      weekday: "long",
    };
    todayShowDate.textContent = new Intl.DateTimeFormat(
        "en-US",
        showCurrentDateOption
    ).format(currshowDate);
    setInterval(() => {
      const timer = new Date();
      const option = {
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
      };
      const formateTimer = new Intl.DateTimeFormat("en-us", option).format(
          timer
      );
      todayShowTime.textContent = `${`${timer.getHours() - 1}`.padStart(
          2,
          "0"
      )}:${`${timer.getMinutes()}`.padStart(
          2,
          "0"
      )}: ${`${timer.getSeconds()}`.padStart(2, "0")}`;
    }, 1000);
  },
};
</script>

<style>
:root {
  --dark-text: #f8fbff;
  --light-body: #f3f8fe;
  --light-main: #fdfdfd;
  --light-second: #c3c2c8;
  --light-hover: #f0f0f0;
  --light-text: #151426;
  --light-btn: #f5c518;
  --white: #fff;
  --shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  --font-family: consolas;
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

.calendar {
  /* height: 550px; */
  margin: 0;
  border-radius: 25px;
  overflow: hidden;
  padding: 50px 100px 0px 100px;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 700;
  color: var(--white);
  padding: 10px;
}

.calendar-body {
  padding-top: 10px;
}

.calendar-week-days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  font-weight: 600;
  cursor: pointer;
  color: rgb(104, 104, 104);
}

.calendar-week-days div:hover {
  color: black;
  transform: scale(1.2);
  transition: all 0.2s ease-in-out;
}

.calendar-week-days div {
  display: grid;
  place-items: center;
  color: var(--bg-second);
  height: 50px;
}

.calendar-days {
  display: grid;
  justify-items: center;
  grid-template-columns: repeat(7, 1fr);
  /* gap: 10px; */
  color: var(--color-txt);
}

.calendar-days div {
  width: 37px;
  height: 33px;
  display: flex;
  align-items: center;
  justify-content: center;
  /* padding: 5px; */
  position: relative;
  cursor: pointer;
  animation: to-top 1s forwards;
}

.month-picker {
  padding: 5px 10px;
  border-radius: 10px;
  cursor: pointer;
}

.month-picker:hover {
  background-color: var(--color-hover);
}

.month-picker:hover {
  color: var(--color-txt);
}

.year-picker {
  display: flex;
  align-items: center;
}

.year-change {
  height: 30px;
  width: 30px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  margin: 0px 10px;
  cursor: pointer;
}

.year-change:hover {
  background-color: var(--light-btn);
  transition: all 0.2s ease-in-out;
  transform: scale(1.12);
}

.year-change:hover pre {
  color: var(--bg-body);
}

.calendar-footer {
  padding: 10px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

#year:hover {
  cursor: pointer;
  transform: scale(1.2);
  transition: all 0.2 ease-in-out;
}

.calendar-days div span {
  position: absolute;
}

.calendar-days div:hover {
  transition: width 0.2s ease-in-out, height 0.2s ease-in-out;
  background-color: #f5c518;
  border-radius: 20%;
  color: var(--dark-text);
}

.calendar-days div.current-date {
  color: var(--dark-text);
  background-color: red;
  border-radius: 20%;
}

.current-date {
  background-color: red !important;
  z-index: 10;
}

.month-list {
  color: var(--light-text);
  grid-template-columns: repeat(3, auto);
  border-radius: 20px;
}

.month-list > div {
  display: grid;
  place-content: center;
  /* margin: 5px 10px; */
  transition: all 0.2s ease-in-out;
}

.month-list > div > div {
  border-radius: 15px;
  padding: 10px;
  cursor: pointer;
}

.month-list > div > div:hover {
  background-color: var(--light-btn);
  color: var(--dark-text);
  transform: scale(0.9);
  transition: all 0.2s ease-in-out;
}

.month-list.show {
  visibility: visible;
  pointer-events: visible;
  transition: 0.6s ease-in-out;
  animation: to-left 0.71s forwards;
}

.month-list.hideonce {
  visibility: hidden;
}

.month-list.hide {
  animation: to-right 1s forwards;
  visibility: none;
  pointer-events: none;
}

.date-time-formate {
  height: max-content;
  font-family: Dubai Light, Century Gothic;
}

.day-text-formate {
  font-family: Microsoft JhengHei UI;
  font-size: 1.4rem;
  padding-right: 5%;
}

.date-time-value {
  display: block;
  height: max-content;
  width: max-content;
  text-align: center;
}

.time-formate {
  font-size: 1.5rem;
}

.time-formate.hideTime {
  animation: hidetime 1.5s forwards;
}

.day-text-formate.hidetime {
  animation: hidetime 1.5s forwards;
}

.date-formate.hideTime {
  animation: hidetime 1.5s forwards;
}

.day-text-formate.showtime {
  animation: showtime 1s forwards;
}

.time-formate.showtime {
  animation: showtime 1s forwards;
}

.date-formate.showtime {
  animation: showtime 1s forwards;
}

.cursor-not-allowed {
  cursor: not-allowed !important;
}

.bg-transparent {
  background-color: transparent !important;
}

.cursor-auto {
  cursor: auto !important;
}

.hover\:bg-gray-200:hover {
  background-color: #818181 !important;
}

@keyframes to-top {
  0% {
    transform: translateY(0);
    opacity: 0;
  }

  100% {
    transform: translateY(100%);
    opacity: 1;
  }
}

@keyframes to-left {
  0% {
    transform: translatex(230%);
    opacity: 1;
  }

  100% {
    transform: translatex(0);
    opacity: 1;
  }
}

@keyframes to-right {
  10% {
    transform: translatex(0);
    opacity: 1;
  }

  100% {
    transform: translatex(-150%);
    opacity: 1;
  }
}

@keyframes showtime {
  0% {
    transform: translatex(250%);
    opacity: 1;
  }

  100% {
    transform: translatex(0%);
    opacity: 1;
  }
}

@keyframes hidetime {
  0% {
    transform: translatex(0%);
    opacity: 1;
  }
  100% {
    transform: translatex(-400%);
    opacity: 1;
  }
}

@media (max-width: 375px) {
  .month-list > div {
    margin: 5px 0px;
  }
}

@media (max-width: 520px) {
  .calendar {
    padding: 50px 50px 0px 50px;
  }

  .date-time-formate {
    padding: 0 10px;
  }

  .month-list {
    padding: 10px;
  }
}

@media (max-width: 421px) {
  .calendar {
    padding: 50px 20px 0px 20px;
  }
}

@media (max-width: 366px) {
  .calendar {
    padding: 0;
  }
}
</style>