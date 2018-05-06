import Vue from 'vue'
import store from './store';
import '../bootstrap';

Vue.component('base-window', require('../components/Window'))
Vue.component('site-list', require('./components/SiteList'))

new Vue({
    store,
    el: '#app',
})
