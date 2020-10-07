export const state = () => ({
  headerMenu: [],
  footerMenu: []
})
export const mutations = {
  update (state, menu) {
    state[menu.location] = [...menu.items]
  }
}
export const getters = {
  headerMenu (state) {
    return state.headerMenu
  },
  footerMenu (state) {
    return state.footerMenu
  }
}
