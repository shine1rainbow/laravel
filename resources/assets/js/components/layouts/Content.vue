<template>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ $t("common.systemName") }}
                <small> 1.0 </small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#/dashboard">
                        <i class="fa fa-dashboard"></i> Home
                    </a>
                </li>
                <!-- <li class="active">Dashboard</li> -->
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <transition
                name="custom-classes-transition"
                mode="out-in"
                enter-active-class="animated fadeInLeft"
                leave-active-class="animated fadeOutRight"
            >
                <router-view></router-view>
            <!--
                <keep-alive>
                    <router-view></router-view>
                </keep-alive>
            -->
            </transition>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</template>

<script>
    export default {

        name: 'Content',

        data() {
            return {
            };
        },
        computed: {
            key() {
                return this.$route.fullPath
            }
        },
        methods: {
        },
    };
</script>

<style>
</style>
