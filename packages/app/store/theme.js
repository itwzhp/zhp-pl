export const state = () => ({
  options: {}
})
export const actions = {
  update ({ commit }, options) {
    commit('update', options)
  }
}
export const mutations = {
  update (state, options) {
    state.options = options
  }
}
export const getters = {
  hasMourning (state) {
    return state.options.mourning
  }
}
