import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import createPersistedState from "vuex-persistedstate";
import { stringify } from 'postcss';

Vue.use(Vuex)

let apiUrl = 'http://127.0.0.1:8000/api/';
axios.defaults.baseURL = apiUrl;

function updateLocalStorage(cart){
    localStorage.setItem('cart', JSON.stringify(cart));
}

export default new Vuex.Store({
    state: {
        user: null,
        token: null,
        outletData: null,
        cart: []
    },

    mutations: {
        setUserData(state, userData) {
            state.user = userData.user
            state.token = userData.token
            localStorage.setItem('user', JSON.stringify(userData.user))
        },
        updateUserData(state, userUpdatedData) {
            state.user = userUpdatedData.data.user
            localStorage.setItem('user', JSON.stringify(userUpdatedData.data.user))
        },
        clearUserData(state) {
            localStorage.removeItem('user')
            state.user = null
            state.token = null
            location.reload()
        },
        addToCart(state, product) {
            let item = state.cart.find(i => i.id === product.id)
            if(item){
                item.quantity++
            }else{
                state.cart.push({...product, quantity: 1})
            }

            updateLocalStorage(state.cart)
        }

    },

    actions: {
        login({
            commit
        }, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post('/login', credentials)
                    .then(({
                        data
                    }) => {
                        if (data.status == true) {
                            commit('setUserData', data)
                        }
                        resolve(data)
                    }).catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },

        register({
            commit
        }, registerData) {
            return new Promise((resolve, reject) => {
                axios
                    .post('/register', registerData)
                    .then(async resp => {
                        resolve(resp.data)
                    }).catch(error => {
                        reject(error)
                    })
            })
        },

        updateProfile({
            commit
        }, profileData) {
            return new Promise((resolve, reject) => {
                axios
                    .post('/update-profile', profileData , {
                        headers: {
                            'Authorization': `Bearer ${this.state.token}`
                        }
                    })
                    .then(async resp => {
                        commit('updateUserData', resp)
                        resolve(resp.data)
                    }).catch(error => {
                        reject(error)
                    })
            })
        },
        updatePassword({
            commit
        }, passwordData) {
            return new Promise((resolve, reject) => {
                axios
                    .post('/update-password', passwordData , {
                        headers: {
                            'Authorization': `Bearer ${this.state.token}`
                        }
                    })
                    .then(async resp => {
                        resolve(resp.data)
                    }).catch(error => {
                        reject(error)
                    })
            })
        },

        logout({
            commit
        }) {
            commit('clearUserData')
        },

        getmenu({
            commit
        }, outletID) {
            return new Promise((resolve, reject) => {
                axios
                    .post('/restaurant-menu', outletID , {
                        headers: {
                            'Authorization': `Bearer ${this.state.token}`
                        }
                    })
                    .then(async resp => {
                        resolve(resp.data)
                    }).catch(error => {
                        reject(error)
                    })
            })
        }
    },

    getters: {

        isLogged: state => !!state.user,

        productQuantity: state => product => {
            const item = state.cart.find(i => i.id === product.id)
            if(item) return item.quantity
            else return null
        }
    },

    plugins: [createPersistedState({
        key: 'vuex',
        reducer(val) {
            if (!val.user) {
                return {}
            } else {
                return val
            }
        }
    })]
})
