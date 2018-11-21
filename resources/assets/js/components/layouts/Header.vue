<template>
    <header class="main-header">
        <!-- Logo -->
        <router-link :to="{ path: '/' }" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>{{ $t("common.systemMiniName") }}</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>{{ $t("common.systemName") }}</b></span>
        </router-link>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/images/default-avater.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"> {{ authUserInfo.name }} </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="assets/images/default-avater.jpg" class="img-circle" alt="User Image">
                                <p>
                                    {{ authUserInfo.name }}
                                    <small>{{ authUserInfo.email }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">{{ $t('common.profile')}}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" 
                                        class="btn btn-default btn-flat"
                                        v-on:click="doLogout"
                                    >
                                        {{ $t('common.logout') }}
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>

    import { decryptData } from './../../utils/encrypt.js'

    export default {

        name: 'Header',

        data() {
            return {};
        },

        computed: {
            authUserInfo: function () {
                let encryptAuthUser = window.localStorage.getItem('authUser')
                let decryptAuthUser = decryptData(encryptAuthUser)
                return decryptAuthUser
            }
        },
        methods: {

            doLogout(e) {
                e.preventDefault();
                window.localStorage.removeItem('authUser')
                window.localStorage.removeItem('version')
                this.$router.push('/login');
            }
        }
    };
</script>
<style scoped>
.main-header a {
    text-decoration: none; 
}
</style>
