<template>
    <div>
        <form novalidate class="md-layout" @submit.prevent="validateUser">
            <md-card class="md-layout-item md-size-50 md-small-size-100 myForm" md-with-hover>
                <md-toolbar class="md-accent">
                    <h3 class="md-title">Войти</h3>
                </md-toolbar>

                <md-card-content>

                    <md-field :class="getValidationClass('email')">
                        <label for="email">Email</label>
                        <md-input type="email" name="email" id="email" autocomplete="email" v-model="form.email" />
                        <span class="md-error" v-if="!$v.form.email.required">The email is required</span>
                        <span class="md-error" v-else-if="!$v.form.email.email">Invalid email</span>
                    </md-field>

                    <md-field :class="getValidationClass('password')">
                        <label for="password">password</label>
                        <md-input type="password" name="password" id="password" autocomplete="password" v-model="form.password" />
                        <span class="md-error" v-if="authError">{{authError}}</span>
                        <span class="md-error" v-else-if="!$v.form.email.required">The email is required</span>
                        <span class="md-error" v-else-if="!$v.form.password.email">Invalid email</span>
                    </md-field>
                    <span class="md-error" v-if="authError">{{authError}}</span>
                </md-card-content>

                <md-card-actions>
                    <md-button type="submit" class="md-accent">login</md-button>
                </md-card-actions>
            </md-card>

        </form>
    </div>
</template>

<script>
    import {login} from "../helpers/auth";
    import { validationMixin } from 'vuelidate'
    import {
        required,
        email,
        minLength,
        maxLength
    } from 'vuelidate/lib/validators'

    export default {
        name: "login",
        mixins: [validationMixin],
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                },
                error: null,
                userSaved: false,
            }
        },
        validations: {
            form: {
                password: {
                    required,
                    minLength: minLength(6)
                },
                email: {
                    required,
                    email
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
                this.form.password = null;
                this.form.email = null;
            },
            saveUser () {
                this.authanticate();

                window.setTimeout(() => {
                    this.clearForm();
                }, 1500)
            },
            validateUser () {
                this.$v.$touch();

                if (!this.$v.$invalid) {
                    this.saveUser()
                }
            },
            authanticate() {
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/'})
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    })
            },
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>

<style lang="scss"  scoped>
    .md-card-content, .md-card-actions {
        background: antiquewhite;
    }
    .myForm {
        margin: 60px auto;
    }

</style>
