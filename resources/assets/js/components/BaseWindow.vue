<template>
    <div :id="id" class="modal" role="dialog" data-backdrop="static">
        <div :class="{'modal-dialog': true, 'modal-lg': size == 'lg', 'modal-sm': size == 'sm'}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
    export default {
        props: {
            id: String,
            title: String,
            size: String,
            handle: {
                type: Boolean,
                default: false
            }
        },

        watch: {
            handle(value) {
                if (value) {
                    $(this.$el).modal('show');
                }
            }
        },

        mounted() {
            const node = $(this.$el);

            node.on('hide.bs.modal', () => {
                this.$emit('close');
            }).on('shown.bs.modal', () => {
                this.$emit('open');

                let total = $('.modal-backdrop').length;

                if (total > 1) {
                    $(el).css('z-index', 1061+total);
                    $('.modal-backdrop:nth('+(total-1)+')').css('z-index', 1059+total);
                }
            }).on('hidden.bs.modal', () => {
                let total = $('.modal-backdrop').length;

                if (total > 0) {
                    $(document.body).addClass('modal-open');
                }
            });
        }
    }
</script>
