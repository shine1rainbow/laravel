<template>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="assets/images/default-avater.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p> {{ authUserInfo.name }} </p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="btn btn-flat" v-on:click="showInfo">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <!--<li class="active treeview" v-for="row in menus">-->
                <li class="treeview" v-for="row in menus">
                    <router-link :to="row.name">
                        <i class="fa " v-bind:class="row.icon"></i>
                        <span>{{ row.display_zh_name }}</span>
                        <i v-show="row.hasOwnProperty('child') && typeof row.child.length != 'undefined'"
                           class="fa fa-angle-left pull-right"></i>
                    </router-link>

                    <ul v-show="row.hasOwnProperty('child') && typeof row.child.length != 'undefined'"
                        class="treeview-menu">
                        <li v-for="child in row.child">
                            <router-link :to="child.name">
                                <i class="fa " v-bind:class="child.icon"></i> {{ child.display_zh_name }}
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
</template>

<script>

    import { decryptData } from './../../utils/encrypt.js'
    import ApiList from './../../config'
    import { http } from './../../utils/fetch'

    export default {

        name: 'Sidebar',

        data() {
            return {
                menus: this.$parent.$data.menus || [],
            };
        },

        computed: {
            authUserInfo: function () {
                let encryptAuthUser = window.localStorage.getItem('authUser')
                let decryptAuthUser = decryptData(encryptAuthUser)
                return decryptAuthUser
            },
        },

        created() {
            this.fetchMenus()
        },

        methods: {

            fetchMenus () {
                http({
                    url: ApiList.getUserPermissionUrl,
                    method: 'get'
                }).then(response => {
                    this.menus = response.data.data
                }, response => {
                    console.log("error to fetch menu")
                });
            },

            showInfo() {
                this.$notify.info({
                    //title: this.$i18n.t("common.message"),
                    //message: this.$i18n.t("common.notSupport")
                    title: 'title',
                    message: 'search'
                });
            },
        }

    };
</script>
<style>

li.treeview.menu-open > a {
    text-decoration: none !important;
}
li.treeview > a {
    text-decoration: none !important;
}
</style>
