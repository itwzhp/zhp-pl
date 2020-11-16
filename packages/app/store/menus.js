export const state = () => ({})
export const mutations = {
  update (state, menu) {
    const itemsAsObject = menu.items.reduce((object, item) => ({ ...object, [item.ID]: item }), {})
    const items = menu.items
    const links = items.reduce((array, item) => {
      const parent = item.menu_item_parent
      if (parent === '0') {
        itemsAsObject[item.ID].index = array.length
        return [...array, { to: item.url, name: item.title }]
      } else if (itemsAsObject[parent].index) {
        const copyOfItem = { to: item.url, name: item.title }
        itemsAsObject[item.ID].root_index = itemsAsObject[parent].index
        array[itemsAsObject[parent].index].submenu = copyOfItem
      } else if (itemsAsObject[parent].root_index) {
        const copyOfItem = { to: item.url, name: item.title }
        array[itemsAsObject[parent].root_index].submenu.mega_menu = array[itemsAsObject[parent].root_index].submenu.mega_menu
          ? [...array[itemsAsObject[parent].root_index].submenu.mega_menu, copyOfItem]
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
