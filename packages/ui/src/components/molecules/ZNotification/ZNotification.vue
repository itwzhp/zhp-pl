<template>
  <div class="z-notification">
    <div class="z-notification__content body-2">
      <slot />
    </div>
    <ZButton
      class="z-notification__close"
      @click="$emit('click:cancel')"
    >
      <ZIcon name="cross" />
    </ZButton>
  </div>
</template>

<script>
import ZButton from '../../atoms/ZButton/ZButton.vue';
import ZIcon from '../../atoms/ZIcon/ZIcon.vue';

export default {
  name: 'ZNotification',
  components: {
    ZButton,
    ZIcon,
  },
};
</script>

<style lang="scss">
.z-notification {
  display: flex;
  width: 320px;
  align-items: flex-start;
  padding: 16px;
  background: #7ba22e;
  border-radius: 10px;
  box-shadow: rgb(157 157 157 / 50%) 0 2px 4px 0;
  color: #fff;

  &__content {
    margin: 0 8px 0 0;
  }

  &__close {
    --button-background: transparent;
    --button-padding: 4px;
    --button-height: auto;
    --icon-color: #fff;

    margin: 0 0 0 auto;
  }

  &--error {
    background: #e30613;
  }
}
</style>
