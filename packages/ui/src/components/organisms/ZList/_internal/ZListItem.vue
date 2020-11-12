<template>
  <li class="z-list-item">
    <slot />
  </li>
</template>

<script>
export default {
  name: 'ZListItem',
};
</script>

<style lang="scss">
.z-list-item {
  margin: 4px 0;
}
</style>
