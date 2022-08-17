<template>
  <TheNavBar/>
  <div class="container-fluid">
    <div class="row">
      <TheSideBar/>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="">
          <router-view v-slot="slotProps">
            <transition mode="out-in" name="routing">
              <component :is="slotProps.Component"></component>
            </transition>
          </router-view>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import TheNavBar from "@/components/layout/TheNavBar";
import TheSideBar from "@/components/layout/TheSideBar";

export default {
  name: "PublicComponent",
  components: {
    TheNavBar, TheSideBar
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
.routing-enter-active {
  animation: fade 0.3s ease-out;
}
.routing-leave-active {
  animation: fade 0.3s ease-in reverse;
}
@keyframes fade {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>