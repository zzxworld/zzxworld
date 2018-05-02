<template>
    <div class="container">
        <div class="content-header">
            <button type="button" class="btn btn-default" @click="openEditWindow=true">新增</button>
            <button type="button" class="btn btn-default">删除</button>
        </div>

        <div class="panel panel-default">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-center" width="50"><input type="checkbox" /></td>
                        <th>名称</th>
                        <th>网址</th>
                        <th>标签</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="site in sites">
                        <td class="text-center"><input type="checkbox" /></td>
                        <td>{{ site.name }}</td>
                        <td>{{ site.url }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <base-window
            title="新增站点"
            v-open-if="openEditWindow"
            @close="openEditWindow=false">
            <div class="form-group">
                <label>网址</label>
                <input class="form-control" type="">
            </div>
            <div class="form-group">
                <label>名称</label>
                <input class="form-control" type="">
            </div>
            <div class="form-group">
                <label>标签</label>
                <input class="form-control" type="">
                <span class="help-block">支持逗号分割多个标签</span>
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </base-window>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                openEditWindow: false,
            }
        },

        computed: {
            sites () {
                return this.$store.state.sites;
            }
        }
    }
</script>
