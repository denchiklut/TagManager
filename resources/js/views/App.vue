<template>
    <div class="page-container md-layout-column">
        <md-toolbar class="md-primary">
            <md-button class="md-icon-button" @click="showNavigation = true">
                <md-icon>menu</md-icon>
            </md-button>
            <span class="md-title">TAG Manager</span>

            <div class="md-toolbar-section-end">
                <span v-if="currentUser">{{currentUser.name}}</span>
                <md-menu md-size="big">
                    <md-button class="md-icon-button" md-menu-trigger>
                        <md-icon>more_vert</md-icon>
                    </md-button>

                    <md-menu-content>
                       <div v-if="!currentUser">
                           <md-menu-item>
                               <router-link to="/login">login</router-link>
                           </md-menu-item>
                           <md-menu-item>
                               <router-link to="/register">Register</router-link>
                           </md-menu-item>
                       </div>

                        <div v-else>
                            <md-menu-item>
                                <a href="#!" @click.prevent="logout">Log out</a>
                            </md-menu-item>
                        </div>

                    </md-menu-content>
                </md-menu>
            </div>
        </md-toolbar>

        <md-drawer :md-active.sync="showNavigation">
            <md-toolbar class="md-transparent" md-elevation="0">
                <span class="md-title">TAG Manager</span>
            </md-toolbar>

            <md-list>
                <md-list-item>
                    <md-icon>move_to_inbox</md-icon>
                    <span class="md-list-item-text">
                        <router-link :to="{ name: 'analytics' }" class="nav-link active">Analytics</router-link>
                    </span>
                </md-list-item>

                <md-list-item>
                    <md-icon>send</md-icon>
                    <span class="md-list-item-text">
                        <router-link :to="{ name: 'companies' }" class="nav-link active">Companies</router-link>
                    </span>
                </md-list-item>

                <md-list-item>
                    <md-icon>error</md-icon>
                    <span class="md-list-item-text">
                        <router-link :to="{ name: 'templates' }" class="nav-link active">Templates</router-link>
                    </span>
                </md-list-item>

                <md-list-item>
                    <md-icon>error</md-icon>
                    <span class="md-list-item-text">
                        <router-link :to="{ name: 'relax' }" class="nav-link active">Relax</router-link>
                    </span>
                </md-list-item>
            </md-list>
        </md-drawer>

        <md-content>
            <div>
                <router-view></router-view>
            </div>
        </md-content>
    </div>
</template>
<script>
    export default {
        name: 'Temporary',
        data: () => ({
            showNavigation: false,
            showSidepanel: false
        }),
        methods: {
            logout() {
                this.$store.commit("logout");
                this.$router.push("/login");
            }
        },
        computed: {
            currentUser() {
               return this.$store.getters.currentUser;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .page-container {
        min-height: 100vh;
        overflow: hidden;
        position: relative;
        border: 1px solid rgba(#000, .12);
    }

    // Demo purposes only
    .md-drawer {
        width: 230px;
        max-width: calc(100vw - 125px);
    }

    .md-content {
        padding: 16px;
    }
</style>
