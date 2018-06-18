import Vue from 'vue'
import store from './store';
import '../bootstrap';

Vue.component('base-window', require('../components/Window.vue'))
Vue.component('site-list', require('./components/SiteList.vue'))

new Vue({
    store,
    el: '#app',
})
