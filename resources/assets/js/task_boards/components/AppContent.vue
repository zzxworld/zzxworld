<template>
    <div class="container">
        <NewTask @add="add" />

        <div class="row">
            <div class="col-sm-4">
                <TaskBlock name="pending" title="准备做" :items="pendingList" />
            </div>
            <div class="col-sm-4">
                <TaskBlock name="doing" title="正在做" :items="doingList" />
            </div>
            <div class="col-sm-4">
                <TaskBlock name="finish" title="完成了" :items="finishList" :enable-clear-button="true" @clear="finishList=[]" />
            </div>
        </div>

        <footer id="page-footer">
            <ul>
                <li><a href="javascript:;" @click="openHelpWindow=true">使用帮助</a></li>
                <li><a href="/">zzxworld</a></li>
            </ul>
        </footer>

        <HelpWindow :handle="openHelpWindow" @close="openHelpWindow=false" />
    </div>
</template>

<script>
    import NewTask from './NewTask.vue';
    import TaskBlock from './TaskBlock.vue';
    import HelpWindow from './HelpWindow.vue';

    export default {
        components: {
            NewTask,
            TaskBlock,
            HelpWindow
        },

        data() {
            return {
                isMounted: false,
                openHelpWindow: false,

                pendingList: [],
                doingList: [],
                finishList: [],
            };
        },

        computed: {
            tasks() {
                return this.pendingList.map(rs => {
                    return { name: rs.name , status: 0 };
                }).concat(this.doingList.map(rs => {
                    return { name: rs.name, status: 1 };
                })).concat(this.finishList.map(rs => {
                    return { name: rs.name, status: 2 };
                }));
            }
        },

        watch: {
            tasks(value) {
                if (this.isMounted) {
                    this.isMounted = false;
                    return;
                }
                this.save();
            },
        },

        methods: {
            add(value) {
                this.pendingList.unshift({name: value});
            },

            save() {
                localStorage.setItem('tasks', JSON.stringify(this.tasks));
            },
        },

        mounted() {
            let tasks = localStorage.getItem('tasks');
            if (tasks) {
                tasks = JSON.parse(tasks);

                this.isMounted = true;

                this.pendingList = tasks.filter(rs => {
                    return rs.status == 0;
                }).map(rs => {
                    return { name: rs.name };
                });

                this.doingList = tasks.filter(rs => {
                    return rs.status == 1;
                }).map(rs => {
                    return { name: rs.name };
                });

                this.finishList = tasks.filter(rs => {
                    return rs.status == 2;
                }).map(rs => {
                    return { name: rs.name };
                });

            }
        }
    }
</script>

<style lang="scss">
    .panel-default {
        border-color: #CCC;

        .panel-heading {
            border-color: #CCC;
        }
    }

    .panel-body {
        background: #FAFAFA;
    }

    .task-input {
        margin: 2em 0;
    }

    @media (min-width: 992px) {
        .task-input {
            margin: 4em 0;
        }
    }

    .task {
        border-color: #CCC;
    }

    .tasks {
        margin-bottom: 0;
        min-height: 48px;
    }

    .sortable-ghost {
        border-style: dashed;
        border-color: #036;
    }

    #page-footer {
        margin-top: 2em;
        ul {
            padding: 0;
            text-align: center;
            li {
                display: inline-block;
                margin: 0 1em;

                a {
                    color: #999;
                }
            }
        }
    }
</style>
