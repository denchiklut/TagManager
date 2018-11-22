<template>
    <div>
        <!--Add Form-->
        <div>
            <add />
        </div>

        <!--Data Table-->
        <!--<md-card class="md-accent mt-15" md-with-hover>-->

            <!--<md-ripple>-->
                <!--<md-toolbar class="md-accent" md-elevation="1">-->
                    <!--<div class="md-toolbar-section-start">-->
                        <!--<h1 class="md-title">Companies</h1>-->
                    <!--</div>-->

                    <!--<md-field md-clearable>-->
                        <!--<md-input placeholder="Search by name..." v-model="search" />-->
                    <!--</md-field>-->
                <!--</md-toolbar>-->
            <!--</md-ripple>-->

            <!--<md-card-content>-->
                <!--<md-table v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>-->
                    <!--<md-table-empty-state>-->
                            <!--<md-progress-spinner :md-diameter="100" :md-stroke="10" md-mode="indeterminate"></md-progress-spinner>-->
                    <!--</md-table-empty-state>-->

                    <!--<md-table-row slot="md-table-row" slot-scope="{ item }" md-with-hover>-->
                        <!--<md-table-cell md-label="#" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>-->
                        <!--&lt;!&ndash;<md-table-cell md-label="id_client" md-sort-by="id_client">{{ item.id_client }}</md-table-cell>&ndash;&gt;-->
                        <!--&lt;!&ndash;<md-table-cell md-label="id_campaign" md-sort-by="id_campaign">{{ item.id_campaign }}</md-table-cell>&ndash;&gt;-->
                        <!--<md-table-cell md-label="signature" md-sort-by="signature">-->
                            <!--<router-link :to="{ name: 'containers', params:{ id: item.id_campaign, url: item.url }}" class="nav-link active">{{ item.signature }}</router-link>-->
                        <!--</md-table-cell>-->
                        <!--&lt;!&ndash;<md-table-cell md-label="url" md-sort-by="url">&ndash;&gt;-->
                           <!--&lt;!&ndash;{{ item.url }}&ndash;&gt;-->
                        <!--&lt;!&ndash;</md-table-cell>&ndash;&gt;-->
                        <!--&lt;!&ndash;<md-table-cell md-label="password" md-sort-by="password">{{ item.password }}</md-table-cell>&ndash;&gt;-->
                        <!--&lt;!&ndash;<md-table-cell md-label="sig" md-sort-by="sig">{{ item.sig }}</md-table-cell>&ndash;&gt;-->
                        <!--<md-table-cell md-label="trigger" md-sort-by="trigger">{{ item.trigger }}</md-table-cell>-->
                        <!--&lt;!&ndash;<md-table-cell md-label="created_at" md-sort-by="created_at.date" md-numeric>{{ item.created_at.date | formatDate }}</md-table-cell>&ndash;&gt;-->
                        <!--<md-table-cell md-label="template" md-sort-by="template">{{ item.templates ? item.templates : txt_def}}</md-table-cell>-->
                        <!--<md-table-cell md-label="edit">-->
                            <!--<md-button class="md-fab md-mini md-primary" @click="showEditForm(item)"><md-icon>edit</md-icon></md-button>-->
                            <!--<md-button class="md-fab md-mini" @click="deleteItem(item)"><md-icon>delete</md-icon></md-button>-->
                        <!--</md-table-cell>-->
                    <!--</md-table-row>-->
                <!--</md-table>-->
            <!--</md-card-content>-->
        <!--</md-card>-->

        <v-card>
            <v-card-title>
                Nutrition
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="search"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="searched"
                :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.trigger }}</td>
                    <td class="text-xs-left">{{ props.item.url }}</td>
                    <td class="text-xs-left">{{ props.item.id_campaign }}</td>
                    <td class="text-xs-left">{{ props.item.id_client }}</td>
                    <td class="text-xs-left">{{ props.item.password }}</td>
                    <td class="text-xs-left">
                        <md-button class="md-fab md-mini md-primary" @click="showEditForm( props.item)"><md-icon>edit</md-icon></md-button>
                        <md-button class="md-fab md-mini" @click="deleteItem( props.item)"><md-icon>delete</md-icon></md-button>
                    </td>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Your search for "{{ search }}" found no results.
                </v-alert>
            </v-data-table>
        </v-card>

        <!--Edit Dialog-->
        <md-dialog :md-active.sync="showDialog">
            <edit @CloseDialog="closeDialog" :form="editCompain"></edit>
        </md-dialog>
    </div>
</template>

<script>
    import AddCompany from '../components/compaing/AddCompany'
    import EditCompany from '../components/compaing/EditCompany'

    const toLower = text => {
        return text.toString().toLowerCase()
    };

    const searchByName = (items, term) => {
        if (term) {
            return items.filter(item => toLower(JSON.stringify(item)).includes(toLower(term)))
        }

        return items
    };

    const searchDef = (items, term) => {
        if (term) {
            return items.filter(item => toLower(JSON.stringify(item.default)).includes(toLower(term)))
        }

        return items;
    };
    export default {
        name: 'TableSearch',
        data: () => ({
            // search: null,
            showDialog: false,
            editCompain: null,
            userSaved: false,
            lastUser: null,
            search: '',
            headers: [
                {
                    text: 'Dessert (100g serving)',
                    align: 'left',
                    sortable: false,
                    value: 'name'
                },
                { text: 'Calories', value: 'calories' },
                { text: 'Fat (g)', value: 'fat' },
                { text: 'Carbs (g)', value: 'carbs' },
                { text: 'Protein (g)', value: 'protein' },
                { text: 'Iron (%)', value: 'iron' },
                { text: 'Action (%)', value: 'action' },
            ],
            desserts: [
                {
                    value: false,
                    name: 'Frozen Yogurt',
                    calories: 159,
                    fat: 6.0,
                    carbs: 24,
                    protein: 4.0,
                    iron: '1%'
                },
                {
                    value: false,
                    name: 'Ice cream sandwich',
                    calories: 237,
                    fat: 9.0,
                    carbs: 37,
                    protein: 4.3,
                    iron: '1%'
                },
                {
                    value: false,
                    name: 'Eclair',
                    calories: 262,
                    fat: 16.0,
                    carbs: 23,
                    protein: 6.0,
                    iron: '7%'
                },
                {
                    value: false,
                    name: 'Cupcake',
                    calories: 305,
                    fat: 3.7,
                    carbs: 67,
                    protein: 4.3,
                    iron: '8%'
                },
                {
                    value: false,
                    name: 'Gingerbread',
                    calories: 356,
                    fat: 16.0,
                    carbs: 49,
                    protein: 3.9,
                    iron: '16%'
                },
                {
                    value: false,
                    name: 'Jelly bean',
                    calories: 375,
                    fat: 0.0,
                    carbs: 94,
                    protein: 0.0,
                    iron: '0%'
                },
                {
                    value: false,
                    name: 'Lollipop',
                    calories: 392,
                    fat: 0.2,
                    carbs: 98,
                    protein: 0,
                    iron: '2%'
                },
                {
                    value: false,
                    name: 'Honeycomb',
                    calories: 408,
                    fat: 3.2,
                    carbs: 87,
                    protein: 6.5,
                    iron: '45%'
                },
                {
                    value: false,
                    name: 'Donut',
                    calories: 452,
                    fat: 25.0,
                    carbs: 51,
                    protein: 4.9,
                    iron: '22%'
                },
                {
                    value: false,
                    name: 'KitKat',
                    calories: 518,
                    fat: 26.0,
                    carbs: 65,
                    protein: 7,
                    iron: '6%'
                }
            ]

        }),
        components: {
            'add':  AddCompany,
            'edit': EditCompany,
        },
        methods: {
            fetchData(){
                this.$store.dispatch('getCompanies');
            },
            deleteItem(item) {
                this.$store.dispatch('deleteCompony', item);
            },
            closeDialog() {
                this.showDialog = false;
            },
            showEditForm(compaing) {
                this.editCompain = compaing;
                this.showDialog = true;
            },
        },
        mounted() {
            this.$store.dispatch('getCompanies');
        },

        computed: {
            searched() {
                return searchByName(this.$store.getters.companies, this.search);
            },

            currentUser() {
                return this.$store.getters.currentUser;
            },
            txt_def() {

                if(this.$store.getters.templates.length == 0) {
                    return
                }
                return searchDef(this.$store.getters.templates, 1)[0].name;
            },
        }
    }
</script>

<style lang="scss" scoped>

    .mt-15 {
        margin-top: 15px;
    }

    .md-field {
        max-width: 300px;
    }

    .md-card-content {
        padding: 0;
    }

    .md-dialog {
        max-width: 768px;
    }
</style>
