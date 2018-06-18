<template>
    <BaseWindow title="使用帮助" :handle="handle" @close="close">
        <ul>
            <li>在顶部的输入框中输入准备做的任务。</li>
            <li>通过拖放操作可调整任务的位置和不同状态。</li>
            <li>任务数据使用浏览器的本地存储功能保存。</li>
            <li>完成状态的任务可以进行清除操作。</li>
        </ul>
    </BaseWindow>
</template>

<script>
    import BaseWindow from '../../components/BaseWindow.vue';

    export default {
        components: {
            BaseWindow
        },

        props: {
            handle: Boolean,
        },

        methods: {
            close() {
                this.$emit('close');
            }
        }
    }
</script>
