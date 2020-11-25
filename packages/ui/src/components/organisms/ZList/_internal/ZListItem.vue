<template>
  <li
    class="z-list-item"
    v-on="$listeners"
  >
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
  margin: var(--list-item, 8px 0);
}
</style>
