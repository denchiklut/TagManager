<template>
    <form action="" @submit.prevent="authanticate">
        <label for="email">email</label>
        <input type="email" v-model="form.email" id="email" placeholder="email">
        <label for="password">password</label>
        <input type="password" v-model="form.password" id="password" placeholder="password">
        <input type="submit" value="login">

        <p v-if="authError">{{authError}}</p>
    </form>
</template>

<script>
    import {login} from "../helpers/auth";

    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                },
                error: null,
            }
        },
        methods: {
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

<style scoped>

</style>
