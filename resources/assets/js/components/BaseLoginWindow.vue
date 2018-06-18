<template>
    <BaseWindow title="登录" :handle="handle" @close="close">
        <div class="form-group">
            <label>账号</label>
            <input type="text" class="form-control" v-model="account" @keyup.enter="login" />
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" class="form-control" v-model="password" @keyup.enter="login" />
        </div>
        <div slot="footer" class="modal-footer">
            <button class="btn btn-primary" @click="login">确认登录</button>
        </div>
    </BaseWindow>
</template>

<script>
    import BaseWindow from './BaseWindow.vue';
    import { successAlert, warningAlert, errorAlert, closeAlert } from '../helpers/alerts';

    export default {
        components: {
            BaseWindow
        },

        props: {
            handle: Boolean,
        },

        data() {
            return {
                account: null,
                password: null,
            };
        },

        methods: {
            close() {
                this.$emit('close');
            },

            login() {
                axios.post('login', {
                    email: this.account,
                    password: this.password,
                }).then(response => {
                    successAlert('登录成功!');

                    this.$emit('logined');

                    $(this.$el).modal('hide');
                }).catch(error => {
                    const status = error.response.status;

                    if (status == 419) {
                        warningAlert('页面认证信息过期，请刷新本页面后重试!');
                    } else if(status == 422) {
                        warningAlert('无效的登录账号或密码!');
                    }
                });
            }
        }
    }
</script>
