<template>
    <textarea class="base-editor" :placeholder="placeholder" v-model="inputValue"></textarea>
</template>

<script>
    export default  {
        props: {
            value: String,
            placeholder: String,
        },

        computed: {
            inputValue: {
                get() {
                    return this.value;
                },

                set(value) {
                    this.$emit('input', value);
                }
            }
        }
    }
</script>
