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
                <li class="footer" @click.stop>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">搜索</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <NoteListPagination :data="pagination" @goto="goto" />
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import NoteListPagination from './NoteListPagination';

    export default {
        components: {
            NoteListPagination
        },

        data() {
            return {
                notes: [],
                pagination: {},
                filter: {
                    limit: 2,
                    page: 1
                }
            };
        },

        methods: {
            loadList() {
                axios.get('notes', {
                    params: this.filter
                }).then(response => {
                    this.notes = response.data.notes;
                    this.pagination = response.data.pagination;
                });
            },

            select(note) {
                this.$emit('selected', note);
            },

            goto(page) {
                this.filter.page = page;
                this.loadList();
            }
        },

        mounted() {
            $('#app-notebook-list').on('show.bs.dropdown', () => {
                this.loadList();
            });
        }
    }
</script>
