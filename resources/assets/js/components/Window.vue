<template>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';

    export default {
        props: {
            title: String,
        },

        mounted () {
            var app = this;
            $(this.$el).on('hide.bs.modal', () => {
                app.$emit('close');
            });
        },
    }

    Vue.directive('open-if', {
        update: (el, binding) => {
            if (binding.value) {
                $(el).modal('show');
            }
        },
    });
</script>
