<template>
  <div class="z-modal">
    <transition name="fade">
      <div
        v-if="isVisible"
        class="z-modal__backdrop"
        @click="$emit('click:close')"
      />
    </transition>
    <transition name="slide">
      <dialog
        v-if="isVisible"
        class="z-modal__dialog"
      >
        <slot />
      </dialog>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'ZModal',
  props: {
    isVisible: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style lang="scss">
.z-modal {
  &__backdrop {
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.4;
  }

  &__dialog {
    position: fixed;
    z-index: 1000;
    top: 0;
    right: 0;
    bottom: 0;
    left: auto;
    display: block;
    overflow: auto;
    width: 100%;
    max-width: 480px;
    height: 100%;
    border: 0;
  }
}

.slide {
  &-enter-active,
  &-leave-active {
    transition: transform 300ms ease-in-out;
  }

  &-enter,
  &-leave-to {
    transform: translateX(100%);
  }
}

.fade {
  &-enter-active,
  &-leave-active {
    transition: opacity 300ms linear;
  }

  &-enter,
  &-leave-to {
    opacity: 0;
  }
}
</style>
