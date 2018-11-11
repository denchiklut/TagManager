<template>
    <div>
        <!--<pre>-->
        <!--{{this.metrics_list.query}}-->
        <!--</pre>-->
        <div class="container">

            <div class="card text-center">
                <div class="card-header">
                    Долгосрочные интересы
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Категория интересов</th>
                            <th>Визиты</th>
                            <th>Посетители</th>
                            <th>Аффинити‑индекс  </th>
                            <th>Отказы</th>
                            <th>Глубина просмотра</th>
                            <th>Время на сайте</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in this.metrics_list.data">
                            <td>{{item.dimensions[0]['name']}}</td>
                            <td>{{item.metrics[0]}}</td>
                            <td>{{item.metrics[1]}}</td>
                            <td>{{Math.round(item.metrics[2]) + '%'}}</td>
                            <td>{{Math.round(item.metrics[3]) + '%'}}</td>
                            <td>{{item.metrics[4].toFixed(2)}}</td>
                            <td>{{Math.round(item.metrics[5])/100}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    {{`С ${this.metrics_list.query.date1} по ${this.metrics_list.query.date2}`}}
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data: () => ({
            metrics_list: [],
        }),
        methods: {
            fetchData() {
                axios
                    .get('/api')
                    .then(responce => {
                        this.metrics_list = JSON.parse(responce.data.data);
                        console.log(responce.data.data)
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