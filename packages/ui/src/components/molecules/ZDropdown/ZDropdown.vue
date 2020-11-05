<template>
  <component
    :is="tag"
    v-click-outside="close"
    class="z-dropdown"
  >
    <slot
      name="toggle"
      v-bind="{isOpen, toggle}"
    >
      <ZButton
        class="z-dropdown__toggle"
        @click="toggle"
      >
        {{ name }}
      </ZButton>
    </slot>
    <slot
      name="content"
      v-bind="{isOpen, toggle}"
    >
      <div
        v-if="isOpen"
        class="z-dropdown__content"
      >
        <slot v-bind="{isOpen, toggle}" />
      </div>
    </slot>
  </component>
</template>

<script>
import ZButton from '../../atoms/ZButton/ZButton.vue';
import { clickOutside } from '../../../directives';

export default {
  name: 'ZDropdown',
  components: { ZButton },
  directives: { clickOutside },
  props: {
    tag: {
      type: String,
      default: 'div',
    },
    name: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      isOpen: false,
    };
  },
  watch: {
    isOpen(isOpen) {
      if (isOpen) {
        this.$emit('update:open');
      } else {
        this.$emit('update:close');
      }
    },
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
    },
    close() {
      this.isOpen = false;
    },
  },
};
</script>

<style lang="scss">
  .z-dropdown {
    $this: &;

    position: relative;
    z-index: 100;
    display: inline-block;

    &__toggle {
      --button-color: #fff;
      --button-border: 0;

      position: relative;
      z-index: 1;
    }

    &__content {
      position: absolute;
      z-index: 0;
      top: var(--dropdown-content-top);
      width: var(--dropdown-content-width, 100%);
      padding: var(--dropdown-content-padding, 32px 8px 16px 8px);
      margin: var(--dropdown-content-margin);
      background: var(--dropdown-content-background, #f7f7f7);
      border-radius: var(--dropdown-content-border-radius, 0 0 10px 10px);
      box-shadow: var(--dropdown-content-box-shadow, 5px 10px 20px 0 rgba(0, 0, 0, 0.13));
      transform: var(--dropdown-content-transform, translateY(-10px));
    }

    &--has-chevron {
      #{$this}__toggle {
        &::after {
          width: 0;
          height: 0;
          border-top: 5px solid var(--button-color, #fff);
          border-right: 5px solid transparent;
          border-left: 5px solid transparent;
          margin: 0 0 0 8px;
          content: "";
        }
      }
    }
  }
</style>
