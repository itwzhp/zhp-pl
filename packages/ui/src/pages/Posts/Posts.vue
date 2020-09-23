<template>
  <div id="posts">
    <ZSection>
      <ZHeading style="grid-column: 5 / span 7;">
        Aktualności
        <small style="display: block; margin: 8px 0; font-weight: 400;">Sprawdź, co nowego w ZHP</small>
      </zHeading>
      <ZPostsFilters
        style=" margin: 32px 0; grid-column: 5 / span 7;"
        :categories="categories"
        :tags="tags"
      />
    </ZSection>
    <ZSection>
      <template v-for="(post, index) in posts">
        <ZPost
          :key="post.id"
          :thumbnail="`https://demo.przemyslawspaczek.pl/wp-content/uploads/${post.rest_media.file}`"
          :title="post.title.rendered"
          :to="post.link"
          author="Przemysław Spaczek"
          :sticky="post.sticky"
          :date="post.date"
          :category="post.sticky ? 'Wyróżnione' : page === 1 && index === 0 ? 'Dzieje się' : post.category"
          :class="{'z-post--highlighted': post.sticky, 'z-post--primary': page === 1 && index === 0 }"
        />
      </template>
    </ZSection>
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
  ZSection,
  ZPost,
  ZHeading,
  ZPostsFilters,
  ZPagination,
} from '../../../index';

export default {
  name: 'Posts',
  components: {
    ZSection,
    ZPostsFilters,
    ZPost,
    ZHeading,
    ZPagination,
  },
  data() {
    return {
      tags: [],
      categories: [
        {
          id: 'teams',
          label: 'Zespół',
          options: [
            { label: 'Wydział zagraniczny' },
            { label: 'Harcerski instytut badawczy' },
          ],
        },
        {
          id: 'ageGroups',
          label: 'Metodyka',
          options: [
            { label: 'Zuchy' },
            { label: 'Harcerze' },
            { label: 'Harcerze Stars' },
            { label: 'Wędrownicy' },
          ],
        },
        {
          id: 'thirdOption',
          label: 'Jakaś trzecia opcja',
          options: [
            { label: 'opcja A' },
            { label: 'opcja B' },
            { label: 'opcja C' },
            { label: 'opcja D' },
          ],
        },
      ],
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
      this.tags = tags.data.map((tag) => ({ label: tag.name }));

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
  #posts {
    .top {}
  }
</style>
