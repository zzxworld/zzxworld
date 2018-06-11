<template>
    <div id="app-notebook">
        <div id="app-notebook-content">
            <BaseEditor placeholder="记点什么..." v-model="note.content" />
        </div>
        <div id="app-notebook-footer">
            <nav>
                <NoteList :disabled="isNotLogin" @selected="selectNote" />
                <button class="btn btn-default" type="button" :disabled="isNotLogin" @click="save">
                    <span class="glyphicon glyphicon-floppy-disk"></span> 保存
                </button>
                <button class="btn btn-default" type="button" @click="add" v-if="isExistNote">
                    <span class="glyphicon glyphicon-file"></span> 新笔记
                </button>
                <div class="pull-right">
                    <button class="btn btn-default" @click="login" v-if="isNotLogin">登录</button>
                    <button class="btn btn-default" @click="logout" v-if="!isNotLogin">退出</button>
                </div>
            </nav>
        </div>
        <BaseLoginWindow :handle="openLoginWindow" @close="cancelLogin" @logined="loadUser" />
    </div>
</template>

<script>
    import queue from 'queue';
    import { warningAlert, errorAlert, confirmAlert } from '../../../helpers/alerts';
    import BaseEditor from '../../../components/BaseEditor';
    import BaseLoginWindow from '../../../components/BaseLoginWindow';
    import NoteList from './NoteList';

    const emptyNote = () => {
        return {
            id: 0,
            content: '',
        };
    }

    export default {
        components: {
            BaseEditor,
            BaseLoginWindow,
            NoteList,
        },

        data() {
            return {
                note: emptyNote(),
                user: null,
                openLoginWindow: false,
            };
        },

        computed: {
            isExistNote() {
                return this.note.id > 0;
            },

            isNotLogin() {
                return this.user === null;
            }
        },

        watch: {
            'note.content': _.debounce(function () {
                this.saveToLocal();
            }, 500)
        },

        methods: {
            add() {
                this.note = emptyNote();
            },

            save(callback = () => {}) {
                const successHandler = response => {
                    this.note.id = response.data.note.id;
                    this.saveToLocal();

                    callback();
                };

                const errorHandler =  error => {
                    const code = error.response.status;

                    if (code == 403) {
                        return warningAlert('请先登录!')
                    } else if (code == 422) {
                        return warningAlert(error.response.data.message);
                    }

                    errorAlert('保存笔记失败!');
                };

                if (this.note.id > 0) {
                    axios.put('notes/'+this.note.id, this.note).then(response => {
                        this.note.id = response.data.note.id;
                    }).catch(errorHandler);
                } else {
                    axios.post('notes', this.note).then(response => {
                        this.note.id = response.data.note.id;
                    }).catch(errorHandler);
                }
            },

            saveToLocal() {
                localStorage.setItem('note', JSON.stringify(this.note));
            },

            selectNote(note) {
                this.note = note;
                this.saveToLocal();
            },

            login() {
                this.openLoginWindow = true;
            },

            logout() {
                confirmAlert('确定要退出登录吗?', () => {
                    let q = queue();

                    q.push(next => {
                        this.save(next);
                    });

                    q.push(next => {
                        axios.post('logout').then(() => {
                            this.user = null;
                            next();
                        });
                    });

                    q.push(next => {
                        this.note = emptyNote();
                        this.saveToLocal();
                    });

                    q.start();
                });
            },

            cancelLogin() {
                this.openLoginWindow = false;
            },

            loadUser(callback = () => {}) {
                axios.get('users/sessions/user').then(response => {
                    this.user = response.data.user;
                    callback();
                });
            }
        },

        mounted() {
            let q = queue();

            q.push(next => {
                let note = localStorage.getItem('note');
                if (note) {
                    this.note = JSON.parse(note);
                }
            });

            q.push(next => {
                this.loadUser(next);
            });

            q.start();
        }
    }
</script>
