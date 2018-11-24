<template>
    <v-layout row>
        <v-flex xs12>
            <v-card>
                <v-toolbar color="teal" dark>
                    <v-toolbar-title class="text-xs-center">New Chat</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon>
                        <v-icon>search</v-icon>
                    </v-btn>
                </v-toolbar>

                <v-list subheader>
                    <v-subheader>Recent chat</v-subheader>
                    <v-list-tile
                        v-for="(item, index) in contacts"
                        :key="item.id"
                        avatar
                        @click="selectContact(item, index)"
                        :class="{'selected':index == selected}"
                    >
                        <v-list-tile-avatar>
                            <img :src="item.profile_img">
                        </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title v-html="item.name"></v-list-tile-title>
                            <v-list-tile-sub-title>{{ item.email }}</v-list-tile-sub-title>
                        </v-list-tile-content>
                        <!--<v-list-tile-action>-->
                            <!--<v-icon :color="item.active ? 'teal' : 'grey'">chat_bubble</v-icon>-->
                        <!--</v-list-tile-action>-->
                    </v-list-tile>
                </v-list>

                <v-divider></v-divider>
                <!--<v-list subheader>-->
                    <!--<v-subheader>Previous chats</v-subheader>-->

                    <!--<v-list-tile-->
                        <!--v-for="item in items2"-->
                        <!--:key="item.title"-->
                        <!--avatar-->
                        <!--@click=""-->
                    <!--&gt;-->
                        <!--<v-list-tile-avatar>-->
                            <!--<img :src="item.avatar">-->
                        <!--</v-list-tile-avatar>-->

                        <!--<v-list-tile-content>-->
                            <!--<v-list-tile-title v-html="item.title"></v-list-tile-title>-->
                        <!--</v-list-tile-content>-->
                    <!--</v-list-tile>-->
                <!--</v-list>-->
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        props: ['contacts'],
        data () {
            return {
                selected: 0,
            }
        },
        methods: {
            selectContact(contact, index ) {

                this.selected = index;
                this.$emit('selected', contact)
            }
        }
    }
</script>

<style scoped>

</style>
