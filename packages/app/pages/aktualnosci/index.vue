<template>
  <div id="posts">
    <div class="hero-wrapper">
      <ZSection class="section-hero">
        <div class="section-hero__picture">
          <ZClipPath :hero-image="news._embedded['wp:featuredmedia'][0].media_details.sizes.medium_large.source_url" />
        </div>
        <ZHeading
          class="t4 section-hero__title uppercase"
        >
          Aktualności
          <div
            class="t6 normal"
            style="margin: 8px 0 0 0;"
          >
            Sprawdź, co nowego w ZHP
          </div>
        </ZHeading>
        <ZFiltersPosts
          class="filters section-hero__filters"
          :categories="categories"
          :selected="{...selectedFilters}"
          @submit="updateQuery"
        />
        <ZSearch
          class="section-hero__search"
          :input="{placeholder: 'Czego dzisiaj chcesz się dowiedzieć?'}"
          @submit="search"
        />
      </ZSection>
    </div>
    <ZSection>
      <!-- FIXME: fallback for posts.length === 0, I can show last 5 posts  -->
      <template v-for="(post, index) in posts">
        <ZPost
          :key="post.id"
          :to="post.rest_redirect ? post.rest_redirect : `/${post.date.split('-')[0]}/${post.slug}`"
          :thumbnail="post.rest_media || placeholder"
          :title="post.title && post.title.rendered"
          :author="post.rest_author"
          :date="post.date"
          :category="post.sticky
            ? 'Ważne'
            : page === 1 && index === 0
              ? 'Dzieje się'
              : post.category"
          class="post"
          :class="{
            'z-post--highlighted': post.sticky,
            'z-post--primary': page === 1 && index === 0,
            'post--highlighted': post.sticky,
            'post--primary': page === 1 && index === 0
          }"
        />
      </template>
    </ZSection>
    <ZPagination
      :page="page"
      :total-pages="totalPages"
      class="pagination"
      @change="updateQuery({page: $event})"
    />
  </div>
</template>

<script>
import {
  ZSection,
  ZPost,
  ZHeading,
  ZFiltersPosts,
  ZPagination,
  ZClipPath,
  ZSearch
} from '@zhp-pl/ui'
import { mapGetters } from 'vuex'

export default {
  watchQuery: true,
  components: {
    ZSection,
    ZFiltersPosts,
    ZPost,
    ZHeading,
    ZPagination,
    ZClipPath,
    ZSearch
  },
  async asyncData ({ $axios, params, query }) {
    const newsRes = await $axios.get('pages', { params: { slug: 'aktualnosci', _embed: true, parent: 0 } })
    const news = newsRes.data.shift()
    // helpers
    const reduce = (accumulator, option) => ({
      ...accumulator,
      [option.id]: map(option)
    })
    const map = option => ({
      id: option.id,
      label: option.name,
      value: `${option.id}`,
      taxonomy: option.taxonomy === 'category' ? 'categories' : option.taxonomy
    })
    // posts
    const postsRes = await $axios.get('posts', { params: { per_page: 16, page: 1, ...query } })
    const posts = postsRes.data
    const totalPages = postsRes.headers['x-wp-totalpages']

    const categoriesRes = await $axios('categories', { params: { per_page: 99 } })
    const categories = categoriesRes.data.reduce(reduce, {})

    const selectedFilters = Object.keys(query)
      .filter(key => (key !== 'page'))
      .reduce((object, param) => {
        return {
          ...object,
          [param]: param === 'categories'
            ? query[param]?.split(',')
            : query[param]
        }
      }, {})
    return { news, posts, page: query.page || '1', totalPages, categories, selectedFilters }
  },
  methods: {
    updateQuery (query) {
      const requestQuery = { ...this.$route.query, ...query }
      this.$router.push({
        path: this.$route.path,
        query: Object.keys(requestQuery)
          .filter((param) => {
            switch (param) {
              case 'page':
                return parseInt(requestQuery[param], 10) > 1
              default:
                return true
            }
          })
          .reduce((accumulator, param) => {
            return requestQuery[param]
              ? { ...accumulator, [param]: requestQuery[param] }
              : accumulator
          }, {})
      })
    },
    search (query) {
      this.$router.push({
        path: '/szukaj',
        query: { search: query, subtype: 'post' }
      })
    }
  },
  computed: {
    ...mapGetters({
      title: 'theme/title',
      placeholder: 'theme/placeholder'
    })
  },
  head () {
    const title = `Aktualności | ${this.title}`
    const description = ''
    const image = this.news._embedded['wp:featuredmedia'][0].media_details.sizes.medium_large.source_url
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
#posts {
  .hero-wrapper {
    max-width: 1360px;
    margin: 0 auto;
  }

  .section-hero {
    @media (min-width: 640px) {
      --section-content-grid-template-columns: repeat(24, minmax(auto, 1fr));
      --section-content-max-width: 1235px;
      --section-content-margin: 0 auto 0 0;
    }

    &__picture {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 9;
        grid-row: span 3;
      }
    }

    &__title {
      margin: 0 0 1.5rem 0;
      grid-column: span 12;
      place-self: end stretch;

      @media (min-width: 640px) {
        grid-column: 10 / span 13;
      }
    }

    &__filters {
      grid-column: span 12;
      place-self: start stretch;

      @media (min-width: 640px) {
        grid-column: 10 / span 13;
        grid-row: 2;
      }
    }

    &__search {
      grid-column: span 12;
      place-self: start stretch;

      @media (min-width: 640px) {
        margin: 0 16% 0 0;
        grid-column: 10 / span 13;
      }
    }
  }

  .post {
    grid-column: span 12;

    @media (min-width: 640px) {
      grid-column: span 4;
    }

    @media (min-width: 768px) {
      grid-column: span 3;
    }

    &--highlighted {
      @media (min-width: 640px) {
        grid-column: 10 / span 3;
      }
    }

    &--primary {
      @media (min-width: 640px) {
        grid-column: span 12;
      }
    }
  }

  .pagination {
    max-width: 1140px;
    padding: 0 1.25rem;
    margin: 32px auto;
  }
}
</style>
