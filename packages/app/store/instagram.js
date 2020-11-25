export const state = () => ({
  posts: []
})
export const mutations = {
  update (state, posts) {
    state.posts = posts
  }
}
export const getters = {
  posts (state) {
    return state.posts
  }
}
