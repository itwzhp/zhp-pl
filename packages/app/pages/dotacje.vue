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
          :to="question.to"
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
} from '@nowa-zhp/ui'

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
          thumbnail: 'https://prod.przemyslawspaczek.pl/wp-content/uploads/2020/11/harcerstwo-ksztalci-scaled.jpg',
          title: 'Harcerstwo kształci',
          to: '/harcerstwo-kształci'
        },
        {
          id: '549',
          thumbnail: 'https://prod.przemyslawspaczek.pl/wp-content/uploads/2020/11/nic-o-nas-bez-nas-scaled.jpg',
          title: 'Nic o nas bez nas',
          to: '/nic-o-nas-bez-nas'
        },
        {
          id: '545',
          thumbnail: 'https://prod.przemyslawspaczek.pl/wp-content/uploads/2020/11/rohis-w-ZHP-scaled.jpg',
          title: 'ROHiS w ZHP',
          to: '/rohis-w-zhp'
        },
        {
          id: '547',
          thumbnail: 'https://prod.przemyslawspaczek.pl/wp-content/uploads/2020/11/harp-scaled.jpg',
          title: 'Harcerska Akademia Rozwoju Pedagogicznego (HARP)',
          to: '/harp'
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
      grid-column: span 4;
    }
  }
}
</style>
