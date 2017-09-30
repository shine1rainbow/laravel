<template>
    <div>
        <div id='particle-background'></div>

        <div class="background-wrapper">
            <transition name="move" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
    import JParticles from 'jparticles'

    export default {

        components: {
            JParticles
        },

        mounted() {

            JParticles.commonConfig = {
                opacity: 1,
                color: ['gray', 'white', 'yellow', 'pink', 'cyan']
            };

            new JParticles.particle('#particle-background', {
                range: 20,
                num: 100,
                maxR: 2.0,
                minR: 1.0,
                maxSpeed: 1
            });
        }
    }
</script>

<style scoped>
    #particle-background {
        position: fixed !important;
        top: 0px;
        bottom: 0px;
        right: 0px;
        left: 0px;
        width: 100%;
        height: 100%;

        background-color: #52697f;
    }

    #particle-background canvas {
        position: fixed !important;
        top: 0px;
        bottom: 0px;
        right: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
    }

    #background-wrapper {
        position: relative;
        z-index: 1;
    }
</style>
