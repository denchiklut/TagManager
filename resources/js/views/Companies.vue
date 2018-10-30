<template>
    <div class="users">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            <p>{{ error }}</p>

            <p>
                <button @click.prevent="fetchData">
                    Try Again
                </button>
            </p>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Componies</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>id_client</th>
                            <th>id_campaign</th>
                            <th>password</th>
                            <th>signature</th>
                            <th>sig</th>
                            <th>url</th>
                            <th>tm_id</th>
                            <th>created_at</th>
                        </tr>
                    </thead>
                    <tbody v-if="componies">


                    <tr v-for="{ id, id_client, id_campaign, password, signature, sig, url, tm_id, created_at, updated_at } in componies">
                        <td>{{id}}</td>
                        <td>{{id_client}}</td>
                        <td>{{id_campaign}}</td>
                        <td>{{password}}</td>
                        <td>{{signature}}</td>
                        <td>{{sig}}</td>
                        <td>{{url}}</td>
                        <td>{{tm_id}}</td>
                        <td>{{created_at.date}}</td>
                    </tr>


                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item" ><button class="page-link" :disabled="! prevPage" @click.prevent="goToPrev">«</button></li>
                    <li class="page-item">{{ paginatonCount }}</li>
                    <li class="page-item" ><button class="page-link" :disabled="! nextPage" @click.prevent="goToNext">»</button></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    const getUsers = (page, callback) => {
        const params = { page };

        axios
            .get('/api/companies', { params })
            .then(response => {
                callback(null, response.data);
            }).catch(error => {
            callback(error, error.response.data);
        });
    };

    export default {
        data() {
            return {
                componies: null,
                meta: null,
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null,
                },
                error: null,
            };
        },
        computed: {
            nextPage() {
                if (! this.meta || this.meta.current_page === this.meta.last_page) {
                    return;
                }

                return this.meta.current_page + 1;
            },
            prevPage() {
                if (! this.meta || this.meta.current_page === 1) {
                    return;
                }

                return this.meta.current_page - 1;
            },
            paginatonCount() {
                if (! this.meta) {
                    return;
                }

                const { current_page, last_page } = this.meta;

                return `${current_page} of ${last_page}`;
            },
        },
        beforeRouteEnter (to, from, next) {
            getUsers(to.query.page, (err, data) => {
                next(vm => vm.setData(err, data));
            });
        },
        // when route changes and this component is already rendered,
        // the logic will be slightly different.
        beforeRouteUpdate (to, from, next) {
            this.users = this.links = this.meta = null
            getUsers(to.query.page, (err, data) => {
                this.setData(err, data);
                next();
            });
        },
        methods: {
            goToNext() {
                this.$router.push({
                    query: {
                        page: this.nextPage,
                    },
                });
            },
            goToPrev() {
                this.$router.push({
                    name: 'companies',
                    query: {
                        page: this.prevPage,
                    }
                });
            },
            setData(err, { data: componies, links, meta }) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.componies = componies;
                    this.links = links;
                    this.meta = meta;
                }
            },
        }
    }
</script>