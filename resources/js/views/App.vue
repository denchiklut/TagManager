<template>
    <div class="page-container md-layout-column">
        <md-toolbar class="md-primary">
            <md-button class="md-icon-button" @click="showNavigation = true">
                <md-icon>menu</md-icon>
            </md-button>
            <span class="md-title">TAG Manager</span>

            <div class="md-toolbar-section-end">
                <h3 v-if="currentUser">{{currentUser.name}}</h3>
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
                        <router-link :to="{ name: 'analytics' }" exact>Analytics</router-link>
                    </span>
                </md-list-item>

                <md-list-item>
                    <md-icon>send</md-icon>
                    <span class="md-list-item-text">
                        <router-link :to="{ name: 'companies' }" exact>Companies</router-link>
                    </span>
                </md-list-item>

                <md-list-item>
                    <md-icon>error</md-icon>
                    <span class="md-list-item-text">
                        <router-link :to="{ name: 'templates' }" exact>Templates</router-link>
                    </span>
                </md-list-item>

                <md-list-item>
                    <md-icon>error</md-icon>
                    <span class="md-list-item-text">
                        <router-link :to="{ name: 'relax' }" exact>Relax</router-link>
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

    .md-drawer {
        width: 230px;
        max-width: calc(100vw - 125px);
    }

    .md-content {
        padding: 16px;
    }

    .md-list-item a{
        color: #757575;
    }
    .md-list-item a:hover{
        color: #757575;
        text-decoration: none;
    }

    .router-link-active {
        background: #757575;
        color: #fff !important;
        padding: 10px 5px;
        width: 100%;
        height: 36px;
        font-weight: 500;
        text-transform: uppercase;
        border-radius: 2px;
        box-shadow: rgba(0, 0, 0, 0.2) 0 3px 1px -2px, rgba(0, 0, 0, 0.14) 0px 2px 2px 0px, rgba(0, 0, 0, 0.12) 0px 1px 5px 0px;
    }

    .router-link-active:hover {
        text-decoration: none!important;
    }

    .md-list-item-text {
        overflow: initial!important;
    }
</style>
