<template>
    <textarea class="base-editor" :placeholder="placeholder"></textarea>
</template>

<script>
    import CodeMirror from 'codemirror';
    import 'codemirror/mode/markdown/markdown';

    export default  {
        props: {
            value: String,
            placeholder: String,
            readonly: {
                type: Boolean,
                default: false,
            }
        },

        data() {
            return {
                editor: null,
            };
        },

        watch: {
            value(value) {
                if (value == this.editor.getValue()) {
                    return;
                }

                this.editor.setValue(this.value);
            },
        },

        mounted() {
            this.editor = CodeMirror.fromTextArea(this.$el, {
                mode:  "markdown",
                content: this.inputValue,
                indentUnit: 4,
                indentWithTabs: false,
                lineWrapping: true,
                readOnly: this.readonly,
            });

            this.editor.on('change', (a, b) => {
                this.$emit('input', a.getValue());
            });

            this.editor.setOption('extraKeys', {
                Tab: cm => {
                    let spaces = Array(cm.getOption("indentUnit") + 1).join(" ");
                    cm.replaceSelection(spaces);
                }
            })
        }
    }
</script>

<style lang="scss">
    @import '~codemirror/lib/codemirror.css';
</style>
