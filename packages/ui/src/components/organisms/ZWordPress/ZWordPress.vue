<script>
import Vue from 'vue';

// hack for components available in WordPress
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZAccordion from '../ZAccordion/ZAccordion.vue';

Vue.component('ZAccordion', ZAccordion);
Vue.component('ZButton', ZButton);

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
        template: `<div>${this.html}</div>`,
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
}
</style>
