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

        save: function () {
            this.saveToLocal();
        },

        /**
         * 从本地加载笔记
         */
        loadFromLocal: function () {
            var notes = localStorage.getItem('notes');
            if (notes) {
                this.notes = JSON.parse(notes);
                this.note = this.notes[0];
            }
        },

        /**
         * 保存笔记到本地
         */
        saveToLocal: function () {
            localStorage.setItem('notes', JSON.stringify(this.notes));
        },

        /**
         * 保存笔记到服务端
         */
        saveToServer: function () {
            var note = this.note;
            var app = this;

            if (note.id) {
                axios.put('notes/'+note.id, note).catch(function (error) {
                    console.log(error);
                });
            } else {
                axios.post('notes', note).then(function (response) {
                    note.id = response.data.note.id;
                    app.saveToLocal();
                }).catch(function (error) {
                    console.log(error.response.status);
                });
            }
        },

        /**
         * 监听笔记内容
         */
        watchContent: function () {
            let app = this;
            this.cancelContentWatcher = this.$watch('note.content', function () {
                // 获取当前编辑中的笔记
                var note = JSON.parse(JSON.stringify(app.note));

                app.note.updated_at = currentDatetime();
                app.saveToLocal();
            });
        },
    },

    mounted: function () {
        this.loadFromLocal();

        if (this.notes.length < 1) {
            this.notes.push(this.note);
        }

        this.watchContent();
    }
});
