<template>
  <component
    :is="tag"
    class="z-bubble caption"
    :class="{'z-bubble--is-checked': isChecked, 'z-bubble--is-badge': !isFilter}"
  >
    <input
      v-if="isFilter"
      :id="id"
      v-outline
      :checked="isChecked"
      type="checkbox"
      class="hidden"
      @input="changeHandler"
    >
    <div
      v-if="hasCross"
      class="z-bubble__uncheck"
    >
      <ZIcon name="cross" />
    </div>
    <ZText
      :for="isFilter ? id: undefined"
      :tag="isFilter ? 'label' : 'span'"
      class="z-bubble__label"
    >
      <slot />
    </ZText>
  </component>
</template>

<script>
import { outline } from '../../../directives';
import ZIcon from '../ZIcon/ZIcon.vue';
import ZText from '../ZText/ZText.vue';

export default {
  name: 'ZBubble',
  directives: {
    outline,
  },
  components: {
    ZText,
    ZIcon,
  },
  model: {
    prop: 'checked',
    event: 'change',
  },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    type: {
      type: String,
      default: 'badge',
    },
    checked: {
      type: [Boolean, Array],
      default: false,
    },
    value: {
      type: [String, Number],
      default: '',
    },
  },
  computed: {
    id() {
      // eslint-disable-next-line no-underscore-dangle
      return this._uid;
    },
    isFilter() {
      return this.type === 'filter' || this.type === 'filter-no-cross';
    },
    hasCross() {
      return this.type === 'filter';
    },
    isChecked() {
      return typeof this.checked === 'boolean'
        ? this.checked
        : this.checked.includes(this.value);
    },
  },
  methods: {
    changeHandler() {
      if (typeof this.checked === 'boolean') {
        this.$emit('change', !this.checked);
      } else if (this.checked.includes(this.value)) {
        this.$emit('change', this.checked.filter((item) => (item !== this.value)));
      } else {
        this.$emit('change', [...this.checked, `${this.value}`]);
      }
    },
  },
};
</script>

<style lang="scss">
  .z-bubble {
    $this: &;

    --text-margin: 0;

    position: relative;

    &:focus-within {
      --bubble-label-outline: 1px auto -webkit-focus-ring-color;
    }

    &__uncheck {
      --icon-size: 4px;
      --icon-color: #fff;

      position: absolute;
      top: 50%;
      left: 8px;
      display: grid;
      width: 14px;
      height: 14px;
      align-items: center;
      justify-content: center;
      background: #a6ce39;
      border-radius: 50%;
      outline: var(--bubble-uncheck-outline);
      pointer-events: none;
      transform: translateY(-50%) scale(var(--bubble-uncheck-scale, 0));
    }

    &__label {
      display: block;
      overflow: hidden;
      min-width: var(--bubble-label-min-width, 72px);
      height: var(--bubble-label-height, 24px);
      padding: var(--bubble-label-padding, 0 8px);
      border: var(--bubble-label-border, 1px solid #a6ce39);
      background: var(--bubble-label-background, var(--background, #fff));
      border-radius: var(--bubble-label-border-radius, 10px);
      color: var(--bubble-label-color, var(--color));
      cursor: pointer;
      line-height: var(--bubble-label-height, 24px) !important;
      outline: var(--bubble-label-outline);
      text-align: center;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    &--is-checked {
      --bubble-uncheck-scale: 1;
      --bubble-label-padding: 0 8px 0 26px;
      --bubble-label-background: #78a22f;
      --bubble-label-color: #fff;
      --bubble-label-border: 1px solid #78a22f;

      &:focus-within {
        --bubble-uncheck-outline: 1px auto -webkit-focus-ring-color;
        --bubble-label-outline: none;
      }
    }

    &--is-badge {
      --bubble-label-border: 0;
      #{$this}__label {
        cursor: default;
      }
    }

    &--no-cross {
      &#{$this}--is-checked {
        #{$this}__label {
          --bubble-label-padding: 0 8px;
        }
      }
    }
  }

  .hidden {
    position: absolute;
    overflow: hidden;
    width: 1px;
    height: 1px;
    clip: rect(1px, 1px, 1px, 1px);
    clip-path: inset(100%);
    white-space: nowrap;
  }
</style>
