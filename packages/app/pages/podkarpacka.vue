<template>
  <div id="faq">
    <ZSection class="section-hero">
      <div class="section-hero__picture">
        <ZClipPath />
      </div>
      <ZHeading
        :level="1"
        class="section-hero__title t3"
      >
        Chorągiew Podkarpacka Związek Harcerstwa Polskiego
        <small style="display: block;">im. Olgi i Andrzeja Małkowskich</small>
      </ZHeading>
      <div class="section-hero__contact">
        <ZText><b>Adres:</b> ul Hetmańska 9. 35-045 Rzeszów</ZText>
        <ZText><b>Telefon:</b> (17) 853 67 31</ZText>
        <ZText>
          <b>E-mail biura:</b> <ZLink to="maito:podkarpacka@zhp.pl">
            podkarpacka@zhp.pl
          </ZLink>
        </ZText>
      </div>
    </ZSection>
    <ZSection
      title="O chorągwi"
      subtitle="Przeczytaj podstawowe informacje na temat chorągwi"
      class="section-questions"
    >
      <template v-for="question in questions">
        <ZCard
          :key="question.id"
          :thumbnail="question.thumbnail"
          :title="question.title"
          :description="question.description"
          :to="question.to"
          class="z-card--pictured z-card--overlayed section-questions__question"
        />
      </template>
    </ZSection>
    <ZSection
      title="Aktualności"
      class="section-posts"
    >
      <ZCarousel
        v-if="posts.length > 0"
        :peeked="true"
        :settings="{
          breakpoints: {
            480: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="section-posts__carousel"
      >
        <template v-for="post in posts">
          <li
            :key="post.id"
            class="glide__slide"
          >
            <ZPost
              :thumbnail="post.rest_media"
              :title="post.title.rendered"
              :to="`/aktualnosci/${post.slug}`"
              :author="post.rest_author"
              :date="post.date"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
    <ZSection class="section-join-us">
      <ZBanner
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/Agnieszka_Madetko-Kurczab_ZHP_21-scaled.jpg"
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus
        sagittis, ultrices consectetur turpis. Quisque maximus metus purus, vitae convallis mi tempus eu."
        :calls-to-action="[
          {name:'Jak zacząć', to: '/jak-zaczac'},
          {name:'Ile kosztuje harcerstwo?', to: '/ile-kosztuje-harcerstwo'},
          {name:'Gdzie się zapisać?', to: '/gdzie-sie-zapisac'}]"
        class="section-join-us__banner"
      />
      <ZPost
        thumbnail="https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18.jpg"
        title="Przewodniczący ZHP i Naczelniczka ZHP: Wychowujemy w zgodzie z wartościami"
        date="2020-08-30"
        class="section-join-us__post"
      />
    </ZSection>
    <ZSection
      title="Wydarzenia i przedsięwzięcia chorągwi podkarpackiej"
      subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam augue nisl, dignissim id metus sagittis, ultrices consectetur turpis."
      class="section-posts"
    >
      <ZCarousel
        v-if="events.length > 0"
        :peeked="true"
        :settings="{
          breakpoints: {
            480: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="section-posts__carousel"
      >
        <template v-for="event in events">
          <li
            :key="event.id"
            class="glide__slide"
          >
            <ZEvent
              :thumbnail="event.rest_media"
              :title="event.title && event.title.rendered"
              :to="`/wydarzenia/${event.slug}`"
              :author="event.rest_author"
              :date="event.rest_acf.date"
              :location="{name: 'Warszawa'}"
              :type="event.rest_event_type"
              :audiences="event.age_groups.map((ageGroup)=>(ageGroups[ageGroup]))"
            />
          </li>
        </template>
      </ZCarousel>
    </ZSection>
    <ZSection
      title="Partnerzy chorągwi"
      class="section-posts"
    >
      <ZCarousel
        v-if="logos.length > 0"
        style="--carousel-slides-padding: 0;"
        :settings="{
          breakpoints: {
            480: {
              perView: 1,
              peek: {
                before: 0,
                after: 20
              }
            }
          }
        }"
        class="section-posts__carousel"
      >
        <template v-for="logo in logos">
          <li
            :key="logo.id"
            class="glide__slide"
          >
            <ZImage
              :src="logo.rest_media"
              style="--image-height: 150px;"
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
  ZClipPath,
  ZText,
  ZLink,
  ZCard,
  ZBanner,
  ZPost,
  ZCarousel,
  ZEvent,
  ZImage
} from '@nowa-zhp/ui'

export default {
  components: {
    ZSection,
    ZHeading,
    ZClipPath,
    ZText,
    ZLink,
    ZCard,
    ZBanner,
    ZPost,
    ZCarousel,
    ZEvent,
    ZImage
  },
  async asyncData ({ $axios }) {
    const postsRes = await $axios.get('posts', { params: { per_page: 8, units: undefined } })
    const posts = postsRes.data
    const eventsRes = await $axios.get('events', { params: { per_page: 8, units: undefined } })
    const events = eventsRes.data
    // logos/38 = podkarpacka
    const logosRes = await $axios.get('logos', { params: { per_page: 99, units: 38 } })
    const logos = logosRes.data

    return { posts, events, logos }
  },
  data () {
    return {
      questions: [
        {
          id: '1',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/prv_75PW_MPW_MM116.jpg',
          title: 'Komenda Chorągwi',
          description: 'Sprawdź skład komendy Chorągwii Podkarpackiej',
          to: '#'
        },
        {
          id: '2',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/Weronika_Malachowska_ZHP_20180814BKK_2144-scaled.jpg',
          title: 'Wykazd hufców',
          description: 'Sprawdź skład komendy Chorągwii Podkarpackiej',
          to: '#'
        },
        {
          id: '3',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18-scaled.jpg',
          title: 'Rada Chorągwi',
          description: 'Rada Chorągwii odpowiada w szczególności za….',
          to: '#'
        },
        {
          id: '4',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-17-1-scaled.jpg',
          title: 'Zespół programowy',
          description: 'Rada Chorągwii odpowiada w szczególności za….',
          to: '#'
        },
        {
          id: '5',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12-scaled.jpg',
          title: 'Sąd Harcerski Chorągwi',
          to: 'Sprawdź skład komendy Chorągwii Podkarpackiej'
        },
        {
          id: '6',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/BBN180729_021.jpg',
          title: 'KSI Chorągwi',
          description: 'Sprawdź skład komendy Chorągwii Podkarpackiej',
          to: '#'
        },
        {
          id: '7',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/BBN180729_021.jpg',
          title: 'Dokumenty Chorągwi',
          description: 'Sprawdź skład komendy Chorągwii Podkarpackiej',
          to: '#'
        },
        {
          id: '8',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/BBN180729_021.jpg',
          title: 'Bazy obozowe',
          description: 'Sprawdź skład komendy Chorągwii Podkarpackiej',
          to: '#'
        },
        {
          id: '9',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/BBN180729_021.jpg',
          title: 'O nas w mediach',
          description: 'Rada Chorągwii odpowiada w szczególności za….',
          to: '#'
        }
      ]
    }
  },
  computed: {
    ageGroups () {
      return this.$store.getters['taxonomies/taxonomy']('age_groups')
    }
  },
  methods: {
    search (query) {
      this.$router.push({
        path: '/szukaj',
        query: { search: query }
      })
    }
  }
}
</script>

<style lang="scss">
#faq {
  overflow: hidden;

  .section-hero {
    &__picture {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 5;
        grid-row: span 2;
      }
    }

    &__title {
      margin: 0 0 1.5rem 0;
      grid-column: span 12;
      place-self: end stretch;

      @media (min-width: 480px) {
        grid-column: span 7;
      }
    }

    &__contact {
      grid-column: span 12;
      place-self: start stretch;

      @media (min-width: 480px) {
        grid-column: span 6;
      }
    }
  }

  .section-questions {
    &__question {
      grid-column: span 4;
    }
  }

  .section-join-us {
    &__banner {
      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 9;
      }
    }

    &__post {
      --post-grid-template-rows: 1fr auto;
      --post-meta-order: -1;

      grid-column: span 12;

      @media (min-width: 480px) {
        grid-column: span 3;
      }
    }
  }

  .section-posts {
    &__carousel {
      grid-column: span 12;
    }
  }
}
</style>
