import {getLocalUser} from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        testStoore: 'Store works',
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        analiticData: [],
        companies: [],
    },
    getters: {
        test(state) {
            return state.testStoore;
        },
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        analiticData(state) {
            return state.analiticData;
        },
        companies(state) {
            return state.companies;
        },
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        updateAnaliticData(state, payload) {
            state.analiticData =  payload;
        },
        updateCompanies(state, payload) {
            state.companies =  payload;
        },
        deleteCompony(state, payload) {
            let index = state.companies.indexOf(payload);
            state.companies.splice(index, 1);
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getAnaliticData: context => {
                axios
                    .get('/api')
                    .then((responce) => {
                        context.commit('updateAnaliticData', responce.data.data);
                    })
        },
        getCompanies: context => {
            axios
                .get('/api/companies')
                .then((responce) => {
                    context.commit('updateCompanies', responce.data.data);
                })
        },
        addCompony: (context, form) => {
            axios.post('/api/companies', form)
                .then(response => {
                    context.dispatch('getCompanies');
                });
        },
        deleteCompony: (context, item) => {
            axios.delete('/api/companies/' + item.id)
                .then(response => {
                    context.commit('deleteCompony', item);
                });
        },
    },
}
