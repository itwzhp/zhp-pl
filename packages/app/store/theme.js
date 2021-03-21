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
  },
  domains (state) {
    return state.options.domains.replace(/ /gm, '').split(',')
  },
  title (state) {
    return state.options.title
  },
  logo (state) {
    return state.options.logo
  },
  placeholder (state) {
    return state.options.placeholder
  }
}
