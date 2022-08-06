import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        authenticated: false,
        user: null,
        settings: null,
    },
    getters: {
        authenticated: state => {
            return state.authenticated;
        },
        user: state => {
            return state.user;
        },
        settings: state => {
            return state.settings;
        }
    },
    mutations: {
        setAuthenticated: (state, payload) => {
            state.authenticated = payload;
        },
        setUser: (state, payload) => {
            state.user = payload;
        },
        setSettings: (state, payload) => {
            state.settings = payload;
        }
    },
    actions: {
        async login({ dispatch }, payload) {
            try {
                axios.get('/sanctum/csrf-cookie');

                const response = await axios.post('/api/login', payload);

                if (response.data.status_code != 200) {
                    throw response.data.message;
                }
                return this.dispatch('getUser');

            } catch (error) {
                throw error;
            }
        },
        async getUser({ commit }) {

            await axios.get('/api/user')
                .then(response => {

                    commit('setUser', response.data);
                    commit('setAuthenticated', true);
                    return this.dispatch('getSettings');
                })
                .catch(error => {
                    commit('setUser', null);
                    commit('setAuthenticated', false);
                    commit('setSettings', null);
                })
        },
        async getSettings({ commit }) {

            await axios.get('/api/business')
                .then(response => {
                    commit('setSettings', response.data.data[0]);
                })
                .catch(error => console.log(error));
        },
        async logout({ commit }) {
            await axios.post('/api/logout')
                .then(response => {
                    commit('setUser', null);
                    commit('setAuthenticated', false);

                })
                .catch(error => {
                    commit('setUser', null);
                    commit('setAuthenticated', false);
                })
        }
    }
});


export default store;