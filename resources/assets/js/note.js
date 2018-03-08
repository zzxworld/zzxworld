import swal from 'sweetalert';

require('./bootstrap');

window.Vue = require('vue');

var app = new Vue({
    el: '#app-page',

    methods: {
        resizeEditor: _.debounce(function () {
            var element = $(this.$el).find('#editor-container');
            element.css('height', $(window).height()-element.offset().top-22);
        }, 100),

        autoSave: _.debounce(function () {
            console.log('saveing...');
        }, 1500),
    },

    mounted: function () {
        this.resizeEditor();

        $(window).on('resize', this.resizeEditor);
    }
});
