<template>
  <div id="faq">
    <ZSection
      title="Członkowie organizacji"
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
  </div>
</template>

<script>
import {
  ZSection,
  ZCard,
  ZBanner,
  ZPost
} from '@nowa-zhp/ui'

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
          id: '233',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/10/ZUCHY-ZHP_NatGeoKids_Konrad_Kmieć-4075-scaled.jpg`,
          title: 'Zuchy',
          description: 'Dzieci w wieku 6-10 lat',
          to: '/zuchy'
        },
        {
          id: '235',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/10/HARCERZE-ZHP_HARCERSKIE_LATO_2019_KAROLINA_PIOTRIOWSKA_-232-scaled.jpg`,
          title: 'Harcerze',
          description: 'Dzieci w wieku 10-13 lat',
          to: '/harcerze'
        },
        {
          id: '239',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/10/HS-ZHP_harcerskielato_lipiec_2019_Konrad_Kmieć-3370-scaled.jpg`,
          title: 'Harcerze starsi',
          description: 'Młodzież w wieku 13-16 lat',
          to: '/harcerze-starsi'
        },
        {
          id: '241',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/10/WĘDRO-Karolina_Pośnik_ZHP_20180807__DSC5370-scaled.jpg`,
          title: 'Wędrownicy',
          description: 'Młodzież w wieku 16-21 lat',
          to: '/wedrownicy'
        },
        {
          id: '243',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/10/AKADEMICY-Zlot_Kadry_2019_Piotr_Rodzoch_DSC5813-scaled.jpg`,
          title: 'Akademicy',
          to: '/akademicy'
        },
        {
          id: '245',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/10/NS-scaled.jpg`,
          title: 'Nieprzetarty Szlak',
          description: 'Dzieci i młodzież z niepełnosprawnościami',
          to: '/nieprzetarty-szlak'
        },
        {
          id: '247',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/10/Agnieszka_Madetko-Kurczab_34-1.jpg`,
          title: 'Dorośli w harcerstwie',
          to: '/dorosli-w-harcerstwie'
        }
      ]
    }
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
}
</style>
