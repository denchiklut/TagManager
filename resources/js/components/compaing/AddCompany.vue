<template>
    <div>

        <form novalidate class="md-layout" @submit.prevent="validateUser">
            <md-card class="md-layout-item md-small-size-100" md-with-hover>
                <md-card-expand>

                    <md-toolbar class="md-primary" md-theme="myTheme" md-aligment="space-between">
                        <div class="md-layout md-gutter md-alignment-center-space-between">
                        <div class="md-layout-item md-size-90">
                             <div class="md-title">Добавить Pixel</div>
                        </div>
                        <div class="md-layout-item md-size-10 text-right">
                            <md-card-expand-trigger>
                                <md-button class="md-icon-button">
                                    <md-icon>keyboard_arrow_down</md-icon>
                                </md-button>
                            </md-card-expand-trigger>
                        </div>
                        </div>
                    </md-toolbar>

                    <md-card-expand-content>
                        <div>
                            <md-card-content>
                                <div class="md-layout md-gutter">
                                    <div class="md-layout-item md-small-size-100">
                                        <md-field :class="getValidationClass('url')" md-theme="myTheme">
                                            <label for="url">url</label>
                                            <md-input name="url" id="url" autocomplete="url" v-model="form.url" :disabled="sending" />
                                            <span class="md-error" v-if="!$v.form.url.required">The url is required</span>
                                            <span class="md-error" v-else-if="!$v.form.url.maxLength">Invalid url</span>
                                        </md-field>
                                    </div>
                                </div>
                            </md-card-content>

                            <md-progress-bar md-mode="indeterminate" v-if="sending" />

                            <md-card-actions>
                                <md-button type="submit" class="md-primary" md-theme="myTheme" :disabled="sending">Добавить</md-button>
                            </md-card-actions>

                            <md-snackbar :md-active.sync="userSaved">Pixel {{ lastUser }} был добавлен успешно!</md-snackbar>
                        </div>

                    </md-card-expand-content>
                </md-card-expand>
            </md-card>
        </form>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {
        required,
        maxLength,

    } from 'vuelidate/lib/validators'

    export default {
        name: 'FormValidation',
        mixins: [validationMixin],
        data: () => ({
            form: {
                id_client: null,
                id_campaign: null,
                password: null,
                signature: null,
                sig: null,
                url: null,
                trigger: null,
            },
            userSaved: false,
            sending: false,
            lastUser: null
        }),
        validations: {
            form: {
                url: {
                    required,
                    maxLength: maxLength(2083),
                },
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
                this.form.id_client = null;
                this.form.id_campaign = null;
                this.form.password = null;
                this.form.signature = null;
                this.form.sig = null;
                this.form.url = null;
                this.form.sig = null;
                this.form.trigger = null;
            },
            savePixel () {
                this.sending = true;
                this.$store.dispatch('addCompony', this.form);
                this.lastUser = `${this.form.url}`;

                setTimeout(() => {
                    this.userSaved = true;
                    this.sending = false;
                    this.clearForm()
                }, 1000)
            },
            validateUser () {
                this.$v.$touch();

                if (!this.$v.$invalid) {
                    this.savePixel()
                }
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

    .text-right {
        text-align: right;
    }
</style>
