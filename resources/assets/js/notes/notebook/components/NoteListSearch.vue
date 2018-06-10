<template>
    <div class="input-group note-list-search">
        <input type="text" class="form-control" v-model="keywordValue" @keyup.enter="search" />
        <span class="input-group-btn">
            <button class="btn btn-default" type="button" @click="search">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            keyword: String,
        },

        data() {
            return {
                inputKeyword: null,
            };
        },

        computed: {
            keywordValue: {
                get() {
                    if (this.inputKeyword === null) {
                        return this.keyword;
                    } else {
                        return this.inputKeyword;
                    }
                },

                set(value) {
                    this.inputKeyword = value;
                }
            }
        },

        methods: {
            search() {
                this.$emit('search', this.keywordValue);
            }
        }
    }
</script>
