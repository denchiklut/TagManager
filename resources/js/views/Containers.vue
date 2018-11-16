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
                  <md-card-media>
                      <md-toolbar class="md-dense md-primary" md-theme="myTheme">
                          <div class="md-layout-item md-size-50">
                              <h3 class="md-title">Фильтр:</h3>
                          </div>
                          <div class="md-layout-item md-size-50 text-right">
                              <md-chip class="md-primary" md-theme="myBtnTheme" md-clickable>{{url}}</md-chip>
                          </div>
                      </md-toolbar>
                      <md-content class="md-scrollbar">
                          <script_t :new_campaign="id"></script_t>
                      </md-content>
                  </md-card-media>
                  <md-ripple>
                      <md-card-header>
                          <div class="md-layout md-gutter md-alignment-center-space-between">
                              <div class="md-layout-item md-size-75">
                                  <div class="md-title" >Код компании: {{id}}</div>
                                  <div class="md-subhead">Поместите этот скрипт в тег
                                      <b>
                                          <span class="has-tag">&lt;</span>
                                          <span class="has-name">head</span>
                                          <span class="has-tag">&gt;</span>
                                      </b>
                                      вашего сайта </div>
                              </div>
                              <div class="md-layout-item md-size-25 text-right">
                                  <md-button class="md-fab md-mini md-primary" md-theme="myBtnTheme" disabled>
                                      <md-icon>edit</md-icon>
                                  </md-button>
                                  <md-button class="md-fab md-mini md-primary" md-theme="myBtnTheme" disabled>
                                      <md-icon>delete</md-icon>
                                  </md-button>
                              </div>
                          </div>
                      </md-card-header>
                  </md-ripple>
              </md-card>
          </div>

          <div  v-for="item in searched" class="md-layout-item">
              <md-card class="md-accent" md-theme="myTheme" md-with-hover>
                  <md-card-media>
                      <md-toolbar class="md-dense md-primary" md-theme="myTheme">
                          <div class="md-layout-item md-size-50">
                              <h3 class="md-title">Фильтр:</h3>
                          </div>
                          <div class="md-layout-item md-size-50 text-right">
                              <md-chip v-if="item.templates_id" class="md-primary" md-theme="purpl" md-clickable>{{getName(item.templates_id)}}</md-chip>
                              <md-chip class="md-primary" md-theme="myBtnTheme" md-clickable>{{item.trigger}}</md-chip>
                          </div>
                      </md-toolbar>
                      <md-content class="md-scrollbar">
                          <script_t :new_campaign="item.new_campaign"></script_t>
                      </md-content>
                  </md-card-media>
                  <md-ripple>
                      <md-card-header>
                          <div class="md-layout md-gutter md-alignment-center-space-between">
                              <div class="md-layout-item md-size-75">
                                  <div class="md-title" >Код компании: {{item.new_campaign}}</div>
                                  <div class="md-subhead">Поместите этот скрипт в тег
                                      <b>
                                          <span class="has-tag">&lt;</span>
                                          <span class="has-name">head</span>
                                          <span class="has-tag">&gt;</span>
                                      </b>
                                      вашего сайта </div>
                              </div>
                              <div class="md-layout-item md-size-25 text-right">
                                  <md-button class="md-fab md-mini md-primary" md-theme="myBtnTheme" @click="showEditFilterDialog(item)">
                                      <md-icon>edit</md-icon>
                                  </md-button>
                                  <md-button class="md-fab md-mini md-primary" md-theme="myBtnTheme" @click="deleteFilter(item)">
                                      <md-icon>delete</md-icon>
                                  </md-button>
                              </div>
                          </div>
                      </md-card-header>
                  </md-ripple>
              </md-card>
          </div>
      </div>

      <md-dialog :md-active.sync="showAddDialog">
          <add @AddTrigger="showLog" @CloseTriggerDialog="closeDialog" :old_comaing="id"></add>
      </md-dialog>

      <md-dialog :md-active.sync="showEditDialog">
          <edit @ShowLogEdit="showLogEdit" @editTriggerE="closeDialog" :form="editTrigger"></edit>
      </md-dialog>

      <md-snackbar :md-active.sync="userSaved">Trigger {{ lastUser }} был добавлен успешно!</md-snackbar>
      <md-snackbar :md-active.sync="userEdit">Trigger {{ lastUser }} изменен успешно!</md-snackbar>
  </div>
</template>

<script>
    import axios from 'axios'
    import AddTrigeger from '../components/containers/AddTrigger'
    import EditTrigger from '../components/containers/EditTrigger'
    import template_1 from '../components/scripts/template_1'

    const toLower = text => {
        return text.toString().toLowerCase()
    };

    const searchByName = (items, term) => {
        if (term) {
            return items.filter(item => toLower(JSON.stringify(item)).includes(toLower(term)))
        }

        return items
    };

    export default {
        props: ['url', 'id'],
        name: "Containers",
        data () {
            return {
                search: null,
                searched: [],
                containers: [],
                showAddDialog: false,
                showEditDialog: false,
                editTrigger: null,
                userSaved:false,
                userEdit:false,
                lastUser:null,
                defUrl: null,
                defaults: [],
                showT: false,
            }
        },
        components: {
            'add': AddTrigeger,
            'edit': EditTrigger,
            'script_t': template_1,
        },

        methods: {
            fetchData() {
                axios
                    .get('/api/containers/' + this.id, this.id)
                    .then(response => {
                        this.containers = response.data.data;
                        this.searched = this.containers;
                        console.log(this.searched)
                    });
            },
            fetchTemplates() {
                axios
                    .get('/api/defaults')
                    .then(response => {
                        this.defaults = response.data.data;
                        console.log(this.defaults);
                    });
            },
            searchOnTable () {
                this.searched = searchByName(this.containers, this.search)
            },
            showEditFilterDialog(item) {
                this.editTrigger = item;
                this.showEditDialog = true;
            },
            deleteFilter(item) {
                axios.delete('/api/containers/' + item.id)
                    .then(response => {
                        let index = this.containers.indexOf(item);
                        this.containers.splice(index, 1);
                    });
            },
            closeDialog() {
                this.showAddDialog = false;
                this.showEditDialog = false;
                this.fetchData();
            },
            showLog(data) {
                this.lastUser = data.data.trigger;
                this.userSaved = true;

                window.setTimeout(() => {
                    this.userSaved = false;
                }, 1500)
            },
            showLogEdit(data) {
                this.lastUser = data.data;
                this.userEdit = true;

                window.setTimeout(() => {
                    this.userSaved = false;
                }, 1500)
            },
            getName (id) {
                return (this.defaults.filter((item)=>{
                    return item.id == id
                         })[0]).name
            }
        },
        created() {
            this.fetchData();
            this.fetchTemplates();
        },
        filters: {

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
            accent: #616161,
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
        max-width: 575px;
        margin: 4px;
        display: inline-block;
        vertical-align: top;
    }

    .md-content {
        /*max-width: 600px;*/
        height: 300px;
        overflow: auto;
        background: #282c33!important;
    }

    .md-card-header {
        /*background: #5d3666e3;*/
        background: #e1515a3b;
        margin-bottom: 0;
    }

    .md-chips {
        margin-bottom: 24px;
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
    }

    .text-p {
        padding-left: 20px;
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
