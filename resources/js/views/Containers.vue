<template>
    <div>
        <md-toolbar class="md-transparent" md-elevation="0">
            <div class="md-title" style="flex: 1">
                <md-field>
                    <label>Тригеры</label>
                    <md-input placeholder="Введите уникальное имя проекта лиюо id компании" v-model="search" @input="searchOnTable"></md-input>
                </md-field>
            </div>
            <md-button><router-link :to="{ name: 'companies' }"  class="nav-link active">Назад</router-link></md-button>
            <md-button class="md-primary md-raised" @click="showAddDialog = true">Создать</md-button>
        </md-toolbar>

        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="md-accent" md-theme="myTheme" md-with-hover>
                    <md-ripple>
                        <md-card-area>
                            <md-toolbar class="md-dense md-tlbr">
                                <md-card-header>
                                    <div class="md-title">компания: {{id}}</div>
                                    <div class="md-subhead">{{currentCompony[0].templates ? currentCompony[0].templates : txt_def}} /  {{url}}</div>
                                </md-card-header>

                            </md-toolbar>

                            <md-content class="md-scrollbar">
                                <md-card-media>
                                    <component :is="txt_def" :new_campaign="id"></component>
                                </md-card-media>
                            </md-content>
                        </md-card-area>
                        <md-card-actions>
                            <md-button @click="showEditFilterTimplase(txt_def)">Edit</md-button>
                            <md-button disabled>remove</md-button>
                        </md-card-actions>
                    </md-ripple>
                </md-card>
            </div>

            <div  v-for="item in searched" class="md-layout-item">
                <md-card class="md-accent" md-theme="myTheme" md-with-hover>
                    <md-ripple>
                        <md-card-area>
                            <md-toolbar class="md-dense md-tlbr">
                                <md-card-header>
                                    <div class="md-title">компания: {{item.new_campaign}}</div>
                                    <div class="md-subhead">{{item.templates}} /  {{item.trigger}}</div>
                                </md-card-header>

                            </md-toolbar>

                            <md-content class="md-scrollbar">
                                <md-card-media>
                                    <component :is="item.templates" :new_campaign="item.new_campaign"></component>
                                </md-card-media>
                            </md-content>
                        </md-card-area>
                        <md-card-actions>
                            <md-button @click="showEditFilterDialog(item)">Edit</md-button>
                            <md-button @click="deleteFilter(item)">remove</md-button>
                        </md-card-actions>
                    </md-ripple>
                </md-card>
            </div>
        </div>

        <md-dialog :md-active.sync="showAddDialog">
            <add  @CloseTriggerDialog="closeDialog" :old_comaing="id"></add>
        </md-dialog>

        <md-dialog :md-active.sync="showEditDialog">
            <edit @editTriggerE="closeDialog" :form="editTrigger"></edit>
        </md-dialog>

        <div>
            <md-dialog :md-active.sync="active">
                <form @submit.prevent="saveDef">

                    <div class="md-layout md-gutter">
                        <div class="md-layout-item">
                            <form novalidate class="md-layout" @submit.prevent="saveDef">
                                <md-card class="md-layout-item md-size-100">
                                    <md-card-header>
                                        <div class="md-title">ШАблоны</div>
                                    </md-card-header>

                                    <md-card-content>
                                        <div class="md-layout md-gutter">
                                            <div class="md-layout-item md-small-size-100">
                                                <md-field>
                                                    <label for="def">Шаблон</label>
                                                    <md-select name="templates" v-model="tmpl_comp" id="def" md-dense >
                                                        <div v-for="d in tmpl">
                                                            <md-option  v-bind:value="d.name">{{d.name}}</md-option>
                                                        </div>
                                                    </md-select>
                                                </md-field>
                                            </div>
                                        </div>
                                    </md-card-content>
                                    <md-card-actions>
                                        <md-button class="md-primary" md-theme="myTheme" @click="active=false">Отмена</md-button>
                                        <md-button type="submit" class="md-primary" md-theme="myTheme">Сохранить</md-button>
                                    </md-card-actions>
                                </md-card>
                            </form>

                        </div>
                    </div>
                </form>
            </md-dialog>
        </div>


    </div>


</template>

<script>
    import AddTrigeger from '../components/containers/AddTrigger'
    import EditTrigger from '../components/containers/EditTrigger'

    import TXE_Standart from '../components/scripts/TXE_Standart'
    import EXT_Notpalevo from '../components/scripts/EXT_Notpalevo'
    import GIB_bigcock from '../components/scripts/GIB_bigcock'
    import TXE_NONSONAR from '../components/scripts/TXE_NONSONAR'

    const toLower = text => {
        return text.toString().toLowerCase()
    };

    const searchByName = (items, term) => {
        if (term) {
            return items.filter(item => toLower(JSON.stringify(item)).includes(toLower(term)))
        }

        return items
    };

    const searchDef = (items, term) => {
        if (term) {
            return items.filter(item => toLower(JSON.stringify(item.default)).includes(toLower(term)))
        }

        return items;
    };

    export default {
        props: ['url', 'id'],
        data () {
            return {
                search: null,
                showAddDialog: false,
                showEditDialog: false,
                editTrigger: null,
                userSaved:false,
                userEdit:false,
                lastUser:null,
                defUrl: null,
                showT: false,
                active: false,
                tmpl_comp: null,
                teml_obj: {
                    id: '',
                    text: '',
                }
            }
        },
        components: {
            'add': AddTrigeger,
            'edit': EditTrigger,

            'TXE_Standart': TXE_Standart,
            'EXT_Notpalevo': EXT_Notpalevo,
            'GIB_bigcock': GIB_bigcock,
            'TXE_NONSONAR': TXE_NONSONAR,
        },

        methods: {
            searchOnTable () {
                this.searched = searchByName(this.containers, this.search)
            },
            showEditFilterDialog(item) {
                this.editTrigger = item;
                this.showEditDialog = true;
            },
            deleteFilter(item) {
                this.$store.dispatch('deleteTrigger', item);
            },
            closeDialog() {
                this.showAddDialog = false;
                this.showEditDialog = false;
            },
            showEditFilterTimplase(txt_def)
            {
                this.active = true;
            },
            saveDef() {
                this.active = false;
                this.teml_obj.id = this.id;
                this.teml_obj.text = this.tmpl_comp;
                this.$store.dispatch('editComponyTimplate', this.teml_obj);

            }
        },
        created() {


        },
        mounted() {
            this.$store.dispatch('getTrigger', this.id);
            this.$store.dispatch('getCurrentCompony', this.id);
        },
        computed: {
            searched() {
                return searchByName(this.$store.getters.triggers, this.search);
            },
            tmpl() {
                return this.$store.getters.templates;
            },
            txt_def() {

                if(this.$store.getters.templates.length == 0) {
                    return
                }
                return searchDef(this.$store.getters.templates, 1)[0].name;
            },
            currentCompony() {
                return this.$store.getters.curentCompony;
            }
        }
    }
</script>
<style lang="scss" scoped>

    // Import the theme engine
    @import "../../../node_modules/vue-material/dist/theme/engine";

    @include md-register-theme("myTheme", (

        // The primary color of your brand
            primary: #616161,

        // The secondary color of your brand
            accent: #525252,
    ));

    @include md-register-theme("myBtnTheme", (

        // The primary color of your brand
            primary: #E53935,

        // The secondary color of your brand
            accent: #616161,
    ));

    @include md-register-theme("purpl", (
            primary: #b335e5
    ));

    // Apply the theme
    @import "../../../node_modules/vue-material/dist/theme/all";

    .md-card {
        max-width: 450px;
        margin: 4px;
        display: inline-block;
        vertical-align: top;
        font-size: 8px;
        line-height: 11px;
    }
    .md-title {
        margin-top: 0!important;
        font-size: 16px;
    }

    .md-content {
        /*max-width: 600px;*/
        height: 160px;
        overflow: auto;
        background: #525252!important;
    }

    .md-card-header {
        padding: 6px 16px;
        /*background: #a06560;*/
        margin-bottom: 0;
    }

    .md-tlbr {
        background: #a06560!important;
    }

    .md-chip {
        font-size: 9px!important;
        /*margin-bottom: 24px;*/
    }

    small {
        font-weight: 500;
    }

    .has-tag {
        color: #89ddff;;
    }

    .has-name {
        color: #f07178;
    }

    .has-string {
        color: #bbdf88;
    }
    .has-attr {
        color: #bb8adb;
    }

    .txt-script {
        margin-left: 15px;
        width: initial;
    }

    .md-toolbar .md-title {

        margin-left: 0;
        font-weight: bold;
        color: #fff!important;

    }

    .text-p {
        padding-left: 0!important;
        margin-top: -20px;
    }
    .has-id {
        color: red
    }
    .has_n {
        color: orange;
    }
    .text-right {
        text-align: right;
    }
</style>
