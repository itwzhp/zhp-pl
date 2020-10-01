<script>
import Vue from 'vue/dist/vue.esm';
import ZButton from '../components/atoms/ZButton/ZButton.vue';

export default {
  components: { ZButton },
  props: {
    html: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      templateRender: undefined,
    };
  },
  watch: {
    html() {
      this.updateRender();
    },
  },
  created() {
    this.updateRender();
  },
  methods: {
    updateRender() {
      const compiled = Vue.compile(`<div>${this.html}</div>`);
      this.templateRender = compiled.render;
      this.$options.staticRenderFns = [];
      // eslint-disable-next-line no-restricted-syntax
      for (const staticRenderFns of compiled.staticRenderFns) {
        this.$options.staticRenderFns.push(staticRenderFns);
      }
    },
  },
  render() {
    return this.templateRender();
  },
};
</script>
