<template>
  <div class="z-modal">
    <div
      v-if="isVisible"
      class="z-modal__backdrop"
      @click="$emit('click:close')"
    />
    <dialog
      v-if="isVisible"
      class="z-modal__dialog"
    >
      <slot />
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
    display: flex;
    width: calc(100% - 40px);
    max-width: 480px;
    max-height: 568px;
    align-items: center;
    justify-content: center;
    border: 0;
    transform: translate(-50%, -50%);

    @media (min-width: 640px) {
      border-radius: 10px;
    }
  }
}
</style>
