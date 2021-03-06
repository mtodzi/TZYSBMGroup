/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import router from './router';
import store from './store/index';
import App from './components/App'

Vue.use(VueRouter);


const app = new Vue({
    el: '#app',
    data:{
    },
    render: h => h(App),
    router,
    store
});
