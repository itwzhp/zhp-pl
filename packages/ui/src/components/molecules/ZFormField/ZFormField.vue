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
        <span v-if="required" class="z-form-field__required">Wymagane</span>
      </ZText>
    </slot>
    <slot
      name="input"
      v-bind="{id}"
    >
      <ZInput
        :id="id"
        v-bind="$attrs"
        class="z-form-field__input"
        @input="$emit('input', $event)"
      />
    </slot>
    <slot name="error" />
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
  inheritAttrs: false,
  props: {
    tag: {
      type: String,
      default: 'div',
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
    required() {
      return this.$attrs.required ? 'wymagane' : '';
    },
  },
};
</script>

<style lang="scss">
  .z-form-field {
    margin: var(--form-field-margin, 0 0 16px 0);

    &__label {
      display: flex;
      align-items: flex-start;
      margin: var(--form-field-label-margin, 0 0 8px 0);
      color: var(--form-field-label-color, #84a311);
      font-size: var(--form-field-label-font-size);
    }

    &__required {
      margin: 0 0 0 8px;
      opacity: 0.5;
    }

    &__error {
      margin: 4px 0 0 0;
      color: #e30613;
    }
  }
</style>
