import '../bootstrap.js';
import Vue from 'vue';
import AppContent from './components/AppContent.vue';

new Vue({
    el: '#app',
    render: h => h(AppContent)
})
