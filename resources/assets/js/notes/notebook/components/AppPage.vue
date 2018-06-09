<template>
    <div class="container">
        <div class="form-group">
            <HTMLEditor v-model="note.content" />
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="button" @click="save">保存</button>
        </div>
        <div>{{ note.content }}</div>
    </div>
</template>

<script>
    import HTMLEditor from './HTMLEditor';
    import swal from 'sweetalert';

    export default {
        components: {
            HTMLEditor
        },

        data() {
            return {
                note: {
                    id: 0,
                    content: '',
                }
            };
        },

        methods: {
            save() {
                const errorHandler =  error => {
                    const code = error.response.status;

                    if (code == 403) {
                        return swal('', '请先登录!', 'warning');
                    } else if (code == 422) {
                        return swal('', error.response.data.message, 'warning');
                    }

                    swal('', '保存失败!', 'error');
                }

                if (this.note.id > 0) {
                    axios.put('notes/'+this.note.id, this.note).then(response => {
                        this.note.id = response.data.note.id;
                    }).catch(errorHandler);
                } else {
                    axios.post('notes', this.note).then(response => {
                        this.note.id = response.data.note.id;
                    }).catch(errorHandler);
                }
            }
        }
    }
</script>
