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
        isLogined: false,

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
        let app = this;
        let name = 'init';
        let notes = [];

        $(document).queue(name, function (next) {

            // 读取本读笔记
            let notesData = localStorage.getItem('notes');
            if (notesData) {
                notes = JSON.parse(notesData);
            }

            next();

        }).queue(name, function (next) {

            // 提交本地笔记
            axios.post('notebooks', {
                notes: notes,
            }).then(function (response) {
                app.isLogined = true;
                next();
            }).catch(function (error) {
                next();
            });

        }).queue(name, function (next) {

            // 如果成功登录时从线上加载笔记
            if (app.isLogined) {
                axios.get('notes').then(function (response) {
                    app.notes = response.data.notes;
                    next();
                }).catch(function (error) {
                    next();
                });

            // 否则使用本地笔记
            } else {
                app.notes = notes;
                next();
            }

        }).queue(name, function (next) {

            // 没有任何笔记时使用默认空白笔记
            if (app.notes.length > 0) {
                app.note = app.notes[0];
            } else {
                app.notes.push(app.note);
            }

            next();

        }).queue(name, function (next) {

            // 监听笔记内容编辑
            app.watchContent();
            next();

        }).dequeue(name);
    }
});
