<template>
  <div class="z-textarea">
    <textarea
      class="z-textarea__input"
      :value="input"
      @input="updateHandler"
      @keydown="prevent"
    />
    <div
      v-if="hasMax"
      class="z-textarea__counter caption"
    >
      {{ toMax }} znaków
    </div>
  </div>
</template>

<script>
export default {
  name: 'ZTextarea',
  model: {
    prop: 'input',
  },
  props: {
    input: {
      type: [String, Number, Boolean],
      default: '',
    },
    max: {
      type: Number,
      default: 0,
    },
  },
  computed: {
    hasMax() {
      return this.max > 0;
    },
    toMax() {
      return this.max - this.input.length;
    },
  },
  methods: {
    prevent(event) {
      if (this.toMax <= 0 && event.key.length === 1) {
        event.preventDefault();
      }
    },
    updateHandler(event) {
      const { value } = event.target;
      this.$emit('input', value.slice(0, this.max));
    },
  },
};
</script>

<style lang="scss">
.z-textarea {
  &__input {
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

  &__counter {
    text-align: right;
  }
}
</style>
