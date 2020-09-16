<template>
  <div id="articles">
    <!-- Przygoda. Przyjaźń. Wychowanie. -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <ZHeading style="grid-column: 5 / span 7;">
        Aktualności
        <small style="display: block; margin: 8px 0; font-weight: 400;">Sprawdź, co nowego w ZHP</small>
      </zHeading>
      <!-- Wybierz miesiąc, Wybierz kategorię, Wybierz tagi -->
      <ZArticlesFilters
        style=" margin: 32px 0; grid-column: 5 / span 7;"
        :categories="categories"
        :tags="tags"
      />
    </div>
    <!-- Aktualności -->
    <div style="display: grid; max-width: 1120px; margin: 32px auto; gap: 20px; grid-template-columns: repeat(4, 1fr);">
      <template v-for="(post, index) in posts">
        <ZArticle
          :key="post.id"
          :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${post.rest_media.file}`"
          :title="post.title.rendered"
          :to="post.link"
          author="Przemysław Spaczek"
          :sticky="post.sticky"
          :date="post.date"
          :category="post.sticky ? 'Wyróżnione' : page === 1 && index === 0 ? 'Dzieje się' : post.category"
          :class="{'z-article--highlighted': post.sticky, 'z-article--primary': page === 1 && index === 0 }"
        />
      </template>
    </div>
    <ZPagination
      :page="page"
      :total-pages="totalPages"
      style="max-width: 1120px; margin: 32px auto;"
      @change="(page)=>{this.page = page}"
    />
  </div>
</template>

<script>
import axios from 'axios';
import {
  ZArticle,
  ZHeading,
  ZArticlesFilters,
  ZPagination,
} from '../../../index';

export default {
  name: 'Articles',
  components: {
    ZArticlesFilters,
    ZArticle,
    ZHeading,
    ZPagination,
  },
  data() {
    return {
      tags: [],
      categories: [],
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
  },
  created() {
    this.requestApi();
  },
  methods: {
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
    async requestApi(direction = 0) {
      const { API_URL } = process.env;

      const tags = await this.fetchAPI(`${API_URL}/tags`);
      this.tags = tags.data;

      // const categories = await this.fetchAPI(`${API_URL}/categories`);
      // this.categories = categories.data;

      const posts = await this.fetchAPI(`${API_URL}/posts`, {
        per_page: 16,
        page: this.page + direction,
      });
      this.posts = posts.data;
      this.totalPages = posts.totalPages;

      this.page += direction;
    },
  },
};
</script>

<style lang="scss">
  #articles {}
</style>
