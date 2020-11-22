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
        Wszystkie informacje dla rodziców w jednym miejscu
      </ZHeading>
      <ZSearch
        class="section-hero__search"
        :input="{placeholder: 'Masz jakieś pytania odnośnie ZHP?'}"
        @submit="search"
      />
    </ZSection>
    <ZSection
      title="Najczęściej zadawane pytania"
      subtitle="Zobacz o co najczęściej pytają rodzice harcerzy"
      class="section-questions"
    >
      <template v-for="question in questions">
        <ZCard
          :key="question.id"
          :thumbnail="question.thumbnail"
          :title="question.title"
          :to="question.to"
          class="z-card--pictured z-card--overlayed section-questions__question"
        />
      </template>
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
      title="Z życia ZHP"
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
  </div>
</template>

<script>
import {
  ZSection,
  ZHeading,
  ZClipPath,
  ZCard,
  ZBanner,
  ZPost,
  ZCarousel,
  ZSearch
} from '@nowa-zhp/ui'

export default {
  components: {
    ZSection,
    ZHeading,
    ZClipPath,
    ZCard,
    ZBanner,
    ZPost,
    ZCarousel,
    ZSearch
  },
  async asyncData ({ $axios }) {
    const postsRes = await $axios.get('posts', { params: { per_page: 8 } })
    const posts = postsRes.data
    return { posts }
  },
  data () {
    return {
      questions: [
        {
          id: '1',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/prv_75PW_MPW_MM116.jpg',
          title: 'W jakim wieku moje dziecko może dołączyć do ZHP?',
          to: '#'
        },
        {
          id: '2',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/Weronika_Malachowska_ZHP_20180814BKK_2144-scaled.jpg',
          title: 'Kim są instruktorzy ZHP?',
          to: '#'
        },
        {
          id: '3',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-18-scaled.jpg',
          title: 'Jak kupić pierwszy mundur harcerski?',
          to: '#'
        },
        {
          id: '4',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/fot.-ZHP-_-Karolina-Piotrowska-17-1-scaled.jpg',
          title: 'Jak przygotować dziecko do obozu letniego?',
          to: '#'
        },
        {
          id: '5',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/08/ZHP_WYLOT_JAMBOREE_2019_KAROLINA_PIOTROWSKA-12-scaled.jpg',
          title: 'Do jakiej drużyny zapisać dziecko?',
          to: '#'
        },
        {
          id: '6',
          thumbnail: 'https://demo.przemyslawspaczek.pl/wp-content/uploads/2020/09/BBN180729_021.jpg',
          title: 'Jak wspierać dziecko w zdobywaniu stopni i sprawności?',
          to: '#'
        }
      ]
    }
  },
  methods: {
    search (query) {
      this.$router.push({
        path: '/szukaj',
        query: { search: query }
      })
    }
  },
  head () {
    const title = 'Dla rodzica | Związek Harcerstwa Polskiego'
    const description = ''
    const image = 'https://zhp.pl/wp-content/uploads/2015/01/zhp_fb.png'
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

    &__search {
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
