import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/home.vue";

import Login from "../pages/auth/login.vue";
import Register from "../pages/auth/register.vue";
import Forgot from "../pages/auth/forgot.vue";

import Reserve from "../pages/reserve.vue";
import movie from "../pages/movie.vue";
import event from "../pages/event.vue";

const router = createRouter(
    {
        history: createWebHistory(),
        routes: [
            {
                name : 'home',
                path: '/',
                component: Home,
            },
            {
                name : 'login',
                path: '/login',
                component: Login,
                meta: {
                    hideNavbar: true
                }
            },
            {
                name : 'register',
                path: '/register',
                component: Register,
            },
            {
                name : 'movie',
                path: '/movie',
                component: movie,
                meta: {}
            },
            {
                name : 'forgot',
                path: '/forgot',
                component: Forgot,
            },
            {
                name : 'reserve',
                path: '/reserve',
                component: Reserve,
                meta: {
                }
            },
            {
                name : 'event',
                path: '/event',
                component: event,
            }
        ]
    }
)

export default router;