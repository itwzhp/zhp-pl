<template>
  <component
    :is="tag"
    class="z-dropdown"
  >
    <slot
      name="toggle"
      v-bind="{isOpen, toggle}"
    >
      <ZButton
        class="z-dropdown__toggle"
        @click="toggle"
        v-text="name"
      />
    </slot>
    <slot
      name="content"
      v-bind="{isOpen, toggle}"
    >
      <div
        v-if="isOpen"
        v-click-outside="close"
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
      String,
      default: '',
    },
  },
  data() {
    return {
      isOpen: false,
    };
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
    z-index: 1;
    display: inline-block;

    &__toggle {
      position: relative;
      z-index: 1;

      --button-color: var(--dropdown-toggle-color, #fff);
      --button-background: var(--dropdown-toggle-background);
      --button-border: var(--dropdown-toggle-border, 0);
    }

    &__content {
      position: absolute;
      z-index: 0;
      width: var(--dropdown-content-width, 100%);
      padding: var(--dropdown-content-padding, 32px 16px);
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
          border-top: 5px solid var(--dropdown-toggle-color, #fff);
          border-right: 5px solid transparent;
          border-left: 5px solid transparent;
          margin: 0 0 0 8px;
          content: "";
        }
      }
    }
  }
</style>