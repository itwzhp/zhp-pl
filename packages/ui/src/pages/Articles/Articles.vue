<template>
  <div id="articles">
    <!-- Przygoda. Przyjaźń. Wychowanie. -->
    <div style="display: grid; max-width: 1120px; margin: auto; grid-template-columns: repeat(12, 1fr);">
      <ZHeading style="grid-column: 5 / span 7;">
        Aktualności
        <small style="display: block; margin: 8px 0; font-weight: 400;">Sprawdź, co nowego w ZHP</small>
      </zHeading>
      <!-- Wybierz miesiąc, Wybierz kategorię, Wybierz tagi -->
      <div style=" margin: 32px 0; grid-column: 5 / span 7;">
        <ZDropdown
          name="Wybierz miesiąc"
          class="z-dropdown--has-chevron"
          style="

--button-height: 40px;
--button-padding: 8px 32px;
--button-min-width: 160px;
--button-box-shadow: 5px 10px 20px 0 rgba(0, 0, 0, 0.13);
--dropdown-content-width: calc(300% - 37px);"
        >
          <form>
            <div
              style="display: grid;
    max-width: 1120px;
    justify-content: end;
    margin: 32px auto;
    column-gap: 8px;
    grid-auto-flow: column;"
            >
              <ZButton
                style="

              --icon-color: #fff;
              --button-min-width: none;
              --button-padding: 0;
              --button-width: 34px;
              --button-height: 34px;"
                type="button"
              >
                <ZIcon name="cross" />
              </ZButton>
              <ZButton
                style="

              --icon-color: #fff;
              --button-padding: 0;
              --button-min-width: none;
              --button-width: 34px;
              --button-height: 34px;"
              >
                <ZIcon name="approved" />
              </ZButton>
            </div>
          </form>
        </ZDropdown>
        <ZDropdown
          name="Wybierz kategorię"
          class="z-dropdown--has-chevron"
          style="

--button-height: 40px;
--button-min-width: 160px;
--dropdown-toggle-background: #78a22f;
--dropdown-content-width: calc(200% - 42px);
--button-padding: 8px 32px;

margin: 0 0 0 -14px;

--button-box-shadow: 5px 10px 20px 0 rgba(0, 0, 0, 0.13);"
        >
          <form>
            <div
              style="display: grid;
    max-width: 1120px;
    justify-content: end;
    margin: 32px auto;
    column-gap: 8px;
    grid-auto-flow: column;"
            >
              <ZButton
                style="

              --icon-color: #fff;
              --button-min-width: none;
              --button-padding: 0;
              --button-width: 34px;
              --button-height: 34px;"
                type="button"
              >
                <ZIcon name="cross" />
              </ZButton>
              <ZButton
                style="

              --icon-color: #fff;
              --button-padding: 0;
              --button-min-width: none;
              --button-width: 34px;
              --button-height: 34px;"
              >
                <ZIcon name="approved" />
              </ZButton>
            </div>
          </form>
        </ZDropdown>
        <ZDropdown
          name="Wybierz tagi"
          class="z-dropdown--has-chevron"
          style="

--button-height: 40px;
--button-padding: 8px 32px;
--button-min-width: 160px;
--dropdown-toggle-background: #4a7b26;
--dropdown-toggle-color: #fff;

margin: 0 0 0 -14px;

--button-box-shadow: 5px 10px 20px 0 rgba(0, 0, 0, 0.13);"
        >
          <form>
            <div
              style="display: grid;
    max-width: 1120px;
    justify-content: end;
    margin: 32px auto;
    column-gap: 8px;
    grid-auto-flow: column;"
            >
              <ZButton
                style="

              --icon-color: #fff;
              --button-min-width: none;
              --button-padding: 0;
              --button-width: 34px;
              --button-height: 34px;"
                type="button"
              >
                <ZIcon name="cross" />
              </ZButton>
              <ZButton
                style="

              --icon-color: #fff;
              --button-padding: 0;
              --button-min-width: none;
              --button-width: 34px;
              --button-height: 34px;"
              >
                <ZIcon name="approved" />
              </ZButton>
            </div>
          </form>
        </ZDropdown>
      </div>
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
    <!-- Paginacja -->
    <div
      style="display: grid;
    max-width: 1120px;
    justify-content: end;
    margin: 32px auto;
    column-gap: 8px;
    grid-auto-flow: column;"
    >
      <ZButton
        v-if="hasPreviousPage"
        style="--icon-color: #fff; width: 34px; height: 34px;"
        @click="updatePage(-1)"
      >
        <ZIcon name="arrow-left" />
      </ZButton>
      <ZButton
        v-if="hasNextPage"
        style="--icon-color: #fff; width: 34px; height: 34px;"
        @click="updatePage(1)"
      >
        <ZIcon name="arrow-right" />
      </ZButton>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import {
  ZArticle, ZHeading, ZButton, ZIcon, ZDropdown,
} from '../../../index';

export default {
  name: 'Home',
  components: {
    ZDropdown,
    ZArticle,
    ZHeading,
    ZButton,
    ZIcon,
  },
  data() {
    return {
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
    async requestApi(direction = 0) {
      const { API_URL } = process.env;
      const perPage = 16;
      const page = this.page + direction;
      const params = {
        per_page: perPage,
        page,
      };
      const response = await axios.get(`${API_URL}/posts`, { params });
      this.totalPages = parseInt(response.headers['x-wp-totalpages'], 10);
      this.posts = response.data;
      this.page = page;
    },
  },
};
</script>

<style lang="scss">
  #articles {}
</style>
