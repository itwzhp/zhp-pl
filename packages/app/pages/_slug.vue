<template>
  <div
    id="page"
    class="page"
    :class="{'page--full': isFull}"
    :style="custom"
  >
    <template v-for="(carousel, key) in topCarousels">
      <ZSection
        :key="key"
        :title="carousel.title"
        class="carousel"
      >
        <ZCarousel
          :peeked="carousel.peeked"
          :settings="{
            perView: carousel.perView,
            autoplay: carousel.autoplay,
            gap: carousel.gap,
            type: 'carousel',
            breakpoints: {
              480: {
                perView: 1,
                gap: 20,
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
                  :to="post.rest_redirect ? post.rest_redirect :`//${post.slug}`"
                  :author="post.rest_author"
                  :sticky="post.sticky"
                  :date="post.date"
                />
              </template>
              <template v-if="post.type === 'logo'">
                <ZImage
                  :src="post.rest_media"
                />
              </template>
            </li>
          </template>
        </ZCarousel>
      </ZSection>
    </template>
    <ZSection
      tag="div"
      class="section"
    >
      <ZHeading
        :level="1"
        class="title t3"
        v-html="hasChildren ? activeChild.title.rendered : page.title.rendered"
      />
      <figure
        v-if="page._embedded['wp:featuredmedia']"
        class="thumbnail"
      >
        <ZImage
          :src="page._embedded['wp:featuredmedia'][0].media_details.sizes.full.source_url"
          class="cover"
        />
        <ZText
          v-if="page._embedded['wp:featuredmedia'][0].caption.rendered"
          tag="figcaption"
          class="caption"
          v-html="`fot. ${page._embedded['wp:featuredmedia'][0].caption.rendered}`"
        />
      </figure>
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
        <div
          v-if="hasChildren"
          class="z-box"
        >
          <ZHeading
            :level="2"
            class="t6 z-box__heading"
          >
            Przejdź do
          </ZHeading>
          <ZList>
            <template v-for="child in children">
              <ZListItem
                :key="child.id"
                class="z-box__item"
              >
                <ZLink :to="`${$route.name === 'dotacje-id' ? '/dotacje' : ''}/${page.slug}/${child.slug}`">
                  {{ child.title.rendered }}
                </ZLink>
              </ZListItem>
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
          :peeked="carousel.peeked"
          :settings="{
            perView: carousel.perView,
            autoplay: carousel.autoplay,
            gap: carousel.gap,
            type: 'carousel',
            breakpoints: {
              480: {
                perView: 1,
                gap: 20,
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
                  :to="post.rest_redirect ? post.rest_redirect :`//${post.slug}`"
                  :author="post.rest_author"
                  :sticky="post.sticky"
                  :date="post.date"
                />
              </template>
              <template v-if="post.type === 'logo'">
                <ZImage
                  :src="post.rest_media"
                />
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
  ZImage,
  ZText
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
    ZImage,
    ZText
  },
  watchQuery: true,
  async asyncData ({ $axios, params, redirect, route }) {
    const asyncCarousel = async (carousel) => {
      const { post_type, taxonomy, id, per_page } = carousel
      const postsRes = await $axios(post_type, { params: { per_page, [taxonomy]: id } })
      return {
        posts: postsRes.data,
        title: carousel.title,
        location: carousel.location,
        peeked: carousel.peeked,
        autoplay: parseInt(carousel.autoplay, 10),
        perView: parseInt(carousel.perView, 10),
        gap: parseInt(carousel.gap, 10)
      }
    }
    const pageRest = await $axios.get('pages', { params: { _embed: true, ...params } })
    if (!pageRest.data.length) {
      redirect({ name: '404' })
    }
    const page = pageRest.data.filter(page => page.parent === 0).shift()

    const childrenRes = await $axios.get('pages', { params: { parent: page.id, _embed: true, per_page: 99 } })
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
    activeChild () {
      return this.hasChildren && this.children[this.$route.params.id]
    },
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
    },
    custom () {
      return this.page.rest_acf.featuredmedia
        ? {
          '--cover-mobile-height': this.page.rest_acf.featuredmedia.mobile && `${this.page.rest_acf.featuredmedia.mobile}px`,
          '--cover-height': this.page.rest_acf.featuredmedia.desktop && `${this.page.rest_acf.featuredmedia.desktop}px`
        }
        : {}
    }
  },
  head () {
    const title = (this.hasChildren ? this.activeChild.title.rendered : this.page.title.rendered) + ' | Związek Harcerstwa Polskiego'
    const description = ''
    const image = this.page._embedded['wp:featuredmedia']
      ? this.page._embedded['wp:featuredmedia'][0].media_details.sizes.full.source_url
      : 'https://zhp.pl/wp-content/uploads/2015/01/zhp_fb.png'
    return {
      title,
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: description
        },
        // Open Graph
        {
          hid: 'og:title',
          property: 'og:title',
          content: title
        },
        {
          hid: 'og:description',
          property: 'og:description',
          content: description
        },
        {
          hid: 'og:image',
          property: 'og:image',
          content: image
        },
        // Twitter Card
        {
          hid: 'twitter:title',
          property: 'twitter:title',
          content: title
        },
        {
          hid: 'twitter:description',
          property: 'twitter:description',
          content: description
        }
      ]
    }
  }
}
</script>

<style lang="scss">
#page {
  overflow: hidden;

  .section {
    --section-margin: 25px 0;
  }

  &.page {
    &--full {
      .content,
      .thumbnail {
        @media (min-width: 480px) {
          grid-column: span 12;
        }
      }
    }
  }

  .title {
    margin: 32px 0 8px 0;
    grid-column: span 12;
    grid-row: 1;

    @media (min-width: 480px) {
      margin: 32px 0;
    }
  }

  .content {
    margin: 0 0 48px 0;
    grid-column: span 12;
    grid-row: 3;

    @media (min-width: 480px) {
      grid-column: span 8;
    }
  }

  .sidebar {
    grid-column: span 12;
    grid-row: 4;

    @media (min-width: 480px) {
      grid-column: span 4;
      grid-row: 2 / span 3;
    }
  }

  .carousel {
    --section-margin: 1.75rem 0;

    &__slider {
      grid-column: span 12;
    }
  }

  .thumbnail {
    margin: 0;
    grid-column: span 12;
    grid-row: 2;

    @media (min-width: 480px) {
      grid-column: span 8;
    }
  }

  .cover {
    display: flex;
    overflow: hidden;
    height: var(--cover-mobile-height, var(--cover-height, 198px));
    border-radius: 10px;

    @media (min-width: 480px) {
      height: var(--cover-height, 396px);
    }

    & .z-image,
    & img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media (min-width: 480px) {
      grid-column: span 8;
    }
  }
}

.z-box {
  padding: 1.25rem;
  background: #f7f7f7;
  border-radius: 10px;
  box-shadow: 0 10px 30px 0 rgba(209, 213, 223, 0.5);

  &__heading {
    margin: 0 0 24px 0;
  }

  &__item {
    margin: 0 0 0.75rem 0;

    &:last-child {
      margin: 0;
    }
  }

  .nuxt-link-active {
    color: var(--color-primary);
  }
}
</style>
