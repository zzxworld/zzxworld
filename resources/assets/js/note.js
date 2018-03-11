import swal from 'sweetalert';

require('./bootstrap');

window.Vue = require('vue');

$.ajaxSetup({
    dataType: 'json',
    contentType: 'application/json',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});

var app = new Vue({
    el: '#app-page',

    data: {
        note: {
            id: 0,
            content: '',
        },
    },

    watch: {
        'note.content': function (value) {
            this.autoSave();
        },
    },

    methods: {
        resizeEditor: _.debounce(function () {
            var element = $(this.$el).find('#editor-container');
            element.css('height', $(window).height()-element.offset().top-22);
        }, 100),

        save: function () {
            $.ajax({
                url: '/notes',
                method: 'post',
                data: JSON.stringify(this.note),
                success: function (response) {
                    console.log(response);
                }
            });
        },

        autoSave: _.debounce(function () {
            localStorage.setItem('note_draft', JSON.stringify(this.note));
        }, 1500),
    },

    mounted: function () {
        var note = localStorage.getItem('note_draft');
        if (note) {
            this.note = JSON.parse(note);
        }

        this.resizeEditor();

        window.onresize = this.resizeEditor;
    }
});
