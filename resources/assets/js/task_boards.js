import swal from 'sweetalert';

require('./bootstrap');

window.Vue = require('vue');

Vue.component('v-window', require('./components/Window.vue'));
Vue.component('v-new-task', require('./task_boards/NewTask.vue'));
Vue.component('v-task-block', require('./task_boards/TaskBlock.vue'));

new Vue({
    el: '#app',

    data: {
        isMounted: false,
        openHelpWindow: false,

        pendingList: [],
        doingList: [],
        finishList: [],
    },

    computed: {
        tasks: function () {
            return this.pendingList.map(function (rs) {
                return {name: rs.name , status: 0};
            }).concat(this.doingList.map(function (rs) {
                return {name: rs.name, status: 1};
            })).concat(this.finishList.map(function (rs) {
                return {name: rs.name, status: 2};
            }));
        }
    },

    watch: {
        tasks: function (value) {
            if (this.isMounted) {
                this.isMounted = false;
                return;
            }
            this.save();
        },
    },

    methods: {
        add: function (value) {
            this.pendingList.unshift({name: value});
        },

        save: function () {
            localStorage.setItem('tasks', JSON.stringify(this.tasks));
        },
    },

    mounted: function () {
        var tasks = localStorage.getItem('tasks');
        if (tasks) {
            tasks = JSON.parse(tasks);

            this.isMounted = true;

            this.pendingList = tasks.filter(function (rs) {
                return rs.status == 0;
            }).map(function (rs) {
                return {name: rs.name};
            });

            this.doingList = tasks.filter(function (rs) {
                return rs.status == 1;
            }).map(function (rs) {
                return {name: rs.name};
            });

            this.finishList = tasks.filter(function (rs) {
                return rs.status == 2;
            }).map(function (rs) {
                return {name: rs.name};
            });

        }
    }
});
