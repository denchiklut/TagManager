<template>
    <div>

        <form novalidate class="md-layout" @submit.prevent="validateUser">
            <md-card class="md-layout-item md-small-size-100" md-with-hover>
                <md-toolbar class="md-primary">
                    <div class="md-title">Добавить Pixel</div>
                </md-toolbar>

                <md-card-content>
                    <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('id_client')">
                                <label for="id_client">id_client</label>
                                <md-input type="number" id="id_client" name="age" autocomplete="age" v-model="form.id_client" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.id_client.required">The age is required</span>
                                <span class="md-error" v-else-if="!$v.form.id_client.maxlength">Invalid age</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('id_campaign')">
                                <label for="id_campaign">id_campaign</label>
                                <md-input type="number" id="id_campaign" name="id_campaign" autocomplete="id_campaign" v-model="form.id_campaign" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.id_campaign.required">The age is required</span>
                                <span class="md-error" v-else-if="!$v.form.id_campaign.maxlength">Invalid age</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('password')">
                                <label for="password">password Name</label>
                                <md-input type="password" name="password" id="password" autocomplete="password" v-model="form.password" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.password.required">The password is required</span>
                                <span class="md-error" v-else-if="!$v.form.password.minlength">Invalid password</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('signature')">
                                <label for="signature">signature</label>
                                <md-input name="signature" id="signature" autocomplete="signature" v-model="form.signature" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.signature.required">The password is required</span>
                                <span class="md-error" v-else-if="!$v.form.signature.minlength">Invalid password</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('sig')">
                                <label for="sig">sig</label>
                                <md-input name="sig" id="sig" autocomplete="sig" v-model="form.sig" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.sig.required">The sig is required</span>
                                <span class="md-error" v-else-if="!$v.form.sig.minlength">Invalid sig</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('url')">
                                <label for="url">url</label>
                                <md-input name="url" id="url" autocomplete="url" v-model="form.url" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.url.required">The url is required</span>
                                <span class="md-error" v-else-if="!$v.form.url.minlength">Invalid url</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item md-small-size-100">
                            <md-field :class="getValidationClass('tm_id')">
                                <label for="tm_id">tm_id</label>
                                <md-input type="number" id="tm_id" name="age" autocomplete="age" v-model="form.tm_id" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.tm_id.required">The tm_id is required</span>
                                <span class="md-error" v-else-if="!$v.form.tm_id.maxlength">Invalid tm_id</span>
                            </md-field>
                        </div>

                    </div>


                </md-card-content>

                <md-progress-bar md-mode="indeterminate" v-if="sending" />

                <md-card-actions>
                    <md-button type="submit" class="md-primary" :disabled="sending">Добавить</md-button>
                </md-card-actions>
            </md-card>

            <md-snackbar :md-active.sync="userSaved">Pixel {{ lastUser }} был добавлен успешно!</md-snackbar>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';
    import { validationMixin } from 'vuelidate'
    import {
        required,
        minLength,

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
                tm_id: null,
            },
            userSaved: false,
            sending: false,
            lastUser: null
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
                    required
                },
                tm_id: {
                    required
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
                this.form.tm_id = null;
            },
            savePixel () {
                this.sending = true;

                // Instead of this timeout, here you can call your API
                window.setTimeout(() => {
                    this.lastUser = `${this.form.signature} ${this.form.password}`;
                    this.userSaved = true;
                    this.sending = false;
                    this.clearForm()
                }, 1500)
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

</style>