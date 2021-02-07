<template>
  <div class="z-modal">
    <div v-if="isVisible" class="z-modal__backdrop" />
    <dialog v-if="isVisible" class="z-modal__dialog">
      <div class="z-modal__content">
        <slot />
      </div>
    </dialog>
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
    top: 50%;
    right: auto;
    left: 50%;
    display: block;
    overflow: auto;
    width: 480px;
    height: 80vh;
    padding: 16px;
    border: 0;
    border-radius: 10px;
    transform: translate(-50%, -50%);
  }

  // &__content {}
}
</style>
