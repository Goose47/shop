<template>
  <Transition>
    <slot></slot>
  </Transition>
</template>

<script>
export default {
  name: "AppPopup"
}
</script>

<style scoped>
.v-enter-active {
  animation: popup 0.8s ease-out;
}

.v-leave-active {
  animation: popup 0.8s ease-in reverse;
}
@keyframes popup {
  from {
    opacity: 0;
    transform: translateY(-50px) scale(0.9);
  }
  to {
    opacity: 1;
    transform: translateY(0px) scale(1);
  }
}
</style>