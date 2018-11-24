<template>
    <div class="feed">
        <ul v-if="contact">
            <li v-for="message in messanges" :class="`message ${message.to == contact.id ? 'sent' : 'received'}`" :key="message.id">
                <div class="text">
                    {{message.text}}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "MessagesFeed",
        props: {
            contact: {
                type: Object
            },
            messanges: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style lang="scss" scoped>

    .feed {
        background: #f0f0f0;
        height: 100%;
        max-height: 424px;
        overflow-y: scroll;

        ul {
            padding-left: 5px;
            list-style: none;

            li {
                &.message {
                    width: 100%;
                    margin: 10px 0;

                    .text {
                        max-width: 250px;
                        border-radius: 5px;
                        padding: 12px;
                        display: inline-block;
                    }

                    &.received {
                        text-align: left;

                        .text {
                            background: #d0fac5;
                        }
                    }
                    &.sent {
                        text-align: right;
                        .text {
                            background: #cdcdcd;
                        }
                    }
                }

            }
        }
    }
</style>
