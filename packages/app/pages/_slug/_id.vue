<template>
  <div>
    <ZWordPress :html="page.content.rendered" />
  </div>
</template>

<script>
import ZWordPress from '@/components/organisms/ZWordPress'

export default {
  components: {
    ZWordPress
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
