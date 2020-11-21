<script>
import Vue from 'vue';

// hack for components available in WordPress
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZAccordion from '../ZAccordion/ZAccordion.vue';

Vue.component('ZButton', ZButton);
Vue.component('ZAccordion', ZAccordion);

export default {
  name: 'ZWordPress',
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    html: {
      type: String,
      default: '',
    },
  },
  computed: {
    component() {
      return {
        template: `<div class="z-word-press">${this.html}</div>`,
      };
    },
  },
  render(createElement) {
    return createElement(
      'div',
      [createElement(this.component)],
    );
  },
};
</script>

<style lang="scss">
.z-word-press {
  line-height: 1.4;

  p {
    margin: 1rem 0;
  }

  figure {
    margin: 0;
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
    display: inline-flex;
    padding: 1rem;
    border: solid #cacaca;
    border-width: 4px 0;
    margin: 0;
    font-style: italic;
    font-weight: 300;
    &::before {
      width: 45px;
      height: 45px;
      background: url('~assets/quote.svg');
      background-size: 100% 100%;
      content: "";
    }
  }

  img { max-width: 100%; height: auto; }

  a:not(.z-button) {
    color: var(--color-primary);
  }
}
</style>
