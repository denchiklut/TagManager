<template>
    <v-app>
        <div>
            <!--Add Form-->
            <div>
                <add />
            </div>

            <!--Data Table-->
            <md-card class="md-accent mt-15" md-with-hover>

                <md-ripple>
                    <md-toolbar class="md-accent" md-elevation="1">
                        <div class="md-toolbar-section-start">
                            <h1 class="md-title">Companies</h1>
                        </div>

                        <md-field md-clearable>
                            <md-input placeholder="Search by name..." v-model="search" />
                        </md-field>
                    </md-toolbar>
                </md-ripple>

                <md-card-content>
                    <v-data-table
                            :headers="headers"
                            :items="componies"
                            :search="search"
                    >
                        <template slot="items" slot-scope="props">
                            <td>{{ props.item.id }}</td>
                            <!--<td class="text-xs-left">{{ props.item.id_client }}</td>-->
                            <td class="text-xs-left">{{ props.item.id_campaign }}</td>

                            <td class="text-xs-left">{{ props.item.signature }}</td>

                            <td class="text-xs-left">
                                <router-link :to="{ name: 'containers', params:{ id: props.item.id_campaign }}" class="nav-link active">
                                    {{ props.item.url }}
                                </router-link>
                            </td>
                            <!--<td class="text-xs-left">{{ props.item.password }}</td>-->
                            <td class="text-xs-left">{{ props.item.sig }}</td>
                            <td class="text-xs-left">{{ props.item.trigger }}</td>
                            <td class="text-xs-left">{{ props.item.templates ? props.item.templates : defTemplate}}</td>
                            <td class="text-xs-left">{{ props.item.created_at.date | formatDate }}</td>
                            <td class="text-xs-left act_btn">
                                <md-button class="md-fab md-mini md-primary" @click="showEditForm( props.item)"><md-icon>edit</md-icon></md-button>
                                <md-button class="md-fab md-mini" @click="deleteItem( props.item)"><md-icon>delete</md-icon></md-button>
                            </td>
                        </template>

                        <v-alert slot="no-results" :value="true" color="error" icon="warning">
                            Your search for "{{ search }}" found no results.
                        </v-alert>
                    </v-data-table>
                </md-card-content>
            </md-card>

            <!--Edit Dialog-->
            <md-dialog :md-active.sync="showDialog">
                <edit @CloseDialog="closeDialog" :form="editCompain"></edit>
            </md-dialog>
        </div>
    </v-app>
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

    export default {
        name: 'TableSearch',
        data: () => ({
            search: null,
            showDialog: false,
            editCompain: null,
            userSaved: false,
            lastUser: null,
            headers: [
                { text: 'id ', value: 'id'},
                // { text: 'id_client', value: 'id_client' },
                { text: 'id_campaign', value: 'id_campaign' },
                { text: 'signature', value: 'signature' },
                { text: 'url', value: 'url' },
                // { text: 'password', value: 'password' },
                { text: 'sig', value: 'sig' },
                { text: 'trigger', value: 'trigger' },
                { text: 'templates', value: 'templates' },
                { text: 'date', value: 'date' },
                { text: 'Action', value: 'Action' },
            ],

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
            componies() {
                return searchByName(this.$store.getters.companies, this.search);
            },

            currentUser() {
                return this.$store.getters.currentUser;
            },
            defTemplate() {
                return this.$store.getters.defTemplate;
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
    .act_btn {
        min-width: 160px!important;
    }
</style>
