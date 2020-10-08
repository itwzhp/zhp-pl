<template>
  <div id="posts">
    <ZSection>
      <ZHeading style="grid-column: 5 / span 7;">
        Aktualności
        <small style="display: block; margin: 8px 0; font-weight: 400;">Sprawdź, co nowego w ZHP</small>
      </zHeading>
      <ZFiltersPosts
        style=" margin: 32px 0; grid-column: 5 / span 7;"
        :categories="categories"
        :tags="tags"
        :date="[]"
        :selected-filters="[]"
        @submit:date="()=>(true)"
        @submit:categories="()=>(true)"
        @submit:tags="()=>(true)"
        @update="()=>(true)"
      />
    </ZSection>
    <ZSection>
      <template v-for="(post, index) in posts">
        <ZPost
          :key="post.id"
          :thumbnail="post.rest_media"
          :title="post.title.rendered"
          :to="`/posts/${post.slug}`"
          author="Przemysław Spaczek"
          :sticky="post.sticky"
          :date="post.date"
          :category="post.sticky ? 'Wyróżnione' : page === 1 && index === 0 ? 'Dzieje się' : post.category"
          class="post"
          :class="{
            'z-post--highlighted': post.sticky,
            'post--highlighted': post.sticky,
            'z-post--primary': page === 1 && index === 0,
            'post--primary': page === 1 && index === 0 }"
        />
      </template>
    </ZSection>
    <ZPagination
      :page="1"
      :total-pages="10"
      style="max-width: 1120px; margin: 32px auto;"
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
  components: {
    ZSection,
    ZFiltersPosts,
    ZPost,
    ZHeading,
    ZPagination
  },
  async asyncData ({ $axios }) {
    const reduce = (accumulator, option) => ({
      ...accumulator,
      [option.id]: map(option)
    })
    const map = option => ({
      id: option.id,
      label: option.name,
      value: option.id
    })

    // posts
    const postsRes = await $axios.get('posts', { per_page: 16 })
    const posts = postsRes.data
    // tags
    const tagsRes = await $axios('tags', {})
    const tags = tagsRes.data.reduce(reduce, {})
    // categories
    const ageGroupsRes = await $axios('age_groups', {})
    const ageGroups = ageGroupsRes.data.reduce(reduce, {})
    const teamsRes = await $axios('teams', {})
    const teams = teamsRes.data.reduce(reduce, {})
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
    return { posts, page: 1, tags, categories }
  }
}
</script>

<style lang="scss">
#posts {
  .post {
    grid-column: span 3;

    &--highlighted {
      grid-column: 10 / span 3;
    }

    &--primary {
      grid-column: span 12;
    }
  }
}
</style>
