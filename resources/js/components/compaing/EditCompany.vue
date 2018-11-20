<template>
    <div>

        <form novalidate class="md-layout" @submit.prevent="validateUser">
            <md-card class="md-layout-item md-small-size-100" md-with-hover>
                <md-toolbar class="md-primary" md-theme="myTheme" md-aligment="space-between">
                    <div class="md-title">Редактировать Pixel</div>
                </md-toolbar>
                <md-card-content>
                    <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('id_client')" md-theme="myTheme">
                                <label for="id_client">id_client</label>
                                <md-input type="number" id="id_client" name="id_client" autocomplete="id_client" v-model="form.id_client" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.id_client.required">The age is required</span>
                                <span class="md-error" v-else-if="!$v.form.id_client.maxlength">Invalid age</span>
                            </md-field>
                        </div>

                        <!--<div class="md-layout-item md-small-size-100">-->
                            <!--<md-field :class="getValidationClass('id_campaign')" md-theme="myTheme">-->
                                <!--<label for="id_campaign">id_campaign</label>-->
                                <!--<md-input type="number" id="id_campaign" name="id_campaign" autocomplete="id_campaign" v-model="form.id_campaign" :disabled="sending" />-->
                                <!--<span class="md-error" v-if="!$v.form.id_campaign.required">The age is required</span>-->
                                <!--<span class="md-error" v-else-if="!$v.form.id_campaign.maxlength">Invalid age</span>-->
                            <!--</md-field>-->
                        <!--</div>-->

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('password')" md-theme="myTheme">
                                <label for="password">password Name</label>
                                <md-input type="password" name="password" id="password" autocomplete="password" v-model="form.password" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.password.required">The password is required</span>
                                <span class="md-error" v-else-if="!$v.form.password.minlength">Invalid password</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('signature')" md-theme="myTheme">
                                <label for="signature">signature</label>
                                <md-input name="signature" id="signature" autocomplete="signature" v-model="form.signature" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.signature.required">The password is required</span>
                                <span class="md-error" v-else-if="!$v.form.signature.minlength">Invalid password</span>
                            </md-field>
                        </div>

                        <!--<div class="md-layout-item md-small-size-100">-->
                            <!--<md-field :class="getValidationClass('sig')" md-theme="myTheme">-->
                                <!--<label for="sig">sig</label>-->
                                <!--<md-input name="sig" id="sig" autocomplete="sig" v-model="form.sig" :disabled="sending" />-->
                                <!--<span class="md-error" v-if="!$v.form.sig.required">The sig is required</span>-->
                                <!--<span class="md-error" v-else-if="!$v.form.sig.minlength">Invalid sig</span>-->
                            <!--</md-field>-->
                        <!--</div>-->

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('url')" md-theme="myTheme">
                                <label for="urlM">url_pixel</label>
                                <md-input name="url" id="urlM" autocomplete="url" v-model="form.url" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.url.required">The url is required</span>
                                <span class="md-error" v-else-if="!$v.form.url.minlength">Invalid url</span>
                            </md-field>
                        </div>

                        <!--<div class="md-layout-item md-small-size-100">-->
                            <!--<md-field :class="getValidationClass('tm_id')" md-theme="myTheme">-->
                                <!--<label for="tm_id">tm_id</label>-->
                                <!--<md-input type="number" id="tm_id" name="trigger" autocomplete="trigger" v-model="form.trigger" :disabled="sending" />-->
                                <!--<span class="md-error" v-if="!$v.form.trigger.required">The trigger is required</span>-->
                                <!--<span class="md-error" v-else-if="!$v.form.trigger.maxlength">Invalid trigger</span>-->
                            <!--</md-field>-->
                        <!--</div>-->
                    </div>
                </md-card-content>
                <md-progress-bar md-mode="indeterminate" v-if="sending" />

                <md-card-actions>
                    <md-button class="md-primary" md-theme="myTheme" @click="close">Отмена</md-button>
                    <md-button type="submit" class="md-primary" md-theme="myTheme" :disabled="sending">Сохранить</md-button>
                </md-card-actions>
            </md-card>
        </form>
        <md-snackbar :md-active.sync="userSaved">Pixel {{`${this.lastUser}`}} был изменен успешно!</md-snackbar>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {
        required,
        minLength,

    } from 'vuelidate/lib/validators'

    export default {
        props:['form'],
        name: 'FormValidation',
        mixins: [validationMixin],
        data: () => ({
            sending: false,
            lastUser: null,
            userSaved: false,
        }),
        validations: {
            form: {
                id_client: {
                    required,
                },
                id_campaign: {
                    required,
                },
                password: {
                    required,
                    minLength: minLength(6)
                },
                signature: {
                    required
                },
                sig: {
                    required
                },
                url: {
                    required,
                },
                // trigger: {
                //     required
                // },
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

            updatePixel () {
                this.sending = true;
                this.userSaved = true;
                this.lastUser = `${this.form.url}`;
                this.$store.dispatch('editCompony', this.form);

                window.setTimeout(() => {
                    this.userSaved = false;
                    this.sending = false;
                    this.close();
                }, 1500)
            },

            validateUser () {
                this.$v.$touch();

                if (!this.$v.$invalid) {
                    this.updatePixel()
                }
            },

            close() {
                this.$emit('CloseDialog')
            },
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
