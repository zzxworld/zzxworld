<template>
    <textarea class="editor" :placeholder="placeholder" :value="value" @input="update"></textarea>
</template>

<script>
export default {
    props: {
        placeholder: {type: String, default: '写点什么...'},
        value: String,
    },

    methods: {
        update: _.debounce(function (e) {
            this.$emit('input', e.target.value);
        }, 400),
    }
}
</script>
