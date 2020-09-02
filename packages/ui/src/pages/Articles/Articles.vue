<template>
  <div id="articles">
    <!-- Przygoda. Przyjaźń. Wychowanie. -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <ZHeading style="grid-column: 5 / span 7;">
        Aktualności
        <small style="display: block; margin: 8px 0; font-weight: 400;">Sprawdź, co nowego w ZHP</small>
      </zHeading>
      <!-- Wybierz miesiąc, Wybierz kategorię, Wybierz tagi -->
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
          :class="{'z-article--highlighted': post.sticky, 'z-article--primary': index === 0}"
        />
      </template>
    </div>
    <!-- Paginacja -->
    <div
      style="display: grid;
    max-width: 1120px;
    justify-content: end;
    margin: 32px auto;
    column-gap: 8px;
    grid-auto-flow: column;"
    >
      <ZButton style="--icon-color: #fff; width: 34px; height: 34px;">
        <ZIcon name="arrow-left" />
      </ZButton>
      <ZButton style="--icon-color: #fff; width: 34px; height: 34px;">
        <ZIcon name="arrow-right" />
      </ZButton>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import {
  ZArticle, ZHeading, ZButton, ZIcon,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZArticle,
    ZHeading,
    ZButton,
    ZIcon,
  },
  data() {
    return {
      posts: [],
    };
  },
  computed: {
    mountCarousel() {
      return this.posts.length > 0;
    },
  },
  async created() {
    const { API_URL } = process.env;
    const params = {
      per_page: 16,
    };
    const { data } = await axios.get(`${API_URL}/posts`, { params });
    this.posts = data;
  },
};
</script>
<style lang="scss">
  #articles {}
</style>
