export const state = () => ({
  text: {}
})
export const mutations = {
  update (state, text) {
    state.text = text
  }
}
export const getters = {
  text (state) {
    return state.text
  }
}
