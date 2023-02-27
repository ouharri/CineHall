import { createApp } from 'vue'
// import './style/index.css'
import App from './App.vue'
import './style.css'

import $ from "jquery";
window.$ = window.jQuery = $;   

import axios from 'axios';
window.axios = axios;

import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
// import 'sweetalert2/theme-borderless/borderless.css'
// import Swal from 'sweetalert2/dist/sweetalert2.js';
window.Swal = Swal;


import 'flowbite';

import router from "./router";

// import tail
// console.log(document.querySelector('.swal2-modal'))

createApp(App)
.use(router)
.mount('#app')
.use(Swal);
