<template>
  <div id="articles">
    <!-- Przygoda. Przyjaźń. Wychowanie. -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <ZHeading style="grid-column: 5 / span 7;">
        Aktualności
        <small style="display: block;">Sprawdź, co nowego w ZHP</small>
      </zHeading>
      <!-- Wybierz miesiąc, Wybierz kategorię, Wybierz tagi -->
    </div>
    <!-- Aktualności -->
    <div style="display: grid; max-width: 1120px; margin: 32px auto; gap: 20px; grid-template-columns: repeat(4, 1fr);">
      <ZArticle
        v-for="(post, index) in posts"
        :key="post.id"
        :thumbnail="post.futured_media"
        :title="post.title.rendered"
        :to="post.link"
        :author="post.author"
        :sticky="post.sticky"
        :date="post.date"
        :class="{'z-article--highlighted': post.sticky, 'z-article--primary': index === 0}"
      />
    </div>
    <!-- Paginacja -->
    <div style="display: grid; max-width: 1120px; justify-content: end; margin: 32px auto; grid-auto-flow: column;">
      <ZButton>
        <ZIcon name="search" />
      </ZButton>
      <ZButton>
        <ZIcon name="search" />
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
  async mounted() {
    const API_URL = 'http://demo.przemyslawspaczek.atthost24.pl/wp-json/wp/v2';
    const usersResponse = await axios.get(`${API_URL}/users`);
    const users = usersResponse.data.reduce((accumulator, user) => ({
      ...accumulator,
      [user.id]: {
        name: user.name,
        to: user.link,
      },
    }), {});
    const postsResponse = await axios.get(`${API_URL}/posts?per_page=16`);
    const posts = postsResponse.data;
    const postsWithMedia = await Promise.all(posts.map(async (post) => {
      const mediaResponse = await axios.get(`${API_URL}/media/${post.featured_media}`);
      const media = mediaResponse.data;
      return { ...post, futured_media: media.guid.rendered };
    }));
    const postsWithAuthors = postsWithMedia.map((post) => ({ ...post, author: users[post.author] }));
    this.posts = postsWithAuthors;
  },
};
</script>
<style lang="scss">
  #home {}
</style>
