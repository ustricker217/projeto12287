/*jshint esversion: 6 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);

const singleplayerGame = Vue.component('singlegame', require('./components/singleplayer_memory.vue'));
const multiplayerGame = Vue.component('multiplayergame', require('./components/multiplayer_memory.vue'));
const userLogin = Vue.component('login', require('./components/userLogin.vue'));
const user = Vue.component('user', require('./components/user.vue'));

const routes = [
    { path: '/', component: user },
    { path: '/singlememory', component: singleplayerGame },
    { path: '/multimemory', component: multiplayerGame },
    { path: '/login', component: userLogin },
];

const router = new VueRouter({
  routes:routes
});

const app = new Vue({
  router,
  data:{
    player1:undefined,
    player2: undefined,
    player3:undefined,
    player4: undefined,
  }
}).$mount('#app');

