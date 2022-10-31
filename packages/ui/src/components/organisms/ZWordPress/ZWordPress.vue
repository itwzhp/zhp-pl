<script>
import Vue from 'vue';
import ZDivider from '../../atoms/ZDivider/ZDivider.vue';
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZAccordion from '../ZAccordion/ZAccordion.vue';
import ZSection from '../ZSection/ZSection.vue';
import ZCard from '../../molecules/ZCard/ZCard.vue';
import '@fortawesome/fontawesome-free/js/brands.min';
import '@fortawesome/fontawesome-free/js/solid.min';
import '@fortawesome/fontawesome-free/js/fontawesome.min';

Vue.component('ZDivider', ZDivider);
Vue.component('ZButton', ZButton);
Vue.component('ZLink', ZLink);
Vue.component('ZAccordion', ZAccordion);
Vue.component('ZSection', ZSection);
Vue.component('ZCard', ZCard)

export default {
  name: 'ZWordPress',
  props: {
    html: {
      type: String,
      default: ''
    },
  },
  computed: {
    htmlToRender() {
      const anchorPattern = /<a.*?href="(.*?)".*?>(.*?)<\/a>/gm;
      return this.html.replace(anchorPattern, (match, href, name) => {
        const isDownloadButton = match.search('wp-block-file__button') > -1;
        if (isDownloadButton){ // TODO: why?
          return `<z-button to="${href}">${name}</z-button>`; 
        }
        return `<z-link to="${href}">${name}</z-link>`;
      });
    },
    toRender() {
      return {
        name: 'WordPressContent',
        template: `<div>${this.htmlToRender}</div>`,
      };
    },
  },
  render(createElement) {
    return createElement(
      'div',
      { class: 'z-wordpress' },
      [createElement(this.toRender)],
    );
  },
};
</script>
<style lang="scss">
.z-wordpress {
  --section-padding: 0;
  --section-margin: 0;
  --button-height: auto;

  line-height: 1.4;
  margin: 0;

  .z-link {
    font-size: 1rem;
  }

  a:not(.z-button) {
    color: var(--color-primary);
  }

  p {
    margin: 1rem 0;
  }

  table {
    border-collapse: collapse;

    th,
    strong {
      color: var(--table-th-color, var(--color-primary));
      font-weight: 700;
    }

    th,
    td {
      padding: 0.5rem 1rem;
    }

    tr {
      border: solid #ddd;
      border-width: 1px 0 0 0;

      &:first-of-type {
        border-width: 0;
      }
    }
  }

  blockquote {
    position: relative;
    padding: 1rem 1rem 1rem 3rem;
    border: solid #cacaca;
    border-width: 4px 0;
    margin: 1rem 0;
    font-size: 1.125rem;
    font-style: italic;
    font-weight: 300;

    @media (min-width: 640px) {
      padding: 1rem 1rem 1rem 5rem;
      font-size: 1.25rem;
    }

    &::before {
      position: absolute;
      top: 1rem;
      left: 1rem;
      width: 1.5rem;
      height: 1.5rem;
      background: url('~assets/quote.svg');
      background-size: 100% 100%;
      content: "";

      @media (min-width: 640px) {
        width: 2.5rem;
        height: 2.5rem;
      }
    }

    p {
      margin: 0 0 1rem 0;
    }

    cite {
      font-size: 1.125rem;

      @media (min-width: 640px) {
        font-size: 1.25rem;
      }
    }
  }

  figure {
    margin: 0;
  }

  img {
    max-width: 100%;
    height: auto;
  }

  // headings
  h1 {
    font-size: 1.57rem;

    @media (min-width: 640px) {
      font-size: 2.125rem;
    }
  }

  h2 {
    font-size: 1.57rem;

    @media (min-width: 640px) {
      font-size: 2.125rem;
    }
  }

  h3 {
    font-size: 1.25rem;

    @media (min-width: 640px) {
      font-size: 1.75rem;
    }
  }

  h4 {
    font-size: 1.125rem;

    @media (min-width: 640px) {
      font-size: 1.5rem;
    }
  }

  h5 {
    font-size: 1rem;

    @media (min-width: 640px) {
      font-size: 1.25rem;
    }
  }

  h6 {
    font-size: 0.75rem;

    @media (min-width: 640px) {
      font-size: 1rem;
    }
  }

  .has-text-align-center {
    text-align: center;
  }

  .has-text-align-right {
    text-align: right;
  }

  .aligncenter {
    text-align: center;
  }

  .wp-block-file {
    display: flex;
    align-content: center;
    justify-content: space-between;
  }

  .wp-block-gallery {
    margin: 1.5rem 0;

    .blocks-gallery-grid {
      display: flex;
      flex-wrap: wrap;
      padding: 0;
      margin: -0.5rem 0 0 -0.5rem;
      list-style-type: none;
    }

    .blocks-gallery-item {
      padding: 0.5rem 0 0 0.5rem;

      &__caption {
        font-size: 0.75rem;
        font-weight: 300;
      }
    }

    @for $i from 1 through 6 {
      &.columns-#{$i} {
        .blocks-gallery-item {
          @media (min-width: 640px) {
            flex: 1 1 calc(100%/#{$i});
          }
        }
      }
    }
  }

  .icon {
    display: flex;
  }

  @for $i from 1 through 12 {
    .z-column-#{$i} {
      grid-column: span 12;

      @media (min-width: 640px) {
        grid-column: span #{$i};
      }
    }
  }

  .z-card--pictured {
    .z-card {
      &__title {
        color: #fff;
      }

      &__description {
        margin: 0;
      }
    }
  }
}
</style>
