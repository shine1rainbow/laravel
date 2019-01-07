<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                        {{ $t('test.name') }}

                        <hr>
                        from store getters: {{ formatLanguage }}
                    </div>

                    <button @click="change">changeLanguage</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {http} from './../utils/fetch'
    import ApiList from './../config'
    import Vue from 'vue';

    export default {

        mounted() {
            console.log(this.$store);
            console.log(this.$store.state.language);
        },

        computed: {
            formatLanguage() {
                return this.$store.getters.formatLanguage
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                //demo of http request
                http({url: ApiList.getMenuCategoriesByMenuType + '1', method: 'get'}).then(response => {
                    console.log(response.data);
                }).catch(err => {
                    console.log(err)
                })
                /*
                //demo of http request
                http({url: '/test', method: 'get'}).then(response => {
                    console.log(response.data);
                }).catch(err => {
                    console.log(err)
                })
                */
            },

            updateLanguage(language) {
                this.$store.commit('CHANGE_LANGUAGE', language);
                console.log(this.$store.state.language);
            },

            change() {
                console.log(this.$store.state.language);
                this.$store.dispatch('changeLanguage', 'change language')
                console.log(this.$store.state.language);
            }
        }
    }
</script>
