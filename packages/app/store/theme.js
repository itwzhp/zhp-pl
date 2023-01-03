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
  favicon (state) {
    return state.options.favicon;
  },
  logo (state) {
    return state.options.logo
  },
  headerLogos(state){
    return state.options.header_logos
  },
  hasHeaderLogos(state){
    return Object.entries(state.options.header_logos).map((item)=>item[1]).filter((val)=>val !== '').length>0
  },
  placeholder (state) {
    return state.options.placeholder
  },
  addEventEnable (state) {
    return state.options.add_event
  },
  colors(state){
    return state.options.colors;
  },
  customCss (state) {
    return state.options.custom_css
  }
}
