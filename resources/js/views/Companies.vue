<template>
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
                <md-table v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
                    <md-table-empty-state
                            md-label="No users found"
                            :md-description="`No user found for this '${search}' query. Try a different search term or create a new user.`">
                    </md-table-empty-state>

                    <md-table-row slot="md-table-row" slot-scope="{ item }" md-with-hover>
                        <md-table-cell md-label="#" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                        <!--<md-table-cell md-label="id_client" md-sort-by="id_client">{{ item.id_client }}</md-table-cell>-->
                        <!--<md-table-cell md-label="id_campaign" md-sort-by="id_campaign">{{ item.id_campaign }}</md-table-cell>-->
                        <md-table-cell md-label="signature" md-sort-by="signature">{{ item.signature }}</md-table-cell>
                        <md-table-cell md-label="url" md-sort-by="url">
                            <router-link :to="{ name: 'containers', params:{ id: item.id_campaign, url: item.url }}" class="nav-link active">{{ item.url }}</router-link>
                        </md-table-cell>
                        <!--<md-table-cell md-label="password" md-sort-by="password">{{ item.password }}</md-table-cell>-->
                        <md-table-cell md-label="sig" md-sort-by="sig">{{ item.sig }}</md-table-cell>
                        <md-table-cell md-label="trigger" md-sort-by="trigger">{{ item.trigger }}</md-table-cell>
                        <md-table-cell md-label="created_at" md-sort-by="created_at.date" md-numeric>{{ item.created_at.date | formatDate }}</md-table-cell>
                        <md-table-cell md-label="edit">
                            <md-button class="md-fab md-mini md-primary" @click="showEditForm(item)"><md-icon>edit</md-icon></md-button>
                            <md-button class="md-fab md-mini" @click="deleteItem(item)"><md-icon>delete</md-icon></md-button>
                        </md-table-cell>
                    </md-table-row>
                </md-table>
            </md-card-content>
        </md-card>

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

    export default {
        name: 'TableSearch',
        data: () => ({
            search: null,
            showDialog: false,
            editCompain: null,
            userSaved: false,
            lastUser: null,
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
            if (this.searched.length) {
                return
            }
            this.$store.dispatch('getCompanies');
        },

        computed: {
            searched() {
                return searchByName(this.$store.getters.companies, this.search);
            },

            currentUser() {
                return this.$store.getters.currentUser;
            }
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
