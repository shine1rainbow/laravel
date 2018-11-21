<template>
    <div class="wrapper">
        <app-header></app-header>
        <app-sidebar></app-sidebar>
        <app-content :title="title"></app-content>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import AppHeader from './Header';
    import AppSidebar from './Sidebar';
    import AppContent from './Content';
    import AppFooter from './/Footer';

    export default {
        name: 'App',

        components: {
            AppHeader, AppSidebar, AppContent, AppFooter,
        },

        data() {
            return {
                title: null,
            };
        },

        replace: false,
    };
</script>

<style>
</style>
