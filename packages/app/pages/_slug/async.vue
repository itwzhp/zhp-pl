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
      <nuxt-child/>
      <ZList
        v-if="childPosts.length"
        style="grid-column: span 12;"
      >
        <template v-for="childPost in childPosts">
          <li :key="childPost.id">
            <ZLink to="#">
              {{ childPost.title && childPost.title.rendered }}
            </ZLink>
          </li>
        </template>
      </ZList>
    </ZSection>
  </div>
</template>

<script>
import {
  ZWordPress,
  ZHeading,
  ZSection,
  ZList,
  ZLink
} from '@nowa-zhp/ui'

export default {
  name: 'Page',
  components: {
    ZWordPress,
    ZHeading,
    ZSection,
    ZList,
    ZLink
  },
  async asyncData ({ $axios, params, query }) {
    const pageRest = await $axios.get('pages', { params })
    const page = pageRest.data[0]
    const childPostsRest = await $axios.get('pages', { params: { parent: page.id } })
    const childPosts = childPostsRest.data
    return { page, childPosts, params, query }
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
