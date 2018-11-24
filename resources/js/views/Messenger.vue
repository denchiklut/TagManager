<template>
    <div class="chat-app">
    <v-app>
        <v-container grid-list-md text-xs-center>
            <v-layout row wrap>
                <v-flex xs12>
                    <v-card dark color="primary">
                        <v-card-text class="px-0">Messenger</v-card-text>
                    </v-card>
                </v-flex>
                <v-flex  xs9>
                    <Conversetion :contact="selectedContact" :messanges="messanges"/>
                </v-flex>
                <v-flex  xs3>
                    <ContactsList :contacts="contacts" @selected="startMessagin"/>
                </v-flex>

            </v-layout>
        </v-container>



    </v-app>
    </div>
</template>

<script>
    import Conversetion from './../components/chat/Conversetion'
    import ContactsList from './../components/chat/ContactsList'
    import axios from "axios";

    export default {
        name: "Messenger",
        data(){
            return {
                selectedContact: null,
                messanges: [],
                contacts: [],
            }
        },
        methods: {
            startMessagin(contact) {

                axios
                    .get(`api/conversation/${contact.id}`)
                    .then(response => {
                        this.messanges = response.data;
                        this.selectedContact = contact;
                    })

            }
        },
        mounted() {
            axios
                .get('api/contacts')
                .then(response => {
                    this.contacts = response.data.data;
                })
        },
        components:{
            Conversetion,
            ContactsList
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        }
    }
</script>

<style scoped>

</style>
