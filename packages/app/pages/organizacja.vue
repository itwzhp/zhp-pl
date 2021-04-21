<template>
  <div id="faq">
    <ZSection
      title="Organizacja"
      subtitle=""
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
    <ZSection class="section-join-us">
      <ZBanner
        :thumbnail="{src: `${$config.mediaBaseURL}/wp-content/uploads/2020/12/Agnieszka_Madetko-Kurczab_ZHP.jpg`}"
        title="Chcesz zapisać swoje dziecko do harcerstwa?"
        content="Harcerstwo to nie tylko niesamowita przygoda, ale także możliwość zdobycia sprawności na całe życie. Chcesz, aby Twoje dziecko wkroczyło z nami na szlak? Tutaj znajdziesz najważniejsze informacje."
        :calls-to-action="[
          {name:'No to zaczynamy', to: '/no-to-zaczynamy'},
          {name:'Ile kosztuje harcerstwo?', to: '/ile-kosztuje-harcerstwo'},
          {name:'Gdzie się zapisać?', to: '/gdzie-sie-zapisac'}]"
        class="section-join-us__banner"
      />
      <ZPost
        v-if="cards['>>>']"
        :title="cards['>>>'].title.rendered"
        :thumbnail="cards['>>>']._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url"
        :to="cards['>>>'].rest_redirect ? cards['>>>'].rest_redirect :`/${cards['>>>'].date.split('-')[0]}/${cards['>>>'].slug}`"
        :date="cards['>>>'].date"
        class="section-join-us__post"
      />
    </ZSection>
  </div>
</template>

<script>
import {
  ZSection,
  ZCard,
  ZBanner,
  ZPost
} from '@zhp-pl/ui'
import { mapGetters } from 'vuex'

export default {
  components: {
    ZSection,
    ZCard,
    ZBanner,
    ZPost
  },
  data () {
    return {
      questions: [
        {
          id: '315',
          title: 'Naczelnik ZHP',
          to: '/naczelnik-zhp'
        },
        {
          id: '312',
          title: 'Główna Kwatera ZHP',
          to: '/glowna-kwatera-zhp'
        },
        {
          id: '5765',
          title: 'Przewodniczący ZHP',
          to: '/przewodniczacy-zhp'
        },
        {
          id: '328',
          title: 'Rada Naczelna ZHP',
          to: '/rada-naczelna-zhp'
        },
        {
          id: '316',
          title: 'Centralna Komisja Rewizyjna ZHP',
          to: '/ckr'
        },
        {
          id: '57696',
          title: 'Naczelny Sąd Harcerski ZHP',
          to: '/nsh'
        },
        {
          id: '507',
          title: 'Statut ZHP',
          to: '/statut-zhp'
        }
      ]
    }
  },
  computed: {
    ...mapGetters({
      cards: 'cards/posts'
    })
  },
  head () {
    const title = 'Członkowie organizacji |  Związek Harcerstwa Polskiego'
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

  .section-questions {
    &__question {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 4;
      }

      @media (min-width: 768px) {
        grid-column: span 3;
      }
    }
  }

  .section-join-us {
    &__banner {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 9;
      }
    }

    &__post {
      --post-grid-template-rows: 1fr auto;
      --post-meta-order: -1;

      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 3;
      }
    }
  }
}
</style>
