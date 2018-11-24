<template>
    <div class="cmposer">
        <v-textarea
            outline
            name="input-7-4"
            label="Outline textarea"
            rows="1"
            v-model="message"
            @keydown.enter="send"
        ></v-textarea>
    </div>
</template>

<script>
    export default {
        name: "MessageComposer",
        data() {
            return {
                message: '',
            }
        },
        methods: {
            send() {
                if (this.messsage ='') {
                    return
                }
                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>

<style scoped>

</style>
