<template>
  <textarea
    class="z-textarea"
    :value="value"
    @input="$emit('input', $event.target.value)"
  />
</template>

<script>
export default {
  name: 'ZTextarea',
  model: {
    prop: 'input',
  },
  props: {
    value: {
      type: [String, Number, Boolean],
      default: '',
    },
  },
};
</script>

<style lang="scss">
.z-textarea {
  width: var(--textarea-width, 100%);
  height: var(--textarea-height);
  padding: var(--textarea-padding, 16px);
  border: var(--textarea-border, 1px solid #a6ce39);
  background: var(--textarea-background, #fff);
  border-radius: var(--textarea-border-radius, 10px);
  box-shadow: none;
  color: var(--textarea-color, #1e152f);
  font: inherit;
  font-size: 0.75rem;

  &::placeholder {
    color: var(--textarea-color, #1e152f);
    font: inherit;
  }
}
</style>
