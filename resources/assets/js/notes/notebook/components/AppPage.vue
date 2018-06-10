<template>
    <div id="app-notebook">
        <div id="app-notebook-content">
            <BaseEditor v-model="note.content" />
        </div>
        <div id="app-notebook-footer">
            <nav>
                <div class="btn-group dropup">
                    <div id="app-notebook-list" class="dropdown btn-note-list">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            笔记列表 <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="note" v-for="note in notes" :key="note.id">
                                <a href="javascript:;" @click="select(note)">{{ note.content.substr(0, 64) }}</a>
                            </li>
                            <li class="pagination" @click.stop>
                                <div class="input-group">
                                    <a class="input-group-addon" href="javascript:;">上页</a>
                                    <input type="text" class="form-control" placeholder="1/2" />
                                    <a class="input-group-addon" href="javascript:;">下页</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-default" type="button" @click="add" v-if="isExistNote">新增</button>
                <button class="btn btn-default" type="button" @click="save">保存</button>
            </nav>
        </div>
    </div>
</template>

<script>
    import BaseEditor from '../../../components/BaseEditor';
    import swal from 'sweetalert';

    const emptyNote = () => {
        return {
            id: 0,
            content: '',
        };
    }

    export default {
        components: {
            BaseEditor
        },

        data() {
            return {
                note: emptyNote(),
                notes: [],
            };
        },

        computed: {
            isExistNote() {
                return this.note.id > 0;
            },
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

            save() {
                const successHandler = response => {
                    this.note.id = response.data.note.id;
                    this.saveToLocal();
                };

                const errorHandler =  error => {
                    const code = error.response.status;

                    if (code == 403) {
                        return swal('', '请先登录!', 'warning');
                    } else if (code == 422) {
                        return swal('', error.response.data.message, 'warning');
                    }

                    swal('', '保存失败!', 'error');
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

            loadList() {
                axios.get('notes').then(response => {
                    this.notes = response.data.notes;
                });
            },

            select(note) {
                this.note = note;
            }
        },

        mounted() {
            let note = localStorage.getItem('note');
            if (note) {
                this.note = JSON.parse(note);
            }

            $('#app-notebook-list').on('show.bs.dropdown', () => {
                this.loadList();
            });
        }
    }
</script>
