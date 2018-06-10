<template>
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
</template>

<script>
    export default {
        data() {
            return {
                notes: []
            };
        },

        methods: {
            loadList() {
                axios.get('notes').then(response => {
                    this.notes = response.data.notes;
                });
            },

            select(note) {
                this.$emit('selected', note);
            }
        },

        mounted() {
            $('#app-notebook-list').on('show.bs.dropdown', () => {
                this.loadList();
            });
        }
    }
</script>
