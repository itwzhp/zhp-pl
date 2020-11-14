<template>
  <div id="posts">
    <ZSection>
      <ZHeading
        style="grid-column: 5 / span 7;"
        class="t3"
      >
        Aktualności
        <small style="display: block; margin: 8px 0;">Sprawdź, co nowego w ZHP</small>
      </zHeading>
      <ZFiltersPosts
        class="filters"
        :categories="categories"
        :selected="{...selectedFilters}"
        @submit="updateQuery"
      />
    </ZSection>
    <ZSection>
      <!-- FIXME: fallback for posts.length === 0, I can show last 5 posts  -->
      <template v-for="(post, index) in posts">
        <ZPost
          :key="post.id"
          :thumbnail="post.rest_media"
          :title="post.title && post.title.rendered"
          :to="`/aktualnosci/${post.slug}`"
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
  ZPagination
} from '@nowa-zhp/ui'

export default {
  watchQuery: true,
  components: {
    ZSection,
    ZFiltersPosts,
    ZPost,
    ZHeading,
    ZPagination
  },
  async asyncData ({ $axios, params, query }) {
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

    const selectedFilters = Object.keys(query).reduce((object, param) => {
      return {
        ...object,
        [param]: param === 'categories'
          ? query[param].split(',')
          : query[param]
      }
    }, {})
    return { posts, page: query.page || '1', totalPages, categories, selectedFilters }
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
    }
  }
}
</script>

<style lang="scss">
#posts {
  .filters {
    margin: 32px 0;
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: 5 / span 7;
    }
  }

  .post {
    grid-column: span 12;

    @media (min-width: 480px) {
      grid-column: span 3;
    }

    &--highlighted {
      @media (min-width: 480px) {
        grid-column: 10 / span 3;
      }
    }

    &--primary {
      @media (min-width: 480px) {
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
