export const state = () => ({})
export const mutations = {
  update (state, menu) {
    const itemsAsObject = menu.items.reduce((object, item) => ({ ...object, [item.ID]: item }), {})
    const items = menu.items
    const links = items.reduce((array, item) => {
      const parent = item.menu_item_parent
      if (parent === '0') {
        itemsAsObject[item.ID].index = array.length
        return [...array, { to: item.url, name: item.title, id: item.ID }]
      } else if (itemsAsObject[parent].index) {
        const copyOfItem = { name: item.title, id: item.ID }
        array[itemsAsObject[parent].index].submenu = array[itemsAsObject[parent].index].submenu
          ? [...array[itemsAsObject[parent].index].submenu, copyOfItem]
          : [copyOfItem]
        itemsAsObject[item.ID].root_index = itemsAsObject[parent].index
        itemsAsObject[item.ID].submenu_index = array[itemsAsObject[parent].index].submenu.length - 1
      } else if (itemsAsObject[parent].root_index) {
        const { root_index, submenu_index } = itemsAsObject[parent]
        const copyOfItem = { to: item.url, name: item.title, id: item.ID }
        array[root_index].submenu[submenu_index].mega_menu = array[root_index].submenu[submenu_index].mega_menu
          ? [...array[root_index].submenu[submenu_index].mega_menu, copyOfItem]
          : [copyOfItem]
      }
      return array
    }, [])
    state[menu.location] = links
  }
}
export const getters = {
  menu: state => (menu) => {
    return state[menu]
  }
}
