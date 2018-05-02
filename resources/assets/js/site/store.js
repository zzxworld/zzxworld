import Vue from 'vue'
import Vuex from 'vuex';

Vue.use(Vuex)

const state = {
    sites: [],
}

const mutations = {
    setSites (state, sites) {
        state.sites = sites;
    },
}

const actions = {

}

export default new Vuex.Store({
    state, mutations, actions
})
