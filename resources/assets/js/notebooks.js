import swal from 'sweetalert';
import Vue from 'vue';
import * as moment from 'moment';
import './bootstrap';

Vue.component('v-editor', require('./components/Editor'));
Vue.component('v-notebook-list', require('./notebooks/List'));

let currentDatetime = function () {
    return moment().format('YYYY-MM-DD HH:mm:ss');
}

let defaultNote = function () {
    return {
        id: null,
        content: null,
        created_at: currentDatetime(),
        updated_at: currentDatetime(),
    };
};

new Vue({
    el: '#notebook',

    data: {
        notes: [],
        note: defaultNote(),

        cancelContentWatcher: null,
    },

    methods: {
        add: function () {
            this.note = defaultNote();
            this.notes.unshift(this.note);
        },

        select: function (note) {
            this.cancelContentWatcher();
            this.note = note;
            this.watchContent();
        },

        watchContent: function () {
            let app = this;
            this.cancelContentWatcher = this.$watch('note.content', function () {
                app.note.updated_at = currentDatetime();
            });
        },
    },

    mounted: function () {
        if (this.notes.length < 1) {
            this.notes.push(this.note);
        }

        this.watchContent();
    }
});
