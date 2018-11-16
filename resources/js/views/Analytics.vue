<template>
    <div class="md-layout md-gutter">
        <div class="md-layout-item"> <pre>{{this.data}}</pre></div>
        <div class="md-layout-item">
            <div class="small">
                <button @click="fillData()">Randomize</button>
                <line-chart :chart-data="datacollection" :height="120" :options="{responsive: true, maintainAspectRatio: true}" ></line-chart>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import LineChart from '../components/charts/LineChart.js'
    export default {
        data: () => ({
            data: null,
            datacollection: null,
            options: {
                responsive: true,
            }
        }),
        components: {
            LineChart
        },
        methods: {
            fetchData() {
                axios
                    .get('/api')
                    .then(responce => {
                        this.data = responce.data.data;
                    })
            },
            fillData () {
                this.datacollection = {
                    labels: ['пн', 'вт','ср','чт','пт','сб','вс'],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: '#f8797966',
                            data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
                        },
                        {
                            label: 'Data Two',
                            backgroundColor: '#5167f8a8',
                            data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
                        },
                        {
                            label: 'Data Three',
                            backgroundColor: '#f518f8bf',
                            data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
                        }
                    ],
                    option: {
                        responsive: true,
                    }
                }
            },
            getRandomInt () {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
            }
        },
        created() {
            this.fetchData();
            this.fillData();
        },
        mounted () {
            this.renderChart(this.datacollection, this.options)
        },
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

</style>