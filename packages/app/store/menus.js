export const state = () => ({})
export const mutations = {
  update (state, menu) {
    const itemsAsObject = menu.items.reduce((object, item) => ({ ...object, [item.ID]: item }), {})
    const { items } = menu
    const links = items.reduce((array, item) => {
      const { menu_item_parent: parent } = item
      if (parent === '0') {
        itemsAsObject[item.ID].index = array.length
        return [...array, { to: item.url, name: item.title, id: item.ID, isClassic: item.classes.includes('classic') }]
      } else if (itemsAsObject[parent].index !== undefined) {
        const copyOfItem = { name: item.title, id: item.ID, to: item.urlc }
        array[itemsAsObject[parent].index].submenu = array[itemsAsObject[parent].index].submenu
          ? [...array[itemsAsObject[parent].index].submenu, copyOfItem]
          : [copyOfItem]
        itemsAsObject[item.ID].root_index = itemsAsObject[parent].index
        itemsAsObject[item.ID].submenu_index = array[itemsAsObject[parent].index].submenu.length - 1
      } else if (itemsAsObject[parent].root_index !== undefined) {
        const { root_index: rootIndex, submenu_index: submenuIndex } = itemsAsObject[parent]
        const copyOfItem = { to: item.url, name: item.title, id: item.ID }
        array[rootIndex].submenu[submenuIndex].mega_menu = array[rootIndex].submenu[submenuIndex].mega_menu
          ? [...array[rootIndex].submenu[submenuIndex].mega_menu, copyOfItem]
          : [copyOfItem]
      }
      return array
    }, [])
    state[menu.location] = { links, name: menu.name }
  }
}
export const getters = {
  menu: state => (menu) => {
    return state[menu].links
  },
  menuName: state => (menu) => {
    return state[menu].name
  }
}
