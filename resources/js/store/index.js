import { createStore } from "vuex";
import axios from "../plugins/axios";
import createPersistedState from "vuex-persistedstate";

export default createStore({
    strict: true,
    state: {
        cart: [],
        product: [],
        user: null,
        drawer: false,
        userId: "",
        snackbar: {
            check: false,
            text: "test"
        },
        transaction: [],
        authId: "",
    },

   getters: {
        total: (state) => {
            if (typeof state.cart === "object" && state.cart.length > 0) {
                return state.cart
                    .map((item) => item.quantity)
                    .reduce((total, quantity) => total + quantity);
            } else {
                return 0;
            }
        },
        totalPrice: (state) => {
           if (typeof state.cart === "object" && state.cart.length > 0) {
               return (state.cart
                   .map((item) => item.price * item.quantity)
                   .reduce((total, price) => total + price)).toFixed(2);
           } else {
               return 0;
           }
        },
       auth: (state) => {
           return !!state.user;
       },
   },

   mutations: {
        setProducts(state, payload) {
            state.product = payload;
        },
       setTransaction(state, payload) {
           state.transaction = payload;
       },
        setCart(state, payload) {
            state.cart = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        setDrawer(state) {
            state.drawer = !state.drawer;
        },
        setUserId(state) {
            state.userId = new Date().getTime().toString();
        },
        setSnackbar(state, payload) {
            state.snackbar = payload;
        },
        setAuthId(state, payload) {
            state.authId = payload;
        }
    },
    actions: {
        getProducts({ commit, state }, page) {
            return axios.get('/products?page=' + page).then(({data}) => {
               commit('setProducts', data.data);

               return data.data
           });
        },
        async createAuth({ commit, state }, data) {
            await axios.get("/sanctum/csrf-cookie");

            return axios.post('/sanctum/token',data).then(({data}) => {
                commit('setAuthId', data.token);

                return data.token;
            });
        },
        userMe({ commit, state }) {
            return axios.get('/user?token=' + state.authId, {
                headers: {
                    "Authorization" : state.authId,
                    "auth-token" : state.authId,
                }
            }).then(({data}) => {
                commit('setUser', data);

                return data
            });
        },
        addToBasket({commit, state}, data) {
            return axios.post('/basket', {
                productId: data.productId,
                userId: state.userId,
                quantity: data.quantity
            }).then((payload) => {
                commit('setCart', payload.data.data);

                commit('setSnackbar', {
                    check: true,
                    text: data.name + " Added"
                })

                setTimeout(() => {
                    commit('setSnackbar', {
                        check: false,
                        text: ""
                    })
                }, 3000)
            }).catch((err) => {
                commit('setSnackbar', {
                    check: true,
                    text: err.response?.data?.message || err.message
                })

                setTimeout(() => {
                    commit('setSnackbar', {
                        check: false,
                        text: err.response?.data?.message || err.message
                    })
                }, 3000)
            })
        },
        clearBasket({ commit, state }) {
            return axios.post('/basket/' + state.userId, {
                _method: "delete"
            }).then(()=> {
                commit('setCart', []);
                commit('setSnackbar', {
                    check: true,
                    text: "Cache Cleared"
                })

                setTimeout(() => {
                    commit('setSnackbar', {
                        check: false,
                        text: ""
                    })
                }, 3000)
            })
        },
        createOrder({commit, state}, data) {
            return axios.post('/transaction', {
                ...data,
                userId: state.userId
            })
                .then((payload) => {
                commit('setCart', []);
            }).catch((err) => {
                commit('setSnackbar', {
                    check: true,
                    text: err.response?.data?.message || err.message
                })

                setTimeout(() => {
                    commit('setSnackbar', {
                        check: false,
                        text: err.response?.data?.message || err.message
                    })
                }, 3000)
            })
        },
        transactionList({commit}) {
            return axios.get('/transaction').then(({data}) => {
                commit('setTransaction', data);

                return data
            });
        },
        updateTransaction({commit}, id) {
            return axios.put('/products/' + id)
                .then(({data}) => {
                    commit('setTransaction', data);

                    return data;
                }).catch((err) => {
                    commit('setSnackbar', {
                        check: true,
                        text: err.response?.data?.message || err.message
                    })

                    setTimeout(() => {
                        commit('setSnackbar', {
                            check: false,
                            text: err.response?.data?.message || err.message
                        })
                    }, 3000)
                })
        },
    },
    plugins: [createPersistedState()],
});
