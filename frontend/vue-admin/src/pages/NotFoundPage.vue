<template>
  <div class="content">
    <h2>Sorry, this page does not exists</h2>
    <h3>Go to <router-link :to="{name: 'dashboard'}">home page</router-link></h3>
  </div>
</template>

<script>
export default {
  name: "NotFoundPage"
}
</script>

<style scoped>
.content {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  justify-content: center;
}
</style>