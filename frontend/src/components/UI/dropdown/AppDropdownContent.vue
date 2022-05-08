<template>
  <ul
      class="dropdown-menu dropdown-menu-dark dropdown-menu-macos mx-0 border-0 shadow content"
      style="width: 220px;"
      v-if="active">
    <slot/>
  </ul>
</template>

<script>
export default {
  name: "AppDropdownContent",
  inject: ['sharedState'],
  computed: {
    active() {
      return this.sharedState.active
    }
  }
}
</script>

<style scoped>
.content {
  position: absolute;
  margin-top: 10px;
}
</style>