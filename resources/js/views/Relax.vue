<template>
    <div>
        <md-card class="md-layout-item md-small-size-100" md-with-hover>
            <md-card-expand>

                <md-toolbar class="md-primary" md-theme="myTheme">
                    <div class="md-layout-item md-size-90">
                        <div class="md-title">Game :)</div>
                    </div>
                    <div class="md-layout-item md-size-10 text-right">
                        <md-card-expand-trigger>
                            <md-button class="md-icon-button">
                                <md-icon>keyboard_arrow_down</md-icon>
                            </md-button>
                        </md-card-expand-trigger>
                    </div>

                </md-toolbar>

                <md-card-expand-content>
                    <div>
                        <md-ripple>
                            <div class="md-layout">
                                <div id="area_for_btn" class="md-layout-item md-size-90">
                                    <md-button id="btn_punch" class="md-fab"
                                               v-bind:style="{top: top+ '%', left: left+ '%'}"
                                               @click="punch"
                                               v-show="show"
                                               v-if="helth>=0 && helth < 100">
                                        <md-icon>flare</md-icon>
                                    </md-button>

                                    <div class="text" v-if="helth==100">
                                        <h1>Ваше время: {{(end - start) % 60}} секунд</h1>
                                    </div>
                                    {{now}}
                                </div>
                                <div class="md-layout-item  md-size-10">
                                    <div id="wrapper">
                                        <div id="score" v-bind:style="{height:helth + '%'}">

                                        </div>
                                        <div class="text">
                                            <p v-if="helth>=0 && helth < 100">{{helth}}%</p>
                                            <md-button  v-if="helth==100"  class="md-raised md-primary" @click="play">play</md-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </md-ripple>
                    </div>

                </md-card-expand-content>
            </md-card-expand>
        </md-card>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                helth: 100,
                top: 0,
                left:0,
                show: true,
                start: null,
                end: null,
                now: null,
            }
        },
        methods: {
            getRandomNumber: function(min, max) {
                return Math.floor(Math.random() * (max -min +1)) + min;
            },
            punch() {
                this.helth+=10;
                this.end = Math.trunc((new Date()).getTime() / 1000);

                this.show = false;

                this.top = this.getRandomNumber(1, 83);
                this.left = this.getRandomNumber(1, 85);

                window.setTimeout(() => {
                    this.show = true;
                }, 100)
            },
            play() {
                this.helth = 0;
                this.start = Math.trunc((new Date()).getTime() / 1000);
                // window.setInterval(() => {
                //     this.now = Math.trunc((new Date()).getTime() / 1000);
                // },1000);
            },
        }
    }
</script>

<style lang="scss"  scoped>

    // Import the theme engine
    @import "../../../node_modules/vue-material/dist/theme/engine";

    @include md-register-theme("myTheme", (
        primary: #3e3e3e
    ));

    // Apply the theme
    @import "../../../node_modules/vue-material/dist/theme/all";


    .md-card-content {
        padding: 0!important;
    }
    #wrapper {
        position: relative;
        height: 400px;
        border: 1px solid #ff5252;
    }

    #score {
        position: absolute;
        bottom: 0;
        width: 100%;
        background: #ff5252;
    }
    .text {
        position: relative;
        text-align: center;
        top: 45%;
    }

    .text h1 {
        color: #fff
    }

    #area_for_btn {
        position: relative;
        background: #676767;
    }

    #btn_punch {
        position: absolute;
        top: 100px;
        left: 100px;
    }
    .text-right {
        text-align: right;
    }

</style>
