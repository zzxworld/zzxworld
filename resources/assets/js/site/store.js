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
    loadList () {
        axios.get('/admin/sites').then((response) => {
            this.commit('setSites', response.data.sites)
        })
    }
}

export default new Vuex.Store({
    state, mutations, actions
})
