<template>
    <div id="app-notebook">
        <div id="app-notebook-content">
            <BaseEditor v-model="note.content" />
        </div>
        <div id="app-notebook-footer">
            <nav>
                <NoteList @selected="note=$event" />
                <button class="btn btn-default" type="button" @click="add" v-if="isExistNote">新增</button>
                <button class="btn btn-default" type="button" @click="save">保存</button>
            </nav>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';
    import BaseEditor from '../../../components/BaseEditor';
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
            NoteList,
        },

        data() {
            return {
                note: emptyNote(),
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
        },

        mounted() {
            let note = localStorage.getItem('note');
            if (note) {
                this.note = JSON.parse(note);
            }
        }
    }
</script>
