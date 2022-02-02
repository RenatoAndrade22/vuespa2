/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue/dist/vue'
import axios from "axios"

import { BootstrapVue } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueToast from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-sugar.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
Vue.use(VueToast)

window.collect = require('collect.js')

window.Vue = Vue

import VueRouter from "vue-router";
import routes from "./routes";
Vue.component('layout-frontend', require('./layout/Layout').default);

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
