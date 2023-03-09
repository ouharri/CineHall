import { createApp } from 'vue'

import App from './App.vue'
import './style.css'

import $ from "jquery";
window.$ = window.jQuery = $;

import axios from 'axios';
window.axios = axios;

import DarkSwal from './scripts/darkSwal';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import 'typeface-roboto'

window.Swal = Swal;
window.DarkSwal = DarkSwal;

import 'flowbite';
import  "flowbite/dist/flowbite.js";

import router from "./router";

import config from '../config'
window.config = config;

createApp(App)
.use(router)
.mount('#app');
