<template>
  <input
    v-model="state"
    class="z-input"
    :type="type"
    :value="value"
  >
</template>
<script>
export default {
  name: 'ZInput',
  model: {
    prop: 'input',
  },
  props: {
    input: {
      type: [String, Number, Boolean],
      default: '',
    },
    value: {
      type: [String, Number, Boolean],
      default: '',
    },
    type: {
      type: String,
      default: 'text',
    },
  },
  data() {
    return {
      state: this.input,
    };
  },
  watch: {
    state(value) {
      this.$emit('input', value);
    },
  },
};
</script>
<style lang="scss">
  .z-input {}
</style>
