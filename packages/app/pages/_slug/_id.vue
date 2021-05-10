<template>
  <div>
    <ZWordPressContent :html="page.content.rendered" />
  </div>
</template>

<script>
import ZWordPressContent from '@/components/organisms/ZWordPressContent'

export default {
  components: {
    ZWordPressContent
  },
  props: {
    children: {
      type: Object,
      default: () => ({})
    }
  },
  asyncData ({ params }) {
    return { id: params.id }
  },
  computed: {
    page () {
      return this.children[this.id]
    }
  }
}
</script>
