<script>
import Vue from 'vue'
import { ZDivider, ZButton, ZLink, ZAccordion, ZSection } from '@zhp-pl/ui'
import '@fortawesome/fontawesome-free/js/brands.min'
import '@fortawesome/fontawesome-free/js/solid.min'
import '@fortawesome/fontawesome-free/js/fontawesome.min'

Vue.component('ZDivider', ZDivider)
Vue.component('ZButton', ZButton)
Vue.component('ZLink', ZLink)
Vue.component('ZAccordion', ZAccordion)
Vue.component('ZSection', ZSection)

export default {
  name: 'ZWordPressContent',
  props: {
    html: {
      type: String,
      default: ''
    }
  },
  computed: {
    htmlToRender () {
      const anchorPattern = /<a.+?href="(.+?)">(.+?)<\/a>/gm
      return this.html.replace(anchorPattern, (match, href, name) => (`<z-link to="${href}">${name}</z-link>`))
    },
    toRender () {
      return {
        template: `<div>${this.htmlToRender}</div>`
      }
    }
  },
  render (createElement) {
    return createElement(
      'div',
      { class: 'z-wordpress' },
      [createElement(this.toRender)]
    )
  }
}
</script>
