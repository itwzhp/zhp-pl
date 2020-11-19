<template>
  <div
    id="page"
    class="page page--full"
    :class="{'page--full': isFull}"
  >
    <template v-for="(carousel, key) in topCarousels">
      <ZSection
        :key="key"
        :title="carousel.title"
        class="carousel"
      >
        <ZCarousel
          :peeked="true"
          :settings="{
            type: 'carousel',
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
          class="carousel__slider"
        >
          <template v-for="post in carousel.posts">
            <li
              :key="post.id"
              class="glide__slide"
            >
              <template v-if="post.type === 'post'">
                <ZPost
                  :key="post.id"
                  :thumbnail="post.rest_media"
                  :title="post.title.rendered"
                  :to="`/aktualnosci/${post.slug}`"
                  :author="post.rest_author"
                  :sticky="post.sticky"
                  :date="post.date"
                />
              </template>
              <template v-if="post.type === 'logo'">
                <ZImage :src="post.rest_media" />
              </template>
            </li>
          </template>
        </ZCarousel>
      </ZSection>
    </template>
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
    <template v-for="(carousel, key) in bottomCarousels">
      <ZSection
        :key="key"
        :title="carousel.title"
        class="carousel"
      >
        <ZCarousel
          :peeked="true"
          :settings="{
            type: 'carousel',
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
          class="carousel__slider"
        >
          <template v-for="post in carousel.posts">
            <li
              :key="post.id"
              class="glide__slide"
            >
              <template v-if="post.type === 'post'">
                <ZPost
                  :key="post.id"
                  :thumbnail="post.rest_media"
                  :title="post.title.rendered"
                  :to="`/aktualnosci/${post.slug}`"
                  :author="post.rest_author"
                  :sticky="post.sticky"
                  :date="post.date"
                />
              </template>
              <template v-if="post.type === 'logo'">
                <ZImage :src="post.rest_media" />
              </template>
            </li>
          </template>
        </ZCarousel>
      </ZSection>
    </template>
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
  ZLink,
  ZImage
} from '@nowa-zhp/ui'

export default {
  components: {
    ZSection,
    ZHeading,
    ZCarousel,
    ZPost,
    ZWordPress,
    ZList,
    ZLink,
    ZImage
  },
  async asyncData ({ $axios, params, redirect, route }) {
    const asyncCarousel = async (carousel) => {
      const { post_type, taxonomy, id, per_page } = carousel
      const postsRes = await $axios(post_type, { params: { per_page, [taxonomy]: id } })
      return {
        posts: postsRes.data,
        title: carousel.title,
        location: carousel.location
      }
    }
    const pageRest = await $axios.get('pages', { params })
    const page = pageRest.data.filter(page => page.parent === 0).shift()

    const childrenRes = await $axios.get('pages', { params: { parent: page.id } })
    const children = childrenRes.data.sort((a, b) => (a.menu_order < b.menu_order ? -1 : 1))
    if (children.length && !params.id) {
      redirect(`${route.path}/${children[0].slug}`)
    }

    const carousels = page.rest_acf && page.rest_acf.carousels
      ? await Promise.all(page.rest_acf.carousels
        .reduce((array, carousel) => ([...array, carousel.carousel]), [])
        .map(carousel => (asyncCarousel(carousel))))
      : []
    return {
      page,
      params,
      carousels,
      children: children.reduce((accumulator, child) => ({
        ...accumulator,
        [child.slug]: child
      }), {})
    }
  },
  computed: {
    isFull () {
      return /page-full/gi.test(this.page.template)
    },
    hasChildren () {
      return Object.keys(this.children).length
    },
    topCarousels () {
      return this.carousels.filter(carosuel => carosuel.location === 'before')
    },
    bottomCarousels () {
      return this.carousels.filter(carosuel => carosuel.location === 'after')
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

      .page--full & {
        grid-column: span 12;
      }
    }
  }

  .sidebar {
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 4;
      grid-row: 3 / span 3;
    }
  }

  .carousel {
    --section-margin: 1.75rem 0;

    &__slider {
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
