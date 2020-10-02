<template>
  <div id="post">
    <ZSection tag="div">
      <ZHeading
        :level="1"
        class="title"
      >
        {{ post.title.rendered }}
      </ZHeading>
      <ZMeta
        :author="{name: post.rest_author.name, avatarUrl: post.rest_author['avatar_url']}"
        :reading-time="post.rest_reading_time"
        :date="post.date"
        :categories="post.categories"
        class="meta"
      />
      <ZImage
        :src="post.rest_media"
        class="cover"
      />
      <Compiler
        class="content"
        :html="post.content.rendered"
      />
      <div class="z-files files">
        <!-- linki i dokumenty powiązane z artykułem -->
        <ZHeading
          :level="3"
          class="z-files__title"
        >
          <ZLink to="$">
            Linki i dokumenty powiązane z artykułem
          </ZLink>
        </ZHeading>
        <ZList class="z-files__files">
          <template v-for="(file, key) in post.files">
            <li :key="key">
              <div class="z-file">
                <div class="z-file__type">
                  {{ file.type }}
                </div>
                <ZHeading
                  :level="4"
                  class="z-file__name"
                >
                  <ZLink :to="file.url">
                    {{ file.name }}
                  </ZLink>
                </ZHeading>
                <div class="z-file__meta">
                  {{ file.mimeType }}, {{ file.date }}
                </div>
              </div>
            </li>
          </template>
        </ZList>
      </div>
      <div class="sidebar" />
    </ZSection>
    <ZSection class="related">
      <ZHeading class="z-heading--uppercase related__title">
        Mogą Cię także zainteresować:
      </ZHeading>
      <ZCarousel
        v-if="relatedPosts.length > 0"
        :peeked="true"
        :settings="{
          type: 'carousel',
          perView: 4,
          gap: 20,
          autoplay: 3000,
        }"
        class="z-carousel--peeked related__carousel"
      >
        <li
          v-for="relatedPost in relatedPosts"
          :key="relatedPost.id"
          class="glide__slide"
        >
          <ZPost
            :key="relatedPost.id"
            :thumbnail="relatedPost.rest_media"
            :title="relatedPost.title.rendered"
            :to="relatedPost.link"
            :author="relatedPost.rest_author"
            :sticky="relatedPost.sticky"
            :date="relatedPost.date"
          />
        </li>
      </ZCarousel>
    </ZSection>
  </div>
</template>

<script>
import axios from 'axios';
import Compiler from '../../helpers/Compiler.vue';
import {
  ZSection,
  ZHeading,
  ZCarousel,
  ZImage,
  ZPost,
  ZMeta,
  ZList,
  ZLink,
} from '../../../index';

export default {
  name: 'Post',
  components: {
    Compiler,
    ZLink,
    ZMeta,
    ZImage,
    ZHeading,
    ZSection,
    ZCarousel,
    ZPost,
    ZList,
  },
  data() {
    return {
      post: {
        date: '',
        title: { rendered: '' },
        content: { rendered: '' },
        rest_media: { rendered: '' },
        rest_author: {},
        rest_reading_time: 0,
        files: [],
      },
      categories: [],
      relatedPosts: [],
    };
  },
  async created() {
    const { API_URL } = process.env;
    const post = await this.fetchAPI(`${API_URL}/posts`, { slug: 'rekrutacja-szefa-szefowej-zespolu-ds-wspolpracy-zagranicznej-w-hufcach-i-choragwiach' });
    const files = [
      { type: 'Link', name: 'Rejestracja patroli', url: '#' },
      {
        type: 'Dokument', name: 'Formularz zgłoszeniowy', url: '#', date: '12.07.2020', mimeType: 'Dokument Word',
      },
      {
        type: 'Dokument', name: 'Formularz zgłoszeniowy', url: '#', date: '12.07.2020', mimeType: 'Dokument PDF',
      },
    ];
    // eslint-disable-next-line prefer-destructuring
    this.post = { ...post.data[0], files };
    // todo: pobranie kategori to każdorazowe zapytanie API?
    // todo: pobranie kategori to zwrócenie kategorii w tym obiekcie
    const relatedPosts = await this.fetchAPI(`${API_URL}/posts`, { per_page: 8 });
    this.relatedPosts = relatedPosts.data;
  },
  methods: {
    async fetchAPI(url, params) {
      const response = await axios.get(url, { params });
      return {
        data: response.data,
      };
    },
    async requestApi() {
      return true;
    },
  },
};
</script>

<style lang="scss">
#post {
  overflow: hidden;

  .title {
    margin: 32px 0;
    grid-column: span 12;
    grid-row: 1;
  }

  .meta {
    margin: 0 0 24px 0;
    grid-column: span 8;
    grid-row: 2;
  }

  .cover {
    display: flex;
    overflow: hidden;
    height: 396px;
    border-radius: 10px;
    grid-column: span 8;
    grid-row: 3;

    img {
      object-fit: cover;
    }
  }

  .content {
    margin: 0 0 48px 0;
    grid-column: span 8;
    grid-row: 4;
  }

  .sidebar {
    grid-column: span 4;
    grid-row: 3 / span 3;
  }
  .files { grid-column: span 8; grid-row: 5; }

  .related {
    &__title {
      grid-column: span 12;
      place-self: center;
    }

    &__carousel {
      grid-column: span 12;
    }
  }

  p {
    margin: 20px 0;
  }

  .image {
    display: flex;
    overflow: hidden;
    border-radius: 10px;
  }
}

.z-files {
  &__title {
    margin: 1rem 0;
  }

  &__files {
    display: grid;
    gap: 12px;
    grid-auto-flow: row;
  }
}

.z-file {
  position: relative;
  display: grid;
  align-items: center;
  justify-content: space-between;
  padding: 32px 16px;
  border: 1px solid #a6ce39;
  border-radius: 2px;
  grid-template-columns: repeat(2, auto);
  &__name {}

  &__type {
    position: absolute;
    top: 8px;
    left: 8px;
    font-size: 12px;
    font-weight: 100;
  }

  &__meta {
    color: #a6ce39;
  }
}
</style>
