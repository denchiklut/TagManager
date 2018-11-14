<template>
    <div>
        <div class="md-layout">
            <div id="area_for_btn" class="md-layout-item md-size-80">
                <md-button id="btn_punch" class="md-raised md-primary" @click="punch" v-show="helth>0">punch</md-button>
            </div>
            <div class="md-layout-item">
                <div id="wrapper">
                    <div id="score" v-bind:style="{height:helth + '%'}">

                    </div>
                    <p id="text">
                        {{helth}}%
                    </p>
                </div>
            </div>
        </div>


        <md-button class="md-raised md-accent" @click="restart">restart</md-button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                helth: 100,
            }
        },
        methods: {
            punch() {
                this.helth-=10;
            },
            restart() {
                this.helth = 100;
            }
        }
    }
</script>

<style lang="scss"  scoped>
    #wrapper {
        position: relative;
        width: 150px;
        height: 300px;
        border: 1px solid black;
    }

    #score {
        position: absolute;
        bottom: 0;
        width: 100%;
        background: red;
    }
    #text {
        position: relative;
        text-align: center;
        top: 45%;
    }

    #area_for_btn {
        position: relative;
    }

    #btn_punch {
        position: absolute;
    }
</style>