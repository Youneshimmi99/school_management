/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

import Vue from "vue";
import routes from "./Routes";
import VueRouter from "vue-router";
Vue.use(VueRouter);
const router = new VueRouter({
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    routes // short for `routes: routes`
});

const app = new Vue({
    router,
    el: "#app"
});
