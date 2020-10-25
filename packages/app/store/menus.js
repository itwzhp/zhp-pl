export const state = () => ({})
export const mutations = {
  update (state, menu) {
    const items = menu.items
      .sort((a, b) => (a.menu_order < b.menu_order ? -1 : 1))
    const flat = items.reduce((accumulator, item) => ({ ...accumulator, [item.ID]: item }), {})
    const reducer = (accumulator, item) => {
      if (item.menu_item_parent !== '0') {
        if (flat[item.menu_item_parent].menu_item_parent === '0') {
          accumulator[item.menu_item_parent]
            .submenu[item.ID] = {
              name: item.title,
              menu: {}
            }
        } else {
          accumulator[flat[item.menu_item_parent].menu_item_parent]
            .submenu[item.menu_item_parent]
            .menu[item.ID] = {
              id: item.ID,
              name: item.title,
              to: item.url
            }
        }
        return accumulator
      }
      return {
        ...accumulator,
        [item.ID]: {
          id: item.ID,
          name: item.title,
          to: item.url,
          submenu: {}
        }
      }
    }

    state[menu.location] = items.reduce(reducer, {})
  }
}
export const getters = {
  menu: state => (menu) => {
    return state[menu]
  }
}
