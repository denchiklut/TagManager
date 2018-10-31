<template>
    <div>
        <md-card class="md-accent" md-with-hover>
            <md-ripple>
                <md-toolbar class="md-accent" md-elevation="1">
                    <div class="md-toolbar-section-start">
                        <h1 class="md-title">Users</h1>
                    </div>

                    <md-field md-clearable>
                        <md-input placeholder="Search by name..." v-model="search" @input="searchOnTable" />
                    </md-field>

                    <md-menu md-size="big" md-direction="bottom-end">
                        <md-button class="md-icon-button" md-menu-trigger>
                            <md-icon>more_vert</md-icon>
                        </md-button>

                        <md-menu-content>
                            <md-menu-item @click="doACall">
                                <span>Call</span>
                                <md-icon>phone</md-icon>
                            </md-menu-item>

                            <md-menu-item @click="sendMessage">
                                <span>Send a message</span>
                                <md-icon>message</md-icon>
                            </md-menu-item>
                        </md-menu-content>
                    </md-menu>
                </md-toolbar>



                <md-card-content>
                    <md-table v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
                        <md-table-empty-state
                                md-label="No users found"
                                :md-description="`No user found for this '${search}' query. Try a different search term or create a new user.`">
                            <md-button class="md-primary md-raised" @click="newUser">Create New User</md-button>
                        </md-table-empty-state>

                        <md-table-row slot="md-table-row" slot-scope="{ item }" md-with-hover>
                            <md-table-cell md-label="#" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                            <md-table-cell md-label="id_client" md-sort-by="id_client">{{ item.id_client }}</md-table-cell>
                            <md-table-cell md-label="id_campaign" md-sort-by="id_campaign">{{ item.id_campaign }}</md-table-cell>
                            <md-table-cell md-label="password" md-sort-by="password">{{ item.password }}</md-table-cell>
                            <md-table-cell md-label="signature" md-sort-by="signature">{{ item.signature }}</md-table-cell>
                            <md-table-cell md-label="sig" md-sort-by="sig">{{ item.sig }}</md-table-cell>
                            <md-table-cell md-label="url" md-sort-by="url">{{ item.url }}</md-table-cell>
                            <md-table-cell md-label="tm_id" md-sort-by="tm_id">{{ item.tm_id }}</md-table-cell>
                            <md-table-cell md-label="created_at" md-sort-by="created_at.date" md-numeric>{{ item.created_at.date }}</md-table-cell>
                        </md-table-row>
                    </md-table>
                </md-card-content>
            </md-ripple>
        </md-card>
    </div>
</template>

<script>
    import axios from 'axios';
    const toLower = text => {
        return text.toString().toLowerCase()
    }

    const searchByName = (items, term) => {
        if (term) {
            return items.filter(item => toLower(JSON.stringify(item)).includes(toLower(term)))
        }

        return items
    }

    export default {
        name: 'TableSearch',
        data: () => ({
            search: null,
            searched: [],
            users: [],
        }),
        methods: {
            newUser () {
                window.alert('Noop')
            },
            searchOnTable () {
                this.searched = searchByName(this.users, this.search)
            },
            fetchData() {
                axios
                    .get('/api/companies')
                    .then(response => {
                        this.users = response.data.data;
                        this.searched = this.users;
                    });
            },
            sendMessage () {
                window.alert('Send a message...')
            },
            doACall () {
                window.alert('Calling someone...')
            }
        },
        created () {
            this.fetchData();
        },
    }
</script>

<style lang="scss" scoped>
    .md-field {
        max-width: 300px;
    }
    .md-card-content {
        padding: 0;
    }
</style>