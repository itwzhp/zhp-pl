<script>
import Vue from 'vue';
// eslint-disable-next-line
import Fragment from 'vue-fragment';
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZLink from '../../atoms/ZLink/ZLink.vue';
import ZAccordion from '../ZAccordion/ZAccordion.vue';

Vue.component('ZButton', ZButton);
Vue.component('ZLink', ZLink);
Vue.component('ZAccordion', ZAccordion);

function isSlot(element) {
  return element === null;
}
function gutenbergToHTML(block) {
  const { innerBlocks } = block;
  const blocks = [];
  while (innerBlocks.length > 0) {
    blocks.push(gutenbergToHTML(innerBlocks.shift()));
  }
  let index = 0;
  return block.innerContent
    .map((element) => {
      if (isSlot(element)) {
        const slot = blocks[index];
        index += 1;
        return slot;
      }
      return element;
    })
    .join('')
    .replace(/\n/gm, '');
}

export default {
  name: 'ZWordPress',
  components: {
    ZButton,
    ZLink,
    ZAccordion,
  },
  props: {
    html: {
      type: String,
      default: '',
    },
    gutenberg: {
      type: Array,
      default: () => ([]),
    },
  },
  computed: {
    hasGutenberg() {
      return this.gutenberg.length > 0;
    },
    gutenbergToRender() {
      const html = this.gutenberg
        .filter((block) => block.blockName)
        .map((block) => gutenbergToHTML(block))
        .join('');
      const anchorPattern = /<a.+?href="(.+?)">(.+?)<\/a>/gm;
      return html.replace(anchorPattern, (match, href, name) => (`<z-link to="${href}">${name}</z-link>`));
    },
    htmlToRender() {
      const anchorPattern = /<a.+?href="(.+?)">(.+?)<\/a>/gm;
      return this.html.replace(anchorPattern, (match, href, name) => (`<z-link to="${href}">${name}</z-link>`));
    },
    toRender() {
      return {
        name: 'WordPressContent',
        template: `<fragment>${this.hasGutenberg ? this.gutenbergToRender : this.htmlToRender}</fragment>`,
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
  line-height: 1.4;

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

  // temporary
  .wp-block-columns {
    @media (min-width: 640px) {
      display: grid;
      grid-auto-flow: column;
      grid-gap: 1.25rem;
    }
  }
}
</style>
