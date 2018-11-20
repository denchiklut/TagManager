<template>
    <div>
        <form novalidate class="md-layout" @submit.prevent="validateUser">
            <md-card class="md-layout-item md-small-size-100" md-with-hover>
                <md-toolbar class="md-primary" md-theme="myTheme" md-aligment="space-between">
                    <div class="md-title">Создать Фильтр</div>
                </md-toolbar>
                <md-card-content>
                    <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('trigger')" md-theme="myTheme">
                                <label for="trigger">trigger</label>
                                <md-input name="trigger" id="trigger" autocomplete="trigger" v-model="form.trigger" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.trigger.required">The trigger is required</span>
                                <span class="md-error" v-else-if="!$v.form.trigger.minLength">Invalid trigger</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('id_campaign')" md-theme="myTheme">
                                <label for="new_campaign">new_campaign</label>
                                <md-input name="new_campaign" id="new_campaign" autocomplete="new_campaign" v-model="form.new_campaign" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.new_campaign.required">The new_campaign is required</span>
                                <span class="md-error" v-else-if="!$v.form.new_campaign.minLength">Invalid new_campaign</span>
                            </md-field>
                        </div>
                    </div>

                    <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                            <md-field>
                                <label for="def">Шаблон</label>
                                <md-select name="templates_id" id="def" v-model="form.templates_id" md-dense :disabled="sending">
                                    <div v-for="d in defaults">
                                        <md-option  v-bind:value="d.id">{{d.name}}</md-option>
                                    </div>


                                </md-select>
                            </md-field>
                        </div>
                    </div>
                </md-card-content>

                <md-progress-bar md-mode="indeterminate" v-if="sending" />

                <md-card-actions>
                    <md-button class="md-primary" md-theme="myTheme" @click="close">Отмена</md-button>
                    <md-button type="submit" class="md-primary" md-theme="myTheme" :disabled="sending">Сохранить</md-button>
                </md-card-actions>
            </md-card>
        </form>
        <md-snackbar :md-active.sync="userSaved">Trigger {{ lastUser }} был добавлен успешно!</md-snackbar>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {
        required,
        minLength,

    } from 'vuelidate/lib/validators'

    export default {
        props: ['old_comaing'],
        mixins: [validationMixin],
        data: () => ({
            form: {
                new_campaign: null,
                trigger: null,
                id_campaign: null,
                templates_id: null,
            },
            lastUser: null,
            userSaved: false,
            sending: false,
        }),
        validations: {
            form: {
                trigger: {
                    required
                },
                new_campaign: {
                    required
                }
            }
        },
        methods: {
            getValidationClass (fieldName) {
                const field = this.$v.form[fieldName];

                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            },
            clearForm () {
                this.$v.$reset();
                this.form.id_campaign = null;
                this.form.new_campaign = null;
                this.form.trigger = null;

            },

            savePixel () {
                this.sending = true;
                this.form.id_campaign = this.old_comaing;

                this.$store.dispatch('addTrigger', this.form);
                this.lastUser = `${this.form.url}`;

                setTimeout(() => {
                    this.userSaved = true;
                    this.sending = false;
                    this.close();
                    this.clearForm()
                }, 1000)
            },

            validateUser () {

                this.$v.$touch();

                if (!this.$v.$invalid) {

                    this.savePixel()
                }
            },
            close() {
                this.$emit('CloseTriggerDialog')
            },
        },
        mounted() {
            this.$store.dispatch('getTemplates');
        },
        computed: {
            defaults() {
                return this.$store.getters.templates;
            }
        }
    }
</script>


<style lang="scss" scoped>

    // Import the theme engine
    @import "../../../../node_modules/vue-material/dist/theme/engine";

    @include md-register-theme("myTheme", (

        // The primary color of your brand
            primary: #9C27B0,

        // The secondary color of your brand
            accent: #E91E63
    ));

    // Apply the theme
    @import "../../../../node_modules/vue-material/dist/theme/all";
</style>
