<template>
    <li>
        <a href="javascript:;" @click="select">
            <span class="summary">{{ summary }}</span>
            <span class="updated-at">{{ updatedAt }}</span>
        </a>
    </li>
</template>

<script>
    import * as moment from 'moment';

    export default {
        props: {
            model: Object,
        },

        data: function () {
            return {
                currentDate: moment(),
            };
        },

        computed: {
            summary: function () {
                if (!this.model.content) {
                    return '无内容';
                }

                return this.model.content.split("\n")[0];
            },

            updatedAt: function () {
                var labels = {
                    'year': '年',
                    'month': '月',
                    'day': '天',
                    'hour': '小时',
                    'minute': '分钟',
                };

                var text = '刚刚';

                for (let name in labels) {
                    let number = this.currentDate.diff(this.model.updated_at, name);
                    if (number > 0) {
                        text = number + ' ' + labels[name] + '前';
                        break;
                    }
                }

                return text;
            }
        },

        methods: {
            select: function () {
                this.$emit('select', this.model);
            }
        },

        mounted: function () {
            let app = this;
            var updateTime = function () {
                app.currentDate = moment();
                setTimeout(updateTime, 60000);
            };

            setTimeout(updateTime, 60000);
        },
    }
</script>
