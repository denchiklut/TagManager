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
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getAnaliticData(context) {
                axios
                    .get('/api', {
                        headers: {
                            "Authorization": `Bearer ${context.state.currentUser.token}`
                        }
                    })
                    .then((responce) => {
                        context.commit('updateAnaliticData', responce.data.data);
                    })
        }
    },
}
