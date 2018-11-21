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
                    enter-active-class="animated boundInLeft"
                    leave-active-class="animated boundOutRight"
            >
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

        methods: {
        },

        created() {
        },
    };
</script>

<style>
</style>

