<template>
    <textarea class="form-control" rows="10" v-model="inputValue"></textarea>
</template>

<script>
    export default  {
        props: {
            value: String,
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
