<template>
    <ul class="dropdown-menu">
        <template v-for="note in notes">
            <v-item :model="note" @select="select"></v-item>
        </template>
    </ul>
</template>

<script>
    export default {
        props: {
            notes: Array,
        },

        components: {
            'v-item': require('./ListItem.vue'),
        },

        methods: {
            select: function (note) {
                this.$emit('select', note);
            }
        }
    }
</script>
