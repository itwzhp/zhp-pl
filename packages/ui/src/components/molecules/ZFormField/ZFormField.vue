<template>
  <component
    :is="tag"
    class="z-form-field"
  >
    <slot name="label">
      <ZText
        v-if="label"
        :for="id"
        tag="label"
        class="z-form-field__label uppercase"
      >
        {{ label }}
      </ZText>
    </slot>
    <slot
      name="input"
      v-bind="{id}"
    >
      <ZInput
        :id="id"
        :type="type"
        class="z-form-field__input"
        @input="$emit('input', $event)"
      />
    </slot>
  </component>
</template>

<script>
import ZText from '../../atoms/ZText/ZText.vue';
import ZInput from '../../atoms/ZInput/ZInput.vue';

export default {
  name: 'ZFormField',
  components: {
    ZText,
    ZInput,
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    type: {
      type: String,
      default: 'text',
    },
    label: {
      type: String,
      default: '',
    },
    value: {
      type: String,
      default: '',
    },
  },
  computed: {
    id() {
      // eslint-disable-next-line no-underscore-dangle
      return this._uid;
    },
  },
};
</script>

<style lang="scss">
  .z-form-field {
    &__label {
      display: block;
      margin: 0 0 8px 0;
      color: var(--form-field-label-color, #84a311);
    }

    &__input {
      margin: 0 0 16px 0;
    }
  }
</style>
