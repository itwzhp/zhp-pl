<script>
import Vue from 'vue';
import ZAccordion from '../ZAccordion/ZAccordion.vue';

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
        template: this.html,
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
