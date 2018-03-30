import swal from 'sweetalert';
import Vue from 'vue';

require('./bootstrap');

Vue.component('v-editor', require('./components/editor'));

let defaultNote = function () {
    return {
        id: null,
        content: null,
        created_at: null,
        updated_at: null,
    };
};

new Vue({
    el: '#notebook',

    data: {
        notes: [],
        note: defaultNote(),
    },

    methods: {
        add: function () {
            this.notes.unshift(defaultNote());
            this.note = this.notes[0];
        },

        select: function (note) {
            this.note = note;
        },
    },

    mounted: function () {
        if (this.notes.length < 1) {
            this.add();
        }
    }
});
