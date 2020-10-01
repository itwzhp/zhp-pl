<template>
  <div id="event">
    <ZSection tag="div">
      <ZHeading
        :level="1"
        class="title"
      >
        {{ event.title.rendered }}
      </ZHeading>
      <ZMeta
        :author="{name: event.rest_author.name, avatarUrl: event.rest_author['avatar_url']}"
        :reading-time="event.rest_reading_time"
        :date="event.date"
        :categories="event.categories"
        class="meta"
      />
      <ZImage
        :src="event.rest_media"
        class="cover"
      />
      <Compiler
        class="content"
        :html="event.content.rendered"
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
          <template v-for="(file, key) in event.files">
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
      <ZHeading class="related__title">
        Mogą Cię także zainteresować:
      </ZHeading>
      <ZCarousel
        v-if="relatedEvents.length > 0"
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
          v-for="relatedEvent in relatedEvents"
          :key="relatedEvent.id"
          class="glide__slide"
        >
          <ZEvent
            :key="relatedEvent.id"
            :thumbnail="relatedEvent.rest_media"
            :title="relatedEvent.title.rendered"
            :date="relatedEvent.rest_acf.date"
            :location="{name: 'Warszawa'}"
            :audience="{name: 'Wszyscy harcerze'}"
            :type="relatedEvent.rest_event_type"
            :age-group="relatedEvent.rest_age_group"
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
  ZEvent,
  ZMeta,
  ZList,
  ZLink,
} from '../../../index';

export default {
  name: 'Event',
  components: {
    Compiler,
    ZLink,
    ZMeta,
    ZImage,
    ZHeading,
    ZSection,
    ZCarousel,
    ZEvent,
    ZList,
  },
  data() {
    return {
      event: {
        date: '',
        title: { rendered: '' },
        content: { rendered: '' },
        rest_media: { rendered: '' },
        rest_author: {},
        rest_reading_time: 0,
        files: [],
      },
      categories: [],
      relatedEvents: [],
    };
  },
  async created() {
    const { API_URL } = process.env;
    const event = await this.fetchAPI(`${API_URL}/events`, { slug: 'hal-2020' });
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
    this.post = { ...event.data[0], files };
    // todo: pobranie kategori to każdorazowe zapytanie API?
    // todo: pobranie kategori to zwrócenie kategorii w tym obiekcie
    const relatedEvents = await this.fetchAPI(`${API_URL}/events`, { per_page: 8 });
    this.relatedEvents = relatedEvents.data;
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
#event {
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
  grid-template-columns: repeat(2, auto);
  border-radius: 2px;
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
