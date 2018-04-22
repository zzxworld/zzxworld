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

            // 检测用户是否已登录
            axios.get('user/sessions/check').then(function (response) {
                app.isLogined = response.data.is_logined;
                next();
            }).catch(function (error) {
                next();
            });

        }).queue(name, function (next) {

            // 提交本地笔记
            if (app.isLogined == false) {
                next();
            } else {
                axios.post('notebooks?nocache='+new Date().getTime(), {
                    notes: notes,
                }).then(function (response) {
                    next();
                }).catch(function (error) {
                    next();
                });
            }

        }).queue(name, function (next) {

            // 加载线上笔记
            if (app.isLogined == false) {
                next();
            } else {
                axios.get('notes').then(function (response) {
                    notes = response.data.notes;
                    app.notes = notes;
                    app.saveToLocal();
                    next();
                }).catch(function (error) {
                    next();
                });
            }

        }).queue(name, function (next) {

            // 设置本地编辑笔记
            if (notes.length > 0) {
                app.note = notes[0];
            } else {
                notes.push(app.note);
            }

            next();

        }).queue(name, function (next) {

            // 监听笔记内容编辑
            app.watchContent();
            next();

        }).dequeue(name);
    }
});
