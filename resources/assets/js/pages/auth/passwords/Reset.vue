<template>
    <div class="row">
        <particle-background></particle-background>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default" id="auth-panel">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label"> {{ $t("common.emailAddr") }} </label>

                            <div class="col-md-6">
                                <span class="error-required" v-show="! form.email">*</span>
                                <input id="email" type="email" class="form-control" v-model="form.email" required
                                       autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label"> {{ $t("common.password") }} </label>

                            <div class="col-md-6">
                                <span class="error-required" v-show="! form.password">*</span>
                                <input id="password" type="password" class="form-control" v-model="form.password"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"> {{ $t("auth.repeatPassword")
                                }} </label>
                            <div class="col-md-6">
                                <span class="error-required" v-show="! form.password_confirmation">*</span>
                                <span class="error" v-show="checkPassword"> {{ $t("auth.notMatch") }}</span>
                                <input id="password-confirm" type="password" class="form-control"
                                       v-model="form.password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"> {{ $t("auth.code") }} </label>
                            <div class="col-md-6">
                                <span class="error-required" v-show="! form.token">*</span>
                                <input id="token" type="text" class="form-control" v-model="form.token" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="#auth-form-button" class="btn btn-primary"
                                        v-bind="{'disabled': disabled}"
                                        v-on:click="onSubmitForm"
                                >
                                    {{ $t("auth.resetPassword") }}
                                </button>
                                <button type="button" id="#back-form-button" class="btn btn-warning"
                                        v-on:click="back()"
                                >
                                    {{ $t("common.back") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ParticleBackground from './../../../components/background/ParticleBackground'
    import {ResetPasswordUrl} from './../../../config.js'

    export default {

        components: {
            ParticleBackground
        },

        data() {
            return {
                form: {
                    email: this.$route.params.email,
                    password: '',
                    password_confirmation: '',
                    token: '',
                },
            }
        },

        computed: {
            disabled: function () {
                for (var key in this.form) {
                    if (!this.form[key]) return true;
                }
                return false;
            },

            checkPassword: function () {
                if (this.form.password != this.form.password_confirmation) {
                    return true
                } else {
                    return false
                }
            },
        },

        methods: {

            //返回登入页面
            back() {
                history.go(-1)
            },

            //发送重置密码链接
            onSubmitForm() {

                const params = {
                    email: this.form.email,
                    token: this.form.token,
                    password: this.form.password
                }

                this.$http.get(ResetPasswordUrl, {
                    params: params
                }).then(response => {

                    if (response.body.code == '200') {

                        this.$notify.success({
                            title: this.$i18n.t("common.success"),
                            message: this.$i18n.t("auth.reLogin"),
                            offset: 40
                        });
                        this.$router.push('/login')

                    } else {

                        this.$notify.error({
                            title: this.$i18n.t("common.failed"),
                            message: response.body.msg,
                            offset: 40
                        });

                    }

                }, response => {

                    this.$notify.error({
                        title: this.$i18n.t("common.failed"),
                        message: this.$i18n.t("common.updateFailed"),
                        offset: 40
                    });

                });

            },
        }
    }
</script>

<style scoped>
    #auth-form-button {
        margin: 0 0 20px;
        border-color: #3c8dbc;
    }

    #auth-form-button:hover {
        background-color: #286090 !important;
        border-color: #1674c6 !important;
    }

    #back-form-button {
        margin: 0 0 20px;
        border-color: #3c8dbc;
    }

    #back-form-button:hover {
        background-color: #286090 !important;
        border-color: #286090;
    }

    #auth-panel {
        position: relative;
        margin-top: 150px;
        z-index: 1;

        border-color: transparent;

        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    #auth-panel > .panel-heading {
        background-color: transparent;
        color: #fff;
        border-color: #adadad;
    }

    #auth-panel form input {
        border-radius: 5px !important;
    }

    .error {
        font-weight: bold;
        color: red;
        float: right;
        margin-top: -10px;
    }

    .error-required {
        font-weight: bold;
        color: red;
        position: absolute;
        left: -5px;
        top: 8px;
    }
</style>
