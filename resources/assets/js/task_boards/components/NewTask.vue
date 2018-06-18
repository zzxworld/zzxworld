<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="task-input input-group">
                <input class="form-control" type="text" placeholder="准备做点啥..." v-model="task" @keyup.enter="add">
                <div class="input-group-btn">
                    <button class="btn btn-primary" @click="add">添加</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export  default {
        data: function () {
            return {
                task: null
            };
        },

        methods: {
            add: function () {
                if (this.task) {
                    this.$emit('add', this.task);
                    this.task = null;
                }
            },
        }
    }
</script>
