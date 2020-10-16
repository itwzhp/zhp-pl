export const state = () => ({})
export const mutations = {
  update (state, taxonomy) {
    state[taxonomy.name] = taxonomy.items.reduce((accumulator, item) => ({ ...accumulator, [item.id]: item }), {})
  }
}
export const getters = {
  taxonomy: state => (taxonomy) => {
    return state[taxonomy]
  }
}
