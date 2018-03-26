import swal from 'sweetalert';
import Vue from 'vue';

require('./bootstrap');

Vue.component('v-editor', require('./components/editor'));

new Vue({
    el: '#app',
});
