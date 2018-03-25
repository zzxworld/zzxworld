<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <button class="btn btn-default btn-xs pull-right" @click="clear" v-if="enableClearButton && items.length">清除</button>
            <h4 class="panel-title">{{ title }}</h4>
        </div>
        <v-draggable :list="items" class="panel-body" :options="{group: 'tasks', draggable: '.task'}">
            <transition-group tag="div" class="tasks list-group">
                <template v-for="(item, pos) in items">
                    <div class="task list-group-item" :key="pos">{{ item.name }}</div>
                </template>
            </transition-group>
        </v-draggable>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        props: {
            name: {type: String, require: true},
            title: {type: String, require: true},
            items: {type: Array, default: []},
            enableClearButton: {type: Boolean, default: false},
        },

        components: {
            'v-draggable': draggable,
        },

        methods: {
            clear: function () {
                this.$emit('clear');
            }
        }
    }
</script>
