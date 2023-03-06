import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/home.vue";

import Login from "../pages/auth/login.vue";
import Register from "../pages/auth/register.vue";
import Forgot from "../pages/auth/forgot.vue";

import Reserve from "../pages/reserve.vue";
import myreservation from "../pages/myReservation.vue"

import movie from "../pages/movie.vue";
import event from "../pages/event.vue";
import starts from "../pages/starts.vue";

import favorites from "../pages/favorites.vue";
import profile from "../pages/profile.vue";

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
                name : 'movies',
                path: '/movies',
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
                path: '/reserve/:id',
                component: Reserve,
                meta: {
                }
            },
            {
                name : 'event',
                path: '/event',
                component: event,
            },
            {
                name:'myreservation',
                path:'/reserve/my-reserve',
                component: myreservation,
            },
            {
                name:'favorites',
                path:'/favorites',
                component: favorites,
            },
            {
                name:'starts',
                path:'/starts',
                component: starts,
            },
            {
                name:'profile',
                path:'/profile',
                component: profile,
            },
            {
                path: '/:pathMatch(.*)*',
                redirect: '/'
            }
        ]
    }
)

export default router;