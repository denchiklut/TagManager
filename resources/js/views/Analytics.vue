<template>
    <div>

        <md-card class="md-accent" md-with-hover>
            <md-ripple>
                <md-card-header>
                    <div class="md-title">Accent color</div>
                    <div class="md-subhead">With hover and ripple effects</div>
                </md-card-header>

                <md-card-content>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio itaque ea, nostrum odio. Dolores, sed accusantium quasi non.
                </md-card-content>

                <md-card-actions>
                    <md-button>Action</md-button>
                    <md-button>Action</md-button>
                </md-card-actions>
            </md-ripple>
        </md-card>

        <md-card class="md-primary" md-theme="purple-card" md-with-hover>
            <md-ripple>
                <md-card-header>
                    <div class="md-title">Purple primary color</div>
                    <div class="md-subhead">With hover and ripple effects</div>
                </md-card-header>

                <md-card-content>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio itaque ea, nostrum odio. Dolores, sed accusantium quasi non.
                </md-card-content>
            </md-ripple>
        </md-card>

        <md-card class="md-primary" md-theme="orange-card" md-with-hover>
            <md-ripple>
                <md-card-header>
                    <div class="md-title">Orange primary color</div>
                    <div class="md-subhead">With hover and ripple effects</div>
                </md-card-header>

                <md-card-content>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio itaque ea, nostrum odio. Dolores, sed accusantium quasi non.
                </md-card-content>
            </md-ripple>
        </md-card>

        <md-card>
            <md-card-media-cover md-text-scrim>
                <md-card-media md-ratio="16:9">
                    <img src="/img/card-sky.jpg" alt="Skyscraper">
                </md-card-media>

                <md-card-area>
                    <md-card-header>
                        <span class="md-title">Gradient background</span>
                        <span class="md-subhead">16/9 image</span>
                    </md-card-header>

                    <md-card-actions>
                        <md-button>Action</md-button>
                        <md-button>Action</md-button>
                    </md-card-actions>
                </md-card-area>
            </md-card-media-cover>
        </md-card>

        <md-card>
            <md-card-media-cover md-solid>
                <md-card-media md-ratio="4:3">
                    <img src="/img/card-sky.jpg" alt="Skyscraper">
                </md-card-media>

                <md-card-area>
                    <md-card-header>
                        <span class="md-title">Solid background</span>
                        <span class="md-subhead">4/3 image</span>
                    </md-card-header>
                </md-card-area>
            </md-card-media-cover>
        </md-card>

        <md-card>
            <md-card-media-cover md-solid>
                <md-card-media md-ratio="1:1">
                    <img src="/img/card-sky.jpg" alt="Skyscraper">
                </md-card-media>

                <md-card-area>
                    <md-card-header>
                        <span class="md-title">Solid background</span>
                        <span class="md-subhead">1/1 image</span>
                    </md-card-header>

                    <md-card-actions>
                        <md-button class="md-icon-button">
                            <md-icon>favorite</md-icon>
                        </md-button>

                        <md-button class="md-icon-button">
                            <md-icon>share</md-icon>
                        </md-button>
                    </md-card-actions>
                </md-card-area>
            </md-card-media-cover>
        </md-card>
    </div>
</template>

<script>
    export default {
        name: 'ThemeColors'
    }
</script>

<style lang="scss" scoped>
    @import "~vue-material/dist/theme/engine";

    @include md-register-theme("green-card", (
            primary: md-get-palette-color(green, 500)
    ));

    @include md-register-theme("black-card", (
            primary: md-get-palette-color(black, 500)
    ));

    @include md-register-theme("purple-card", (
            primary: md-get-palette-color(purple, 500)
    ));

    @include md-register-theme("orange-card", (
            primary: md-get-palette-color(orange, 500)
    ));

    @import "~vue-material/dist/base/theme";
    @import "~vue-material/dist/components/MdCard/theme";

    .md-card {
        width: 320px;
        margin: 4px;
        display: inline-block;
        vertical-align: top;
    }
</style>