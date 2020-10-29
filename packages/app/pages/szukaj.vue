<template>
  <div id="search">
    <ZSection>
      <ZText style="grid-column: span 12;">
        {{ searches }}
      </ZText>
    </ZSection>
  </div>
</template>

<script>
import {
  ZSection,
  ZText
} from '@nowa-zhp/ui'

export default {
  components: {
    ZSection,
    ZText
  },
  async asyncData ({ $axios, params, query }) {
    const searchesRes = await $axios.get('search', { params: { ...query } })
    const searches = searchesRes.data
    return { searches }
  }
}
</script>

<style lang="scss">
#search {
  overflow: hidden;
}
</style>
