<template>
<TransitionGroup>
  <slot></slot>
</TransitionGroup>
</template>

<script>
export default {
  name: "AppListPopup"
}
</script>

<style scoped>
.v-enter-from {
  opacity: 0;
  transform: translateX(-30px);
}
.v-enter-active {
  transition: all 0.8s ease-in;
}
.v-enter-to,
.v-leave-from
{
  opacity: 1;
  transform: translateX(0)
}
.v-leave-active {
  transition: all 0.8s ease-out;
}
.v-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>