<template>
    <div>
        <p>{{this.data}}</p>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data: () => ({
            data: null,
        }),
        methods: {
            fetchData() {
                axios
                    .get('/api')
                    .then(responce => {
                        this.data =responce.data.data;
                    })
            }
        },
        created() {
            this.fetchData();
        }
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
    .card {
        box-shadow: 0 0 15px -6px black;
    }
</style>