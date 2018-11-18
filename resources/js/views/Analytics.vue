<template>
    <div class="md-layout md-gutter">
        <div class="md-layout-item"> <pre>{{this.analiticData}}</pre></div>
        <div class="md-layout-item">
            <div class="small">
                <md-button class="md-dense md-raised md-primary" @click="fillData()">Randomize</md-button>
                <line-chart :chart-data="datacollection" :height="120" :options="{responsive: true, maintainAspectRatio: true}" ></line-chart>
            </div>
            <div>
                <md-table v-model="people" md-card @md-selected="onSelect">
                    <md-table-toolbar>
                        <h1 class="md-title">With auto select and alternate headers</h1>
                    </md-table-toolbar>

                    <md-table-toolbar slot="md-table-alternate-header" slot-scope="{ count }">
                        <div class="md-toolbar-section-start">{{ getAlternateLabel(count) }}</div>

                        <div class="md-toolbar-section-end">
                            <md-button class="md-icon-button">
                                <md-icon>delete</md-icon>
                            </md-button>
                        </div>
                    </md-table-toolbar>

                    <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="multiple" md-auto-select>
                        <md-table-cell md-label="Name" md-sort-by="name">{{ item.url }}</md-table-cell>
                        <md-table-cell md-label="Email" md-sort-by="email">{{ item.call }}</md-table-cell>
                        <md-table-cell md-label="Gender" md-sort-by="gender">{{ item.created_at.date | formatDate}}</md-table-cell>
                    </md-table-row>
                </md-table>

                <p>Selected:</p>
                {{ selected }}
            </div>
        </div>
    </div>
</template>

<script>
    import LineChart from '../components/charts/LineChart.js'
    export default {
        data: () => ({
            datacollection: null,
            options: {
                responsive: true,
            },
            people: [
                {
                    url: 'denchklut.com',
                    call: '10',
                    created_at: {
                        "date": "2018-11-13 00:00:00.000000",
                        "timezone_type": 3,
                        "timezone": "UTC"
                    },
                },
            ],
            selected:[]
        }),
        components: {
            LineChart
        },
        methods: {
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
            },
            onSelect (items) {
                this.selected = items;
                console.log('select event');
                console.log(items)
            },
            getAlternateLabel (count) {
                let plural = '';

                if (count > 1) {
                    plural = 's'
                }

                return `${count} user${plural} selected`
            }
        },
        created() {
            this.fillData();
        },
        mounted() {
            this.$store.dispatch('getAnaliticData');
        },

        computed: {
            analiticData() {
                return this.$store.getters.analiticData;
            },
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

    .md-table + .md-table {
        margin-top: 16px
    }

</style>
