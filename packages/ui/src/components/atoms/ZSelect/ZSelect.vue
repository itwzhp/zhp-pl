<template>
  <select
    v-model="state"
    class="z-select"
  >
    <slot>
      <option
        v-for="(option, key) in options"
        :key="key"
        :value="option.value"
      >
        {{ option.content }}
      </option>
    </slot>
  </select>
</template>
<script>
export default {
  name: 'ZSelect',
  model: {
    prop: 'selected',
    event: 'change',
  },
  props: {
    selected: {
      type: String,
      default: '',
    },
    options: {
      type: Array,
      default: () => ({}),
    },
  },
  data() {
    return {
      state: this.selected,
    };
  },
  watch: {
    state(value) {
      this.$emit('change', value);
    },
  },
};
</script>
<style lang="scss">
  .z-select {}
</style>
