<template>
    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button" :disabled="withoutPrevPage" @click="prevPage">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </button>
        </span>
        <input type="text" class="form-control" :placeholder="paginationInfo" />
        <span class="input-group-btn">
            <button class="btn btn-default" type="button" :disabled="withoutNextPage" @click="nextPage">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            data: Object,
        },

        computed: {
            withoutPrevPage() {
                return !this.data.hasOwnProperty('page')
                    || this.data.page <= 1;
            },

            withoutNextPage() {
                return !this.data.hasOwnProperty('page_total')
                    || !this.data.hasOwnProperty('page')
                    || this.data.page >= this.data.page_total;
            },

            paginationInfo() {
                if (this.data.page_total) {
                    return this.data.page+'/'+this.data.page_total;
                }

                return '';
            }
        },

        methods: {
            prevPage() {
                this.$emit('goto', this.data.page-1);
            },

            nextPage() {
                this.$emit('goto', this.data.page+1);
            }
        }
    }
</script>
