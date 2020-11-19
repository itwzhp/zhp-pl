export const state = () => ({
  posts: {}
})
export const mutations = {
  update (state, post) {
    state.posts = { ...state.posts, [post.name]: post.post }
  }
}
export const getters = {
  posts (state) {
    return state.posts
  }
}
