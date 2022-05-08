<template>
  <div class="app">
    <router-view></router-view>
  </div>
</template>

<script>
import NavBar from "@/components/NavBar";
import SideBar from "@/components/SideBar";

export default {
  components: {
    NavBar,
    SideBar
  }
}
</script>

<style>
body {
  font-size: .875rem;
}

</style>
