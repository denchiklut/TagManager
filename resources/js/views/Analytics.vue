<template>
    <div class="md-layout md-gutter">
        <div class="md-layout-item"> <pre>{{this.data}}</pre></div>
        <div class="md-layout-item">
            <div class="small">
                <button @click="fillData()">Randomize</button>
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

                    <md-table-row slot="md-table-row" slot-scope="{ item }" :md-disabled="item.name.includes('Stave')" md-selectable="multiple" md-auto-select>
                        <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
                        <md-table-cell md-label="Email" md-sort-by="email">{{ item.email }}</md-table-cell>
                        <md-table-cell md-label="Gender" md-sort-by="gender">{{ item.gender }}</md-table-cell>
                        <md-table-cell md-label="Job Title" md-sort-by="title">{{ item.title }}</md-table-cell>
                    </md-table-row>
                </md-table>

                <p>Selected:</p>
                {{ selected }}
            </div>
        </div>
        <div class="md-layout-item"> <pre>{{this.data}}</pre></div>
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
            },
            people: [
                {
                    name: 'Shawna Dubbin',
                    email: 'sdubbin0@geocities.com',
                    gender: 'Male',
                    title: 'Assistant Media Planner'
                },
                {
                    name: 'Odette Demageard',
                    email: 'odemageard1@spotify.com',
                    gender: 'Female',
                    title: 'Account Coordinator'
                },
                {
                    name: 'Lonnie Izkovitz',
                    email: 'lizkovitz3@youtu.be',
                    gender: 'Female',
                    title: 'Operator'
                },
                {
                    name: 'Thatcher Stave',
                    email: 'tstave4@reference.com',
                    gender: 'Male',
                    title: 'Software Test Engineer III'
                },
                {
                    name: 'Clarinda Marieton',
                    email: 'cmarietonh@theatlantic.com',
                    gender: 'Female',
                    title: 'Paralegal'
                }
            ],
            selected:[]
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
            },
            onSelect (items) {
                this.selected = items
                console.log('select event')
                console.log(items)
            },
            getAlternateLabel (count) {
                let plural = ''

                if (count > 1) {
                    plural = 's'
                }

                return `${count} user${plural} selected`
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

    .md-table + .md-table {
        margin-top: 16px
    }

</style>