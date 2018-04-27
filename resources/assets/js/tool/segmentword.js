import swal from 'sweetalert';
import Vue from 'vue';
import '../bootstrap';

new Vue({
    el: '#app',

    data: {
        content: null,
        words: [],
    },

    methods: {
        submit () {
            if (!this.content) {
                swal('', '请输入要分词的文本!', 'warning');
                return false;
            }

            axios.post('/tool/segmentwords', {
                text: this.content,
            }).then((response) => {
                this.words = response.data.words;
            }).catch(() => {
                swal('', '提交分词失败! 请稍后再试。', 'error');
            });
        }
    },
});
