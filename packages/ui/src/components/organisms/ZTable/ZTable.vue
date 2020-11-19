<template>
  <component
    :is="tag"
    class="z-table"
  >
    <slot />
  </component>
</template>

<script>
export default {
  name: 'ZTable',
  props: {
    tag: {
      type: String,
      default: 'table',
    },
  },
};
</script>

<style lang="scss">
.z-table {
  border-collapse: collapse;

  th,
  strong {
    color: var(--table-th-color, var(--color-primary));
    font-weight: 700;
  }

  th,
  td {
    padding: 0.5rem 1rem;
  }

  tr {
    border: solid #ddd;
    border-width: 1px 0 0 0;

    &:first-of-type {
      border-width: 0;
    }
  }
}
</style>
