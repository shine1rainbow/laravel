<template>
    <div class="container-fluid">
        <particle-background></particle-background>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default" id="auth-panel">
                    <div class="panel-heading">Reset Password</div>
                    <div class="panel-body">
                        <form class="form-horizontal">

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label"> {{ $t("common.emailAddr") }} </label>

                                <div class="col-md-6">
                                    <input type="email"
                                           class="form-control"
                                           required
                                           v-model="email"
                                    >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit"
                                            class="btn btn-primary"
                                            v-on:click="sendResetPasswordEmail()"
                                            v-bind="{'disabled': disabled}"
                                    >
                                        {{ $t("auth.getCode") }} 
                                    </button>
                                    <button type="button" class="btn btn-warning"
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
    </div>
</template>

<script>
    import ParticleBackground from './../../../components/background/ParticleBackground'
    import {SendResetTokenEmailUrl} from './../../../config.js'

    export default {

        components: {
            ParticleBackground
        },

        data() {
            return {
                email: '',
            }
        },

        computed: {
            disabled: function () {
                if (this.email) {
                    return false;
                } else {
                    return true;
                }
            }
        },

        methods: {

            back() {
                this.$router.push('/login')
            },

            //发送重置密码链接
            sendResetPasswordEmail() {

                const params = {
                    email: this.email
                }

                this.$http.get(SendResetTokenEmailUrl, {
                    params: params
                }).then(response => {

                    if (response.body.code == '200') {
                        this.$notify.success({
                            title: this.$i18n.t("common.tips"),
                            message: this.$i18n.t("auth.loginEmail"),
                            offset: 40
                        });
                        this.$router.push({path: 'reset/' + this.email})
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
                        message: response.body.email['0'],
                        offset: 40
                    });

                });
            }

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
        border-color: #2072b9;
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
</style>
