<style lang="scss">
    .label-tag {
        margin-right: 0.5em;
    }
</style>

<template>
    <div class="container">
        <div class="content-header">
            <button type="button" class="btn btn-default" @click="openEditWindow=true">新增</button>
            <button type="button" class="btn btn-default" :disabled="!selected.length" @click="del">删除</button>
        </div>

        <div class="panel panel-default">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-center" width="50">
                            <input type="checkbox" @change="toggleSelectAll" />
                        </td>
                        <th>名称</th>
                        <th>网址</th>
                        <th>标签</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="site in sites">
                        <td class="text-center">
                            <input type="checkbox" :value="site.id" v-model="selected" />
                        </td>
                        <td><a href="javascript:;" @click="edit(site)">{{ site.name }}</a></td>
                        <td>{{ site.url }}</td>
                        <td><span class="label-tag label label-default" v-for="tag in site.tags">{{ tag.name }}</span></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <base-window
            id="add-window"
            title="新增站点"
            v-open-if="openEditWindow"
            @close="openEditWindow=false">
            <div class="form-group">
                <label>网址</label>
                <input class="form-control" type="text" v-model="site.url">
            </div>
            <div class="form-group">
                <label>名称</label>
                <input class="form-control" type="text" v-model="site.name">
            </div>
            <div class="form-group">
                <label>标签</label>
                <input class="form-control" type="text" v-model="site.tags">
                <span class="help-block">支持逗号分割多个标签</span>
            </div>
            <button type="submit" class="btn btn-primary" @click="save">保存</button>
        </base-window>
    </div>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        data () {
            return {
                site: {},
                selected: [],
                openEditWindow: false,
            }
        },

        computed: {
            sites () {
                return this.$store.state.sites;
            },

            siteTags () {
                var tags = [];

                if (this.site.hasOwnProperty('tags') && typeof this.site.tags == 'string') {
                    tags = this.site.tags.replace(/，/g, ',').split(',').filter((rs) => {
                        return rs && rs.trim() != '';
                    }).filter((rs, pos, self) => {
                        return self.indexOf(rs) === pos;
                    }).map((rs) => {
                        return rs.trim();
                    });
                }

                return tags;
            },
        },

        methods: {
            toggleSelectAll (e) {
                if (e.target.checked) {
                    this.selected = this.sites.map((site) => {
                        return site.id;
                    })
                } else {
                    this.selected = [];
                }
            },

            edit (site) {
                this.site = site;
                this.openEditWindow = true;
            },

            save () {
                if (!this.site.url) {
                    swal('', '网址没有输入', 'warning')
                    return false;
                }

                let successCallback = (response) => {
                    if (response.data.message != 'ok') {
                        swal('', response.data.message, 'warning')
                    } else {
                        this.$store.dispatch('loadList')
                        $('#add-window').modal('hide')
                    }
                }

                let failureCallback = (error) => {
                    if (error.response.status == 422) {
                        swal('', error.response.data.message, 'error')
                    } else {
                        swal('', '保存站点失败', 'error')
                    }
                }

                let data = this.site;

                data.tags = this.siteTags;

                let url = '/admin/sites';

                if (this.site.id > 0) {
                    axios.put('/admin/sites/'+data.id, data).then(successCallback).catch(failureCallback);
                } else {
                    axios.post('/admin/sites', data).then(successCallback).catch(failureCallback);
                }
            },

            del () {
                let app = this;

                swal({
                    text: '确定要删除选择的站点吗?',
                    dangerMode: true,
                    buttons: ['取消', '确定'],
                }).then((confirmed) => {
                    axios.delete('/admin/sites/bulk_destroy', {
                        params: {
                            ids: this.selected,
                        }
                    }).then((response) => {
                        this.$store.dispatch('loadList')
                    }).catch((error) => {
                        swal('', '删除操作失败', 'error')
                    });
                })
            }
        },

        mounted () {
            this.$store.dispatch('loadList')
        }
    }
</script>
