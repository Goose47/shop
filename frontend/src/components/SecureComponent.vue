<template>
  <NavBar></NavBar>
  <div class="container-fluid">
    <div class="row">
      <SideBar></SideBar>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="">
          <router-view></router-view>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import NavBar from "@/components/NavBar";
import SideBar from "@/components/SideBar";

export default {
  name: "SecureComponent",
  components: {
    NavBar, SideBar
  }
}
</script>

<style>
.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}
.page_title {
  margin-top: 2px;
  margin-bottom: 2px;
}
</style>