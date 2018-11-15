<template>
    <div>
        <md-card  md-with-hover>
            <md-toolbar class="md-primary" md-theme="myTheme">
                <h3 class="md-title">Шаблоны скриптов</h3>
                <div class="control">
                    <md-switch v-model="expandSingle" Accent class="md-theme-default">Показывать по одному</md-switch>
                </div>
            </md-toolbar>
            <md-card-content>
                <div class="list">
                    <md-list :md-expand-single="expandSingle" >
                        <div v-for="(item, idx) in templates">
                            <md-list-item md-expand >
                                <md-icon :class="{orng_icon: idx == activeIndex}">whatshot</md-icon>
                                <span class="md-list-item-text"> {{item.name}}</span>
                                <md-list slot="md-expand">

                                    <md-content class="md-primary text_template" md-theme="myTheme">
                                        <div class="md-layout md-gutter">
                                            <div class="md-layout-item md-size-90">
                                                <TXE_Standart :new_campaign="1"></TXE_Standart>
                                            </div>
                                            <div class="md-layout-item ">
                                                <md-button class="md-dense md-raised md-primary btn-accept"
                                                    @click="apply_template(item, idx)"
                                                    :class="{applied: idx == activeIndex}"
                                                    md-theme="orange-btn"
                                                >Применить</md-button>
                                            </div>
                                        </div>
                                    </md-content>
                                </md-list>
                            </md-list-item>
                        </div>
                    </md-list>
                </div>
            </md-card-content>
        </md-card>
    </div>
</template>

<script>
    import axios from 'axios'
    import template_1 from '../components/scripts/template_1'
    export default {
        data() {
            return {
                templates: [],
                expandSingle: false,
                applied: false,
                activeIndex: null,
                orng_icon: null,
            }
        },
        methods: {
            fetchData() {
                axios
                    .get('/api/templates')
                    .then(response => {
                        this.templates = response.data.data;

                        response.data.data.forEach((item) =>{

                            if (item.default == '1') {
                                this.activeIndex =item.id-1;
                            }
                        });
                    });

            },
            apply_template(item, idx) {
                this.activeIndex = idx;

                axios.patch('/api/templates/' + item.id, item)
                    .then(response => {
                            console.log(item);
                    });
            }
        },
        components: {
            'TXE_Standart': template_1
        },
        created() {
            this.fetchData();
            this.expandSingle = true;
        }
    }
</script>

<style lang="scss" scoped>


    // Import the theme engine
    @import "../../../node_modules/vue-material/dist/theme/engine";

    @include md-register-theme("myTheme", (

    // The primary color of your brand
    primary: #3e3e3e,

    // The secondary color of your brand
    accent: #616161
    ));

    @include md-register-theme("orange-btn", (
            primary: #ff5252
    ));

    // Apply the theme
    @import "../../../node_modules/vue-material/dist/theme/all";

    .md-card-content {
        padding: 0;
    }

    .control {
        min-width: 250px;
        display: flex;
        flex-direction: column;
        padding: 10px;
    }
    .md-list {
        padding: 0;
    }

    .text_template {
        padding: 10px 0;
    }
    .btn-accept {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .applied {
        background: #68d20fd9!important;
    }

    .orng_icon {
        color: #FF5722!important;
    }
</style>