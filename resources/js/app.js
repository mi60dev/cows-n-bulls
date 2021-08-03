require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Routes from './routes'

Vue.use(VueRouter)
const router = new VueRouter({ routes: Routes });

const app = new Vue({
    el: '#app',
    router,
});
