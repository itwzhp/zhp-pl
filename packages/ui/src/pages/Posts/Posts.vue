<template>
  <div id="posts">
    <ZSection>
      <ZHeading syle="grid-column: 5 / span 7;">
        Aktualności
        <small style="display: block; margin: 8px 0; font-weight: 400;">Sprawdź, co nowego w ZHP</small>
      </zHeading>
      <ZFiltersPosts
        style=" margin: 32px 0; grid-column: 5 / span 7;"
        :categories="categories"
        :tags="tags"
        :date="date"
        :selected-filters="selectedFilters"
        @submit:date="updateSelectedDate"
        @submit:categories="updateSelectedCategories"
        @submit:tags="updateSelectedTags"
        @update="updateFilters"
      />
    </ZSection>
    <ZSection>
      <template v-for="(post, index) in posts">
        <ZPost
          :key="post.id"
          :thumbnail="post.rest_media"
          :title="post.title.rendered"
          :to="post.link"
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
      :page="page"
      :total-pages="totalPages"
      style="max-width: 1120px; margin: 32px auto;"
      @change="()=>(true)"
    />
  </div>
</template>

<script>
import axios from 'axios';
import {
  ZSection,
  ZPost,
  ZHeading,
  ZFiltersPosts,
  ZPagination,
} from '../../../index';

export default {
  name: 'Posts',
  components: {
    ZSection,
    ZFiltersPosts,
    ZPost,
    ZHeading,
    ZPagination,
  },
  data() {
    return {
      date: [],
      tags: {},
      categories: {},
      selectedFilters: {},
      posts: [],
      page: 1,
      totalPages: 0,
    };
  },
  computed: {
    mountCarousel() {
      return this.posts.length > 0;
    },
    hasNextPage() {
      return this.page < this.totalPages;
    },
    hasPreviousPage() {
      return this.page > 1;
    },
    filtersQuery() {
      let query = {};
      if (this.selectedFilters.date) {
        // eslint-disable-next-line prefer-destructuring
        query.after = this.selectedFilters.date[0];
        // eslint-disable-next-line prefer-destructuring
        query.before = this.selectedFilters.date[1];
      }
      if (this.selectedFilters.categories) {
        query = { ...query, ...this.selectedFilters.categories };
      }
      if (this.selectedFilters.tags) {
        query.tags = [...this.selectedFilters.tags];
      }
      return query;
    },
  },
  watch: {
    selectedFilters() {
      this.requestPosts(this.filtersQuery);
    },
  },
  created() {
    this.requestApi();
  },
  methods: {
    reduceOptions(accumulator, option) {
      return {
        ...accumulator,
        [option.id]: this.mapOption(option),
      };
    },
    mapOption(option) {
      return {
        id: option.id,
        label: option.name,
        value: option.id,
      };
    },
    removeSelectedFilter(state) {
      this.selectedFilters = JSON.parse(JSON.stringify(state));
    },
    updateSelectedDate(date) {
      this.selectedFilters = { ...this.selectedFilters, date };
    },
    updateSelectedCategories(categories) {
      this.selectedFilters = { ...this.selectedFilters, categories };
    },
    updateSelectedTags(tags) {
      this.selectedFilters = { ...this.selectedFilters, tags };
    },
    updateFilters(filters) {
      this.selectedFilters = { ...filters };
    },
    updatePage(direction) {
      this.requestApi(direction);
    },
    async fetchAPI(url, params) {
      const response = await axios.get(url, { params });
      return {
        data: response.data,
        totalPages: parseInt(response.headers['x-wp-totalpages'], 10),
      };
    },
    async requestPosts(params) {
      const { API_URL } = process.env;
      const postParams = {
        per_page: 16,
        ...params,
      };
      const posts = await this.fetchAPI(`${API_URL}/posts`, postParams);
      this.posts = posts.data;
      this.totalPages = posts.totalPages;
    },
    async requestApi(direction = 0) {
      const { API_URL } = process.env;

      const tags = await this.fetchAPI(`${API_URL}/tags`, { hide_empty: true });
      this.tags = tags.data.reduce(this.reduceOptions, {});

      const ageGroups = await this.fetchAPI(`${API_URL}/age_groups`, { hide_empty: true });
      const teams = await this.fetchAPI(`${API_URL}/teams`, { hide_empty: true });
      this.categories = {
        teams: { id: 'teams', label: 'Zespoły', options: { 0: { id: 0, label: 'Wybierz zespół', value: '' }, ...teams.data.reduce(this.reduceOptions, {}) } },
        age_groups: { id: 'age_groups', label: 'Metodyki', options: { 0: { id: 0, label: 'Wybierz metodykę', value: '' }, ...ageGroups.data.reduce(this.reduceOptions, {}) } },
      };
      const postParams = {
        per_page: 16,
        page: this.page + direction,
      };
      const posts = await this.fetchAPI(`${API_URL}/posts`, postParams);
      this.posts = posts.data;
      this.totalPages = posts.totalPages;

      this.page += direction;
    },
  },
};
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
