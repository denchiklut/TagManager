<template>
   <div>
       <h2>{{contact ? contact.name : 'Select chat'}}</h2>
       <MessagesFeed :contact="contact" :messanges="messanges"  />
       <MessageComposer @send="sendMessage" />
   </div>
</template>

<script>
    import MessagesFeed from './../chat/MessagesFeed'
    import MessageComposer from './../chat/MessageComposer'
    export default {
        props: {
            contact: {
                type: Object,
                default: null,
            },
            messanges: {
                type: Array,
                default: []
            }
        },
        name: "Conversetion",
        components: {
            MessagesFeed,
            MessageComposer
        },
        methods: {
            sendMessage(text) {
                console.log(text)
            }
        }
    }
</script>

<style scoped>

</style>
