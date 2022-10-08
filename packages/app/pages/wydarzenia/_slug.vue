<template>
  <div id="event">
    <ZSection
      tag="div"
      class="section"
    >
      <ZHeading
        :level="1"
        class="title t3"
      >
        {{ event.title.rendered }}
      </ZHeading>
      <ZMetaEvent
        :thumbnail="event.rest_media || placeholder"
        :date="event.rest_acf.date"
        :location="{name: event._embedded['wp:term'][0][0] && event._embedded['wp:term'][0][0].name, to:'#'}"
        :type="event.rest_event_type"
        :audiences="event.age_groups.map((ageGroup)=>(ageGroups[ageGroup]))"
        class="meta"
      />
      <div class="sidebar">
        <ZEventOrganizer
          :organizer="event.rest_acf.organizer"
          :web="event.rest_acf.web"
        />
      </div>
      <ZWordPress
        class="content"
        :html="event.content.rendered"
      />
      <ZFiles
        v-if="hasFiles"
        title="Linki i dokumenty powiązane z artykułem:"
        :files="files"
        class="files"
      />
    </ZSection>
    <ZSection
      class="related section"
      title="Mogą Cię także zainteresować:"
    >
      <ZCarousel
        v-if="relatedEvents.length > 0"
        :peeked="true"
        :settings="{
          breakpoints: {
            640: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="z-carousel--peeked related__carousel"
      >
        <template v-for="relatedEvent in relatedEvents">
          <li
            :key="relatedEvent.id"
            class="glide__slide"
          >
            <ZEvent
              :key="relatedEvent.id"
              :thumbnail="relatedEvent.rest_media || placeholder"
              :title="relatedEvent.title.rendered"
              :date="relatedEvent.rest_acf.date"
              :location="{name: relatedEvent._embedded['wp:term'][0][0] && relatedEvent._embedded['wp:term'][0][0].name, to:'#'}"
              :type="relatedEvent.rest_event_type"
              :audiences="relatedEvent.age_groups.map((ageGroup)=>(ageGroups[ageGroup]))"
              :to="`/wydarzenia/${relatedEvent.slug}`"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
  </div>
</template>

<script>
import {
  ZSection,
  ZHeading,
  ZCarousel,
  ZEvent,
  ZFiles,
  ZEventOrganizer,
  ZMetaEvent
} from '@zhp-pl/ui'
import ZWordPress from '@/components/organisms/ZWordPress.vue'
import { mapGetters } from 'vuex'

export default {
  components: {
    ZSection,
    ZHeading,
    ZCarousel,
    ZEvent,
    ZFiles,
    ZWordPress,
    ZEventOrganizer,
    ZMetaEvent
  },
  async asyncData ({ $axios, params, query }) {
    // events
    const eventRes = await $axios.get('events', { params: { ...params, _embed: true } })
    const event = eventRes.data[0]
    // related events
    const relatedEventsRes = await $axios.get('events', { params: { per_page: 8, _embed: true } })
    const relatedEvents = relatedEventsRes.data
    // files
    const files = Array.isArray(event.rest_acf.plikilinki)
      ? event.rest_acf.plikilinki.map(file => ({
        ...file,
        type: file.file ? 'Dokument' : 'Link',
        date: file.file.modified
      }))
      : []

    return { event, relatedEvents, files }
  },
  computed: {
    ...mapGetters({
      title: 'theme/title',
      placeholder: 'theme/placeholder'
    }),
    hasFiles () {
      return this.files.length > 0
    },
    ageGroups () {
      return this.$store.getters['taxonomies/taxonomy']('age_groups')
    }
  },
  head () {
    const title = this.event.title.rendered + ' | ' + this.title
    const description = ''
    const image = this.event.rest_media ? this.event.rest_media : this.placeholder
    return {
      title,
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: description
        },
        // Open Graph
        {
          hid: 'og:title',
          property: 'og:title',
          content: title
        },
        {
          hid: 'og:description',
          property: 'og:description',
          content: description
        },
        {
          hid: 'og:image',
          property: 'og:image',
          content: image
        },
        // Twitter Card
        {
          hid: 'twitter:title',
          property: 'twitter:title',
          content: title
        },
        {
          hid: 'twitter:description',
          property: 'twitter:description',
          content: description
        }
      ]
    }
  }
}
</script>

<style lang="scss">
#event {
  overflow: hidden;

  .section {
    --section-margin: 25px 0;
  }

  .title {
    margin: 32px 0;
    grid-column: span 12;
    grid-row: 1;
  }

  .meta {
    margin: 0 0 24px 0;
    grid-column: span 12;

    @media (min-width: 640px) {
      grid-column: span 8;
      grid-row: 3;
    }
  }

  .content {
    margin: 0 0 48px 0;
    grid-column: span 12;

    @media (min-width: 640px) {
      grid-column: span 8;
      grid-row: 4;
    }
  }

  .sidebar {
    grid-column: span 12;

    @media (min-width: 640px) {
      grid-column: span 4;
      grid-row: 3 / span 3;
    }
  }

  .files {
    grid-column: span 8;
    grid-row: 5;
  }

  .related {
    &__title {
      grid-column: span 12;
      place-self: center;
    }

    &__carousel {
      grid-column: span 12;
    }
  }
}
</style>
