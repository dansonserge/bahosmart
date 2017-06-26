import Vue from 'vue'

import Vuex from 'Vuex';


import userStore from './components/stores/userStore'

import quizStore from './components/stores/quizStore'

import initDataStore from './components/stores/initDataStore'

import chatStore from './components/stores/chatStore'

Vue.use(Vuex)

const debug=process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules:{userStore,quizStore,initDataStore},
    strict:debug
})




