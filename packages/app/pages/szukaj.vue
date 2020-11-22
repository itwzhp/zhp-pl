<template>
  <div id="search">
    <div class="hero-wrapper">
      <ZSection class="section-hero">
        <div class="section-hero__picture">
          <ZClipPath :hero-image="search._embedded['wp:featuredmedia'][0].media_details.sizes.medium_large.source_url" />
        </div>
        <ZHeading
          class="t4 section-hero__title uppercase"
        >
          {{ title }}
        </ZHeading>
        <ZSearch
          class="section-hero__search"
          @submit="submit"
        />
      </ZSection>
    </div>
    <ZSection>
      <template v-for="post in posts">
        <template v-if="post.subtype === 'post'">
          <ZPost
            :key="post.id"
            :to="`/aktualnosci/${post._embedded.self[0].slug}`"
            :title="post.title"
            :date="post._embedded.self[0].date"
            :thumbnail="post._embedded.self[0].rest_media || require('~/assets/placeholder.png')"
            :author="post._embedded.self[0].rest_author"
            style="grid-column: span 3;"
          />
        </template>
        <template v-else-if="post.subtype === 'event'">
          <ZEvent
            :key="post.id"
            :to="`/wydarzenia/${post._embedded.self[0].slug}`"
            :title="post.title"
            :date="post._embedded.self[0].rest_acf.date"
            :type="post._embedded.self[0].rest_acf.rest_event_type"
            :thumbnail="post._embedded.self[0].rest_media || require('~/assets/placeholder.png')"
            style="grid-column: span 3;"
          />
        </template>
        <template v-else>
          <ZCard
            :key="post.id"
            :to="post._embedded.self[0].slug"
            :title="post.title"
            :thumbnail="post._embedded.self[0].rest_media || require('~/assets/placeholder.png')"
            style="grid-column: span 3;"
          />
        </template>
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
  ZClipPath,
  ZSearch,
  ZPost,
  ZEvent,
  ZCard,
  ZHeading,
  ZPagination
} from '@nowa-zhp/ui'

export default {
  watchQuery: true,
  components: {
    ZSection,
    ZClipPath,
    ZSearch,
    ZPost,
    ZEvent,
    ZCard,
    ZHeading,
    ZPagination
  },
  async asyncData ({ $axios, params, query }) {
    const searchRes = await $axios.get('pages', { params: { slug: 'szukaj', _embed: true, per_page: 16 } })
    const search = searchRes.data.shift()

    const postsRes = await $axios.get('search', { params: { ...query, _embed: true } })
    const posts = postsRes.data

    const totalPages = postsRes.headers['x-wp-totalpages']

    return { posts, page: query.page || '1', totalPages, search, query }
  },
  computed: {
    title () {
      return `Wyniki wyszukiwania dla "${this.query.search}"`
    }
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
    submit (query) {
      this.$router.push({
        path: '/szukaj',
        query: { search: query }
      })
    }
  }
}
</script>

<style lang="scss">
#search {
  overflow: hidden;

  .pagination {
    max-width: 1140px;
    padding: 0 1.25rem;
    margin: 32px auto;
  }

  .hero-wrapper {
    max-width: 1360px;
    margin: 0 auto;
  }

  .section-hero {
    @media (min-width: 480px) {
      --section-content-grid-template-columns: repeat(24, minmax(auto, 1fr));
      --section-content-max-width: 1235px;
      --section-content-margin: 0 auto 0 0;
    }

    &__picture {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 9;
        grid-row: span 2;
      }
    }

    &__title {
      margin: 0 0 1.5rem 0;
      grid-column: span 12;
      place-self: end stretch;

      @media (min-width: 480px) {
        grid-column: span 13;
      }
    }

    &__search {
      grid-column: span 12;
      place-self: start stretch;

      @media (min-width: 480px) {
        grid-column: span 13;
      }
    }
  }
}
</style>
