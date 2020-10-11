<template>
  <div id="page">
    <ZSection class="section">
      <ZHeading
        :level="1"
        class="title t3"
      >
        {{ page.title.rendered }}
      </ZHeading>
      <ZWordPress
        class="content"
        :html="page.content && page.content.rendered"
      />
    </ZSection>
  </div>
</template>

<script>
import {
  ZWordPress,
  ZHeading,
  ZSection
} from '@nowa-zhp/ui'

export default {
  name: 'Page',
  components: {
    ZWordPress,
    ZHeading,
    ZSection
  },
  async asyncData ({ $axios, params, query }) {
    const pageRest = await $axios.get('pages', { params })
    const page = pageRest.data[0]
    return { page }
  }
}
</script>

<style lang="scss">
#page {
  overflow: hidden;

  .title,
  .content {
    grid-column: span 12;
  }

  .section {
    @media (min-width: 480px) {
      --section-margin: 3rem 0;
    }
  }
}
</style>
