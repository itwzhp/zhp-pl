<template>
  <div class="z-divider" />
</template>

<script>
export default {
  name: 'ZDivider',
};
</script>

<style lang="scss">
.z-divider {
  width: var(--divider-width, 15%);
  height: var(--divider-height, 3px);
  background: var(--divider-background, var(--color-primary));
}
</style>
