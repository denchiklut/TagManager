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
        triggers: [],
        templates: []
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
        triggers(state) {
            return state.triggers;
        },
        templates(state) {
            return state.templates;
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
        },
        // addTriggers(state, payload) {
        //     state.triggers.push(payload);
        // },
        updateTriggers(state, payload) {
            state.triggers =  payload;
        },
        deleteTriggers(state, payload) {
            let index = state.triggers.indexOf(payload);
            state.triggers.splice(index, 1);
        },
        updateTemplates(state, payload) {
            state.templates =  payload;
        },
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
                    console.log(responce.data.data)
                    responce.data.data;//= [JSON.parse('{"id":398,"id_client":"16","id_campaign":"581","password":"htnfhutn","signature":"test_581","sig":"66307c9455b0c9b37c5423951ff46c9e60cfe49b","url":"test","trigger":0,"created_at":{"date":"2018-11-22 09:14:06.000000","timezone_type":3,"timezone":"UTC"},"updated_at":{"date":"2018-11-22 09:14:06.000000","timezone_type":3,"timezone":"UTC"}}')];
                    context.commit('updateCompanies', responce.data.data);
                })
        },
        addCompony: (context, form) => {
            axios.post('/api/companies', form)
                .then(response => {
                    context.dispatch('getCompanies');
                });
        },
        editCompony: (context, form) => {
            axios.patch('/api/companies/' + form.id, form)
                .then(response => {
                    context.dispatch('getCompanies');
                });
        },
        editComponyTimplate: (context, form_timplase) => {

            console.log(form_timplase.id);
            console.log(form_timplase.text);

            axios.patch('/api/companies/' + form_timplase.id, form_timplase)
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
        getTrigger: (context, id) => {
            axios
                .get('/api/containers/' + id, id)
                .then(response => {
                    context.commit('updateTriggers', response.data.data);
                });
        },
        addTrigger: (context, form) => {
            axios.post('/api/containers', form)
                .then(response => {
                    context.dispatch('getTrigger', form.id_campaign);
                    // context.commit('addTriggers', form);
                });

        },
        editTrigger: (context, form) => {
            axios.patch('/api/containers/' + form.id, form)
                .then(response => {
                    context.dispatch('getTrigger', form.id_campaign);
                    // console.log(this.form);

                });

        },
        deleteTrigger: (context, item) => {
            axios.delete('/api/containers/' + item.id)
                .then(response => {
                    context.commit('deleteTriggers', item);
                });
        },
        getTemplates: context => {
            axios
                .get('/api/defaults')
                .then(response => {
                    context.commit('updateTemplates', response.data.data);
                });
        },

    },
}
