<template>
  <div id="page">
    <ZSection tag="div">
      <ZHeading
        :level="1"
        class="title t3"
      >
        {{ page.title.rendered }}
      </ZHeading>
      <nuxt-child
        v-if="hasChildren"
        :children="children"
        class="content"
      />
      <ZWordPress
        v-else
        :html="page.content && page.content.rendered"
        class="content"
      />
      <div class="sidebar">
        &nbsp;<div
          v-if="hasChildren"
          class="z-box"
        >
          <ZHeading
            :level="2"
            class="t4"
          >
            Przejdź do
          </ZHeading>
          <ZList>
            <template v-for="child in children">
              <li :key="child.id">
                <ZLink :to="`/${page.slug}/${child.slug}`">
                  {{ child.title.rendered }}
                </ZLink>
              </li>
            </template>
          </ZList>
        </div>
      </div>
    </ZSection>
    <ZSection class="related">
      <ZHeading class="related__title t4 uppercase">
        Aktualności silni duchem:
      </ZHeading>
      <ZCarousel
        v-if="relatedPosts.length > 0"
        :peeked="true"
        :settings="{
          breakpoints: {
            480: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="related__carousel"
      >
        <template v-for="relatedPost in relatedPosts">
          <li
            :key="relatedPost.id"
            class="glide__slide"
          >
            <ZPost
              :key="relatedPost.id"
              :thumbnail="relatedPost.rest_media"
              :title="relatedPost.title.rendered"
              :to="`/aktualnosci/${relatedPost.slug}`"
              :author="relatedPost.rest_author"
              :sticky="relatedPost.sticky"
              :date="relatedPost.date"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
  </div>
</template>

<script>
import {
  ZSection,
  ZHeading,
  ZCarousel,
  ZPost,
  ZWordPress,
  ZList,
  ZLink
} from '@nowa-zhp/ui'

export default {
  name: 'Page',
  components: {
    ZSection,
    ZHeading,
    ZCarousel,
    ZPost,
    ZWordPress,
    ZList,
    ZLink
  },
  async asyncData ({ $axios, params, redirect, route }) {
    const pageRest = await $axios.get('pages', { params })
    const page = pageRest.data.shift()
    const childrenRes = await $axios.get('pages', { params: { parent: page.id } })
    const children = childrenRes.data.sort((a, b) => (a.menu_order < b.menu_order ? -1 : 1))
    if (children.length && !params.id) {
      redirect(`${route.path}/${children[0].slug}`)
    }
    const relatedPostsRes = await $axios.get('posts', { per_page: 8 })
    const relatedPosts = relatedPostsRes.data

    return {
      page,
      params,
      relatedPosts,
      children: children.reduce((accumulator, child) => ({
        ...accumulator,
        [child.slug]: child
      }), {})
    }
  },
  computed: {
    hasChildren () {
      return Object.keys(this.children).length
    }
  }
}
</script>

<style lang="scss">
#page {
  overflow: hidden;

  .title {
    margin: 32px 0;
    grid-column: span 12;
    grid-row: 1;
  }

  .content {
    margin: 0 0 48px 0;
    grid-column: span 12;
    grid-row: 4;

    @media (min-width: 480px) {
      grid-column: span 8;
    }
  }

  .sidebar {
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 4;
      grid-row: 3 / span 3;
    }
  }

  .related {
    &__title {
      grid-column: span 12;
      place-self: center;
    }

    &__carousel {
      grid-column: span 12;
    }
  }
}

.z-box {
  padding: 1.25rem;
  background: #f7f7f7;
  border-radius: 10px;
  box-shadow: 0 10px 30px 0 rgba(209, 213, 223, 0.5);
}
</style>
