<template>
  <div id="faq">
    <ZSection
      title="Dotacje i projekty realizowane w ZHP"
      class="section-subsidies"
    >
      <template v-for="question in questions">
        <ZCard
          :key="question.id"
          :thumbnail="question.thumbnail"
          :title="question.title"
          :description="question.description"
          :to="`/dotacje/${question.to}`"
          class="z-card--pictured z-card--overlayed section-subsidies__subsidie"
        />
      </template>
    </ZSection>
  </div>
</template>

<script>
import {
  ZSection,
  ZCard
} from '@zhp-pl/ui'

export default {
  components: {
    ZSection,
    ZCard
  },
  data () {
    return {
      questions: [
        {
          id: '233',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/11/harcerstwo-ksztalci-scaled.jpg`,
          title: 'Harcerstwo kształci',
          to: 'harcerstwo-ksztalci'
        },
        {
          id: '549',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/11/nic-o-nas-bez-nas-scaled.jpg`,
          title: 'Nic o nas bez nas',
          to: 'nic-o-nas-bez-nas'
        },
        {
          id: '545',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/11/rohis-w-ZHP-scaled.jpg`,
          title: 'ROHiS w ZHP',
          to: 'rohis-w-zhp'
        },
        {
          id: '547',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2020/11/harp-scaled.jpg`,
          title: 'Harcerska Akademia Rozwoju Pedagogicznego (HARP)',
          to: 'harp'
        },
        {
          id: '548',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2021/09/PFRON_wersja_podstawowa_RGB-01.jpg`,
          title: 'Dotacje PFRON',
          to: 'PFRON'
        },
        {
          id: '550',
          thumbnail: `${this.$config.mediaBaseURL}/wp-content/uploads/2023/11/01_znak_podstawowy_kolor_biale_tlo-1.png`,
          title: 'Laboratoria Przyszłości',
          to: 'laboratoria-przyszlosci'
        }
      ]
    }
  },
  head () {
    const title = 'Dotacje | Związek Harcerstwa Polskiego'
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

  .section-subsidies {
    &__subsidie {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span 4;
      }
    }
  }
}
</style>
