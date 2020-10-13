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
        :tags="tags"
        :categories="categories"
        :selected="{...selectedFilters}"
        @submit="submitHandler"
        @unselect="submitHandler"
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
            ? 'Wyróżnione'
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
      :page="1"
      :total-pages="10"
      class="pagination"
      @change="()=>(true)"
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
  name: 'Posts',
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
      taxonomy: option.taxonomy === 'post_tag'
        ? 'tags' // FIXME: hack for differences from rest request and taxonomy name
        : `${option.taxonomy}s` // FIXME: hack for differences from taxonomy name and rest_base
    })
    // posts
    const postsRes = await $axios.get('posts', { params: { per_page: 16, ...query } })
    const posts = postsRes.data
    // TODO: move tags to vuex
    const tagsRes = await $axios('tags', { params: { per_page: 99 } })
    const tags = tagsRes.data.reduce(reduce, {})
    // TODO: move age_groups to vuex
    const ageGroupsRes = await $axios('age_groups', {})
    const ageGroups = ageGroupsRes.data.reduce(reduce, {})
    // TODO: move teams to vuex
    const teamsRes = await $axios('teams', {})
    const teams = teamsRes.data.reduce(reduce, {})
    // FIXME: do categories more descriptive -> categoriesFields?
    const categories = {
      teams: {
        id: 'teams',
        label: 'Zespół',
        options: {
          0: {
            id: 0,
            label: 'Wybierz zespół',
            value: ''
          },
          ...teams
        }
      },
      age_groups: {
        id: 'age_groups',
        label: 'Metodyki',
        options: {
          0: {
            id: 0,
            label: 'Wybierz metodykę',
            value: ''
          },
          ...ageGroups
        }
      }
    }
    const filtersKeys = ['tags', 'age_groups', 'teams', 'before', 'after']
    const selectedFilters = Object.keys(query).reduce((accumulator, param) => {
      if (filtersKeys.includes(param)) {
        return {
          ...accumulator,
          [param]: param === 'tags'
            ? query[param].split(',')
            : query[param]
        }
      } else {
        return accumulator
      }
    }, {})
    return { posts, page: 1, tags, categories, selectedFilters, query }
  },
  methods: {
    submitHandler (query) {
      const requestQuery = { ...this.$route.query, ...query }
      this.$router.push({
        path: this.$route.path,
        query: Object.keys(requestQuery).reduce((accumulator, param) => {
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
